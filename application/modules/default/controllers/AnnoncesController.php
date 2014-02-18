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
    	$form->populate($datos);
    	$this->view->form = $form;
    	$this->view->announce = $datos;
    	
    	$modelAnounce = new App_Model_Announce();
    	$this->view->result = $modelAnounce->listSearch($datos);    	
    	$this->view->total = $modelAnounce->countSearch($datos);
    	
    	
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

