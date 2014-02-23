<?php
class App_Controller_Action_Default extends App_Controller_Action
{
	public function init()
	{
		parent::init();
                $formTienda = new App_Form_BuscarTienda();
        $this->view->formMagasin = $formTienda;
		$this->_helper->layout->setLayout('layout');

	}
}