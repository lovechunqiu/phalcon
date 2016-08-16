<?php

/**
 * func 10 del dir   
 * @author  woshitongliango@126.com
 * @version 1.0
 * @param   string $dirname  
 * @param   boolen $isSelfDir   
 * @return  boolen             
 * @example  
 * p(getDirList(WEB_ROOT.'cache'));
 * @todo        
 */
function delDir($dirname,$isSelfDir=false){
    $getDirList = getDirList($dirname);      
    if(!$getDirList){
        return true;
    }
    arsort($getDirList['dirList']);  
    //del filename
    if($getDirList['fileList']){
        foreach ($getDirList['fileList'] as $key => $value) {
            unlink($value);
        }
    }
    //del dir
    if($getDirList['dirList']){
        foreach ($getDirList['dirList'] as $key => $value) {            
            rmdir($value);
        }
    }            
    if($isSelfDir) rmdir($dirname);     
    return true;
}

/**
 * func 9 del filename   
 * @author  woshitongliango@126.com
 * @version 1.0
 * @param   string $filePath  
 * @return  boolen             
 * @example  
 * p(getDirList(WEB_ROOT.'cache'));
 * @todo        
 */
function delFile($filePath){
    return file_exists($filePath)?unlink($filePath):true;
}

/**
 * func 8 tree dirname   
 * @author  woshitongliango@126.com
 * @version 1.0
 * @param   string $dirname  
 * @return  boolen             
 * @example  
 * p(getDirList(WEB_ROOT.'cache'));
 * @todo        
 */
function getDirList($dirname) {

    global $result_demo;
    if (!isset($result_demo)) {
        $result_demo = array(
            'totalCountDir' => 0,
            'totalCountFile' => 0,
            'dirList' => array(),
            'fileList' => array(),
            'totalSize' => 0,
        );
        if (!file_exists($dirname) || !is_dir($dirname)) {
            return false;
        }
    }
    
    $handle = opendir($dirname);
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            $path = $dirname . '/' . $file;
            if (is_dir($path)) {
                $result_demo['dirList'][] = $path;
                $result_demo['totalCountDir'] += 1;
                getDirList($path);
            } else {
                $result_demo['fileList'][] = $path;
                $result_demo['totalSize'] += filesize($path);
                $result_demo['totalCountFile'] += 1;
            }
        }
    }
    closedir($handle);
    return $result_demo;
}

/**
 * func 7 read or write file   
 * @author  woshitongliango@126.com
 * @version 1.0
 * @param   string $filePath 
 * @param   string $content  
 * @param   boolen $isAppend   
 * @return  boolen             
 * @example  
 * mFile(WEB_ROOT.'cache/aaa/abc.html.txt','aaa',true)
 * mFile(WEB_ROOT.'cache/aaa/abc.html.txt') 
 * @todo        
 */
function mFile($filePath = '', $content = '', $isAppend = false) {
    if (empty($content)) {
        if (!isFileName($filePath) || !file_exists($filePath)) {
            trigger_error($filePath . ' no exist!');
        }
        return file_get_contents($filePath);
    }

    if (isFileName($filePath) && mmkdir($filePath)) {
        $ret = $isAppend ? file_put_contents($filePath, $content, FILE_APPEND) : file_put_contents($filePath, $content);
        if (!$ret) {
            trigger_error($filePath . ' write fail!');
        }
        return true;
    } else {
        trigger_error($filePath . ' operateion fail!');
    }
}

/**
 * func 6 show error   
 * @author  woshitongliango@126.com
 * @version 1.0
 * @param   object $e 
 * @param   string $type  phalconPdoError  phalconDefaultError phalconError
 * @return  boolen             
 * @example  
 * trigger_error ('Trigger a fatal error');
 * throw new \Exception("An error");
 * 3/0;
 * unlink('abc'); 
 * @todo     
 * log error msg   
 */
function showError($e, $type = 'phalconError') {
    $msg = PHP_EOL . DATE . ' ' . $type . ' fileName ' . $e->getFile() . PHP_EOL . 'fileLine ' . $e->getLine() . PHP_EOL . 'errorMessage ' . PHP_EOL . $e->getMessage() . PHP_EOL;
    if (DEBUG) {
        p($msg);
        exit();
    } else {
        exit('not found');
    }
}

//cache try error
set_error_handler(function($errorCode, $errorMessage, $errorFile, $errorLine) {     
    throw new ErrorException($errorMessage, 0, $errorCode, $errorFile, $errorLine);
    exit();
});

/**
 * func 5 judge path if filename   
 * @author  woshitongliango@126.com
 * @version 1.0
 * @param   string $path 
 * @return  boolen             
 * @example  
 * p(isFileName(WEB_ROOT.'cache/abc.html.txt'),isFileName(WEB_ROOT.'cache/abc/')); 
 * @todo        
 */
function isFileName($path = '') {
    return isset(pathinfo($path)['extension']) ? true : false;
}

/**
 * func 4 cookie manage   
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
 * func 3 session manage   
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
 * func 2 mkdir   
 * @author  woshitongliango@126.com
 * @version 1.0
 * @param   string $dirPath 
 * @return  boolen             
 * @example  
 * p('func 2 mkdir 创建目录',mmkdir(WEB_ROOT.'cache/mkdirdemo'));die;    
 * @todo error             
 */
function mmkdir($dirPath) {
    if (isFileName($dirPath)) {
        $dirPath = dirname($dirPath);
    }

    if (!is_dir($dirPath)) {
        if (!mkdir($dirPath, 0755, TRUE)) {
            trigger_error($dirPath . 'mkdir error');
        }
    }

    return true;
}

/**
 * func 1 print args  
 * @author  woshitongliango@126.com
 * @version 1.0
 * @param   string int bool array res obj ……
 * @return             
 * @example  
 * p('func 1 print args  参数打印',__DIR__,1,true,['hello'=>'world']);die;       
 * @todo              
 */
function p() {
    $args = func_get_args();
    //https://docs.phalconphp.com/zh/latest/api/Phalcon_Debug_Dump.html         
    foreach ($args as $arg) {
        echo (new \Phalcon\Debug\Dump())->variable($arg);
    }
}
