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
		$this->view->ruta = $this->config->app->photoUrl;
			
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
			$alea = rand(1000, 9999);
			$params['ref'] = $params['departement']."000".$params['id_mot'].$alea;

			$id = $modelanunce->saveAnnonce($params);
			
			$dataAinfo = $params;
			$dataAinfo['marque_aut'] = $params['marque'];
			$dataAinfo['modele_aut'] = $modeleName;
			$modeleCategory = new App_Model_Category();
			$category = $modeleCategory->getCategoryById($params['id_cat']);						
			$dataAinfo['categorie'] = $category;
			$dataAinfo['date_depot'] = $params['date_valid'];
			$dataAinfo['controle'] = '1';
			
			
			$modelAinfo = new App_Model_AnnounceInfo();
			//if (isset($params['id']) and $params['id'] > 0)
				//$modelAinfo->updateAnnonceInfo($dataAinfo);
			//else 
			$modelAinfo->saveAnnonceInfo($dataAinfo);
			
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
		$modelanunce = new App_Model_Announce();
		$form = new App_Form_CreateAnnounce();
		
		$modelPhotos = new App_Model_Photo() ;

		if ($this->_request->isPost()) {
			$params = $this->_getAllParams();
			
			$temp = $params['modele'];
			$modele = explode('_', $params['modele']);				
			$params['modele'] = $modele[0];
			$modeleName = $modele[1];			
			$params['departement'] = $params['deparment'];			
			$params['titre'] = $params['marque'] . " " . $modeleName . " " . $params['cylindree'];			
			$params['id_cat'] = $params['category'];
			$params['id_mot'] = $params['modele'];
				
			$idAnnonce = $modelanunce->saveAnnonce($params);
			
			$dataAinfo = $params;
			$dataAinfo['marque_aut'] = $params['marque'];
			$dataAinfo['modele_aut'] = $modeleName;
			$modeleCategory = new App_Model_Category();
			$category = $modeleCategory->getCategoryById($params['id_cat']);
			$dataAinfo['categorie'] = $category;				
				
			$modelAinfo = new App_Model_AnnounceInfo();
			$modelAinfo->updateAnnonceInfo($dataAinfo);
			
			
			
			
			$this->view->register = $this->getParam('register', NULL);
			if ($this->view->register == "valid" and $idAnnonce > 0) {
				$dataForm = $params;
				$dataForm['modele'] = $temp;
				$dataForm['id'] = $idAnnonce;
				$form->populate($dataForm);
				
				$this->view->valid = TRUE;
				$this->view->params = $params;
				$this->view->caract = $params;
				$this->view->idannunce = $idAnnonce;
				$this->_redirect('/compte/annonce-publier/modifier/annonce/' . $idAnnonce );
				
			}
				
		}



		if ($idAnnonce > 0) {			
			$this->view->form = $form;			
			$photos = $modelPhotos->getPhotosByAnnonce($idAnnonce);
			$params = $modelanunce->detailAnnounce($idAnnonce);
			
			$this->view->photos = $photos;
			$this->view->urlPhoto = $this->config->app->viewPhotos . $params['departement'] . "/";
			//echo $this->view->urlPhoto;exit; 
			
			
				
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

    public function deleteAction(){
            $id = $this->_getParam('id');
            $model = new App_Model_Announce();
            $result = $model->deleteAnnonce($id);
            $this->_redirect('/compte');
     }
    
}


