<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use function Sodium\randombytes_random16;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string|null $login
 * @property string|null $password
 * @property string $accessToken
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
            ['id', 'integer'],
            ['login', 'unique', 'message' => 'This login already registered!'],
            [['login', 'password'], 'required'],
        ];
    }

    public function beforeSave($insert)
    {
        if (empty($this->accessToken)) {
            $this->accessToken = random_int(1,99999);
        }

        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password'
        ];
    }

    public static function findIdentity($id)
    {
        return self::findOne(['users.id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['users.accessToken' => $token]);
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
        return $this->password === md5($password);
    }
}
