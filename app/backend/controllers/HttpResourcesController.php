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
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'httpresource'],
                'rules' => [
                    [
                        'actions' => ['index', 'httpresource'],
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
     * Displays HTTP resources.
     *
     * @return string
     */
    public function actionIndex()
    {
        $httpResources = HttpResource::find()->orderBy(['id' => SORT_DESC]);

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
        $httpResource = HttpResource::find()->where(['id' => Yii::$app->request->get()['id']])->one();

        $attempts = $httpResource->getAttempts()->orderBy(['id' => SORT_DESC]);

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
