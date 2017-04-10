<?php
  use yii\helpers\Html;
?>
<p>You have entered the following information:</p>

<ul>
    <li><label>姓名</label>: <?= Html::encode($model->name) ?></li>
    <li><label>邮箱</label>: <?= Html::encode($model->email) ?></li>
</ul>

