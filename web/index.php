<?php
/*
 * if（defined){
 * }else{
 * }
 * 
 * display_errors=1;    显示错误
 * error_reporting=E_ALL;  错误级别
 *入口脚本是定义全局常量的最好地方，Yii 支持以下三个常量：
 *  • YII_DEBUG ：标识应用是否运行在调试模式。当在调试模式下，应用会保留更多日志信息，如果
 *   抛出异常，会显示详细的错误调用堆栈。因此，调试模式主要适合在开发阶段使用， YII_DEBUG
 *   默认值为 false。
 *  • YII_ENV ：标识应用运行的环境，详情请查阅配置章节。 YII_ENV 默认值为  'prod' ，表示应用运
 *  行在线上产品环境。
 *  • YII_ENABLE_ERROR_HANDLER ：标识是否启用 Yii 提供的错误处理，默认为 true。
 */


// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');   
//dev----开发环境  pro----正式环境

//composer自动加载类spl_autoload_register()
require(__DIR__ . '/../vendor/autoload.php');
//包含Yii类文件
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php'); //核心代码入口

$config = require(__DIR__ . '/../config/web.php');   //加载应用配置信息

//创建、配置、运行一个应用
(new yii\web\Application($config))->run();
