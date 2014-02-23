<?php

class Default_LoginController extends App_Controller_Action_Default
{

    public function init()
    {
        parent::init();
    }
    
    
    public function indexAction(){
    	
    	$this->view->login = true;
    	
    	if ($this->_request->isPost()) {
    		$datos = $this->_getAllParams();
    		
    		$confirm = false;

    		$model = new App_Model_Client();

    		$user = $model->validUser($datos['email']);    		
    		
    		if ($datos['pass'] and $datos['passred'] and ($datos['pass']== $datos['passred']) 
    				and !$user and !empty($datos['adresse']) and !empty($datos['code_postal'])
    				and !empty($datos['ville']) and !empty($datos['portable']))
    		{	
    			$pass = $datos['pass'];
    			$date = Zend_Date::now()->toString('Y-MM-dd HH:mm:ss');
    			$datos['date_inscription'] = $date;
    			$datos['pass'] = md5($pass);
    			$datos['date_derniere_modification'] = $date;
    			$id = $model->saveClient($datos);

    			$modelH = new App_Model_ClientConnexion();
    			
    			$clientH = array(
    					'id_client' => $id,
    					'hachage' => md5(rand(1000, 9899)),
    					'nb_connexions' => '1',
    					'date_first_connexion' => $date,
    					'date_last_connexion' => $date,
    			);
    			$modelH->insertData($clientH);

    			// login
    			if ($id){
    				$access = $model->loguinUsuario($datos['email'], $pass);
    				if ($access) {
    					$this->_redirect('/compte');
    				}
    			} else {
    				
    			}
    			
    			
    		} else {    		
    			$this->view->data = $datos;
    			$this->view->error = true;
    		}
    		
    		
    		
    	}
        
    }
    
}