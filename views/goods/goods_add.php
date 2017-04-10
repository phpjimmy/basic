<?php
   use yii\helpers\Html;
   use yii\widgets\ActiveForm;
   
   $this->title = '商品添加';
?>
  
   
   
  <?php $form= ActiveForm::begin(['id'=>'addForm']);?>
    <div>
        <?=$form->field($model,'goods_name')->label('商品名称')->textInput();?>
    </div>
    <div>
        <?=$form->field($model,'goods_price')->label('商品价格')->textInput();?>
    </div>

   <input type="submit" value="提交">
    
  <?php ActiveForm::end();?>

   <script src="/basic/web/assets/e4f7a39d/jquery.js"></script>
   <script>
       $(document).ready(function(){
           $("#addForm").submit(function(){
               alert("添加成功");
           })
       });
   </script>

