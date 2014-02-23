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
        $formTienda = new App_Form_BuscarTienda();
        $this->view->formMagasin = $formTienda;
        $model = new App_Model_Magasin();
        $this->view->countMagasin = $model->countMagasinFrance();
        $modelSlider = new App_Model_Slider();
        $this->view->slider = $modelSlider->listSlider();
        
        $modelAnounce = new App_Model_Announce();
    	$this->view->totalAnuncio = $modelAnounce->countAnnounce();
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

