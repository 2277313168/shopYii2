<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/3/10
 * Time: 16:08
 */
namespace backend\models;
use yii\db\ActiveRecord;

class Goods extends ActiveRecord {

    public static function tableName()
    {
        return "{{%goods}}";
    }

    public function rules()
    {
        return [
            ['cat_id', 'required', 'message' => '请选择分类', 'on' => [ 'add','edit']],  //必须有，否则parent_id无法入库
            ['goods_name', 'required', 'message' => '请输入商品名称', 'on' => [ 'add','edit']] ,
            ['goods_desc', 'required', 'message' => '请输入商品描述', 'on' => [ 'add','edit']] ,
            ['shop_price', 'required', 'message' => '请输入本店售价', 'on' => [ 'add','edit']] ,
            ['is_hot', 'required', 'message' => '请选择', 'on' => [ 'add','edit']] ,
            ['is_promote', 'required', 'message' => '请选择', 'on' => [ 'add','edit']] ,
            ['promote_price', 'required', 'message' => '请输入促销价', 'on' => [ 'add','edit']] ,
            ['is_onsale', 'required', 'message' => '请选择', 'on' => [ 'add','edit']] ,
            ['is_new', 'required', 'message' => '请选择', 'on' => [ 'add','edit']] ,
            ['goods_img', 'required', 'message' => '请选择', 'on' => [ 'add','edit']] ,
            ['album', 'required', 'message' => '请选择', 'on' => [ 'add','edit']] ,
        ];
    }

    public function add($data){
        $this->scenario = 'add';
        if($this->load($data) && $this->validate()){
            $this->save();
            return true;
        }else{
            return false;
        }
    }

    public function edit($data){
        $this->scenario = 'edit';
        if($this->load($data) && $this->save()){
            return true;
        }else{
            return false;
        }
    }
}