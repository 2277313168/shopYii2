<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/3/4
 * Time: 15:13
 */
namespace backend\models;

use yii\db\ActiveRecord;
use Yii;

class Admin extends ActiveRecord
{

    public $rememberMe = true;
    public $rePsw;
    public $newPsw;
    public $reNewPsw;

    public static function tableName()
    {
        return "{{%admin}}";
    }

    public function rules()
    {
        return [
            ['admin_name', 'required', 'message' => '请输入管理员账号', 'on' => ['login', 'seekPsw', 'add']],
            ['password', 'required', 'message' => '请输入密码', 'on' => ['login', 'add', 'edit', 'changePsw']],
            ['password', 'checkPwd', 'on' => ['login','changePsw']],
            ['email', 'required', 'message' => '请输入管理员邮箱', 'on' => ['seekPsw', 'add', 'edit']],
            ['email', 'email', 'message' => '邮箱格式不正确', 'on' => ['seekPsw', 'add', 'edit']],
            ['email', 'unique', 'message' => '邮箱已被注册', 'on' => ['add', 'edit']],
            ['email', 'checkEmail', 'on' => ['login', 'seekPsw']],
            ['rePsw', 'required', 'message' => '请输入确认密码', 'on' => ['add']],
            ['rePsw', 'compare', 'compareAttribute' => 'password', 'message' => '两次输入密码不一致', 'on' => ['add']],

            ['password', 'required', 'message' => '请输入旧密码', 'on' => ['changePsw']],
            ['newPsw', 'required', 'message' => '请输入新密码', 'on' => ['changePsw']],
            ['reNewPsw', 'required', 'message' => '请输入确认密码', 'on' => ['changePsw']],
            ['reNewPsw', 'compare', 'compareAttribute' => 'reNewPsw', 'message' => '两次输入密码不一致', 'on' => ['changePsw']],
        ];
    }

    public function checkPwd()
    {
        if (!$this->hasErrors()) {

            $data = self::find()->where('admin_name = :admin_name and password = :password',
                [":admin_name" => $this->admin_name, ":password" => md5($this->password)])->one();
            if (empty($data)) {
                $this->addError('password', '用户名与密码不匹配');
            }
        }

    }

    public function checkEmail()
    {
        if (!$this->hasErrors()) {
            $data = self::find()->where('admin_name = :name and emai = :email', [":name" => $this->admin_name, ":email" => $this->email])->one();

            if (empty($data)) {

                $this->addError('email', '用户名和邮箱不匹配');
            }
        }
    }


    public function login($data)
    {
        $this->scenario = 'login';
        if ($this->load($data) && $this->validate()) {


            $data1 = self::find()->where('admin_name = :admin_name and password = :password',
                [":admin_name" => $this->admin_name, ":password" => md5($this->password)])->one();
            if (empty($data1)) {
                $this->addError('password', '用户名或密码错误');
            }


            $lifetime = $this->rememberMe ? 3600 * 30 * 24 : 0;
            $session = Yii::$app->session;
            session_set_cookie_params($lifetime);
            $session['admin_id'] = $data1['admin_id'];
            $session['admin_name'] = $this->admin_name;


//            $this->updateAll(['login_time'=>time(), 'login_ip'=> ip2long(Yii::$app->request->userIP )] , 'admin_name= :admin_name',[':admin_name'=>$this->admin_name] ) ;
            $this->updateAll(['login_time' => time(),], 'admin_name= :admin_name', [':admin_name' => $this->admin_name]);

            return true;
        } else {
            return false;
        }

    }

    public function seekPsw($data)
    {
        $this->scenario = 'seekPsw';
        if ($this->load($data) && $this->validate()) {

            return true;
        } else {
            return false;
        }
    }

    public function add($data)
    {
        $this->scenario = 'add';
        if ($this->load($data) && $this->validate()) {
            $this->password = md5($this->password);
            if ($this->save(false)) { //false表示保存时不再验证；默认为true，保存时会验证
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }
    }

    public function edit($data)
    {
        $this->scenario = 'edit';

        if ($this->load($data) && $this->validate()) {
//            $adminOld = self::find()->where("admin_name = :name and password = :psw",[':name'=> $data['admin_name'] ,':psw'=>md5($data['password']) ]);
            $adminOld = self::find()->where("admin_name = :name and password = :psw", [':name' => $data['Admin']['password'], ':psw' => md5($data['Admin']['password'])])->one();

           // var_dump($adminOld);die;
            if (empty($adminOld)) {
                $this->addError('password', '密码输入错误');
                return false;
            } else {
                $this->updateAll(['email' => $this->email], 'admin_name = :name', [':name' => $this->admin_name]);
                return true;
            }
        } else {
            return false;
        }
    }


    public function changePsw($data)
    {
        $this->scenario = 'changePsw';

//        $data1 = self::find()->where('admin_id = :id and password= :psw', [':id' => Yii::$app->session['admin_id'], ':psw' => $this->password])->one();
//        var_dump($data1);die;
//        if (empty($data1)) {
//            $this->addError('password', '旧密码错误');
//            return false;
//        }

        if ($this->load($data) && $this->validate()) {
//            var_dump($this->newPsw);
//            die;
            $this->updateAll(['password' => md5($this->newPsw)], 'admin_id = :id', [':id' => Yii::$app->session['admin_id']]);
            return true;
        } else {
            return false;
        }

    }


}