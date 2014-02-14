<?php

class Default_ContenidoController extends App_Controller_Action_Admin {

	public function init() {
		parent::init();
	}

	public function indexAction() {
		$this->view->headLink()->appendStylesheet(
				$this->getConfig()->app->mediaUrl . 'css/lib/uniform.default.css'
		);
		$this->view->headLink()->appendStylesheet(
				$this->getConfig()->app->mediaUrl . 'css/compiled/tables.css'
		);

		$model = new App_Model_Rbt();
		$form = new App_Form_BuscarContenido();

		if ($this->_request->isGet()) {
			$busqueda = $this->getParam('busqueda');
			$flag = $this->getParam('flag');
			$contenido = $model->listRbt($flag, $busqueda);
			//var_dump($contenido);exit;
		}
		$params = $this->getAllParams();
		$form->populate($params);

		$this->view->form = $form;
		$this->view->rbt = $contenido;


	}
	
	public function ordenarAction() {
		$this->view->headLink()->appendStylesheet(
				$this->getConfig()->app->mediaUrl . 'css/lib/uniform.default.css'
		);
		$this->view->headLink()->appendStylesheet(
				$this->getConfig()->app->mediaUrl . 'css/compiled/tables.css'
		);
	
		$model = new App_Model_DetaCategoriaRbt();
		$form = new App_Form_BuscarOrdenar();
	
		if ($this->_request->isPost()) {
			$categoria = $this->getParam('categoria');
			$idempresa = $this->getParam('idempresa');
			
			$contenido = $model->getDetaCategoria($categoria, $idempresa);
			$this->view->rbt = $contenido;
			
			$params = $this->getAllParams();
			$form->populate($params);
		}
	
		$this->view->form = $form;
		
	
	
	}

	public function cargarAction() {
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
				$this->getConfig()->app->mediaUrl . 'css/compiled/form-showcase.css'
		);
		 
		$this->view->headScript()->appendFile(
				$this->getConfig()->app->mediaUrl . 'js/wysihtml5-0.3.0.js'
		);
		$this->view->headScript()->appendFile(
				$this->getConfig()->app->mediaUrl . 'js/bootstrap-wysihtml5-0.0.2.js'
		);
		 
		$this->view->headScript()->appendFile(
				$this->getConfig()->app->mediaUrl . 'js/jquery.uniform.min.js'
		);
		$this->view->headScript()->appendFile(
				$this->getConfig()->app->mediaUrl . 'js/select2.min.js'
		);
		 
		$idUsuario = $this->view->authData->iduser_empresa;
		//$idEmpresa = $this->view->authData->idempresa;
		 
		$form = new App_Form_CrearContenido();
		$this->view->form = $form;
		 
