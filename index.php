<?php
error_log(date('Y-m-d H:i:s') . "\n" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "\n" . file_get_contents('php://input') . "\n\n", 3, '/home/webmigra/web_demo/osnap/protected/runtime/'.date('Ymd').'.log');

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii-1.1.16/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();