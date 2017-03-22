<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/3/6
 * Time: 11:12
 */
namespace backend\controllers;

use yii\web\Controller;
use backend\models\Admin;
use yii\data\Pagination;
use Yii;

class AdminController extends Controller
{
    public function actionIndex()
    {

//        $adminList =  Admin::find()->all();
//        return $this->render('index',array('adminList'=>$adminList));

        $adminModel = Admin::find();
        $count = $adminModel->count();
        $pager = new Pagination(['totalCount' => $count, "pageSize" => '1']);
        $adminList = $adminModel->offset($pager->offset)->limit($pager->limit)->all();

        $this->layout = "layout1";
        return $this->render('index', array('adminList' => $adminList, 'pager' => $pager));
    }

    public function actionAdd()
    {
         $adminModel = new Admin;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($adminModel->add($post)) {
                Yii::$app->session->setFlash('info', '添加成功');
            } else {
                Yii::$app->session->setFlash('info', '添加失败');
            }

            $adminModel->password = '';
            $adminModel->rePsw = '';
        }

        $this->layout = "layout1";
        return $this->render('add', array('adminModel' => $adminModel));
    }

    public function actionEdit(){
//        var_dump(new Admin);
//        var_dump(Admin::find());die;


        $admin = Admin::find()->where("admin_id = :id",[':id'=>Yii::$app->session['admin_id'] ] )->one();

        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if($admin->edit($post)){
                Yii::$app->session->setFlash('info','修改成功');
            }else{
                Yii::$app->session->setFlash('info','修改失败');
            }

        }

        $admin['password'] = '';

        $this->layout = 'layout1';
        return $this->render('edit',array('adminModel'=>$admin));
    }

    public function actionDelete()
    {
        $id = Yii::$app->request->get('id');
//       $adminModel = new Admin ;
//        if($adminModel->deleteAll("admin_id = $id")){
//            Yii::$app->session->setFlash('info','删除成功');
//        }
        if( Admin::deleteAll("admin_id = $id") ); //两种都可以
        $this->redirect(['admin/index']);

    }

    public function actionChangepsw(){
        $adminModel = Admin::find()->where('admin_id = :id',[':id'=>Yii::$app->session['admin_id'] ])->one();

        if(Yii::$app->request->isPost ){
            $post = Yii::$app->request->post();

           if( $adminModel->changePsw($post) ){
               Yii::$app->session->setFlash('info','修改密码成功');
           }
        }

        $adminModel->password = '';
        $this->layout = "layout1";
        return $this->render('changePsw',array('adminModel'=>$adminModel));
    }



}