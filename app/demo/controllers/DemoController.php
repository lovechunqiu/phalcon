<?php
class DemoController extends ControllerBase
{
    public function initialize()
    {        
        parent::initialize();
    }
 
   
    public function indexAction()
    { 
      //p(cookie('name',null));  
      //p(cookie('name',TIME));
      //p(cookie('name'),cookie());
     
              
      //p(session('name',null));  
      //p(session('name','value'));
      //p(session('name'),session());
      //p(session(null));
      p(__DIR__,1,true,['hello'=>'world'],WEB_ROOT,mmkdir(WEB_ROOT.'cache/mkdirdemo'));die;
      p('demoColler index action');   
      $this->view->pick('demo/demo');
    }
    
    public function demoAction()
    {  
        p('demoColler demo action');   
    }
     
}
