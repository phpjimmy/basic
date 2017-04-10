<?php

namespace app\controllers;

use Yii;  //vendor/yiisoft/yii2/Yii.php

class TestController extends \yii\web\Controller{
    
    //public $layout='test';
    
    //全局调用行为
    public function behaviors() {
        return [
            'behavior'=>[     //key值可以任意定义
                'class'=> \app\components\MyBehavior::className(),
                'p1'=>'hello php',
            ]
        ];
    }
    
   
    //可以通过beforeAction()请求可以获取到当前访问的控制器/方法的属性  于此对应   afterAction($action, $result)
    public function beforeAction($action) {   //一定要添加返回值 默认返回值是false
        //var_dump($action);
        
        //echo $action->id;   //请求中的方法名称   
        //echo $action->controller->id;   //请求中的控制器名称
        //echo '<br>';
       // echo $action->controller->id."/".$action->id;  //请求中的控制器名称/方法名称
        //echo '<br>';
        //echo $action->controller->module->defaultRoute;
        
        //return parent::beforeAction($action);
        return true;
        
    }
   

    public function actionIndex(){
        //$value = '行为类不继承就可以使用，方法若要用，直接通过$this->attachBehavior($name, $behavior)附加到方法就可以了，该方法可以调用MyBehavior所有属性和方法';
        //echo $this->p1;
        //$this->getMethod();
        //$this->setProp2($value);
        //echo  $this->getProp2();
        
        $model = new \app\models\Goods;
        $model->getMethod();
        echo $model->p1;
        
        //echo "Yii";
        //$this->render():加载全部模板(layout模板)
        return $this->render('index',
                ['param'=>'张三', 'sex'=>'女' ]);
    }
    
    public function actionSe(){
        //$this->renderPartial()：加载部分模板(不加载layout模板)
        return $this->renderPartial('index',
                ['param'=>'张三', 'sex'=>'女' ]);  
    }
    
    public function actionSay($id){   //方法有参数时，则请求URL中必须包含该参数（名字要一致！！）
        echo $id;
    }
    
    public function actionThree(){
        //yii获取git请求参数：Yii::$app->request->get();
        //yii获取post请求参数：Yii::$app->request->post();
        //获取请求参数  $request = new Request();
        //var_dump($_GET);
        //var_dump(Yii::$app->request->get());
        //echo Yii::$app->request->get('id');
        var_dump(Yii::$app->request->get('id',2));
        
    }
    
    
    //response响应--返回数据的格式
    public function actionDataformat(){
        
        //设置响应数据的格式
        Yii::$app->response->format= \yii\web\Response::FORMAT_JSON;  //header("Content-Type:application/json");
        //Yii::$app->response->format= \yii\web\Response::FORMAT_XML;  //header("Content-Type:application/json");
        return ['name'=>'张三','sex'=>'女'];
        
    }
    
  
    //response响应---发送文件
    public function actionDown(){
        //header
        //网站根目录web
        /*
         * 如果不是在动作方法中调用文件发送方法， 在后面还应调用 yii\web\Response::send() 没有其他内容追加到响应中。
         * return Yii::$app->response->sendFile("css/site.css")->send();
         * 如果发送的文件比较大，就用sends()
         */
        //return Yii::$app->response->sendFile("css/site.css");  //response发送文件(下载文件)
        Yii::$app->response->redirect(\yii\helpers\Url::toRoute('site/index'));  //response页面跳转
        
    }
    
    public function actionBehavior(){
        
        //局部调用行为
        $b = $this->attachBehavior("mybehavior", new \app\components\MyBehavior);  //可以调用MyBehavior所有属性和方法
        echo $b->p1;
        $b->getMethod();
        $value = '行为类不继承就可以使用，方法若要用，直接通过$this->attachBehavior($name, $behavior)附加到方法就可以了，该方法可以调用MyBehavior所有属性和方法';
        $b->setProp2($value);
        echo  $b->getProp2();
        
    }
    
    
    //缓存 ---->先设置后获取！！！！！
    public function actionCache(){
        Yii::$app->cache->set('name', "张三");     //存储缓存，默认是文件缓存
        Yii::$app->cache->set('age', 11,13);    //age变量生命周期 3秒
        
        //sleep(3);   //sleep — 延缓执行 (休眠)
        //echo Yii::$app->cache->get("name");
    }
    
    public function actionGet(){
        echo Yii::$app->cache->get("name");
        echo Yii::$app->cache->get("age");
    }
    
    
    
    
}
