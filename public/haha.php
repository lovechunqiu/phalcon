<?php
//ini_set('display_errors',1);
//ini_set('log_errors',1); 
//ini_set('error_log',WEB_ROOT.'cache/log/error/'.APP_FILE_NAME.'/'. date('Y-m-d') . '.log');  
session_start();
    	 
    	$array = explode(' ', microtime());
    	$microtime = round(($array[0]+$array[1])*1000);
        var_dump($microtime,time(),$microtime/1000);die;
        
var_dump(1111,$_GET,$_SESSION);
