<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/3/13
 * Time: 10:22
 */
namespace frontend\models;
use yii\db\ActiveRecord;
use Yii;

class User extends ActiveRecord {

    public static function tableName(){
        return "{{%user}}";
    }

    public function rules()
    {
        return [
            ['email', 'required', 'message' => '请输入用户邮箱', 'on' => ['login']],
            ['email', 'email', 'message' => '邮箱格式不正确', 'on' => ['login']],
            ['password', 'required', 'message' => '请输入用户密码', 'on' => ['login']],
        ];
    }

    public function login($data){
        $this->scenario = 'login';
        if($this->load($data) && $this->validate()){
            $user = self::find()->where("email = :email and password = :password",[':email'=>$this->email,':password'=>$this->password])->one();
            if(empty($user)){
               $this->addError('password','邮箱或密码错误');
            }else{
                $session = Yii::$app->session;
                $session['user_id'] = $user['user_id'];
                $session['user_name'] = $user['user_name'];
                return true;
            }
        }else{
            return false;
        }
    }



}