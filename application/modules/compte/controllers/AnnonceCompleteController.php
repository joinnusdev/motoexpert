<?php

class Compte_AnnonceCompleteController extends App_Controller_Action_Default
{

    public function init()
    {
        parent::init(); 
    }
    
    public function indexAction()
    {
    	if ($this->_request->isPost()) {
    		
    		$form = new App_Form_CreateAnnounce();
    		
    		$params = $this->_getAllParams();
    		
    		/*copiamos las imagenes imagenes*/
    		$config = Zend_Registry::get('config');

    		$dataPhotoTotal= array();
    		//imgprincipal
    		$ruta = $config->app->fotoPrincipal;
    		
    		$file1 = $form->file1->getFileName();
    		
    		if (!empty ($file1)) {
    			$form->file1->addFilter(
    					'Rename',
    					array('target' => "pict".$params['cod_id']."-01.jpg", 'overwrite' => true)
    			);
    			$rutafinal = $ruta . $params['departement'] . "/";
    			
    			$form->file1->setDestination($rutafinal);
    			$form->file1->receive();    			
    			$dataPhoto = array(
    					'id_annonce' => $params['cod_id'],
    					'ref_annonce' => $params['ref'],
    					'nom_fichier' => "pict".$params['cod_id']."-01.jpg",
    					'ordre' => '1'
    			);
    			$dataPhotoTotal[] = $dataPhoto;
    		}
    		
    		$file2 = $form->file2->getFileName();
    		
    		if (!empty ($file2)) {
    			$form->file2->addFilter(
    					'Rename',
    					array('target' => "pict".$params['cod_id']."-02.jpg", 'overwrite' => true)
    			);
    			$rutafinal = $ruta . $params['departement'] . "/";
    			$form->file2->setDestination($rutafinal);
    			$form->file2->receive();
    			$dataPhoto = array(
    					'id_annonce' => $params['cod_id'],
    					'ref_annonce' => $params['ref'],
    					'nom_fichier' => "pict".$params['cod_id']."-02.jpg",
    					'ordre' => '2'
    			);
    			$dataPhotoTotal[] = $dataPhoto;
    		}
    		$file3 = $form->file3->getFileName();
    		
    		if (!empty ($file3)) {
    			$form->file3->addFilter(
    					'Rename',
    					array('target' => "pict".$params['cod_id']."-03.jpg", 'overwrite' => true)
    			);
    			$rutafinal = $ruta . $params['departement'] . "/";
    			$form->file3->setDestination($rutafinal);
    			$form->file3->receive();
    			$dataPhoto = array(
    					'id_annonce' => $params['cod_id'],
    					'ref_annonce' => $params['ref'],
    					'nom_fichier' => "pict".$params['cod_id']."-03.jpg",
    					'ordre' => '3'
    			);
    			$dataPhotoTotal[] = $dataPhoto;
    		}
    		
    		$file4 = $form->file4->getFileName();
    		
    		if (!empty ($file4)) {    			
    			$form->file4->addFilter(
    					'Rename',
    					array('target' => "pict".$params['cod_id']."-04.jpg", 'overwrite' => true)
    			);
    			$rutafinal = $ruta . $params['departement'] . "/";
    			$form->file4->setDestination($rutafinal);
    			$form->file4->receive();    			
    			$dataPhoto = array(
    					'id_annonce' => $params['cod_id'],
    					'ref_annonce' => $params['ref'],
    					'nom_fichier' => "pict".$params['cod_id']."-04.jpg",
    					'ordre' => '4'
    			);
    			
    			$dataPhotoTotal[] = $dataPhoto;
    		}
    		
    		$file5 = $form->file5->getFileName();
    		
    		if (!empty ($file5)) {
    			$form->file5->addFilter(
    					'Rename',
    					array('target' => "pict".$params['cod_id']."-05.jpg", 'overwrite' => true)
    			);
    			$rutafinal = $ruta . $params['departement'] . "/";
    			$form->file5->setDestination($rutafinal);
    			$form->file5->receive();
    			$dataPhoto = array(
    					'id_annonce' => $params['cod_id'],
    					'ref_annonce' => $params['ref'],
    					'nom_fichier' => "pict".$params['cod_id']."-05.jpg",
    					'ordre' => '5'
    			);
    			$dataPhotoTotal[] = $dataPhoto;
    		}
    		
    		$modelPhoto = new App_Model_Photo();
    		$modelanunce = new App_Model_Announce();    		
    		// guardando las fotos
    		
    		
    		foreach ($dataPhotoTotal as $items):    		    		
    			if (isset($params['foto1']))
    			    $modelPhoto->deletePhotos($params['foto1']);
    			if (isset($params['foto2']))
    				$modelPhoto->deletePhotos($params['foto2']);    			
    			if (isset($params['foto3']))
    				$modelPhoto->deletePhotos($params['foto3']);
    			if (isset($params['foto4']))
    				$modelPhoto->deletePhotos($params['foto4']);
    			if (isset($params['foto5']))
    				$modelPhoto->deletePhotos($params['foto5']);    			
    			$modelPhoto->savePhotos($items);
    		endforeach;
    		// actualizando el anuncio
    		$params['id'] = $params['cod_id'];
                $params['modere'] = '0';
    		$params['parution'] = ($params['parution'] == "on")?1:0;
    			 
    		
    		$id = $modelanunce->saveAnnonce($params);
    		
    		
    		$this->_redirect('/compte?annonce=ok'); 
    		
    		
    		
    		
    	}
    }
    
    
}


