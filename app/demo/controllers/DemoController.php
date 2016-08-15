<?php
class DemoController extends ControllerBase
{
    public function initialize()
    {        
        parent::initialize();
    }
 
   
    public function indexAction()
    {       
      p('demoColler index action');   
        
    }
    
    public function demoAction()
    {  
        p('demoColler demo action');   
    }
     
}
