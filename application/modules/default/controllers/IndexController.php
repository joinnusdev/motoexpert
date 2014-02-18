<?php

class Default_IndexController extends App_Controller_Action_Default
{

    public function init()
    {
        parent::init();
    }
    
    public function indexAction()
    {
        $modelMoto = new App_Model_Moto();
        
        $result = $modelMoto->listarMarca();
        print_r($result);
        
       
    } 

}

