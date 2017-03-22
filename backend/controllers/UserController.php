<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/3/8
 * Time: 14:30
 */

namespace backend\controllers;

use backend\models\UserDetail;
use yii\data\Pagination;
use yii\web\Controller;
use backend\models\User;
use Yii;



class UserController extends Controller
{

    public function actionIndex()
    {
        $userModel = User::find()->joinWith('userDetail'); //关联表!!!
        $count = $userModel->count();
        $pager = new Pagination(['totalCount' => $count, "pageSize" => '2']);
        $userList = $userModel->offset($pager->offset)->limit($pager->limit)->all();

        $this->layout = "layout1";
        return $this->render('index',array('userList'=>$userList, 'pager'=>$pager));
    }

    public function actionAdd()
    {
        $userModel = new User;
        if( Yii::$app->request->isPost ){
            if($userModel->add(Yii::$app->request->post()) ){
                Yii::$app->session->setFlash('info','添加成功');
            }

        }

        $this->layout = 'layout1';
        return $this->render('add',array('userModel'=>$userModel));
    }

    public function actionEdit()
    {
        $id = Yii::$app->request->get('id');
        $userModel = User::find()->where("user_id = $id")->one();
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if($userModel->edit($post) ){
                Yii::$app->session->setFlash('info','修改成功');
            }else{
                Yii::$app->session->setFlash('info','修改失败');
            }
        }

        $this->layout = "layout1";
        return $this->render('edit',array('userModel'=>$userModel));
    }

    public function actionDelete(){
        //使用事务
        try{
            $id = Yii::$app->request->get('id');

            if(empty($id)){
                throw new \Exception();
            }
            //开始事务
            $trans = Yii::$app->db->beginTransaction();

            if( ! (UserDetail::deleteAll("user_id = $id ")) ){
                throw new \Exception();
            }
            if( !(User::deleteAll("user_id = $id "))){
                throw new \Exception();
            }
            $trans->commit();

        }catch (\Exception $e){
                if(Yii::$app->db->getTransaction()){
                    $trans->rollBack();
                }
        }

//        $id = Yii::$app->request->get('id');
//        $userModel = new User;
//        if($userModel->deleteAll("user_id = $id")){
//            Yii::$app->session->setFlash('info','删除成功');
//        }
        $this->redirect(['user/index']);

    }

}