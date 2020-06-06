<?php


namespace app\modules\user\models;

use app\models\User;
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
            ['login', 'unique', 'targetClass' => User::className(), 'message' => 'This login already registered!'],
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
           $user->password = md5($this->password);
           return $user->save();
        }

        return false;
    }
}