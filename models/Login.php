<?php
namespace app\models;

use Yii;

class Login extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface{
    //父类是接口类。子类要继承父类，子类需要继承接口类里的全部方法
    
    //ActionRecord：连接数据库的表
   //如果类名和数据表名不能直接对应，可以覆写 tableName() 方法去显式指定相关表名
    public static function tableName() {
        return "t_post";
    }
    
    public function rules(){  //第一个参数（字段） 第二个参数（验证规则）
        return [
            ['username', 'required','message'=>'用户名不能为空'],
            ['username', 'string', 'max' => 15],
            ['password', 'required','message'=>'密码不能为空'],
            ['password', 'string',  'min' => 6, 'message' => '密码至少填写6位'],
            ['verifyCode','captcha'],
        ];
    }
    
    
    //根据主键查询用户信息
    public static function findIdentity($id){
        return static::findOne($id);
    }
    
    
    //根据用户名去查询用户的相关信息
    public static function findByUserName($name){
        return static::find()->where(['username'=>$name])->one();
    }
    
    
    //验证用户密码
    public static function validatePassword($data,$password){
        if($data->password== md5($password)){
           return Yii::$app->user->login($data,3600);   //vendor/yiisoft/yii2/web/user.php里面的login()方法
        } else {
           return false;    
        }
    }

    //根据令牌token(用户凭证)查询用户信息
    public static function findIdentityByAccessToken($token, $type = null){
        return true;
    }

    //返回用户主键
    public function getId(){
        return $this->userid;
    }
    
    //返回用户认证码
    public function getAuthKey(){
        return true;  //必须返回true
    }

    //验证用户认证码
    public function validateAuthKey($authKey){
        return true;  //必须返回true
    }
    
    
    
}
