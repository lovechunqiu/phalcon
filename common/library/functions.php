<?php


function session($data = array(),$ope = 'get'){
    
    $session = Com::getDIServer('session');  
     
    if($ope=='destroy'){    
        return $session->destroy();
    }    
    
    if(empty($data)) return $_SESSION; 
    
    //读取
    if($ope=='get'){
        if($session->has($data)){
            return $session->get($data);
        }else{
            return false;
        }
    } 
    
    //设置
    if($ope=='set'){
        $session->set($data['key'],$data['value']);
    }
    
    //删除
    if($ope=='del'){    
        $session->remove($data); 
    }      
    
    return true;    
}


//https://github.com/phalcon/cphalcon/blob/master/phalcon/http/response/cookies.zep
function cookie($data = array(),$ope = 'get'){
    if(empty($data)) return $_COOKIE; 
    $cookies = Com::getDIServer('cookies');    
    //读取
    if($ope=='get'){
        if($cookies->has($data)){
            return $cookies->get($data)->getValue();
        }else{
            return false;
        }
    } 
    
    //设置
    if($ope=='set'){
        if(empty($data['expire'])) $data['expire'] = time()+60*60*24;
        $cookies->set($data['key'],$data['value'], $data['expire'])->send();
    }
    
    //删除
    if($ope=='del'){    
        $cookies->get($data)->delete();
    }
    
    return true;    
}

/**
 * mkdir   
 * @author  woshitongliango@126.com
 * @version 1.0
 * @param   string $dirPath 
 * @return             
 * @example  
 * p(__DIR__,1,true,['hello'=>'world']);    
 * p(__DIR__,1,true,['hello'=>'world'],'noexit);   
 * @todo error             
 */

function mmkdir($dirPath){     
    if(isset(pathinfo($dirPath)['extension'])){
         $dirPath = dirname($dirPath);          
    }            
    
    if(!is_dir($dirPath)){
        if(!mkdir($dirPath, 0755, TRUE)){
            throwError($dirPath.'mkdir error');
        }         
    }        
    return true;
}

/**
 * print args if last args is 'noexit' mean not use exit   
 * @author  woshitongliango@126.com
 * @version 1.0
 * @param   string int bool array res obj ……
 * @return             
 * @example  
 * p(__DIR__,1,true,['hello'=>'world']);    
 * p(__DIR__,1,true,['hello'=>'world'],'noexit);   
 * @todo              
 */
function p() {
    $args = func_get_args();
    $isExit = array_pop($args);
     
    //https://docs.phalconphp.com/zh/latest/api/Phalcon_Debug_Dump.html         
    foreach ($args as $arg) {
        echo (new \Phalcon\Debug\Dump())->variable($arg);
    }
    
    echo (new \Phalcon\Debug\Dump())->variable($isExit);
  
    if ($isExit != 'noexit') {
        exit();
    }
}
