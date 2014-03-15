<?php

class Default_ContactController extends App_Controller_Action_Default
{

    public function init()
    {
        parent::init();
    }
    
    
    public function indexAction(){
        
    }
    
    public function contactarAction(){
         if ($this->_request->isPost()) {
            $datos = $this->_getAllParams();
            
            $mail = $datos['email'];
            $destinatario = 'info@moto-expert.fr';
            $copy = 'developpeur@infra.fr';
            //$destinatario = 'olivier@infra.fr';
            
            $mag = new App_Model_Magasin();
            $mag_selec = $mag->magasinInfo($datos['magasin']);
            $email_mag = isset($mag_selec['email']) ? $mag_selec['email'] : NULL;
            $nom_mag = isset($mag_selec['ville']) ? $mag_selec['ville'] : 'Aucun';
			
            if(isset($email_mag)) {
            	$destinatario = $email_mag;
            	$copy .= ', info@moto-expert.fr';
            }
            
            $cuerpo = " 


                Nom : ". $datos['nom'] ."<br>
                Prénom : ". $datos['prenom'] ."<br>
                E-Mail : ". $mail ."<br>
                Téléphone : ". $datos['telephone'] ."<br>
                Adresse : ". $datos['adresse'] ."<br>
                Code postal : ". $datos['code_postal'] ."<br>
                Ville : ". $datos['ville'] ."<br>
                Magasin : ". $nom_mag ."<br>
                Message :<br>" . $datos['message'] . "<br>
                <p>
                MOTO EXPERT - SIÈGE SOCIAL - 36 Rue Berthelot<br>
                Tel. : +33 (0)2 43 85 29 88<br>
                Fax : +33 (0)2 43 85 29 50<br>


                    ";
            $asunto = "MOTO EXPERT - Une demande d'information générale";
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            $headers .= "Cc: '.$copy.'\r\n";
            $headers .= "From:<".$mail.">\r\n";

            mail($destinatario,$asunto,$cuerpo,$headers) ;

            //echo "<script>alert('vous recevrez un email avec votre nouveau mot de passe');</script>";
            $this->_redirect('/');


        }
    }
}