<?php

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\data\Pagination;
use common\models\HttpResource;

/**
 * HttpResource controller
 */
class HttpresourcesController extends Controller
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
     * Displays HTTP resources.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $httpResources = HttpResource::find()->orderBy(['created_at' => SORT_DESC]);

        $pagination = new Pagination([
            'defaultPageSize' => 50,
            'totalCount' => $httpResources->count()
        ]);

        return $this->render('index', [
            'httpResources' => $httpResources->offset($pagination->offset)->limit($pagination->limit)->all(),
            'pagination' => $pagination,
        ]);
    }

    /**
     * Display HTTP resource.
     *
     * @return string
     */
    public function actionHttpresource()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $httpResource = HttpResource::find()->where(['id' => Yii::$app->request->get()['id']])->one();

        $attempts = $httpResource->getAttempts()->orderBy(['created_at' => SORT_DESC]);

        $pagination = new Pagination([
            'defaultPageSize' => 25,
            'totalCount' => $attempts->count()
        ]);

        return $this->render('httpResource', [
            'httpResource' => $httpResource,
            'attempts' => $attempts->offset($pagination->offset)->limit($pagination->limit)->all(),
            'pagination' => $pagination,
        ]);
    }
}
