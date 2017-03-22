<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/3/12
 * Time: 15:51
 */
namespace frontend\models;
use yii\db\ActiveRecord;

class Category extends ActiveRecord {

    public static function tableName()
    {
        return "{{%category}}";
    }

    public function getCatList($arr,$pid){
        $res = array();
        foreach ($arr as $k=>$v)
        {
            if($v['parent_id'] == $pid){
                $v['child'] = $this->getCatList($arr,$v['cat_id']);
                $res[] = $v;
            }
        }
       return $res;
    }


}