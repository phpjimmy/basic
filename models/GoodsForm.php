<?php
namespace app\models;


class GoodsForm extends \yii\base\Model{
   //GoodsForm仅仅是收集数据做验证
    
   public $goods_name;
   public $goods_price;
   
   public function rules() {
       return [
           ['goods_name','required','message'=>'商品名字不能为空']
       ];
   }
    
    
}
