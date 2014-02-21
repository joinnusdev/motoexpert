<?php

/**
 * Description of User
 *
 * @author James Otiniano
 */
class App_Model_ClientConnexion extends App_Db_Table_Abstract {

	protected $_name = 'client_connexion';

	const TABLE_CLIENTCON = 'client_connexion';
	
	public function updateData($datos, $id) {
		$id = $this->update($datos, 'id_client = ' . $id);
		return $id; 
	}
	
	public function insertData($datos) {
		
		$id = $this->insert($datos);
		return $id;
	
	}
	
	
	

	
}
