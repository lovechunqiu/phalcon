<?php
use Phalcon\Mvc\View as View;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;

        
$di->set('view', function () use ($di,$config){        
    $view = new View();         
    $view->setViewsDir($config->application->viewsDir);
    $view->registerEngines(array(
        ".html" => 'volt'
    ));
    return $view;
});

//注册模版引擎
$di->set('volt', function ($view, $di) use ($config){    
     
    $volt = new VoltEngine($view, $di);
    //模版引擎参数配置
    $volt->setOptions(array(                     
        'stat' => true,
        'compileAlways' => true,
        'compiledPath' => function ($templatePath) use($di, $config){           
            $_SERVER['controllerName'] = $di['dispatcher']->getControllerName();            
            $_SERVER['actionName']  = $di['dispatcher']->getActionName();    
            $pathinfo = pathinfo($templatePath);             
            $path = $config->application->voltCacheDir.$_SERVER['controllerName'].'/'.$pathinfo['basename'];                
            mmkdir($path);
            return $path . '.php';                        
        }
    ));
    $compiler = $volt->getCompiler();
    //{{ haha('aaa','bbb') }}
    //$compiler->addFunction('haha', 'var_dump');
    //{{ p(11111) }}
    //$compiler->addFunction('p', 'p');
    //viewFunctionExtension
    //模版条用函数
    //$compiler->addExtension(new PhpFunctionExtension());
    return $volt;
}, true);
