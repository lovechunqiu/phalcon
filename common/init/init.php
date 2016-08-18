<?php
/*
 * 常量定义
 */
//时间
define('TIME', time());
//当前格式化之后的时间
define('DATE', date('Y-m-d H:i:s',TIME));

//init common function  
require_once(WEB_ROOT.'common/library/functions.php'); 

G('demo1');

//配置文件
use Phalcon\Config\Adapter\Ini as ConfigIni; 
use Phalcon\Config as Config;
use Phalcon\Mvc\View as View;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\DI\FactoryDefault as FactoryDefault;
use Phalcon\Mvc\Dispatcher as Dispatcher;
use Phalcon\Logger as Logger;
use Phalcon\Logger\Adapter\File as FileLogger; 
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\Model\Metadata\Memory as MetaData;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Http\Response\Cookies as Cookies;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Tag as Tag;
use Phalcon\Mvc\Model\Query\Lang as Lang;
use Phalcon\Mvc\Router as Router;
use Phalcon\DI\FactoryDefault\CLI as CliDI; 




//加载配置文件
$config = require_once APP_PATH.'config/'.ENVIROMENT.'Config.php';      
$loader = new \Phalcon\Loader();
 
//加载命名空间
//$loader->registerNamespaces(array(    
//    'M' => WEB_ROOT . $config->application->modelsDir, 
//    'M\Hope' =>WEB_ROOT . $config->application->modelsDir.'hope/',      
//    'M\System' =>WEB_ROOT . $config->application->modelsDir.'system/',
//))->register();

//应用引导文件 定义目录啥的
$registerDirs = array(
    $config->application->controllersDir,
    $config->application->viewsDir,  
    WEB_ROOT . $config->application->pluginsDir,
    WEB_ROOT . $config->application->libraryDir,
    WEB_ROOT . $config->application->modelsDir,           
);


//注册目录
$loader->registerDirs($registerDirs)->register();

$di = new FactoryDefault();        
$di->set('dispatcher', function () use ($di) {
    $eventsManager = new EventsManager;
    //https://docs.phalconphp.com/en/latest/reference/dispatching.html#handling-not-found-exceptions
    //访问控制列表
    //$eventsManager->attach('dispatch:beforeDispatch', new SecurityPlugin);
    //404插件
    $eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);            
    $dispatcher = new Dispatcher;
    $dispatcher->setEventsManager($eventsManager);
    return $dispatcher;
});
    
$di->set('session', function () use($di,$config){      
    mmkdir($config->application->sessionCacheDir);     
    ini_set('session.save_handler','files');
    ini_set('session.save_path',$config->application->sessionCacheDir);
    $session = new SessionAdapter();                        
    $session->start();
    return $session;
});

//https://github.com/phalcon/incubator/tree/master/Library/Phalcon/Session/Adapter
$di->set('sessionSaveFile', function () use($di)
{
    p(222); 
    mmkdir(SESSION_SAVE_PATH,1);
    p(SESSION_SAVE_PATH);die;
    return new \Phalcon\Session\Adapter\Files(SESSION_SAVE_PATH);
}, true);
    
$di->set('url', function () use ($di) {    
    $url = new UrlProvider();
    $url->setBaseUri('/');
    return $url;
});    

//路由设置 
//https://docs.phalconphp.com/zh/latest/reference/routing.html#using-convertions
$di->set('router', function () use($di,$config)
{                         
    return require_once(APP_PATH.'config/router.php');
});   

/**
 * 注册用户组件 在模版中也可以调用
 */
$di->set('diServers',  function () use ($di) {
	return array_keys($di->getServices());
});

//配置文件
$di->set('config', $config);


//加载基础服务
#require_once WEB_ROOT . 'common/config/baseServices.php';        
//合并应用服务
require_once APP_PATH . '/config/services.php';   
 