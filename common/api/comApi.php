<?php
use Phalcon\Mvc\User\Component;
class comApi extends \Phalcon\Mvc\User\Component{
            
    //获取di
    public static function demo()
    { 
        return 'comApi static demo';
                             
    } 
    
    
    public  function demo3()
    { 
        return 'comApi demo3';
                             
    } 
                     
}
