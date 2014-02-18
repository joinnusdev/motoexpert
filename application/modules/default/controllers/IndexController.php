<?php

class Default_IndexController extends App_Controller_Action_Default
{

    public function init()
    {
        parent::init();
    }
    
    public function indexAction()
    {
        /*$modelMoto = new App_Model_Moto();
        $result = $modelMoto->listarMarca();
        $this->view->listarMarca = $result; */
    	$form = new App_Form_BuscarMoto();
    	$this->view->form = $form;
    }
    
    public function getModeleAction()
    {
    	$this->_helper->layout->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
    	
    	$id = $this->_getParam('id');
    	
    	$model = new App_Model_Moto();
    	
    	$result = $model->listarModelo($id);
    	
    	echo Zend_Json::encode($result);

        //$this->view->listarMarca = $result;

    } 

}

