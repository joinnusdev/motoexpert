<?php
class App_Model_Announce extends App_Db_Table_Abstract {

	protected $_name = 'annonces';

	public function listSearch($datos=NULL, $trier = NULL){

		$query_ = "
		/* SELECT a.id,a.ref, a.titre, a.date, a.annee,a.cylindree,
		a.couleur, a.km, a.id_cat,a.prix,a.departement,
		a.garantie, c.nom_cat, m.marque, m.id_mot,m.modele
		,foto.nom_fichier as foto, info.controle FROM
		annonces a, categories c, annonce_cat ac, motos m
		,annonces_info info
		,annonces_photos foto
		WHERE a.id_mot = m.id_mot AND a.ref = ac.ref AND ac.id_cat = c.id_cat
		and foto.id_annonce = a.id
		and info.ref = a.ref
		AND a.internet <> '0'
		AND a.modere = '1'
		AND a.ispayed = '1' */";

		$query = "SELECT a.id,a.ref, a.titre, a.date, a.annee,a.cylindree,
		a.couleur, a.km, a.id_cat,a.prix,a.departement,
		a.garantie, c.nom_cat, m.marque, m.id_mot,m.modele
		,foto.nom_fichier as foto, info.controle
		,moto.id_me, moto.nom, moto.ville
		,info.neuf, info.isgarantie
		FROM  annonces a
		inner join categories c on a.id_cat = c.id_cat
		left join motos m on a.id_mot = m.id_mot
		left join annonces_info info on info.ref = a.ref
		left join annonces_photos foto on foto.id_annonce = a.id
		left join moto_expert moto on  moto.id_me = a.id_me
		where a.internet <> '0'
		AND a.modere = '1'
		AND a.ispayed = '1'
		AND a.prov <> 'mebe'
		";

		//if (!isset($datos['deparment']) and !isset($datos['category']) and !isset($datos['magasin']) and !isset($datos['marque']) and !isset($datos['modele']))
		//return false;

		if (isset($datos['deparment']) and $datos['deparment'] != 0 and !is_null($datos))
			$query.= " AND a.departement = ".$datos['deparment'];

		if (isset($datos['category']) and $datos['category'] != 0 and !is_null($datos))
			$query.= " AND a.id_cat = ".$datos['category'];

		if (isset($datos['magasin']) and $datos['magasin'] != 0 and !is_null($datos))
			$query.= " AND a.id_me = ".$datos['magasin'];

		if (isset($datos['marque']) and !empty($datos['marque'])) {
			$query.= " AND a.marque = ". '"'.$datos['marque'].'"';
		}
		if (isset($datos['modele']) and $datos['modele'] != 0  and !is_null($datos))
			$query.= " AND m.id_mot = ".$datos['modele'];

		$query.= " group by a.id";
                if (is_null($trier) or empty($trier))
			$query.= " order by a.date asc";
		else {
			$trier = explode("_", $trier);
                        print_r($trier);
                        
			if (($trier[0] == "date" || $trier[0] == "prix") and 
                            ($trier[1] == "asc" || $trier[1] == "desc"))
                            $query.= " order by a." . $trier[0] . " " . $trier[1];
                        
		}
		try{
			$result =  $this->getAdapter()->fetchAll($query);
			return $result;

		}catch (Exception $e){
			var_dump($e->getMessage());
		}

	}

	public function countSearch($datos){

		$query = "
		SELECT count(*) as total
		FROM annonces a, categories c, annonce_cat ac, motos m
		WHERE a.id_mot = m.id_mot
		AND a.ref = ac.ref
		AND ac.id_cat = c.id_cat
		AND a.internet <>  '0'
		AND a.modere = '1'
		AND a.ispayed =  '1'
		AND a.prov <> 'mebe'
		";
		if (isset($datos['deparment']) and $datos['deparment'] != 0)
			$query.= " AND a.departement = ".$datos['deparment'];

		if (isset($datos['category']) and $datos['category'] != 0)
			$query.= " AND a.id_cat = ".$datos['category'];

		if (isset($datos['magasin']) and $datos['magasin'] != 0)
			$query.= " AND a.id_me = ".$datos['magasin'];

		if (isset($datos['marque']) and $datos['marque'] != "" and $datos['marque'] != 0) {
			$query.= " AND a.marque = ". '"'.$datos['marque'].'"';
		}
		if (isset($datos['modele']) and $datos['modele'] != 0)
			$query.= " AND m.id_mot = ".$datos['modele'];


		try{
			return $this->getAdapter()->fetchCol($query);

		}catch (Exception $e){
			var_dump($e->getMessage());
		}

	}

