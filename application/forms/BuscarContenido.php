<?php

class App_Form_BuscarContenido extends App_Form
{
    public function init() {
        parent::init();
        
        $this->addElement(new Zend_Form_Element_Select('flag'));
        $this->getElement('flag')->addMultiOption('cancion', 'Canción');
        $this->getElement('flag')->addMultiOption('artista', 'Artista');
        $this->getElement('flag')->addMultiOption('empresa', 'Empresa');
        //$this->getElement('flag')->addMultiOption('categoria', 'Categoría');
        
        $e = new Zend_Form_Element_Text('busqueda');
        $e->setAttrib('class', 'search');        
        $this->addElement($e);        
        $this->addElement('hash', 'csrf');
        
         foreach($this->getElements() as $e) {
            $e->removeDecorator('DtDdWrapper');
            $e->removeDecorator('Label');
            $e->removeDecorator('HtmlTag');
        } 
    }
}

?>
