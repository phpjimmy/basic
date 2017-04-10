<?php
namespace app\models;

class RegisterForm extends \yii\base\Model{
   //收集数据做验证
    
   public $userid;
   public $username;
   public $sex;
   public $age;
   public $password;
   
   public $email;
   public $created_at;
   public $updated_at;
   
   
    public function rules(){
        return [
            ['username', 'filter', 'filter' => 'trim'],
            [['username', 'sex', 'age', 'password','email'], 'required','message' => '必填'],
            ['username', 'string', 'max' => 15],
            ['username', 'unique', 'targetClass' => '\app\models\Register', 'message' => '用户名已存在.'],
            ['sex', 'string', 'max' => 1],
            ['age', 'integer'],
            ['email', 'email'],
            ['password', 'string',  'min' => 6, 'message' => '密码至少填写6位'],
            [['created_at', 'updated_at'], 'default', 'value' => date('Y-m-d H:i:s')],
        ];
    }
    
    
    
    
 
    
}
