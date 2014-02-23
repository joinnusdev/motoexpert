<?php

class Compte_IndexController extends App_Controller_Action_Default
{

    public function init()
    {
        parent::init();
    }
    
    public function indexAction()
    {
    	$modelanunce = new App_Model_Announce();    	
    	
    	$this->view->result = 
    	$modelanunce->announceByCLient($this->view->authData->cid);
    	
    	
        
    }
    
    
}

