<?php

namespace app\entity;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Users
 *  @property integer id Айди пользователя
 *  @property string login Логин пользователя
 *  @property string password Пароль пользователя
 *  @property string photo Фото пользователя
 *//

class Users extends ActiveRecord implements IdentityInterface
{
    public static function findIdentity($id)
    {

    }

    public function getId()
    {

    }

    public static function findIdentityByAccessToken($token, $type = null){}
    public function getAuthKey(){}
    public function validateAuthKey($authKey){}
}