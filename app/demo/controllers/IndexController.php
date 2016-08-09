<?php
class IndexController extends ControllerBase
{
    public function initialize()
    {        
        parent::initialize();
    }
 
   
    public function indexAction()
    {       
      //$_SESSION['aaa'] = time();
      
      session(['key'=>'userSessionInfo','value'=>time()],'set'); 
      p(session(),$_SERVER,Com::getData());       
      $this->view->pick('index/index');
        
    }
    
    public function mainAction()
    {  
        
    }
     
}
