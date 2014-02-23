<?php

class App_Form_CreateAnnounce extends App_Form
{
    public function init() {
        parent::init();
        
        $multi = new App_Model_Moto();
        $e = new Zend_Form_Element_Select('marque');        
        $e->setMultiOptions(array('0'=> '-- Marque --')+$multi->listarMarca());
        $this->addElement($e);
        
        
        $e = new Zend_Form_Element_Select('modele');
        $e->setMultiOptions(array('0'=> '-- Modele --'));
        $this->addElement($e);
        
        $multi = new App_Model_Category();
        $e = new Zend_Form_Element_Select('category');
        $e->setMultiOptions(array('0'=> 'Catégorie')+$multi->listCategory());
        $this->addElement($e);
        
         foreach($this->getElements() as $e) {
            $e->removeDecorator('DtDdWrapper');
            $e->removeDecorator('Label');
            $e->removeDecorator('HtmlTag');
        } 
    }
}

?>
