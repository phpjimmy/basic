<?php

namespace app\models;

use Yii;
use yii\base\Model;

class EntryForm extends Model{
    //Model表单模型：收集数据做验证
    public $name;
    public $email;
    
    public function rules(){
        return [
            [['name', 'email'], 'required','message'=>'必填'],
            ['email', 'email'],
        ];
    }
    
}
