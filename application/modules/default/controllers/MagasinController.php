<?php

class Default_MagasinController extends App_Controller_Action_Default
{

    public function init()
    {
        parent::init();
    }
    
    
    public function indexAction(){
        echo $idMagasin = $this->_getParam('magasin');
        
        $model = new App_Model_Magasin();
        $this->view->magasinInfo = $model->magasinInfo($idMagasin);
        $this->view->magasinPhoto = $model->magasinPhoto($idMagasin);
        $this->view->lastAnnoncesMagasin = $model->lastAnnoncesMagasin($idMagasin);
        $this->view->countMagasin = $model->countMagasin($idMagasin);
    }
    
    public function mailAction(){
        
        if ($this->_request->isPost()) {
            $datos = $this->_getAllParams();
            $idTienda = $datos['idTienda'];
            $destinatario = $datos['mailTienda'];
            //$destinatario = 'olivier@infra.fr';
            $nombre = $datos['nom'];
            $prenom = $datos['prenom'];
            $emisor = $datos['email'];
            $cuerpo = $datos['message'];
            
            $cuerpo = "
                Nom : ". $datos['nom'] ."<br>
                Prénom : ". $datos['prenom'] ."<br>
                E-Mail : ". $emisor ."<br>
                Téléphone : ". $datos['telephone'] ."<br>
                Adresse : ". $datos['adresse'] ."<br>
                Code postal : ". $datos['code_postal'] ."<br>
                Ville : ". $datos['ville'] ."<br>
                Message :<br>" . $datos['message'] . "<br>
                <p><br>";            
            $asunto = "MOTO EXPERT - Nouveau message en provenance du site mobile";
            //para el envío en formato HTML
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            //direcciones que recibián copia
            $headers .= "Cc: developpeur@infra.fr\r\n";
            //dirección del remitente
            $headers .= "From:". $nombre." ".$prenom . "<".$emisor.">\r\n";

            mail($destinatario,$asunto,$cuerpo,$headers) ;

            //echo "<script>alert('l'envoi de courrier');</script>";
            $this->_redirect('/magasin?magasin='.$idTienda);
        }
       
        
       
    }
}