<?php
   //echo \yii\helpers\Url::toRoute(['goods/edit','id'=>1]);
?>
<ul>
    <?php foreach ($list as $v):?>
    <li><?=$v['goods_name'];?>----价格：<?=$v['goods_price'];?></li>
    <?php endforeach;?>
</ul>

<!--  
     使用[[yii\widgets\LinkPager]]去渲染从操作中传来的分页信息，
     小部件LinkPage显示一个分页按钮的列表。点击任何一个按钮都会跳转到对应的分页
-->
<?=\yii\widgets\LinkPager::widget(['pagination'=>$page]);?> 

<?=\app\components\HelloWiget::widget(['message'=>'Word','name'=>'张三']);?>

