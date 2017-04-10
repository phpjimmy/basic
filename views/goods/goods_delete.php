<?php
   use yii\helpers\Html;
   use yii\widgets\ActiveForm;
   
   $this->title = '商品删除';
?>
  <h1><?= Html::encode($this->title) ?></h1>
  <?php $form= ActiveForm::begin(['id'=>'deleteForm']);?>
    <div>
        <input type="text" name="goods_name" value="<?=$info['goods_name'];?>">
    </div>
    <div>
        <input type="text" name="goods_price" value="<?=$info['goods_price'];?>">
    </div>

   <input type="hidden" name="goods_id" value="<?=$info['goods_id'];?>">
   <input type="submit" value="提交">
    
  <?php ActiveForm::end();?>'
   <script src="/basic/web/assets/e4f7a39d/jquery.js"></script>

   <script>
       $(document).ready(function(){
           $("#deleteForm").submit(function(){
               alert("删除成功");
           })
       });
   </script>