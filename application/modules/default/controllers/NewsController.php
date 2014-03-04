<?php

class Default_NewsController extends App_Controller_Action_Default
{

    public function init()
    {
        parent::init();
    }
    
    public function indexAction()
    {
        $modelNoticia = new App_Model_Noticia();
        $this->view->news = $modelNoticia->listNews();
       
    } 
    
    public function detailAction(){}
    
}

?>
