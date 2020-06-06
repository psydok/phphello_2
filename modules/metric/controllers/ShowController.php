<?php

namespace app\modules\metric\controllers;

use app\modules\metric\models\Metric;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Default controller for the `metric` module
 */
class ShowController extends Controller
{
    /**
     * Renders the list show for the module
     * @return string
     */
    public function actionList()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Metric::find()
        ]);

        return $this->render('list', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
