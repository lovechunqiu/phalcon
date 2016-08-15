<?php
use Phalcon\Mvc\Controller;
class ControllerBase extends Controller
{  
 
    protected function initialize()
    {    
        //title
        //$this->tag->prependTitle('INVO | ');             
    }
    
    public function beforeExecuteRoute($dispatcher)
    {       
                      
          
    }
       
    public function afterExecuteRoute($dispatcher)
    {      
     
        
    }    
     
     
    public function forward($params)
    {         
          
    	return $this->dispatcher->forward(
            array(
                'controller' => $params['controller'],
                'action' => $params['action'],               
            )
    	);
    }
             
    
}
