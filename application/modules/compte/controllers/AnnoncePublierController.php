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
    	
    	$this->view->valid = FALSE;
    	
    	if ($this->_request->isPost()) {
    		$params = $this->_getAllParams();
    		
    		
    		$date = strtotime(date('d-m-Y'));
    		$params['id_client'] = $this->view->authData->cid;
    		//$params['departement'] = substr($this->view->authData->code_postal, 0, 2);
    		$params['date_crea'] = $date;
    		$params['date_valid'] = $date;
    		$params['parution'] = '0';
    		$params['internet'] = '1';
    		$params['ispayed'] = '1';
    		$params['type_occaz'] = '1';
    		$params['modere'] = '1';
    		$params['id_cat'] = $params['category'];
    		$params['id_mot'] = $params['modele'];
    		$params['ref'] = $params['departement']."000".$params['id_mot']."0000";
    		
    		$id = $modelanunce->saveAnnonce($params);
    		$this->view->register = $this->getParam('register', NULL);
    		if ($this->view->register == "valid" and $id > 0) {
    			$this->view->valid = TRUE;
    			$this->view->caract = $params;
    			$this->view->idannunce = $id;
    		}
    		
    		//$this->_redirect('/compte');
    		
    		
    		
    	}
    }
    
    
}


