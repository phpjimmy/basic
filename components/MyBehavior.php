<?php
namespace app\components;

use yii\db\ActiveRecord;

//行为类
class MyBehavior extends \yii\base\Behavior{
    
    public $p1="get behavior";
    private $_prop2;

    public function getProp2(){
        return $this->_prop2;
    }

    public function setProp2($value){
        $this->_prop2 = $value;
    }
    
    public function getMethod(){
        echo "Method  <br>";
        
    }
    
    //触发行为响应对应组件的事件--->覆写 yii\base\Behavior::events() 方法
    public function events(){  //events() 方法返回事件列表和相应的处理器
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
        ];
    }

    public function beforeValidate($event){   //处理器  $event 指向事件参数
        // 处理器方法逻辑
    }
    
}
