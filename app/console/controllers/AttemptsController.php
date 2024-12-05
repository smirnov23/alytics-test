<?php
namespace console\controllers;

use yii\console\Controller;
use common\models\HttpResource;
use common\models\Attempt;


/**
 * Attempts controller
 */
class AttemptsController extends Controller {

    public function actionIndex() {
        $httpResources = HttpResource::find()->all();
        foreach ($httpResources as $httpResource) {
            $ch = curl_init($httpResource->url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            $now = time();
            $attempt = new Attempt();
            $attempt->http_resource_id = $httpResource->id;
            $attempt->http_code = $httpCode;
            $attempt->response = $response;
            $attempt->number = 1;
            $attempt->created_at = $now;
            $attempt->updated_at = $now;
            $attempt->insert();
        }
    }
}