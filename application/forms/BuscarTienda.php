<?php

class App_Form_BuscarTienda extends App_Form
{
       public function init() {
        parent::init();
        
        $multi = new App_Model_Magasin();
        $e = new Zend_Form_Element_Select('magasin');
        $e->setMultiOptions(array('0'=> 'Magasin') + $multi->listMagasin());
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
