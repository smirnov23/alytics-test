<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use console\jobs\AttemptJob;
use common\models\HttpResource;
use yii\db\Expression;


/**
 * Attempts controller
 */
class AttemptsController extends Controller {

    public function actionIndex() {
        if (!Yii::$app->mutex->acquire("console-attempts-mutex")) {
            return;
        }

        $httpResources = HttpResource::find()
            ->where([
                'or',
                ['attempted_at' => null],
                [
                    'and',
                    ['or', ['fails' => 0], 'fails < fail_limit'],
                    [
                        '>=',
                        new Expression('extract(epoch from now() - attempted_at)'),
                        new Expression('attempt_frequency * 60 - 10')
                    ],
                    [
                        'or',
                        ['fails' => 0],
                        [
                            '>=',
                            new Expression('extract(epoch from now() - attempted_at)'),
                            new Expression('fail_delay * 60 - 10')
                        ]
                    ]
                ]
            ])
            ->all()
        ;

        foreach ($httpResources as $httpResource) {
            Yii::$app->queue->push(new AttemptJob([
                'http_resource_id' => $httpResource->id
            ]));
        }
    }
}