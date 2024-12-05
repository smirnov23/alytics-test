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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
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
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $attempts = Attempt::find()->with('httpResource')->orderBy(['created_at' => SORT_DESC]);

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
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('attempt', [
            'attempt' => Attempt::find()->where(['id' => Yii::$app->request->get()['id']])->one(),
        ]);
    }
}
