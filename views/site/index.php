<?php

?>
<div class="site-index">
    test yii
    <!-- 判断当前用户是否是游客（未认证的）-->
    <?php echo Yii::$app->user->isGuest?'登录':Yii::$app->user->identity->username;?>
</div>

