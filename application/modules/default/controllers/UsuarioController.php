<?php

class Default_UsuarioController extends App_Controller_Action_Admin {

	public function init() {
		parent::init();
	}

	public function crearAction() {
		$this->view->headLink()->appendStylesheet(
				$this->getConfig()->app->mediaUrl . 'css/lib/bootstrap-wysihtml5.css'
		);
		$this->view->headLink()->appendStylesheet(
				$this->getConfig()->app->mediaUrl . 'css/lib/uniform.default.css'
		);
		$this->view->headLink()->appendStylesheet(
				$this->getConfig()->app->mediaUrl . 'css/lib/select2.css'
		);
		$this->view->headLink()->appendStylesheet(
				$this->getConfig()->app->mediaUrl . 'css/lib/bootstrap.datepicker.css'
		);
			
		$this->view->headLink()->appendStylesheet(
				$this->getConfig()->app->mediaUrl . 'css/compiled/form-showcase.css'
		);
			
		$this->view->headScript()->appendFile(
				$this->getConfig()->app->mediaUrl . 'js/wysihtml5-0.3.0.js'
		);
		$this->view->headScript()->appendFile(
				$this->getConfig()->app->mediaUrl . 'js/bootstrap-wysihtml5-0.0.2.js'
		);
		$this->view->headScript()->appendFile(
				$this->getConfig()->app->mediaUrl . 'js/bootstrap.datepicker.js'
		);
		$this->view->headScript()->appendFile(
				$this->getConfig()->app->mediaUrl . 'js/jquery.uniform.min.js'
		);
		$this->view->headScript()->appendFile(
				$this->getConfig()->app->mediaUrl . 'js/select2.min.js'
		);
		$form = new App_Form_CrearUsuario();
		$this->view->form = $form;
			
		if ($this->_request->isPost()) {
			$data = $this->getRequest()->getPost();

			if ($form->isValid($data)) {
				$data['fecha_registro'] = Zend_Date::now()->toString('Y-MM-dd HH:mm:ss');
				$model = new App_Model_Empresa();
				$id = $model->addUser($data);
					
				if ($id) {
					$this->_flashMessenger->addMessage("Usuario registrado con éxito");
					$this->_redirect('/admin/usuario');
				} else
					$this->_flashMessenger->addMessage("Lo sentimos hubo un error de comunicación favor,
							intentalo nuevamente");
					
					
					
			}
			$form->populate($data);




		}
	}

	public function cambiarClaveAction() {
		$this->view->headLink()->appendStylesheet(
				$this->getConfig()->app->mediaUrl . 'css/lib/bootstrap-wysihtml5.css'
		);
		$this->view->headLink()->appendStylesheet(
				$this->getConfig()->app->mediaUrl . 'css/lib/uniform.default.css'
		);
		$this->view->headLink()->appendStylesheet(
				$this->getConfig()->app->mediaUrl . 'css/lib/select2.css'
		);
		$this->view->headLink()->appendStylesheet(
				$this->getConfig()->app->mediaUrl . 'css/lib/bootstrap.datepicker.css'
		);

		$this->view->headLink()->appendStylesheet(
				$this->getConfig()->app->mediaUrl . 'css/compiled/form-showcase.css'
		);

		$this->view->headScript()->appendFile(
				$this->getConfig()->app->mediaUrl . 'js/wysihtml5-0.3.0.js'
		);
		$this->view->headScript()->appendFile(
				$this->getConfig()->app->mediaUrl . 'js/bootstrap-wysihtml5-0.0.2.js'
		);
		$this->view->headScript()->appendFile(
				$this->getConfig()->app->mediaUrl . 'js/bootstrap.datepicker.js'
		);
		$this->view->headScript()->appendFile(
				$this->getConfig()->app->mediaUrl . 'js/jquery.uniform.min.js'
		);
		$this->view->headScript()->appendFile(
				$this->getConfig()->app->mediaUrl . 'js/select2.min.js'
		);
			
		$cod = (int) $this->getParam('cod');
		$form = new App_Form_EditarUsuario();
		$this->view->form = $form;
		$mod = new App_Model_Empresa();

		if ($cod) {
			$data = $mod->getUserEmpresa($cod);
			$form->populate($data);
		}



		if ($this->_request->isPost()) {
			$dataPost = $this->getAllParams();
			$modelUser = new App_Model_UsuarioEmpresa();

			$result = $modelUser->changePassword($dataPost);

			if ($result) {
				$this->_flashMessenger->addMessage("Clave cambiada con exito");
				$this->_redirect('/admin/usuario');
			}
			else {
				$this->view->msg = "Favor intentalo nuevamente";
				$form->populate($dataPost);
			}


		}


			
			
			
	}

	public function indexAction() {
			
		$this->view->headLink()->appendStylesheet(
				$this->getConfig()->app->mediaUrl . 'css/compiled/tables.css'
		);
		$model = new App_Model_Empresa();
		$form = new App_Form_BuscarUsuarioEmpresa();
			
		if ($this->_request->isGet()) {
			$busqueda = $this->getParam('busqueda');
			$flag = $this->getParam('flag');
			$empresas = $model->listUserEmpresa($flag, $busqueda);
		}
			
		$this->view->form = $form;
		$this->view->empresas = $empresas;
			
	}



}