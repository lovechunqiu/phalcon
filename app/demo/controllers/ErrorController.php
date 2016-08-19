<?php
class ErrorController extends ControllerBase
{
    public function initialize()
    {        
        parent::initialize();
    }
 
   
    public function indexAction()
    {       
      p('demoColler index  040 action');   
        
    }
    
    public function show404Action()
    {  
        p($_SERVER,'demoColler 404  demo action');   
    }
     
}
