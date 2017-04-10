<?php
use yii\helpers\Html;
use yii\captcha\Captcha;

$this->title = '用户登录';
?>
<h1><?= Html::encode($this->title) ?></h1>


<?php $form= \yii\bootstrap\ActiveForm::begin();?>

<div>
      <?=$form->field($model,'username')->label('用户名：')->textInput();?>
</div>
<div>
      <?=$form->field($model,'password')->label('密码：')->passwordInput();?>
</div>
<div>
    <?= $form->field($contact, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ])->label('验证码：') ?>
</div>
<div class="form-group">
        <?= Html::submitButton('登录', ['class' => 'btn btn-primary']) ?>
</div>

<?php \yii\bootstrap\ActiveForm::end();?>

