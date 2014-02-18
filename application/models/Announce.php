<?php
class App_Model_Announce extends App_Db_Table_Abstract {

	protected $_name = 'annonces';

	public function listSearch($datos){

		$query = "
		SELECT a.id,a.ref, a.titre, a.date, a.annee,a.cylindree, a.couleur, a.km, a.prix,a.departement,
		a.garantie, c.nom_cat, m.marque, m.modele
		FROM annonces a, categories c, annonce_cat ac, motos m
		WHERE a.id_mot = m.id_mot
		AND a.ref = ac.ref
		AND ac.id_cat = c.id_cat
		";
		if (isset($datos['deparment']) and $datos['deparment'] != 0)
			 $query.= " AND a.departement = ".$datos['deparment'];
		
		if (isset($datos['category']) and $datos['category'] != 0)
			$query.= " AND a.id_cat = ".$datos['category'];
		
		if (isset($datos['magasin']) and $datos['magasin'] != 0)
			$query.= " AND a.id_me = ".$datos['magasin'];
		
		if (isset($datos['marque']) and $datos['marque'] != "") {
			$query.= " AND a.marque = ". '"'.$datos['marque'].'"';
		}
		if (isset($datos['modele']) and $datos['modele'] != 0)
			$query.= " AND m.id_mot = ".$datos['modele'];
			 
			 
			try{
			return $this->getAdapter()->fetchAll($query);
			 
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
		";
		if (isset($datos['deparment']) and $datos['deparment'] != 0)
			$query.= " AND a.departement = ".$datos['deparment'];
	
		if (isset($datos['category']) and $datos['category'] != 0)
			$query.= " AND a.id_cat = ".$datos['category'];
	
		if (isset($datos['magasin']) and $datos['magasin'] != 0)
			$query.= " AND a.id_me = ".$datos['magasin'];
	
		if (isset($datos['marque']) and $datos['marque'] != "") {
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


}