<?php
   //echo \yii\helpers\Url::toRoute(['goods/edit','id'=>1]);
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '商品列表';
?>
<table class="table" >
	<caption style="font-size:38px">商品列表</caption>
	<thead>
	    <tr>
		<th>商品名字</th>
		<th>价格</th>
                <th>商品关键字</th>
	    </tr>
	</thead>
        
	<tbody>
	<?php foreach ($list as $v):?>
	    <tr>
		<td><?=$v['goods_name'];?></td>
		<td><?=$v['shop_price'];?></td>
                <td><?=$v['keywords'];?></td>
	    </tr>
	<?php endforeach;?>
	</tbody>
        
 </table>
<!--  
     使用[[yii\widgets\LinkPager]]去渲染从操作中传来的分页信息，
     小部件LinkPage显示一个分页按钮的列表。点击任何一个按钮都会跳转到对应的分页
-->
<?=\yii\widgets\LinkPager::widget(['pagination'=>$page]);?> 

<?=\app\components\HelloWiget::widget(['message'=>'Word','name'=>'张三']);?>



