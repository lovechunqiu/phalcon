<?php

use Phalcon\Mvc\Application as Application;

//应用模式
define('APP_MODEL', 'MVC');
//网站根目录
define('WEB_ROOT', realpath('..') . '/');
//app入口文件名字
define('APP_FILE_NAME', pathinfo($_SERVER['SCRIPT_NAME'])['filename']);
//app应用路径
define('APP_PATH', WEB_ROOT . 'app/' . APP_FILE_NAME . '/');
//启动应用
define('DEBUG', true);
//项目环境 develop,sandbox,productive
define('ENVIROMENT','develop');

try {
    require_once WEB_ROOT . 'common/init/init.php';
    $application = new Application($di);
    $handle = $application->handle();
    $getContent = $handle->getContent();
    echo $getContent;
    
} catch (\Phalcon\Exception $e) {
    p($e->getMessage());die;
    phalconErrorLog($e);
} catch (\PDOException $e) {
   p($e->getMessage());die;
    phalconErrorLog($e, 'phalconPdoError');
} catch (\Exception $e) {
   p($e->getMessage());die;
    phalconErrorLog($e, 'phalconDefaultError');
}
?>