<?php

namespace app\controllers;

use app\entity\Users;
use app\models\RegistrationModel;
//use app\models\User;
use app\models\UserForm;
use app\repository\UsersRepository;
use Yii;
use yii\web\Controller;

class UserController extends Controller
{

    public function actionLogin()
    {
        $this->view->title = 'Login';
        $model = new UserForm();

        if (!\Yii::$app->user->isGuest){
            return $this->goHome();
        }

        if($model->load(\Yii::$app->request->post()) && $model->login()){
            return $this->goHome();
        }
        return $this->render('login', ['model' => $model]);
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionRegistration()
    {
        $this->view->title = 'Регистрация';
        $model = new RegistrationModel();

        if ($model->load(Yii::$app->request->post() && $model->validate())){
            $userId = UsersRepository::createUser(
                $model->login,
                $model->password
            );
            if ($userId){
                Yii::$app->user->login(Users::findIdentity($userId));
                return $this->goHome();
            }
        } return $this->render('registration', ['model' => $model]);
    }






}