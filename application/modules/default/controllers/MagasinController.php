<?php

class Default_MagasinController extends App_Controller_Action_Default
{

    public function init()
    {
        parent::init();
    }
    
    
    public function indexAction(){
        $idMagasin = $this->_getParam('magasin');
        $model = new App_Model_Magasin();
        $this->view->magasinInfo = $model->magasinInfo($idMagasin);
        $this->view->magasinPhoto = $model->magasinPhoto($idMagasin);
        $this->view->lastAnnoncesMagasin = $model->lastAnnoncesMagasin($idMagasin);
    }
}