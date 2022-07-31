<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;
use Yii;
/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $token_key
 * @property int $role
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            [['email', 'username', 'password'], 'string', 'max' => 255],
            [['email', 'username', 'password'], 'string', 'min' => 3],
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();

        if (!$this->hasErrors()) {
            //$user = $this->getUser();

            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);

            //$user->generateAuthKey();

            return $user->save();
        }
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Пользователь',
            'email' => 'E-mail',
            'password' => 'Пароль',
        ];
    }
}