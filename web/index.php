<?php
// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'prod');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../config/web.php'),
    require(__DIR__ . '/../config/web-local.php')
);

$application = new yii\web\Application($config);

$application->on(yii\web\Application::EVENT_BEFORE_REQUEST, function(yii\base\Event $event){
    $event->sender->response->on(yii\web\Response::EVENT_BEFORE_SEND, function($e){
//        function sanitize_output($buffer) {
//            $search = array(
//                '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
//                '/[^\S ]+\</s',  // strip whitespaces before tags, except space
//                '/(\s)+/s'       // shorten multiple whitespace sequences
//            );
//
//            $replace = array(
//                '>',
//                '<',
//                '\\1'
//            );
//
//            $buffer = preg_replace($search, $replace, $buffer);
//
//            return $buffer;
//        }
//
//        ob_start("sanitize_output");
        ob_start("ob_gzhandler");
    });
    $event->sender->response->on(yii\web\Response::EVENT_AFTER_SEND, function($e){
        ob_end_flush();
    });
});
$application->run();
