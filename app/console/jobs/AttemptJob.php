<?php
namespace console\jobs;

use Yii;
use yii\base\BaseObject;
use yii\queue\JobInterface;
use common\models\HttpResource;
use common\models\Attempt;
use yii\db\Expression;
use Exception;
use Throwable;

class AttemptJob extends BaseObject implements JobInterface
{
    public $http_resource_id;
    
    public function execute($queue)
    {
        $httpResource = HttpResource::find()->where(['id' => $this->http_resource_id])->one();

        $ch = curl_init($httpResource->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $attempt = new Attempt();
            $attempt->http_resource_id = $httpResource->id;
            $attempt->http_code = $httpCode;
            $attempt->response = $response;
            $attempt->number = $httpResource->getAttempts()->count() + 1;
            $attempt->insert();

            if ($response === false || $httpCode === 0 || $httpCode >= 400) {
                $httpResource->fails++;
            }
            else {
                $httpResource->fails = 0;
            }
            $httpResource->attempted_at = new Expression('NOW()');
            $httpResource->save();

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
}