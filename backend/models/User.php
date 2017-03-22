<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/3/8
 * Time: 14:52
 */

namespace backend\models;
use yii\db\ActiveRecord;
use Yii;

class User extends ActiveRecord{

    public $rePsw;
    public static function tableName(){
        return "{{%user}}" ;
    }

    public function rules()
    {
        return [
            ['user_name', 'required', 'message' => '请输入用户昵称', 'on' => [ 'add','edit']],
            ['email', 'required', 'message' => '请输入用户邮箱', 'on' => ['add','edit']],
            ['email', 'email', 'message' => '邮箱格式不正确', 'on' => ['add','edit']],
            ['email', 'unique', 'message' => '邮箱已被注册', 'on' => ['add','edit']],

            ['password', 'required', 'message' => '请输入密码', 'on' => ['add']],
            ['rePsw', 'required', 'message' => '请输入确认密码', 'on' => ['add']],
            ['rePsw', 'compare','compareAttribute'=>'password', 'message' => '两次输入密码不一致', 'on' => ['add']],

        ];
    }

    public function add($data){
        $this->scenario = 'add';
        var_dump($data);
        if($this->load($data) && $this->validate()){
            $this->password = md5($this->password);
            $this->rePsw = md5($this->password);
            $this->reg_time = time();
            $this->save(false);
            return true;
        }else{
            return false;
        }
    }

    public function edit($data){
        $this->scenario = 'edit';
        if($this->load($data) && $this->validate()){
            $this->save(false);
            return true;
        }else{
            return false;
        }

    }

    //关联user_detail表
    public function getUserDetail(){
        return $this->hasOne(UserDetail::className(),['user_id'=>'user_id']);
    }


}