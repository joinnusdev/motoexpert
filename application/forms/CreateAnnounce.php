<?php

class App_Form_CreateAnnounce extends App_Form
{
    public function init() {
        parent::init();
        
        $multi = new App_Model_Moto();
        $e = new Zend_Form_Element_Select('marque');        
        $e->setMultiOptions(array('0'=> '-- Marque --')+$multi->listarMarca());
        $this->addElement($e);
        
        $multi = new App_Model_Department();
        $e = new Zend_Form_Element_Select('deparment');
        $e->setMultiOptions(array('0'=> 'Département') + $multi->listDepartment());
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Select('modele');
        $e->setMultiOptions(array('0'=> '-- Modele --'));
        $this->addElement($e);
        
        $multi = new App_Model_Category();
        $e = new Zend_Form_Element_Select('category');
        $e->setMultiOptions(array('0'=> 'Catégorie')+$multi->listCategory());
        $this->addElement($e);
        
        
        $e = new Zend_Form_Element_Text('annee');
        $e->setAttrib('placeholder', "Année");        
        $this->addElement($e);
        $e = new Zend_Form_Element_Text('cylindree');
        $e->setAttrib('placeholder', "Cylindrée");
        $this->addElement($e);
        $e = new Zend_Form_Element_Text('couleur');
        $e->setAttrib('placeholder', "Couleur");
        $this->addElement($e);
        $e = new Zend_Form_Element_Text('km');
        $e->setAttrib('placeholder', "Kilométrage");
        $this->addElement($e);
        $e = new Zend_Form_Element_Text('prix');
        $e->setAttrib('placeholder', "Prix");
        $this->addElement($e);
        $e = new Zend_Form_Element_Textarea('descr_site');
        $e->setAttrib('cols', '35');
        $e->setAttrib('rows', '4');
        $e->setRequired(true);
        $this->addElement($e);
        $e->setAttrib('placeholder', "Descriptif");
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Checkbox('check_prix');
        $e->setUncheckedValue('');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Checkbox('check_km');
        $e->setUncheckedValue('');
        $this->addElement($e);
        
        
        $e = new Zend_Form_Element_Hidden('id');
        $this->addElement($e);
        
        
        
        $config = Zend_Registry::get('config');
        $ruta = $config->app->fotoPrincipal;
        
        $e = new Zend_Form_Element_File('file1');        
        $e->setDestination($ruta);                
        $this->addElement($e);
        
        $e = new Zend_Form_Element_File('file2');
        $e->setDestination($ruta);
        $this->addElement($e);
        
        $e = new Zend_Form_Element_File('file3');
        $e->setDestination($ruta);
        $this->addElement($e);
        
        $e = new Zend_Form_Element_File('file4');
        $e->setDestination($ruta);
        $this->addElement($e);
        
        $e = new Zend_Form_Element_File('file5');
        $e->setDestination($ruta);
        $this->addElement($e);
        
        
         foreach($this->getElements() as $e) {
            $e->removeDecorator('DtDdWrapper');
            $e->removeDecorator('Label');
            $e->removeDecorator('HtmlTag');
        } 
    }
}

?>
