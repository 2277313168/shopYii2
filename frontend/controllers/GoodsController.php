<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/3/3
 * Time: 10:00
 */
namespace frontend\controllers;
use backend\models\Goods;
use yii\web\Controller;
use Yii;

class GoodsController extends Controller{

    public $layout="layout1";
    public function actionIndex(){

        return $this->render('product');
    }

    public function actionDetail(){
        $id = Yii::$app->request->get('id');
        $goods = Goods::find()->where("goods_id = $id")->one();


        return $this->render('detail',array('goods'=>$goods));
    }
}