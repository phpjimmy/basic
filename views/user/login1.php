<?php
//use yii\captcha\Captcha;
?>
<?php $form= \yii\bootstrap\ActiveForm::begin();?>
<div>
    用户名：<input type="text" name="username"/>
</div>
<div>
    密&nbsp;&nbsp;码：<input type="password" name="password"/>
</div>

<div>
    <input type="submit" value="登录" />
</div>


<?php \yii\bootstrap\ActiveForm::end();?>

