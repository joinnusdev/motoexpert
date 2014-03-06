<?php

class Default_NewsController extends App_Controller_Action_Default
{

    public function init()
    {
        parent::init();
    }
    
    public function indexAction()
    {
    	$form = new App_Form_SearchNews();
    	$this->view->form = $form;
        $modelNoticia = new App_Model_Noticia();
        
        $datos = $this->getAllParams();
        $form->populate($datos);
        $page = $this->_getParam('page', NULL);
        
        if ($this->_request->isGet()) {
        	if ($datos and !is_null($datos)) {
        
        		$data = @$form->getValues();
        		$result = $modelNoticia->listNews();
        		 
        		$this->view->prueba = $data;        		 
        		 
        		$paginator = Zend_Paginator::factory($result);
        		$paginator->setCurrentPageNumber($page)
        		->setItemCountPerPage(50);
        		$this->view->result = $paginator;
        		 
        		if ($this->view->result){
        			$this->view->total = count($result);        			
        		}
        	}
        }
    } 
    
    public function detailAction()
    {
    	$modelNoticia = new App_Model_Noticia();    	
    	$datos = $this->getAllParams();    	
    	$page = $this->_getParam('cod_new', NULL);
    	
    	if ($this->_request->isGet()) {
    		if ($datos and !is_null($datos)) {    	
    			$result = $modelNoticia->listNews();
    			 
    			$paginator = Zend_Paginator::factory($result);
    			$paginator->setCurrentPageNumber($page)
    			->setItemCountPerPage(1);
    			$this->view->result = $paginator;
    			 
    			if ($this->view->result){
    				$this->view->total = count($result);
    			}
    		}
    	}
    	
    }
    
}