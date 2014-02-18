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
        $result = $model->detailAnnounce($id);
        $this->view->detailAnnonces = $result;
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

