<?php
namespace app\models;

//ORM数据模型映射
class Goods extends \yii\db\ActiveRecord{
    //AR连接数据库中的表
    
    //附加行为 全局调用
    public function behaviors() {
        return [
            'behavior'=>[   //key值可以任意定义
                'class'=> \app\components\MyBehavior::className(),
            ]
        ];
    }
    
    /*
     * AR类的beforeSave方法是AR对象在保存之前进行要执行的动作，
     * 我们可以在里面进行赋值操作，校验操作等等，但是它有返回值，当返回true的时候才会进行保存，否则不保存对象
     */
    public function beforeSave($insert) {   //一定要添加返回值  默认返回值是false
        //$this->password=md5($this->password);
        
        //修改密码的例子
       // if(!empty($this->password)){
           // $this->password = md5($this->password);
        //} else {
           // unset($this->password);
        //}
     
        //return parent::beforeSave();
        return true;
    }

    //ActionRecord：连接数据库的表
   //如果类名和数据表名不能直接对应，可以覆写 tableName() 方法去显式指定相关表名
    public static function tableName(){
        return "t_goods";   //"{{%t_goods}}"  ecs_goods
    }
    
    //表单字段验证 Model
    public function rules(){
        return [
            ['goods_name','required','message'=>'商品名称必填'],
            ['goods_name','string','max'=>15,'message'=>'商品名称长度过长'],
            ['goods_price','required','message'=>'商品价格必填'],
            
        ];
    }
    
}
