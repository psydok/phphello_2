<?php


namespace app\models;

use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $login;
    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['login', 'trim'],
            ['login', 'string', 'min' => 3, 'max' => 255],
            [['login', 'password'], 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function save(){
        if ($this->validate()){
           $user = new User();
           $user->id = $user->getId();
           $user->login = $this->login;
           $user->password =Yii::$app->security->generatePasswordHash($this->password);
           return $user->save();
        }

        return false;
    }
}