	public function countAnnounce(){

		$query = "SELECT count(distinct(a.id)) as totalAnnounce
		FROM categories c, annonce_cat ac, occaz o, motos mo,
		annonces a
		LEFT JOIN moto_expert me ON a.id_me = me.id_me
		LEFT JOIN annonces_info ai ON a.ref = ai.ref
		WHERE a.internet <> '0' AND a.id_mot = mo.id_mot
		AND a.ref = ac.ref AND ac.id_cat = c.id_cat
		AND o.id_occaz = a.type_occaz
		AND a.ispayed = '1' AND a.modere = '1'
		AND a.prov <> 'mebe'";
		try{
			return $this->getAdapter()->fetchRow($query);

		}catch (Exception $e){
			var_dump($e->getMessage());
		}
	}


	public function detailAnnounce($id){
		$query = "
		SELECT a.parution, a.rep_mail,a.rep_tel,a.rep_port ,a.id,a.ref, a.titre, a.date, a.date_crea, a.annee,a.cylindree,
		a.couleur, a.km, a.id_cat,a.prix,a.departement,
		a.garantie, c.nom_cat, m.marque, m.id_mot,m.modele
		,foto.nom_fichier as foto, info.controle
		,moto.id_me, moto.nom, moto.ville,moto.adresse ,moto.tel
		,moto.fax , moto.horaires,moto.latitude,moto.longitude,moto.liengmap
		,info.type_occaz,a.descr_site,info.neuf, info.isgarantie
		FROM  annonces a
		left join categories c on a.id_cat = c.id_cat
		left join motos m on a.id_mot = m.id_mot
		left join annonces_info info on info.ref = a.ref
		left join annonces_photos foto on foto.id_annonce = a.id
		left join moto_expert moto on  moto.id_me = a.id_me
		where a.internet <> '0'
		AND a.modere = '0'
		AND a.ispayed = '1'
		AND a.prov <> 'mebe'
		and a.id =".$id;
		try{
			return $this->getAdapter()->fetchRow($query);

		}catch (Exception $e){
			var_dump($e->getMessage());
		}

	}

        
        
        public function detailFichaAnnounce($id){
		$query = "
		SELECT a.parution, a.rep_mail,a.rep_tel,a.rep_port ,a.id,a.ref, a.titre, a.date, a.date_crea, a.annee,a.cylindree,
		a.couleur, a.km, a.id_cat,a.prix,a.departement,
		a.garantie, c.nom_cat, m.marque, m.id_mot,m.modele
		,foto.nom_fichier as foto, info.controle
		,moto.id_me, moto.nom, moto.ville,moto.adresse ,moto.tel
		,moto.fax , moto.horaires,moto.latitude,moto.longitude,moto.liengmap
		,info.type_occaz,a.descr_site,info.neuf, info.isgarantie
		FROM  annonces a
		left join categories c on a.id_cat = c.id_cat
		left join motos m on a.id_mot = m.id_mot
		left join annonces_info info on info.ref = a.ref
		left join annonces_photos foto on foto.id_annonce = a.id
		left join moto_expert moto on  moto.id_me = a.id_me
		where a.internet <> '0'
		AND a.modere = '1'
		AND a.ispayed = '1'
		AND a.prov <> 'mebe'
		and a.id =".$id;
		try{
			return $this->getAdapter()->fetchRow($query);

		}catch (Exception $e){
			var_dump($e->getMessage());
		}

	}
        
	public function photoDetailAnnonce($id){
		$query = "select * from annonces_photos where id_annonce=".$id;
		try{

			return $this->getAdapter()->fetchAll($query);

		}catch (Exception $e){
			var_dump($e->getMessage());
		}

	}

	public function announceByCLient($idClient)
	{
		$query = "SELECT * FROM  annonces a
		left join annonces_photos ap on a.id = ap.id_annonce
		WHERE a.id_client = ".$idClient." and a.modere!=2                         
		group by a.id";
                // preguntar si se agrega 
                //and a.modere = 0
			
		try{
			return $this->getAdapter()->fetchAll($query);

		}catch (Exception $e){
			var_dump($e->getMessage());
		}

	}

	private function _save($datos) {
		$id = 0;
		if (!empty($datos['id'])) {
			$id = (int) $datos['id'];
		}
		unset($datos['id']);

		$datos = array_intersect_key($datos, array_flip($this->_getCols()));

		if ($id > 0) {
			$cantidad = $this->update($datos, 'id = ' . $id);
			$id = ($cantidad < 1) ? 0 : $id;
		} else {
			$id = $this->insert($datos);
		}
		return $id;
	}

	public function saveAnnonce($datos) {
		return $this->_save($datos);
	}

	public function deleteAnnonce($id){
		$where = $this->_db->quoteInto('id =?', $id);
		$this->_db->delete($this->_name, $where);
	}

}