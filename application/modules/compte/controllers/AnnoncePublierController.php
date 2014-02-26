<?php

class Compte_AnnoncePublierController extends App_Controller_Action_Default
{

	public function init()
	{
		parent::init();
	}

	public function indexAction()
	{
		$form = new App_Form_CreateAnnounce();
		$this->view->form = $form;
			
		$modelanunce = new App_Model_Announce();
		//$modelclient = new App_Model_Client();
		$this->view->ruta = $this->config->app->photoUrl;
		//$this->view->result =
		//$modelanunce->announceByCLient($this->view->authData->cid);
			
		//$this->view->datos = $modelclient->getClientById($this->view->authData->cid);
			
		$this->view->valid = FALSE;
			
		if ($this->_request->isPost()) {
			$params = $this->_getAllParams();

			$d = new App_Date_Calc();
			$date = $d->dateToDays(date('d'), date('m'), date('Y'));

			//sumar un mes
			$fecha = date('d-m-Y');
			$nuevafecha = strtotime ( '+1 month' , strtotime ( $fecha ) ) ;
			$nuevafecha = date ( 'd-m-Y' , $nuevafecha );
			$n = explode('-', $nuevafecha);
			$datev = $d->dateToDays($n[0], $n[1], $n[2]);

			$params['id_client'] = $this->view->authData->cid;

			$temp = $params['modele'];
			$modele = explode('_', $params['modele']);

			$params['modele'] = $modele[0];
			$modeleName = $modele[1];
			$params['date_crea'] = $date;
			$params['departement'] = $params['deparment'];
			$params['date_valid'] = $datev;
			$params['titre'] = $params['marque'] . " " . $modeleName . " " . $params['cylindree'];
			$params['parution'] = '0';
			$params['internet'] = '1';
			$params['ispayed'] = '1';
			$params['type_occaz'] = '1';
			$params['modere'] = '1';
			$params['id_cat'] = $params['category'];
			$params['id_mot'] = $params['modele'];
			$params['ref'] = $params['departement']."000".$params['id_mot']."0000";

			$id = $modelanunce->saveAnnonce($params);
			$this->view->register = $this->getParam('register', NULL);
			if ($this->view->register == "valid" and $id > 0) {
				$dataForm = $params;
				$dataForm['modele'] = $temp;
				$dataForm['id'] = $id;
				$form->populate($dataForm);
					
				$this->view->valid = TRUE;
				$this->view->params = $params;
				$this->view->caract = $params;
				$this->view->idannunce = $id;
			}
			//$this->_redirect('/compte');
		}
	}


	public function modifierAction()
	{
		$idAnnonce = $this->getParam('annonce', NULL);


		if ($this->_request->isPost()) {
			$params = $this->_getAllParams();
				
			$d = new App_Date_Calc();
			$date = $d->dateToDays(date('d'), date('m'), date('Y'));
				
			//sumar un mes
			$fecha = date('d-m-Y');
			$nuevafecha = strtotime ( '+1 month' , strtotime ( $fecha ) ) ;
			$nuevafecha = date ( 'd-m-Y' , $nuevafecha );
			$n = explode('-', $nuevafecha);
			$datev = $d->dateToDays($n[0], $n[1], $n[2]);
				
			$params['id_client'] = $this->view->authData->cid;
				
			$temp = $params['modele'];
			$modele = explode('_', $params['modele']);
				
			$params['modele'] = $modele[0];
			$modeleName = $modele[1];
			$params['date_crea'] = $date;
			$params['departement'] = $params['deparment'];
			$params['date_valid'] = $datev;
			$params['titre'] = $params['marque'] . " " . $modeleName . " " . $params['cylindree'];
			$params['parution'] = '0';
			$params['internet'] = '1';
			$params['ispayed'] = '1';
			$params['type_occaz'] = '1';
			$params['modere'] = '1';
			$params['id_cat'] = $params['category'];
			$params['id_mot'] = $params['modele'];
			$params['ref'] = $params['departement']."000".$params['id_mot']."0000";
				
			$id = $modelanunce->saveAnnonce($params);
			$this->view->register = $this->getParam('register', NULL);
			if ($this->view->register == "valid" and $id > 0) {
				$dataForm = $params;
				$dataForm['modele'] = $temp;
				$dataForm['id'] = $id;
				$form->populate($dataForm);
					
				$this->view->valid = TRUE;
				$this->view->params = $params;
				$this->view->caract = $params;
				$this->view->idannunce = $id;
			}
				
		}



		if ($idAnnonce > 0) {

			$form = new App_Form_CreateAnnounce();
			$this->view->form = $form;

			$modelanunce = new App_Model_Announce();
			$params = $modelanunce->detailAnnounce($idAnnonce);
			//var_dump($params);exit();
				
			$params['deparment'] = $params['departement'];
			$params['category'] = $params['id_cat'];
			$params['modele'] = $params['id_mot'];
				
			if ($params) {
				$this->view->ruta = $this->config->app->photoUrl;
				$this->view->valid = TRUE;
					
				$form->populate($params);
				$this->view->caract = $params;
				$this->view->idannunce = $idAnnonce;
				$this->view->params = $params;
			} else
				$this->_redirect('/compte');

		} else
			$this->_redirect('/compte');

	}


}


