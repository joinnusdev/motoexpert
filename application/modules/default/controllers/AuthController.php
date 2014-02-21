<?php

class Default_AuthController extends App_Controller_Action
{

    
    
    public function indexAction()
    {       	
    	
        if ($this->_request->isPost()) {
            $data = $this->_getAllParams();
            
            $f = new Zend_Filter_StripTags();
            
            $email = $f->filter($data['email']);
            $clave = $f->filter($data['passe']);
            
            $model = new App_Model_Client();
            $valido = $model->loguinUsuario($email, $clave);          
            
            if (Zend_Auth::getInstance()->hasIdentity()) {            	
            	$this->_helper->redirector->gotoUrl('/compte/');
            }
            else {
                $this->_helper->redirector->gotoUrl('/login/index?msg=error');
            }
        }
        $this->_helper->redirector->gotoUrl('/');
    } 
    public function logoutAction()
    {       	
        $this->_helper->layout->disableLayout();
        $auth = Zend_Auth::getInstance();
        
        if ($auth->hasIdentity()) {            
            $data = $auth->getStorage()->read();

            $datef = Zend_Date::now()->toString('Y-MM-dd HH:mm:ss');
            $modelH = new App_Model_ClientConnexion();
            if (!$data->id_client and is_null($data->id_client)) {            	            
            	$clientH = array(
            			'id_client' => $data->cid,
            			'hachage' => md5(rand(1000, 9899)),
            			'nb_connexions' => '1',
            			'date_first_connexion' => $datef,
            			'date_last_connexion' => $datef,
            			);
            	$modelH->insertData($clientH);            
            } else {
            	$clientH = array(
            			'hachage' => md5(rand(1000, 9899)),
            			'nb_connexions' => (int)$data->nb_connexions +1,            			
            			'date_last_connexion' => $datef,
            	);
            	$modelH->updateData($clientH, $data->id_client);
            	
            }
            
            
            $auth->clearIdentity();
            $this->_helper->redirector->gotoUrl('/');
        } else {
            $this->_helper->redirector->gotoUrl('/');
        }

    } 

}

