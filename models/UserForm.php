<?php

namespace app\models;

use app\entity\Users;
use app\repository\UsersRepository;
use yii\base\Model;

class UserForm extends Model
{
    public  function attributeLabels()
{
    return [
      'login' => 'Логин',
      'password' => 'Пароль',
    ];
}


    public $login;
    public $password;
    public $_user = false;

    public function rules()
    {
        return
            [
              [['login', 'password'], 'required'],
                ['password', 'validatePassword'],
            ];
    }

    public function validatePassword($attribute, $params)
    {
        if(!$this->hasErrors()){
            $user = $this->getUser();

            if (!$user or !$user->validatePassword($this->password)){
                $this->addError($attribute, 'Логин или Пароль не верный');
            }
        }
    }

    public function getUser()
    {
        if ($this->_user === false)
        {
            $this->_user = UsersRepository::getUserByLogin($this->login);
        }

        return $this->_user;
    }

    public function login()
    {
        if ($this->validate())
        {
            return \Yii::$app->user->login($this->getUser());
        }
        return false;
    }
}