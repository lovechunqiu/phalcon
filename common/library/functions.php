<?php

/**
 * cookie manage   
 * @author  woshitongliango@126.com
 * @version 1.0
 * @param   string $name 
 * @param   string $value
 * @return  boolen             
 * @example  
 * set cookie('name','value')    
 * get one cookie('name') 
 * get all cookie() 
 * del one cookie('name',null)
 * @todo        
 * @doc //https://github.com/phalcon/cphalcon/blob/master/phalcon/http/response/cookies.zep      
 */

function cookie($name = '', $value = '') {
     
    $cookies = Com::getDIServer('cookies');
    $cookieConfig = Com::getDIServer('config')->application->cookie->toArray();
    //del name
    if (!empty($name) && $value === null) {
        $cookies->get($name)->delete();
        return $cookies->has($name) ? false : true;
    }

    //get all
    if (empty($name) && empty($value)) {
        return $_COOKIE;
    }

    //set name
    if (!empty($name) && !empty($value)) {
        $cookies->useEncryption($cookieConfig['useEncryption'])->set($name, $value, $cookieConfig['expire'], $cookieConfig['path'])->send();
        //p($cookies->get($name)->setPath('/index/'));die;
        return $cookies->has($name);
    }

    //get name
    if (!empty($name) && empty($value)) {
        return $cookies->has($name) ? $cookies->get($name)->getValue() : false;
    }
}

/**
 * session manage   
 * @author  woshitongliango@126.com
 * @version 1.0
 * @param   string $name 
 * @param   string $value
 * @return  boolen             
 * @example  
 * set session('name','value')    
 * get one session('name') 
 * get all session() 
 * del one session('name',null)
 * destroy session(null)
 * @todo              
 */
function session($name = '', $value = '') {
    $session = Com::getDIServer('session');

    //del name
    if (!empty($name) && $value === null) {
        $session->remove($name);
        return $session->has($name) ? false : true;
    }

    //destroy session
    if ($name === null) {
        return $session->destroy();
    }

    //get all
    if (empty($name) && empty($value)) {
        return $_SESSION;
    }

    //set name
    if (!empty($name) && !empty($value)) {
        $session->set($name, $value);
        return $session->has($name);
    }

    //get name
    if (!empty($name) && empty($value)) {
        return $session->has($name) ? $session->get($name) : false;
    }
}

/**
 * mkdir   
 * @author  woshitongliango@126.com
 * @version 1.0
 * @param   string $dirPath 
 * @return  boolen             
 * @example  
 * mmkdir(WEB_ROOT.'cache/mkdirdemo')      
 * @todo error             
 */
function mmkdir($dirPath) {
    if (isset(pathinfo($dirPath)['extension'])) {
        $dirPath = dirname($dirPath);
    }

    if (!is_dir($dirPath)) {
        if (!mkdir($dirPath, 0755, TRUE)) {
            throwError($dirPath . 'mkdir error');
        }
    }

    return true;
}

/**
 * print args  
 * @author  woshitongliango@126.com
 * @version 1.0
 * @param   string int bool array res obj ……
 * @return             
 * @example  
 * p(__DIR__,1,true,['hello'=>'world']);       
 * @todo              
 */
function p() {
    $args = func_get_args();
    //https://docs.phalconphp.com/zh/latest/api/Phalcon_Debug_Dump.html         
    foreach ($args as $arg) {
        echo (new \Phalcon\Debug\Dump())->variable($arg);
    }
}
