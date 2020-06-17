<?php

namespace app\modules\api\controllers;

use app\modules\metric\models\Metric;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\rest\IndexAction;


class MetricController extends \yii\rest\Controller
{
    public $modelClass = 'app\modules\metric\models\Metric';

    /**
     * GET request on input
     * @return string
     */
    public function actionIndex()
    {
        $query = Metric::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }
    
    /** @inheritDoc */
    public function actions()
    {
        $actions = [
            'index' => [
                'class' => IndexAction::class,
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => function () {
                    $model = new Metric();
                    return $model::find()->where(Yii::$app->request->queryParams)->all();
                },
            ],
        ];

        return array_merge(parent::actions(), $actions);
    }

    /**
     * POST request on input metric
     * @return Metric
     */
    public function actionCreate()
    {
        $data = Yii::$app->request->getBodyParams();

        $model = new Metric();

        if ($model->load($data, '') && $model->validate()) {
            if ($model->add()) {
                Yii::$app->response->setStatusCode(201);
            }
        }

        return $model;
    }

    /** @inheritDoc */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
//
//        $behaviors['authenticatior'] = [
//            'class' => HttpBearerAuth::class,
//        ];

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true, //разрешить всех
                    'roles' => ['@'],//всех, кто авторизирован
                ],
            ],
        ];

        return $behaviors;
    }
}
