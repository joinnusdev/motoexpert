<?php

class Compte_AnnoncePublierController extends App_Controller_Action_Default
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
    	$this->view->result = 
    	$modelanunce->announceByCLient($this->view->authData->cid);
    	
    	$this->view->datos = $modelclient->getClientById($this->view->authData->cid);
    	
    	if ($this->_request->isPost()) {
    		$params = $this->_getAllParams();
    		$params['cid'] = $this->view->authData->cid;
    		
    		$modelclient->saveClient($params);    		
    		
    		$this->_redirect('/compte');
    		
    	}
    	
    	
    	
        
    }
    
    
}

