<?php

class App_Form_CrearContenido extends App_Form
{
    public function init() {
        parent::init();
        
        $e = new Zend_Form_Element_Hidden('idrbt');
        $this->addElement($e);
        
        $empresa = new App_Model_Empresa();
        $e = new Zend_Form_Element_Select('idempresa');
        $e->setMultiOptions($empresa->listEmpresas());        
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('cancion');        
        $e->setAttrib('required', 'required');
        $e->setAttrib('class', 'span6');
        $e->setRequired();
        $e->addValidator(new Zend_Validate_StringLength(array('min'=>1,'max'=>45)));
        $this->addElement($e);
        
        $multi = new App_Model_Categoria();
        $e = new Zend_Form_Element_Multiselect('categoria');        
        $e->setMultiOptions($multi->listComboCategoria());
        $this->addElement($e);
        
        
        $e = new Zend_Form_Element_Text('artista');
        $e->setAttrib('required', 'required');
        $e->setAttrib('class', 'span6');
        $e->setRequired();
        $e->addValidator(new Zend_Validate_StringLength(array('min'=>1,'max'=>45)));
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('pais');
        $e->setValue('Bolivia');
        $e->setAttrib('class', 'span6');
        $this->addElement($e);
        
        $empresa = new App_Model_Genero();
        $e = new Zend_Form_Element_Select('idgenero');
        $e->setMultiOptions($empresa->listComboGenero());
        $this->addElement($e);
                
        $e = new Zend_Form_Element_Text('tag');
        $e->setAttrib('class', 'span6');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('editora');
        $e->setAttrib('class', 'span6');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('precio');        
        $e->setValue('3.50');
        $e->setAttrib('class', 'span6');
        $this->addElement($e);
                
        $e = new Zend_Form_Element_Select('periodo');        
        $e->addMultiOption('7', '7');
        $e->addMultiOption('15', '15');
        $e->addMultiOption('30', '30');
        $e->setValue('7');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('fecha_valido');
        $e->setAttrib('class', 'span6');
        $this->addElement($e);
        
        /*
         * Canción mp3 
         */
        $config = Zend_Registry::get('config');
        $ruta = $config->app->mediaAudMp;
                
        $e = new Zend_Form_Element_File('cancion_formato_mp');
        $e->setDestination($ruta);
        $e->setAttrib('class', 'span6');
        $e->setAttrib('required', 'required');
        $e->setRequired(true);
        $this->addElement($e);
        
        /*
         * Canción wav
        */
        $config = Zend_Registry::get('config');
        $ruta = $config->app->mediaAudWav;
        
        $e = new Zend_Form_Element_File('cancion_formato_wav');
        $e->setDestination($ruta);
        $e->setAttrib('class', 'span6');
        $e->setAttrib('required', 'required');
        $e->setRequired(true);
        $this->addElement($e);
        
        /*
         * Imagen Pequeña
        */
        $config = Zend_Registry::get('config');
        $ruta = $config->app->mediaImgSmall;
        
        $e = new Zend_Form_Element_File('imagen_small');
        $e->setDestination($ruta);
        $e->setAttrib('class', 'span6');
        $e->setAttrib('required', 'required');
        $e->setRequired(true);
        $this->addElement($e);
        /*
         * Imagen Destacada
        */
        $config = Zend_Registry::get('config');
        $ruta = $config->app->mediaImgDestacada;
        
        $e = new Zend_Form_Element_File('imagen_destacada');
        $e->setAttrib('required', 'required');
        $e->setDestination($ruta);
        $e->setAttrib('class', 'span6');
        $this->addElement($e);
        
        
        
        $e = new Zend_Form_Element_Submit('guardar');
        $e->setLabel('Guardar');
        $e->setAttrib('class', 'btn btn-primary');
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
