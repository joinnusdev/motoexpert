<?php

class App_Form_CrearUsuario extends App_Form
{
    public function init() {
        parent::init();
        
        $e = new Zend_Form_Element_Text('nombre');        
        $e->setAttrib('required', 'required');
        $e->setAttrib('class', 'span6');
        $e->setRequired();
        $e->addValidator(new Zend_Validate_StringLength(array('min'=>1,'max'=>45)));
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('ruc');
        $e->setAttrib('class', 'span6');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('direccion');
        $e->setAttrib('class', 'span6');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('direccion');
        $e->setAttrib('class', 'span6');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('representante_legal');
        $e->setAttrib('class', 'span6');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('telefono');
        $e->setAttrib('class', 'span6');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('web');
        $e->setAttrib('class', 'span6');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('celular');
        $e->setAttrib('class', 'span6');
        $this->addElement($e);

        $e = new Zend_Form_Element_Text('correo_electronico');
        $e->setAttrib('class', 'span6');
        $e->setFilters(array("StripTags", "StringTrim"));
        $v = new Zend_Validate_EmailAddress();
        $e->addValidator($v);
        $e->setRequired(true);
        $e->addFilter(new Zend_Filter_HtmlEntities());
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('usuario');        
        $e->setRequired();
        $e->setAttrib('class', 'span6');
        $this->addElement($e);        

        $e = new Zend_Form_Element_Password('clave');
        $e->setAttrib('class', 'span6');
        $e->setLabel('Password');
        $e->setRequired();
        $e->setAttrib("autocomplete", "off");
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Select('tipousuario');        
        $e->addMultiOption('2', 'Empresa');
        $e->addMultiOption('3', 'Operador');
        $e->addMultiOption('1', 'Admin');
        $this->addElement($e);
                
        $e = new Zend_Form_Element_Submit('guardar');
        $e->setLabel('Guardar');
        $e->setAttrib('class', 'btn primary');
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
