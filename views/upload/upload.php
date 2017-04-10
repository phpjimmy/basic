<?php
use yii\bootstrap\ActiveForm;
?>
<!-- option:用来设置form标签的属性及对应的值 enctype form表单编码格式-->
<?php $form = ActiveForm::begin(['id'=>'form','options'=>['enctype'=>'multipart/form-data','class' => 'upload-class']])?>
    
    <?=$form->field($model,'imgurl')->fileInput()->label(false)?>
    <input type="submit" value="上传" />
<?php ActiveForm::end();?>