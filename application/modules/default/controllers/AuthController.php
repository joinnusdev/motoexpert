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
            
            $model = new App_Model_User();
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
            $auth->clearIdentity();
            $this->_helper->redirector->gotoUrl('/');
        } else {
            $this->_helper->redirector->gotoUrl('/');
        }

    } 

}

