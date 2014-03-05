<?php

class Default_FranchiseController extends App_Controller_Action_Default
{

    public function init()
    {
        parent::init();
    }
    
    public function indexAction()
    {
        
    } 
    public function occasionMotoAction(){
        $model = new App_Model_Servicio();
        $result = $model->getOcasion();
        $this->view->ocasion = $result;
    }
    public function carteFideliteAction(){
        $model = new App_Model_Servicio();
        $result = $model->getFanClub();
        //print_r($result);   
       // echo $result[3]['copyright-text'];
        
        $this->view->fan = $result;
        
    }
    public function serviceRapideAction(){
        
    }
    
    public function livraisonMotoAction(){
        
    }
    
}

?>
