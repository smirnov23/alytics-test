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
class TestController extends Controller {

    public function actionIndex() {
        if (!Yii::$app->mutex->acquire("console-attempts-mutex")) {
            return;
        }

        echo HttpResource::find()
            ->where([
                'or',
                ['attempted_at' => null],
                [
                    'and',
                    ['or', ['fails' => 0], 'fails < fail_limit'],
                    [
                        '>=',
                        new Expression('round(extract(epoch from now() - attempted_at))'),
                        new Expression('attempt_frequency * 60')
                    ],
                    [
                        'or',
                        ['fails' => 0],
                        [
                            '>=',
                            new Expression('round(extract(epoch from now() - attempted_at))'),
                            new Expression('fail_delay * 60')
                        ]
                    ]
                ]
            ])
            ->with('attempts')
            ->createCommand()
            ->getRawSql()
        ;
    }
}