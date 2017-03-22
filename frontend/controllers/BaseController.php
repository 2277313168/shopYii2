<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/3/12
 * Time: 15:32
 */
namespace frontend\controllers;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use frontend\models\Category;

class BaseController extends Controller {

    public function init()
    {
        $cat = Category::find()->all();
        $arr = ArrayHelper::toArray($cat);
        $catList = (new Category)->getCatList($arr,0);
        $this->view->params['menu'] = $catList;


    }


}