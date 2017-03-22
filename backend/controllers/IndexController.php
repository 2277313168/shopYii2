<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/3/2
 * Time: 15:04
 */
namespace backend\controllers;
use yii\web\Controller;


class IndexController extends Controller{

    public function actionIndex(){



        $this->layout = "layout1";
        return $this->render('index');
    }
}