		if ($this->_request->isPost()) {

			$data = $this->_getAllParams();
			if ($form->isValid($data)) {
				$modelRbt = new App_Model_Rbt();
				$fecha = Zend_Date::now()->toString('YYYY-MM-dd HH:mm:ss');
				 
				$data['fecha_registro'] = $fecha;
				$data['estado'] = App_Model_Rbt::ESTADO_ACTIVO;
				//$data['idempresa'] = $idEmpresa;
				$data['iduser_registro'] = $idUsuario;
				$data['uri'] = "definir formato";
				 
				$id = $modelRbt->actualizarDatos($data);
				if ($id) {
					$dataRbt = array(
							'idrbt' => $id,
					);
					/*copiamos los archivos imagenes y musica*/
					$config = Zend_Registry::get('config');
					//mp3
					$ruta = $config->app->mediaAudMp;

					$mp3 = $form->cancion_formato_mp->getFileName();
					if (!empty ($mp3)) {
						$form->cancion_formato_mp->addFilter(
								'Rename',
								array('target' => $ruta . "rbt".$id . "cod.mp3", 'overwrite' => true)
						);
						$form->cancion_formato_mp->receive();
						$dataRbt = array(
								'idrbt' => $id,
								'cancion_formato_mp' => "rbt" . $id . "cod.mp3",
						);
					}

					//wav
					$ruta = $config->app->mediaAudWav;
					$wav = $form->cancion_formato_wav->getFileName();
					if (!empty ($wav)) {
						$form->cancion_formato_wav->addFilter(
								'Rename',
								array('target' => $ruta . "rbt". $id . "cod.wav", 'overwrite' => true)
						);
						$form->cancion_formato_wav->receive();
						$dataRbt['cancion_formato_wav'] = "rbt". $id . "cod.wav";
					}

					//imagen small
					$ruta = $config->app->mediaImgSmall;
					$imgs = $form->imagen_small->getFileName();
					if (!empty ($imgs)) {
						$form->imagen_small->addFilter(
								'Rename',
								array('target' => $ruta . "rbt". $id . "cod.jpg", 'overwrite' => true)
						);
						$form->imagen_small->receive();
						$dataRbt['imagen_small'] = "rbt". $id . "cod.jpg";
					}

					//imagen destacada
					$ruta = $config->app->mediaImgDestacada;
					$imgd = $form->imagen_destacada->getFileName();
					if (!empty ($imgd)) {
						$form->imagen_destacada->addFilter(
								'Rename',
								array('target' => $ruta . "rbt". $id . "cod.jpg", 'overwrite' => true)
						);
						$form->imagen_destacada->receive();
						$dataRbt['imagen_destacada'] = "rbt". $id . "cod.jpg";
					}


					//actualizamos
					$modelRbt->actualizarDatos($dataRbt);

					/* fin copia*/

					// insertamos el detalle
					$modelDeta = new App_Model_DetaCategoriaRbt();
					$modelDeta->addDetaCategoria($data, $id);

					$this->_flashMessenger->addMessage("Contenido cargado con éxito");
					$this->_redirect('/admin/contenido');
				} else
					$this->view->msg = "Lo sentimos intentalo nuevamente";
			} else
				var_dump($form->getErrorMessages());
			 
			$form->populate($data);



		}
	}


	public function editarAction() {
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
				$this->getConfig()->app->mediaUrl . 'css/compiled/form-showcase.css'
		);

		$this->view->headScript()->appendFile(
				$this->getConfig()->app->mediaUrl . 'js/wysihtml5-0.3.0.js'
		);
		$this->view->headScript()->appendFile(
				$this->getConfig()->app->mediaUrl . 'js/bootstrap-wysihtml5-0.0.2.js'
		);

		$this->view->headScript()->appendFile(
				$this->getConfig()->app->mediaUrl . 'js/jquery.uniform.min.js'
		);
		$this->view->headScript()->appendFile(
				$this->getConfig()->app->mediaUrl . 'js/select2.min.js'
		);

		$idUsuario = $this->view->authData->iduser_empresa;
		//$idEmpresa = $this->view->authData->idempresa;
		 
		$modelRbt = new App_Model_Rbt();
		$modelDeta = new App_Model_DetaCategoriaRbt();
		$idRbt = (int) $this->getParam('cod');
		$form = new App_Form_EditarContenido();
		 
		if ($idRbt) {
			$cate = $modelDeta->getDetaByRbt($idRbt);
			$datos = $modelRbt->getRbtById($idRbt);
			$this->view->dataimg = $datos;
			$form->populate($datos);
			$form->categoria->setValue($cate);
			$this->view->form = $form;

		}
		 

		if ($this->_request->isPost()) {
			

			$data = $this->_getAllParams();			
			if ($form->isValid($data)) {
				$id = $modelRbt->actualizarDatos($data);
				 
				if ($id) {

					$dataRbt = array(
							'idrbt' => $id,
					);					
					/*copiamos los archivos imagenes y musica*/
					$config = Zend_Registry::get('config');
					//mp3
					$ruta = $config->app->mediaAudMp;

					$mp3 = $form->cancion_formato_mp->getFileName();
					if (!empty ($mp3)) {
						$form->cancion_formato_mp->addFilter(
								'Rename',
								array('target' => $ruta . "rbt".$id . "cod.mp3", 'overwrite' => true)
						);
						$form->cancion_formato_mp->receive();
						$dataRbt = array(
								'idrbt' => $id,
								'cancion_formato_mp' => "rbt" . $id . "cod.mp3",
						);
					}

					//wav
					$ruta = $config->app->mediaAudWav;
					$wav = $form->cancion_formato_wav->getFileName();
					if (!empty ($wav)) {
						$form->cancion_formato_wav->addFilter(
								'Rename',
								array('target' => $ruta . "rbt". $id . "cod.wav", 'overwrite' => true)
						);
						$form->cancion_formato_wav->receive();
						$dataRbt['cancion_formato_wav'] = "rbt". $id . "cod.wav";
					}

					//imagen small
					$ruta = $config->app->mediaImgSmall;
					$imgs = $form->imagen_small->getFileName();
					if (!empty ($imgs)) {
						$form->imagen_small->addFilter(
								'Rename',
								array('target' => $ruta . "rbt". $id . "cod.jpg", 'overwrite' => true)
						);
						$form->imagen_small->receive();
						$dataRbt['imagen_small'] = "rbt". $id . "cod.jpg";
					}

					//imagen destacada
					$ruta = $config->app->mediaImgDestacada;
					$imgd = $form->imagen_destacada->getFileName();
					if (!empty ($imgd)) {
						$form->imagen_destacada->addFilter(
								'Rename',
								array('target' => $ruta . "rbt". $id . "cod.jpg", 'overwrite' => true)
						);
						$form->imagen_destacada->receive();
						$dataRbt['imagen_destacada'] = "rbt". $id . "cod.jpg";
					}


					//actualizamos
					if (count($dataRbt) > 1)
						$modelRbt->actualizarDatos($dataRbt);

					/* fin copia*/



					// insertamos el detalle
					$modelDeta = new App_Model_DetaCategoriaRbt();

					$modelDeta->addDetaCategoria($data, $id, TRUE);

					$this->_flashMessenger->addMessage("RBT editado con éxito");
					$this->_redirect('/admin/contenido/editar/cod/'.$id);
				} else
					$this->view->msg = "Lo sentimos intentalo nuevamente";
			} else
				var_dump($form->getErrorMessages());
			 
			$form->populate($data);



		}
	}

	 

	public function pendientesAction() {
		 
		$config = Zend_Registry::get('config');
		$this->view->ruta = $config->app->elementsUrl;
		 

		$this->view->headLink()->appendStylesheet(
				$this->getConfig()->app->mediaUrl . 'css/lib/uniform.default.css'
		);
		$this->view->headLink()->appendStylesheet(
				$this->getConfig()->app->mediaUrl . 'css/compiled/tables.css'
		);

		$model = new App_Model_Rbt();
		$form = new App_Form_BuscarPendientes();

		if ($this->_request->isGet()) {
			$busqueda = $this->getParam('busqueda');
			$flag = $this->getParam('flag');
			$contenido = $model->listRbt($flag, $busqueda, TRUE);
		}
		$params = $this->getAllParams();
		$form->populate($params);

		$this->view->form = $form;
		$this->view->rbt = $contenido;
	}


	public function aprobarAction() {
		 
		$modelRbt = new App_Model_Rbt();
		$idRbt = (int) $this->getParam('cod');
		
		if ($idRbt) {
		$dataRbt = array(
				'idrbt' => $idRbt,
				'estado' => App_Model_Rbt::ESTADO_ACTIVO
		);

		//actualizamos
		$modelRbt->actualizarDatos($dataRbt);
		
		$this->_flashMessenger->addMessage("RBT Aprobado satisfactoriamente");
		$this->_redirect('/admin/contenido/pendientes');


		}

		 
	}
	
	public function guardarOrdenAction() {
		$params = $this->getAllParams();
		
		$this->_flashMessenger->addMessage("Se registro el orden adecuadamente");
		$this->_redirect('/admin/contenido/ordenar');
		
	}



}