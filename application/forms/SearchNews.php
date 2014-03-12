<?php

class App_Form_SearchNews extends App_Form
{
    public function init() {
        parent::init();
        
        /*$multi = new App_Model_CategoryMoto();
        $e = new Zend_Form_Element_Select('category');
        $e->setMultiOptions(array('0'=> 'Toute l’actu ')+$multi->listCategory());
        $this->addElement($e);
        */
        $multi = new App_Model_CategoryMoto();
        $e = new Zend_Form_Element_Select('category');
        $e->setMultiOptions(array(''=> 'sélectionner',
                                'Toute l’actu'=> 'Toute l’actu',
                                'Circuit et compétition'=> 'Circuit et compétition',
                                'Actualité Nationale'=> 'Actualité Nationale'));
        $this->addElement($e);
        
        
       /* $multi = new App_Model_Department();
        $e = new Zend_Form_Element_Select('deparment');
        $e->setMultiOptions(array('0'=> 'Toute l’actu') + $multi->listDepartment());
        $this->addElement($e);
       */ 
        $multi = new App_Model_Department();
        $e = new Zend_Form_Element_Select('deparment');
        $e->setMultiOptions(array(''=> 'sélectionner',
                                    'Toute l’actu'=> 'Toute l’actu',
                                    'Circuit et compétition'=> 'Circuit et compétition',
                                    'Info magasin'=> 'Info magasin'));
        $this->addElement($e);
        
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
