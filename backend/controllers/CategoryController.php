<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/3/10
 * Time: 8:51
 */
namespace backend\controllers;
use Behat\Gherkin\Exception\Exception;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use backend\models\Category;
use Yii;

class CategoryController extends Controller {

    public function actionIndex(){
        $catModel = Category::find()->all();
        $catList = ArrayHelper::toArray($catModel);
        $catList1 = (new Category)->tree($catList,0,0);

        $this->layout = "layout1";
        return $this->render('index',array('catList'=>$catList1));
    }

    public function actionAdd(){
        $model = new Category;

        if(Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if($model->add($post)){
                Yii::$app->session->setFlash('info','添加成功');
            }else{
                Yii::$app->session->setFlash('info','添加失败');
            }
        }


        $catList = ArrayHelper::toArray(Category::find()->all());
        $catTree = (new Category)->tree($catList);
        $options = (new Category)->getOptions($catTree);
        $this->layout = "layout1";
        return $this->render('add',array('model'=>$model,'catTree'=>$options));
    }


    public function actionEdit(){
        $id = Yii::$app->request->get('id');
        $catModel = Category::find()->where("cat_id = $id")->one();

        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if($catModel->edit($post)){
                Yii::$app->session->setFlash('info','编辑成功');
                $this->redirect(['category/index']);
            }
        }

        $catList = ArrayHelper::toArray(Category::find()->all());
        $catTree = (new Category)->tree($catList);
        $options = (new Category)->getOptions($catTree);
        $this->layout = "layout1";
        return $this->render('add',array('model'=>$catModel,'catTree'=>$options));

    }

    public function actionDelete(){
        try{
            $id = Yii::$app->request->get('id');
            if(empty($id)){
                throw new \Exception('参数错误');
            }
            $cat = Category::find()->where("parent_id = $id")->one();
            if(!empty($cat)){
                throw new \Exception('该分类下有子分类，不能删除');
            }
            if(!Category::deleteAll("cat_id = $id")){
                throw new \Exception('删除失败');
            }

        }catch(\Exception $e){
                Yii::$app->session->setFlash('info',$e->getMessage());
        }

        return $this->redirect(['category/index']);
    }



}