<?php

namespace app\modules\admin\controllers;

use app\models\User;
use app\modules\user\models\SignupForm;
use Yii;

class AdminController extends \yii\web\Controller
{
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'User created');
            return $this->redirect(['admin/index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = User::findOne($id);
        $model->delete();
        Yii::$app->session->setFlash('success', 'User has been deleted');

        return $this->redirect(['admin/index']);
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $usersList = User::find()->all();

        return $this->render('index', [
            'usersList' => $usersList,
        ]);
    }

    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = User::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'User has been updated');
            return $this->redirect(['admin/index']);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }
}
