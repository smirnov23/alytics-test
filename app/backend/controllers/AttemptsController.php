<?php

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\data\Pagination;
use common\models\Attempt;

/**
 * Attempts controller
 */
class AttemptsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'attempt'],
                'rules' => [
                    [
                        'actions' => ['index', 'attempt'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['get'],
                    'attempt' => ['get'],
                ],
            ],
        ];
    }

    /**
     * Displays attempts.
     *
     * @return string
     */
    public function actionIndex()
    {
        $attempts = Attempt::find()->with('httpResource')->orderBy(['id' => SORT_DESC]);

        $pagination = new Pagination([
            'defaultPageSize' => 50,
            'totalCount' => $attempts->count()
        ]);

        return $this->render('index', [
            'attempts' => $attempts->offset($pagination->offset)->limit($pagination->limit)->all(),
            'pagination' => $pagination,
        ]);
    }

    /**
     * Display attempt.
     *
     * @return string
     */
    public function actionAttempt()
    {
        return $this->render('attempt', [
            'attempt' => Attempt::find()->where(['id' => Yii::$app->request->get()['id']])->one(),
        ]);
    }
}
