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
        
       $query = "SELECT m.id_me as id_me , m.nom as nom, m.gerant as gerant ,m.adresse as adresse, m.email as email , m.societe as societe , 
	m.ouverture as ouverture,m.ad_ville as ad_ville , m.ville as ville , m.horaires as horaires , m.tel as tel , m.fax as fax ,
	m.dep as dep,m.latitude as latitude, m.longitude as longitude, m.liengmap as liengmap, m.espace_scoot as espace_scoot,
        m.acces as acces , m.actif as actif , b.responsable as responsablezone, b.email as emailzone, c.nom_fichier as fichier_photo
        FROM moto_expert m
        LEFT JOIN zones b 
        ON m.id_zone=b.id_zone
        LEFT JOIN magasins_photos c
        ON	m.id_me=c.id_magasin
        WHERE m.id_me='".$idMagasin."'";   
       try{
        return $this->getAdapter()->fetchRow($query);
         
       }catch (Exception $e){
                var_dump($e->getMessage());
       }
    }
    
    
     public function magasinPhoto($idMagasin){
        
       $query = "SELECT m.id_me,m.nom,m.ville,p.nom_fichier,p.ordre FROM 
                moto_expert m inner join magasins_photos p on m.id_me = p.id_magasin
                WHERE m.id_me='".$idMagasin."'";   
       try{
        return $this->getAdapter()->fetchAll($query);
         
       }catch (Exception $e){
                var_dump($e->getMessage());
       }
    }
    
    
    public function countMagasin($idMagasin){

		$query = "
		SELECT count(*) as total FROM annonces a, categories c, annonce_cat ac, motos m
		WHERE a.id_mot = m.id_mot
		AND a.ref = ac.ref
		AND ac.id_cat = c.id_cat
		AND a.internet <>  '0'
		AND a.modere = '1'
		AND a.ispayed =  '1'
		and a.id_me = ". $idMagasin;
		
		try{
			return $this->getAdapter()->fetchRow($query);

		}catch (Exception $e){
			var_dump($e->getMessage());
		}

	}
        
    public function lastAnnoncesMagasin($idMagasin){
        $query = "select a.id,a.prix,a.titre, a.departement,a.date,a.cylindree,a.km,a.annee,
                    m.marque,m.modele,
                    foto.nom_fichier,info.neuf,info.isgarantie,
                    info.controle,info.isgarantie
                from moto_expert t
                inner join annonces a on t.id_me = a.id_me
                left join annonces_photos foto on foto.id_annonce = a.id 
                inner join annonces_info info on info.ref = a.ref 
                inner join motos m on a.id_mot = m.id_mot 
                where t.id_me = " . $idMagasin . "
                AND t.actif = '1'
                AND a.ispayed = '1'
                AND a.internet <> '0'
                AND a.modere = '1'
                group by a.id
                order by a.id desc
                limit 3;";
      
           
       try{
        return $this->getAdapter()->fetchAll($query);
         
       }catch (Exception $e){
                var_dump($e->getMessage());
       }
    }
    
    public function getMagasin($idMagasin){
        $query = "select t.id_me,t.ville from moto_expert t
                    where t.id_me = " . $idMagasin;
      
           
       try{
        return $this->getAdapter()->fetchRow($query);
         
       }catch (Exception $e){
                var_dump($e->getMessage());
       }
    }
}