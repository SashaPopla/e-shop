<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    const ROLE_USER = 1;
    const ROLE_MANAGER = 5;
    const ROLE_ADMIN = 10;

    public static function tableName()
    {
	    return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        //return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
	    return \Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setPassword($password)
    {
        $this->password = \Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    public static  function roles()
    {
        return [
            self::ROLE_USER => Yii::t('app', 'User'),
            self::ROLE_MANAGER => Yii::t('app', 'Manager'),
            self::ROLE_ADMIN => Yii::t('app', 'Admin'),
        ];
    }

    public function getRoleName(int $id)
    {
        $list = self::roles();
        return $list[$id] ?? null;
    }

    public function isAdmin()
    {
        return ($this->role == self::ROLE_ADMIN);
    }

    public function isManager()
    {
        return ($this->role == self::ROLE_MANAGER);
    }

    public function isUser()
    {
        return ($this->role == self::ROLE_USER);
    }
}