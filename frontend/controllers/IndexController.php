<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/3/3
 * Time: 9:16
 */
namespace frontend\controllers;

use backend\models\Goods;
use yii\web\Controller;

class IndexController extends BaseController
{

    public function actionIndex()
    {
        $onsaleList = Goods::find()->where('is_onsale = "1" ')->orderBy('goods_id asc')->limit(4)->all();
        $promoteList = Goods::find()->where('is_promote = "1" ')->orderBy('goods_id asc')->limit(4)->all();
        $newList = Goods::find()->where('is_new = "1" ')->orderBy('goods_id asc')->limit(4)->all();



        $this->layout = 'layout1';
        return $this->render('index',array('onsale'=>$onsaleList,'promote'=>$promoteList,'new'=>$newList));
    }

}