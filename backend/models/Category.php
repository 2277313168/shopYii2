<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/3/10
 * Time: 8:55
 */
namespace backend\models;
use yii\db\ActiveRecord;

class Category extends ActiveRecord {

    public static function tableName()
    {
        return "{{%category}}";
    }

    public function rules()
    {
        return [
            ['parent_id', 'required', 'message' => '请选择父类', 'on' => [ 'add','edit']],  //必须有，否则parent_id无法入库
            ['cat_name', 'required', 'message' => '请输入分类名称', 'on' => [ 'add','edit']] ,
        ];
    }

    public function tree($arr,$pid=0,$level=0){
        static $res = array();
        foreach ($arr as $k=>$v) {
            if($v['parent_id'] == $pid){
                $v['level'] = $level;
                $res[] = $v;
                $this->tree($arr,$v['cat_id'],$level+1);
            }
        }

        return $res;
    }

    public function getOptions($arr){
        $res = array();
        $res['0'] = '顶级分类';
        foreach($arr as $v){
            $k = $v['cat_id'];
            $res["$k"] = str_repeat('-----',$v['level']).$v['cat_name'];
        }
        return $res;
    }

    public function add($data){
        $this->scenario = 'add';
        if($this->load($data) && $this->save()){ //save默认为save(true)，会自动验证
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