<?php
namespace app\controllers;

use Yii;  //除了use后面不加斜杠/，其他都要加
use app\models\ContactForm;

class UserController extends \yii\web\Controller{
    
    public $defaultAction = 'login';  //自定义方法
    
    //用户注册
    public function actionRegister() {
         $model = new \app\models\Register;
         
         if(Yii::$app->request->isPost){
              $data = Yii::$app->request->post();   //获取post请求数据
              //var_dump($data);
              //echo $data['Register']['username'];
              //$model->load() //赋值
              if($model->load($data)){     //为表单中的属性赋值（加载数据）
                 if($model->validate()){  //验证model中的rules规则
                    $model->save();      //保存数据
                    return $this->redirect(\yii\helpers\Url::toRoute("site/index"));
                 }
              }
          }
          
        return $this->render('register', ['model' => $model]);
           
    }

    //用户登录  1.用户是否登录 $_SESSION['userid']
    public function actionLogin1(){
        
        //判断是否登录，如果不是游客，进行跳转（首页）
        if(!Yii::$app->user->isGuest){
            $this->redirect(\yii\helpers\Url::toRoute("site/index"));
        }
        
        if(Yii::$app->request->getIsPost()){
            $model = new \app\models\Login();
            $data = Yii::$app->request->post();  //获取请求数据
            //var_dump($data);
            $user = $model->findByUserName($data['username']);  //根据用户名去查询用户的相关信息
            if($user){
                //验证用户密码
               $result = $model->validatePassword($user,$data['password']);
               if($result){
                    $url = \yii\helpers\Url::toRoute("site/index");
                    echo "<script>alert('登录成功');window.location.href='".$url."'</script>";
                    //echo "<script>alert('登录成功');</script>";
                    //return $this->redirect(\yii\helpers\Url::toRoute("site/index"));
               }else{
                    echo "<script>alert('登录失败，密码错误');</script>";
               }
            } else {
                echo "<script>alert('用户名不存在');</script>";
                exit;
            }
            
            
        }
        
        return $this->render('login');
        
    }
    
    
    public function actionLogin(){
        $model = new \app\models\Login();
        
        //判断是否登录，如果不是游客，进行跳转（首页）
        if(!Yii::$app->user->isGuest){
            $this->redirect(\yii\helpers\Url::toRoute("site/index"));
        }
        
        $contact = new \app\models\ContactForm();
        if ($contact->load(Yii::$app->request->post()) && $contact->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        
        
        if(Yii::$app->request->getIsPost()){
            $data = Yii::$app->request->post();  //获取请求数据
            //var_dump($data);
            //var_dump($data['Login']['username']);
            $user = $model->findByUserName($data['Login']['username']);  //根据用户名去查询用户的相关信息
            if($user){
                //验证用户密码
               $result = $model->validatePassword($user,$data['Login']['password']);
               if($result){
                    $url = \yii\helpers\Url::toRoute("site/index");
                    echo "<script>alert('登录成功');window.location.href='".$url."'</script>";
                    //echo "<script>alert('登录成功');</script>";
                    //return $this->redirect(\yii\helpers\Url::toRoute("site/index"));
               }else{
                    echo "<script>alert('登录失败,密码错误');</script>";
               }
            } else {
                echo "<script>alert('用户名不存在');</script>";
                exit;
            }
   
        }
   
      return $this->render('login',['model'=>$model,'contact'=>$contact]);
    
    }
    
    //Cookie-Session
    public function actionSession(){
        $session= Yii::$app->session;   //session类  Yii::$app->session：session默认开启
        //存值，设置一个session变量
        $session->set("name", "张三");
        $session['n-sex']="女";
        $_SESSION['age1']=1;
        
        //获取session中的变量值
        echo $session->get("name");
        //echo $session->get("n-sex");
        echo $session['n-sex'];
        echo $_SESSION['age1'];
       
        //删除一个session变量
        $session->remove("name");   //unset($_SESSION['name'])
        unset($session['n-sex']);
        //var_dump($session);
        
        //检查session变量是否已存在
        //if($session->has("age1")) //isset($_SESSION['age1']);
        //if(isset($session['age1']))
        
        foreach ($session as $key=>$v){
            var_dump($key);
            var_dump($v);
        }
        
        $cookie=Yii::$app->response->cookies;
        //header()
        //cookies存值通过new cookie
        $cookie->add(new \yii\web\Cookie(['name'=>"a",'value'=>2]));
        $cookie->add(new \yii\web\Cookie(['name'=>"b",'value'=>3]));
        $cookie->add(new \yii\web\Cookie(['name'=>"c",'value'=>4]));
        
        //cookie中的变量不是立马生效
        echo Yii::$app->request->cookies->getValue("b");   //取值是requeat
        // 删除一个cookie
        Yii::$app->response->cookies->remove("b");       //删除是response
        
        echo Yii::$app->request->cookies->getValue("c");
        
          
        
    }
    
    
}
