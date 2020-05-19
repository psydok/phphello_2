<?php

namespace app\models;

use http\Exception\RuntimeException;
use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string|null $login
 * @property string|null $password
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public static function tableName()
    {
        return 'users';
    }

    public static function findByUsername($username)
    {
        return self::findOne(['users.login' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['login', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
        ];
    }

    public static function findIdentity($id)
    {
        return self::findOne(['users.id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new \RuntimeException('Not implement');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    /**
     * Validates the password.
     *
     * @param string $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return $this->password === Yii::$app->security->generatePasswordHash($password);
    }
}
