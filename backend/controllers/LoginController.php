<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/3/4
 * Time: 11:44
 */
namespace backend\controllers;
use yii\web\Controller;
use backend\models\Admin;
use Yii;

class LoginController extends Controller {

    public function actionLogin(){
        $adminModel = new Admin;
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();

            if($adminModel->login($post)){
                $this->redirect(['index/index']);
                Yii::$app->end();

            }
        }


        $this->layout = false ;
        return $this->render('login',array('admin'=> $adminModel) );
    }

    public function actionLogout(){
        Yii::$app->session->removeAll();
        $this->redirect(['login/login']);
        Yii::$app->end();
    }

    public function actionSeekpsw(){
        $adminModel = new Admin;
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if($adminModel->seekPsw($post)){

            }
        }


        $this->layout = false;
        return $this->render('seekPsw',array('admin'=> $adminModel) );
    }



}