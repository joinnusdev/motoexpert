<?php

class Default_AnnoncesController extends App_Controller_Action_Default
{

    public function init()
    {
        parent::init();
    }
    
    public function indexAction()
    {
        $datos = $this->getAllParams();
    	$form = new App_Form_SearchMotoDeta();    	
    	$this->view->announce = $datos;    	
    	$modelAnounce = new App_Model_Announce();
    	
    	$this->view->result = "";
    	$this->view->total = 0;
    	$this->view->totalAnuncio = $modelAnounce->countAnnounce();
    	$datos = $this->getAllParams();
    	$form->populate($datos);
    	$this->view->form = $form;
    	$page = $this->_getParam('page');
    	
    	if ($this->_request->isGet()) {    		    		
    		if ($datos and !is_null($datos)) {
    			    			
    			$data = @$form->getValues();
    			$result = $modelAnounce->listSearch($data);
    			
    			$this->view->prueba = $data;
    			
    			
    			$paginator = Zend_Paginator::factory($result);
    			$paginator->setCurrentPageNumber($page)
    			->setItemCountPerPage(10);
    			$this->view->result = $paginator;    			    			
    			
    			if ($this->view->result)
    			$this->view->total = count($result);    			
    		}
    	}
    }
    
    public function getModeleAction()
    {
    	$this->_helper->layout->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
    	
    	$id = $this->_getParam('id');
    	
    	$model = new App_Model_Moto();
    	
    	$result = $model->listarModelo($id);
    	
    	echo Zend_Json::encode($result);
    } 

}

