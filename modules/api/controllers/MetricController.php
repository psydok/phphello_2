<?php

namespace app\modules\api\controllers;

use app\modules\api\models\Metric;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Response;
use yii\helpers\Url;
use function Amp\Iterator\map;
use function GuzzleHttp\Psr7\copy_to_string;
use function GuzzleHttp\Psr7\str;

class MetricController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    /**
     * GET request on input metric with condition WHERE
     * @return array data of metric from db
     */
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $request = Yii::$app->request;
//        $dataProvider = new ActiveDataProvider([
//            'query' => Metric::find(),
//            'pagination' => array('pageSize' => 10),
//        ]);
        $name = $request->getBodyParam('name');
        $field = $request->getBodyParam('field');
        $value = $request->getBodyParam('value');

        $params = array();

        if (!is_null($name))
            $params['name'] = $name;

        if (!is_null($field))
            $params['field'] = $field;

        if (!is_null($value))
            $params['value'] = $value;

//       var_dump($params);

        $metric = Metric::find()->where($params)->all();

        if (count($metric) > 0) {
            return array('status' => true, 'data' => $metric);
        }

        return array('status' => false, 'data' => 'No data found');
    }

    /**
     * POST request on input metric
     * @return array with info about status operation
     */
    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $metric = new Metric();
        $metric->scenario = Metric::SCENARIO_CREATE;
        $metric->attributes = Yii::$app->request->post();

        if ($metric->validate()) {
            $metric->add();

            return array('status' => true, 'data' => 'Metric created successfully');
        }
        
        return array('status' => false, 'data' => $metric->getErrors());
    }

}
