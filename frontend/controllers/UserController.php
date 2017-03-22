<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/3/3
 * Time: 11:09
 */
namespace frontend\controllers;
use yii\web\Controller;
use Yii;
use frontend\models\User;

class UserController extends Controller {

    public function actionRegister(){
        $this->layout= "layout1";
        return $this->render('register');
    }

    public function actionLogin(){
        $model =new User;
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if($model->login($post)){
                $this->redirect(['index/index']);
            }
        }

        $this->layout= "layout1";
        return $this->render('register',array('model'=>$model));
    }

    public function actionLogout(){
        Yii::$app->session->destroy();
        return $this->redirect(['user/login']);
    }
}