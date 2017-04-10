<?php
namespace app\models;

class Upload extends \yii\base\Model{
    //表单类模型仅仅做数据验证
    
    public $imgurl;
    
    //rules规则
    public function rules() {
        return [
            ['imgurl','required','message'=>'请选择文件'],
            ['imgurl','file','extensions'=>'png,jpg,jpeg,gif,doc,txt','message'=>'文件格式不正确'],
        ];
    }
    
}
