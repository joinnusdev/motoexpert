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
    	$page = $this->_getParam('page', 1);
    	$trier = $this->_getParam('trier', NULL);
    	
    	if ($this->_request->isGet() or $this->_request->isPost()) {    		    		
    		if ($datos and !is_null($datos)) {
    			$data = @$form->getValues();    			
    			
    			$result = $modelAnounce->listSearch($data, $trier);
    		    $data["page"] = $page;
    		    $data["trier"] = $trier;
    			$this->view->prueba = $data;
    			$paginator = Zend_Paginator::factory($result);
    			$paginator->setCurrentPageNumber($page)
    			->setItemCountPerPage(50);
    			$this->view->result = $paginator;
    			$this->view->trier = $trier;
    			
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

