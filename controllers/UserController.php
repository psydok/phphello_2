<?php

namespace app\controllers;

use Yii;
use app\models\LoginForm;
use yii\web\Response;
use app\models\SignupForm;

class UserController extends \yii\web\Controller
{
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Register action.
     *
     * @return Response
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'User registered!');

            return $this->goHome();
        }
        Yii::$app->session->setFlash('error', 'User can not registered!');

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

}
