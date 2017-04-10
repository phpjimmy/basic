<?php
   use yii\helpers\Html;
   use yii\widgets\ActiveForm;
   
   $this->title = '用户注册';
?>
   <h1><?= Html::encode($this->title) ?></h1>
   
   
  <?php $form= ActiveForm::begin(['id'=>'registerForm']);?>
    <div>
        <?=$form->field($model,'username')->label('用户名')->textInput();?>
    </div>
    <div>
        <?=$form->field($model,'sex')->label('性别')->textInput();?>
    </div>
    <div>
        <?=$form->field($model,'age')->label('年龄')->textInput();?>
    </div>
    <div>
        <?=$form->field($model,'password')->label('密码')->passwordInput();?>
    </div>
    <div>
        <?=$form->field($model,'email')->label('邮箱')->input('email');?>
    </div>
   
    <div class="form-group">
        <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
    </div>

  <?php ActiveForm::end();?>

   <script src="/basic/web/assets/e4f7a39d/jquery.js"></script>

   <script>
       $(document).ready(function(){
           $("#registerForm").submit(function(){
               alert('注册成功');
           })
       });
   </script>
