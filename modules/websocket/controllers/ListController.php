<?php


namespace app\modules\websocket\controllers;

use yii\web\Controller;

class ListController extends Controller
{
    public function actionIndex() {
        return $this->render('index');
    }
}