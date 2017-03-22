<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/3/13
 * Time: 15:39
 */
namespace frontend\models;
use yii\db\ActiveRecord;

class Cart extends ActiveRecord {

    public static function tableName()
    {
        return "{{%cart}}";
    }

    public function rules()
    {
        return[
           [['user_id','goods_id','goods_num','goods_attr_id'] , 'required'],

        ];
    }


//    public function add($data){
//        $this->scenario='add';
//    }
}