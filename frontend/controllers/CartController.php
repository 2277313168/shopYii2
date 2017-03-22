<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/3/3
 * Time: 10:20
 */
namespace frontend\controllers;
use backend\models\Goods;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;
use frontend\models\Cart;

class CartController extends Controller {

    public function actionIndex(){
        $userId = Yii::$app->session['user_id'] ;
        $cart = Cart::find()->where("user_id = $userId")->all();
        $cartInfo = array();
        foreach ($cart as $k=>$v){
            $goodsId = $v['goods_id'];
            $goods = Goods::find()->where("goods_id = $goodsId")->one();
            $cartInfo[$k]['goods_num'] = $v['goods_num'];
            $cartInfo[$k]['cart_id'] = $v['cart_id'];
            $cartInfo[$k]['goods_name'] = $goods['goods_name'];
            $cartInfo[$k]['goods_img'] = $goods['goods_img'];
            $cartInfo[$k]['shop_price'] = $goods['shop_price'];
        }

        $this->layout = "layout1";
        return $this->render('index',array('cart'=>$cartInfo));
    }


    public function actionAdd(){
        if(empty( Yii::$app->session['user_id'] )){
         //   Yii::$app->session['urlBefore'] =
            $this->redirect(['user/login']);
        }

        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $data['Cart']['user_id'] = Yii::$app->session['user_id'];
            $data['Cart']['goods_id'] = $post['goods_id'];
            $data['Cart']['goods_num'] =$post['goods_num'];
            $data['Cart']['goods_attr_id'] = '1';

            $cartModel = Cart::find()->where("goods_id =:goods_id and user_id=:user_id ",[':goods_id'=>$post['goods_id'],':user_id'=> Yii::$app->session['user_id'] ])->one();

            if($cartModel){ //存在，则数量加1，并保存
//                var_dump('已存在');
//                var_dump($cartModel);
                $cartModel['goods_num'] = $cartModel['goods_num']+$post['goods_num'];
                $cartModel->save();
            }else{
               // var_dump('新建');var_dump($data);
                $cartModel = new Cart;
                $cartModel->load($data);  //$data格式必须正确，必须是$data['Cart']下的数据，_csrf-frontend可有可无；否则load失败
                $cartModel->save();       //必须把$data['Cart']中的数据写到models下Cart的rule函数中,否则保存不成功
            }
        }

        $this->redirect(['goods/detail','id'=>$post['goods_id'] ]);



    }





}