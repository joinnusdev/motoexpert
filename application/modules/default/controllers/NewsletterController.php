<?php

class Default_NewsletterController extends App_Controller_Action_Default
{

    public function init()
    {
        parent::init();
    }
    
    
    public function indexAction(){
           if ($this->_request->isPost()) {
            $datos = $this->_getAllParams();
            $data['email'] = $datos['email'];
            
            $modelNewsletter = new App_Model_Newsletter();
            $modelNewsletter->saveNewsletter($data);
            $this->_redirect('/');
        }
    }
}