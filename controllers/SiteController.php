<?php

namespace app\controllers;  //防止类重名

use Yii;   //vendor/yiisoft/yii2/Yii.php
use yii\filters\AccessControl;  //执行方法之前先过滤
use yii\web\Controller;  //控制器的基类
use yii\filters\VerbFilter; //过滤类
use app\models\LoginForm;    //别名/引用
use app\models\ContactForm;

use app\models\EntryForm;

class SiteController extends Controller{
    
    //自定义公共模板，views/layouts/test
    //public $layout = "test";  //默认值是main
    //public $defaultAction = 'login';  //自定义方法，默认是index


    /**
     * @inheritdoc
     */
    public function behaviors(){   //yii 行为方法
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],  //定义要过滤的方法
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],  //@代表全体成员
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                   // 'login' => ['get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    //方法命名规则：action+方法名（首字母大写）
    public function actionIndex(){
        var_dump(Yii::$app->user->identity);  //Yii::$app->user->identity 检测当前用户身份

        //渲染模板
        //先调用公共模板layouts下定义的模板main.php，然后把$content变量替换成render里面对应的参数模板
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();  //连接数据库表
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout(){
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionSay($message = 'hello'){
        return $this->render('say',['message'=>$message]);    
    }
    
     public function actionEntry(){
 
        $model = new EntryForm;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // 验证 $model 收到的数据
            // 做些有意义的事 ...
            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // 无论是初始化显示还是数据验证错误
            return $this->render('entry', ['model' => $model]);
        }
    }
    
    
}
