<?php

class Default_FicheMotoController extends App_Controller_Action_Default
{

    public function init()
    {
        parent::init();
    }
    
    public function indexAction()
    {
    	$form = new App_Form_SearchMotoDeta();
    	$this->view->form = $form;
        $id = $this->_getParam('id');
        $model = new App_Model_Announce();
        $result = $model->detailFichaAnnounce($id);
        $this->view->detailAnnonces = $result;
        
        $resultPhoto = $model->photoDetailAnnonce($id);
        $this->view->photoAnnonces = $resultPhoto;
        
        
        
        $page = $this->_getParam('page', NULL);
    	$codigo = $this->_getParam('id', NULL);
        $modelNoticia = new App_Model_Noticia();
    	if ($this->_request->isGet()) {
    		if ($datos and !is_null($datos)) {    	
    			$result = $modelNoticia->listNewsDeta($codigo);
    			if ($codigo) {
    				$result = $result + $modelNoticia->listNews($codigo);    				
    			}
    			 
    			$this->view->prueba = $datos;
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

