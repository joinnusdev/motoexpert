<?php

class App_Form_SearchMotoDeta extends App_Form
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
        
        $e = new Zend_Form_Element_Select('category');
        $e->setMultiOptions(array('0'=> 'Catégorie'));
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Select('deparment');
        $e->setMultiOptions(array('0'=> 'Département'));
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Select('magasin');
        $e->setMultiOptions(array('0'=> 'Magasin'));
        $this->addElement($e);
        
        
        $e = new Zend_Form_Element_Submit('button');        
        $this->addElement($e);
        
        
         foreach($this->getElements() as $e) {
            $e->removeDecorator('DtDdWrapper');
            $e->removeDecorator('Label');
            $e->removeDecorator('HtmlTag');
        } 
    }
}

?>
