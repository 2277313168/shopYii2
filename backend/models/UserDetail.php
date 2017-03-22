<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/3/8
 * Time: 18:00
 */
namespace backend\models;
use yii\db\ActiveRecord;
use yii\db\ActiveRecordtive;

class UserDetail extends ActiveRecord {

    public static function tableName()
    {
        return "{{%user_detail}}";
    }
}