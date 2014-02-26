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
    	$modelclient = new App_Model_Client();
    	$this->view->ruta = $this->config->app->photoUrl;
    	$this->view->result =$modelanunce->announceByCLient($this->view->authData->cid);    	 
    	$this->view->datos = $modelclient->getClientById($this->view->authData->cid);    	
    	
    	
        
    }
    
    
}

