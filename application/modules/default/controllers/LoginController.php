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
    
    function recoverPasswordAction(){
         if ($this->_request->isPost()) {
            $datos = $this->_getAllParams();
            
            $mail = $datos['email'];
            
            $modelCliente = new App_Model_Client();
            $correoExistente = $modelCliente->findUser($mail);
            
            if($correoExistente!=""){
                $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
                $newPass = "";
                for($i=0;$i<6;$i++) {
                $newPass .= substr($str,rand(0,62),1);
                }
                $modelclient = new App_Model_Client();
                $params['cid'] = $correoExistente['cid'];
    		$params['pass'] = md5($newPass);
    		$modelclient->saveClient($params); 
                
                $destinatario = $mail;
                //$destinatario = 'jsteve.villano@gmail.com';
                $nom = $correoExistente['nom'];
                $prenom = $correoExistente['prenom'];
                $nombre = $nom." ".$prenom;
                $cuerpo = " Bonjour <strong>" . $nombre . "</strong>, <p>
                            
                            Voici votre nouveau mot de passe MotoExpert qui vous servira à accéder à votre compte Expertnautes:<br>
                            Nouveau mot de passe: <strong>". $newPass ."</strong> <p>
                            <p>
                            Vous pouvez modifier le mot de passe une fois identifié dans la zone Expertnautes > Gérer vos informations personnelles.
                            <p>
                            Pour accéder à votre compte, cliquez sur le lien ci-dessous:<br>
                            <a  href='http://motoexpert-mobile.infra-imagerie.com/login'>Moto Expert</a><p>
                            

                            Toute l'équipe MotoExpert vous remercie de votre confiance.";
                $asunto = "Recuperar Contraseña";
                // $destinatario = "jsteve.villano@gmail.com";
                //para el envío en formato HTML
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                //direcciones que recibián copia
                $headers .= "Cc: eric@altimea.com\r\n";
                //dirección del remitente
                $headers .= "From:MotoExpert";

                mail($destinatario,$asunto,$cuerpo,$headers) ;

                echo "<script>alert('vous recevrez un email avec votre nouveau mot de passe');</script>";
                $this->_redirect('/login');
                
            }
            
            
        }
    }
}