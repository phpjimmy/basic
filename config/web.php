<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
//    'modules'=>[
//        'admin'=>'mdm\admin\Module',
//        'layout'=>'left-menu',
//    ],
    'components' => [   //组件   key值都是Yii::$app后跟的属性
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'G9w-6ZLJXp4jd1liqkaK88czhKpJhP7N',  //composera安装有值  通过giehub打包过来的需要自己填充值（值随便写）
        ],
        'cache' => [  //默认存储runtime/cache
            'class' => 'yii\caching\FileCache',  //MemCache
            'cachePath'=>"@webroot/upload",     //缓存路径
            'keyPrefix'=>'my',     //指定缓存文件名前缀
            
        ],
        'user' => [
            'identityClass' => 'app\models\login',   //用户认证类 必须指向的是一个实现了IdentityInterface接口的model对象
            'enableAutoLogin' => true,  //自动登录是否开启
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
//        'authManager'=>[
//            'class'=>'yii\rbac\DbManager',
//        ],
        
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        
        //默认的url访问：index.php?r=控制器/方法 有参数时 index.php?r=控制器/方法&key=value
        'urlManager' => [
            'enablePrettyUrl' => true,   //是否开启友好url  url访问：index.php/控制器/方法 有参数时 index.php/控制器/方法?key=value
            'showScriptName' => false,   //是否显示脚本文件
            'enableStrictParsing' => false,  //是否开启严格url解析
            'suffix' => '.html',  //伪静态  有参数时，加上?key=value
            'rules' => [
            ],
        ],
        
    ],
//    'as access'=>[  //权限判断
//           'class'=>'mdm\admin\components\AccessControl',
//            'allowActions'=>[
//                'site/*',
//                'admin/*',
//                'test/*',
//            ]
//        ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
