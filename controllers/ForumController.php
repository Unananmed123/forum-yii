<?php

namespace app\controllers;

use yii\web\Controller;

class ForumController extends Controller
{
    public function actionIndex()
    {
        $this->view->title = 'index';
        return $this->render('index');
    }

}