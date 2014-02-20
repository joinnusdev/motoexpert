<?php
class App_Model_Magasin extends App_Db_Table_Abstract {

    protected $_name = 'moto_expert';
    const ESTADO_ACTIVO = 1;
    const PAIS = 'fr';

    public function listMagasin(){
        $query = $this->_db
        ->select()->from(array('m' => $this->_name), array('id_me', 'ville'))
        ->where('m.actif = ?', App_Model_Magasin::ESTADO_ACTIVO)
        ->order('m.ville');       
        return $this->_db->fetchPairs($query);
    }
    
    public function countMagasinFrance(){
        $query = $this->_db
        ->select()->from(array('m' => $this->_name), array('count(*) as magasin'))
        ->where('m.actif = ?', App_Model_Magasin::ESTADO_ACTIVO)
        ->where('m.pays= ?', App_Model_Magasin::PAIS)
        ->order('m.ville');       
        return $this->getAdapter()->fetchRow($query);
        try{
                return $this->getAdapter()->fetchRow($query);

        }catch (Exception $e){
                var_dump($e->getMessage());			
        }
    }
    
    public function magasinInfo($idMagasin){
        
       $query = "SELECT a.id_me as id_me , a.nom as nom, a.gerant as gerant ,a.adresse as adresse, a.email as email , a.societe as societe , a.ouverture as ouverture,
        a.ad_ville as ad_ville , a.ville as ville , a.horaires as horaires , a.tel as tel , a.fax as fax , a.dep as dep,
        a.latitude as latitude, a.longitude as longitude, a.liengmap as liengmap, a.espace_scoot as espace_scoot,
        a.acces as acces , a.actif as actif , b.responsable as responsablezone, b.email as emailzone, c.nom_fichier as fichier_photo
        FROM moto_expert a 
        LEFT JOIN zones b 
        ON a.id_zone=b.id_zone
        LEFT JOIN magasins_photos c
        ON	a.id_me=c.id_magasin
        WHERE a.id_me='".$idMagasin."'";   
       try{
        return $this->getAdapter()->fetchRow($query);
         
       }catch (Exception $e){
                var_dump($e->getMessage());
       }
    }
    
    
     public function magasinPhoto($idMagasin){
        
       $query = "SELECT * FROM magasins_photos WHERE id_magasin ='".$idMagasin."'";   
       try{
        return $this->getAdapter()->fetchAll($query);
         
       }catch (Exception $e){
                var_dump($e->getMessage());
       }
    }

}