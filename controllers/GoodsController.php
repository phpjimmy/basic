<?php
namespace app\controllers;

use yii;   //获取请求数据 vendor/yiisoft/yii2/Yii.php

class GoodsController extends \yii\web\Controller{
   
    //添加商品
    public function actionAdd(){
        
        $model = new \app\models\Goods();
        //var_dump($model);   //输出类型是对象
        if(Yii::$app->request->getIsPost()){
            $data = Yii::$app->request->post();  //post请求数据
            //var_dump($data);   //输出类型是数组
            //echo $data['Goods']['goods_name'];
            
            //$model->goods_name=$data['Goods']['goods_name'];  //插入操作 一一对应
            //$model->goods_price=$data['Goods']['goods_price'];
            //$model->save();
            
            //$model->load() //赋值
            if($model->load($data)){      //为表单中的属性赋值（加载数据）
                if($model->validate()){   //验证model中的rules规则
                  $model->save();
                }  
            }
        }
        
        //$model调用表中的字段
        //$model->goods_name="苹果";
        //$model->goods_price=2.4;
        //$model->save();
        
        return $this->render('goods_add',['model'=>$model]);
    }
    
    //修改商品
    public function actionModify($id){
        
        $model = new \app\models\Goods;
        //外部调用静态方法：1.Goods::find();  2.$good = new Goods(); $good->find();
        //echo $id;
        $info = $model->find()
                      ->where(['goods_id'=>$id])
                      ->asArray()  //find()可以返回数组
                      ->one();
        
        //Yii::$app->request->isPost:判断是否是Post请求
        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post();
            //var_dump($data);
            
            $goods = $model->findOne($id);  //判断更新或者插入操作
            //var_dump($goods);
            //$goods->delete(); //删除操作
            
            // echo $goods->goods_id;
            //echo '名称:'.$goods->goods_name;
            //echo '价格:'.$goods->goods_price;
            
            $goods->goods_name=$data['goods_name']; //更新操作 一一对应
            $goods->goods_price=$data['goods_price'];
            $goods->save();
            
            $model->goods_name=$data['goods_name'];  //插入操作 一一对应
            $model->goods_price=$data['goods_price'];
            //$model->save();
            //exit;
        }
        return $this->render('goods_modify',['model'=>$model,'info'=>$info]); //展示数据
        
    }
    
    //删除商品
    public function actionDelete($id){
        
        $model = new \app\models\Goods;
        //外部调用静态方法：1.Goods::find();  2.$good = new Goods(); $good->find();
        //echo $id;
        $info = $model->find()
                      ->where(['goods_id'=>$id])
                      ->asArray()  //find()可以返回数组
                      ->one();
        
        //Yii::$app->request->isPost:判断是否是Post请求
        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post();
            
            $goods = $model->findOne($id);  //判断更新或者插入操作
            //var_dump($goods);
            $goods->delete(); //删除操作
        }
        return $this->render('goods_delete',['model'=>$model,'info'=>$info]); //展示数据
        
    }
    
    
    //自动生成---编辑商品 (也可以修改商品)
    public function actionEdit($id){
        
        $goods = \app\models\Goods::findOne($id);   //findOne()静态方法
        //var_dump($goods);
        //echo \yii\helpers\Url::toRoute('goods/test');  //toRoute()生成路由
        //echo '<br>';
        //echo \yii\helpers\Url::to('goods/test');
        
        //getIsPost()  isPost   //判断是否是Post请求
        //Yii::$app->request->getIsAjax()  //判断是否是Ajax请求
        if(Yii::$app->request->getIsPost()){
            $goods->load(Yii::$app->request->post());  //为表单中的属性赋值（加载数据）
            if($goods->save()){
                $this->redirect(\yii\helpers\Url::toRoute('goods/test'));  //$this->redirect()重定向
            }  
        }
        return $this->render('goods_add',['model'=>$goods]);
        
    }
    
    
    //分页列表
    public function actionList1(){
        
        //count()
        $count = (new \app\models\Goods())->find()->count(); //计算有多少页
        //echo $count;
        $page = new \yii\data\Pagination([
            'defaultPageSize' => 2, //每页有几样商品
            'totalCount' => $count
        ]);
        //$countPage = ceil($count/1);   向上取整ceil  向下取整
        //php取整的几种方式:有三种方式，floor()(舍去小数部分，只取整数)，ceil()(进一取整，只要有小数部分，直接加一)，round()(四舍五入取整)
        
        $list = (new \app\models\Goods())->find()
                                       ->offset($page->offset)  
                                       ->limit($page->limit)
                                       ->orderBy('goods_price')  //排序 放在all前边,默认倒序
                                       ->all();
        
        //echo \yii\helpers\Url::toRoute(['goods/edit','id'=>1]);  
        return $this->render('index1',
                ['page'=>$page,'list'=>$list]);
        
    }
    
    
    //测试
    public function actionTest(){
       // public function actionTest($id){
        $model = new \app\models\Goods;
        //外部调用静态方法：1.Goods::find();  2.$good = new Goods(); $good->find();
        //echo $id;
//        $info = $model->find()
//                       ->where(['goods_id'=>$id])
//                       ->asArray()  //find()可以返回数组
//                       ->one();
        
        //$info1 = $model->findOne(1);  //findOne(1)根据主键来查询 goods_id
        //$info2 = $model->find()->asArray()->all();  //find()->all();查询所有数据
        
        //fineOne() findAll()返回的是对象
       // $obj = $model->findOne(["goods_name"=>"苹果"]);
        //$obj1 = $model->findAll([1,2,3]);
        
        //预处理语句：绑定参数防止 SQL 注入攻击  queryOne()返回一行
        //$post = Yii::$app->db->createCommand('SELECT * FROM t_goods WHERE goods_id=:id')
                             //->bindValue(':id', $_GET['id'])
                           //  ->queryOne();
        //执行原生Sql语句
       // $post1 = Yii::$app->db->createCommand('SELECT * FROM t_goods WHERE goods_id=1')->queryOne();    
        
        //query对象中select(字段)->form(表名),query对象执行select操作
        //$rows = (new \yii\db\Query())->select(['goods_id','goods_name'])
                                     //->from('t_goods')
                                    // ->where(['goods_id'=>1])
                                    // ->one();  //one():返回一条数据(一维数组)
        
       
        /*
         * 这两种是等价的
         * SELECT * FROM t_goods LIMIT 1 OFFSET 0;
         * SELECT * FROM t_goods LIMIT 0,1;
         */
         //select goods_name,goods_price from t_goods limit 1,2
        //$rows1 = (new \yii\db\Query())->select(['goods_name','goods_price'])
                                     //->from('t_goods')
                                    // ->offset(1)  //偏移量 从第几条数据开始偏移 第一条数据默认下标是0 
                                    // ->limit(2)   //查询多少条
                                    // ->all();  //all():返回数据集合(二维数组)
        //$rows2 = (new \yii\db\Query())->from('t_goods')
                                     // ->leftjoin('t_post','t_goods.goods_id=t_post.userid')
                                     // ->all();
        //$num = (new \yii\db\Query())->from('t_goods')
                                   // ->count();
        
        //模糊查询 select * from t_goods where goods_name like '%苹%';
        //$like = (new \yii\db\Query())->from('t_goods')->where(['like','goods_name','苹'])->all();
        
        //var_dump($like);
        return $this->render('test',['model'=>$model]); //展示数据
    }
    
    
    
    public function actionList(){
        
        //count()
        $count = (new \app\models\Goods())->find()->count(); //计算有多少页
        //echo $count;
        $page = new \yii\data\Pagination([
            'defaultPageSize' => 5, //每页有几样商品
            'totalCount' => $count
        ]);
        //$countPage = ceil($count/1);   向上取整ceil  向下取整
        //php取整的几种方式:有三种方式，floor()(舍去小数部分，只取整数)，ceil()(进一取整，只要有小数部分，直接加一)，round()(四舍五入取整)
        
        $list = (new \app\models\Goods())->find()
                                       ->offset($page->offset)  
                                       ->limit($page->limit)
                                       ->orderBy('cat_id')  //排序 放在all前边,默认倒序
                                       ->all();
        
        //echo \yii\helpers\Url::toRoute(['goods/edit','id'=>1]);  
        return $this->render('index',
                ['page'=>$page,'list'=>$list]);
        
    }
    
    
    
    
    
}
