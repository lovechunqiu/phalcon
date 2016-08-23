<?php
use Phalcon\Mvc\User\Component;
class Com extends \Phalcon\Mvc\User\Component{
            
    //获取di
    public static function getDIServer($serverName)
    { 
        //$di = new \Phalcon\DI()
        return \Phalcon\DI::getDefault()->getShared($serverName);                     
    } 
    
     
    
    //获取post数据
    public static  function postData()
    {  
        return Com::getDIServer('request')->getPost();
    }    
 
    //获取get数据
    public static  function getData()
    {   
        return $_GET;
        //return Com::getDIServer('request')->get();
    }     
     
        
}
