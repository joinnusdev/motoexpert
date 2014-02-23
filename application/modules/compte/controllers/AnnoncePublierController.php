<?php

class Compte_AnnoncePublierController extends App_Controller_Action_Default
{

    public function init()
    {
        parent::init();
        
    }
    
    public function indexAction()
    {
    	$form = new App_Form_CreateAnnounce();
    	$this->view->form = $form;
    	
    	
    	
    	$modelanunce = new App_Model_Announce();
    	$modelclient = new App_Model_Client();
    	$this->view->ruta = $this->config->app->photoUrl;    	
    	$this->view->result = 
    	$modelanunce->announceByCLient($this->view->authData->cid);
    	
    	$this->view->datos = $modelclient->getClientById($this->view->authData->cid);
    	
    	if ($this->_request->isPost()) {
    		$params = $this->_getAllParams();
    		$params['cid'] = $this->view->authData->cid;
    		
    	}
    	
    	
    	
        
    }
    
    
}

