<?php
class ErrorController extends ControllerBase
{
    public function initialize()
    {        
        parent::initialize();
    }
 
   
    public function indexAction()
    {       
      p('demoColler index action');   
        
    }
    
    public function show404Action()
    {  
        p('demoColler demo action');   
    }
     
}
