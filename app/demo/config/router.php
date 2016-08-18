<?php
//https://docs.phalconphp.com/zh/latest/reference/routing.html
use Phalcon\Mvc\Router as Router;
//参数为false就是不按照系统默认的规则    
$router = new Router(false);
/*设置默认的控制器以前方法 为true的情况下管用
$router->setDefaults(
    array(
        'controller' => 'index',
        'action'     => 'index.do'
    )
);
$router->setDefaultController('index');
$router->setDefaultAction('index');  
*/




//$router->add(
//    //"/category/([0-9]{4})/([0-9]{2})/([0-9]{2})/:params",
//    "/(.*)-c([0-9]{4}).html",        
//    array(
//        "controller" => "index",
//        "action"     => "demo",
//        "catid"       => 1, // ([0-9]{4})
//        //"month"      => 2, // ([0-9]{2})
//        //"day"        => 3, // ([0-9]{2})
//        //"params"     => 4  // :params
//    
//))->convert('controller', function($controller) { 
//    return $controller;
//})->convert('action', function($action) {     
//    return $action;
//});
////rewrite "^/(.*)-c([0-9]+)-sale([0-9]+)(.*)\.html$" /category.php?id=$2&sale=$3 last;

//Messenger-Bags-c37-b0.html
//"/(.*)-c([0-9]{4}).html",   


 
//设置默认控制器 默认方法
$router->add('/', array(
'controller' => 'index',
'action' => 'index',
));



//在控制器存在的情况下 设置默认方法
//$router->add('/:controller.html|/:controller[/]{0,1}', array(	 
 
$router->add('/:controller'.$config->application->urlExt, array(	
        'controller' => 1,      
        'action' => 'index',
))->convert('controller', function($controller) {           
    return $controller;
});

 //全局.do规则 后续可以做分类的html形式
$router->add('/:controller/:action'.$config->application->urlExt, array(	 
        'controller' => 1,
        'action' => 2,    
))->convert('controller', function($controller) { 
     
    return $controller;
})->convert('action', function($action) {     
    return $action;
});

//设置404
$router->notFound(array(    
   'controller' => 'error',
   'action'=> 'show404'
));



//http://my.demo.com/index-c12.html?a=1
$router->add(
    "/(.*)-c([0-9]+)\.html",   
    array(
        'controller' => 'demo',
        'action'     => 'index',
        'catid'       => 2, // ([0-9]{4})
))->convert('controller', function($controller) { 
    //p($controller);
    return $controller;
})->convert('action', function($action) {  
     //p($action);die;
    return $action;
});

$controllerName = $router->getControllerName();    
$actionName = $router->getActionName(); 
$router->handle();
return $router;
