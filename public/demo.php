<?php
error_reporting(0); 
header('Content-Type:text/html;charset=utf-8');
date_default_timezone_set("Etc/GMT-8"); 
use Phalcon\Mvc\Application as Application;
use \ErrorException as ErrorException;
use \Exception as Exception;

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
    showError($e);
} catch (\PDOException $e) {  
    showError($e, 'phalconPdoError');
} catch (\Exception $e) {  
    showError($e, 'phalconDefaultError');
}
?>