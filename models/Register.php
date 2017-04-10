<?php
namespace app\models;

class Register extends \yii\db\ActiveRecord{
   //ActionRecord：连接数据库的表
    
    /*
     * AR类的beforeSave方法是AR对象在保存之前进行要执行的动作，
     * 我们可以在里面进行赋值操作，校验操作等等，但是它有返回值，当返回true的时候才会进行保存，否则不保存对象
    */
     public function beforeSave($insert) {
        //$this->password=md5($this->password);
        
        //修改密码的例子
        if(!empty($this->password)){
            $this->password = md5($this->password);
        } else {
           unset($this->password);
        }
     
        //return parent::beforeSave();
        return true;
    }
    
     public static function tableName(){
        return "t_post";   //"{{%t_goods}}"
     }
    
     public function rules(){
        return [
            ['username', 'filter', 'filter' => 'trim'],
            [['username', 'sex', 'age', 'password','email'], 'required','message' => '必填'],
            ['username', 'string', 'max' => 15],
            ['sex', 'string', 'max' => 1],
            ['age', 'integer'],
            ['email', 'email'],
            ['password', 'string',  'min' => 6, 'message' => '密码至少填写6位'],
            [['created_at', 'updated_at'], 'default', 'value' => date('Y-m-d H:i:s')],
        ];
    }
    
}
