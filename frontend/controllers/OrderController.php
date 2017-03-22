<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/3/3
 * Time: 10:49
 */
namespace frontend\controllers;
use yii\web\Controller;

class OrderController extends Controller{

    public $layout = "layout1";

    public function actionIndex(){

//        return $this->render('index');
    }

    public function actionCheck(){

        return $this->render('check');
    }
}