<?php

class Default_AuthController extends App_Controller_Action
{

    
    
    public function indexAction()
    {       	
        $this->_helper->layout->setLayout('login');
        
        if ($this->_request->isPost()) {            
            
            $data = $this->_getAllParams();
            
            $f = new Zend_Filter_StripTags();
            
            $email = $f->filter($data['email']);
            $clave = $f->filter($data['clave']);
            $usuario = new App_Model_UsuarioEmpresa();
            $valido = $usuario->loguinUsuario($email, $clave);          
            
            if (Zend_Auth::getInstance()->hasIdentity()) {
                if ($valido->tipousuario == '1')
                    $this->_helper->redirector->gotoUrl('/admin/panel');
                if ($valido->tipousuario == '2')
                    $this->_helper->redirector->gotoUrl('/empresa/');
                if ($valido->tipousuario == '3')
                    $this->_helper->redirector->gotoUrl('/operador/');
                if ($valido->tipousuario == '4')
                	$this->_helper->redirector->gotoUrl('/supervisor/panel');
            }
            else {
                $this->_helper->redirector->gotoUrl('/');
            }

            $this->_flashMessenger->addMessage("Intentelo nuevamente datos incorrectos");
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

