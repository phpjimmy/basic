<?php
namespace app\components;

class HelloWiget extends \yii\base\Widget {
   
    public $message;
    public $name;

    //init()初始化方法 赋值
    public function init() {
        if($this->message==""){
            $this->message="PHP";
        }
    }
    
    //run()返回数据
    public function run(){
        return "hello".$this->message."----".$this->name;
        //return $this->render();
    }
    
    
}
