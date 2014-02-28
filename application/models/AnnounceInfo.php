<?php
class App_Model_AnnounceInfo extends App_Db_Table_Abstract {

	protected $_name = 'annonces_info';
	
	public function saveAnnonceInfo($datos) {
		$db = $this->getDefaultAdapter();
		$datos = array_intersect_key($datos, array_flip($this->_getCols()));
		$id = $db->insert($this->_name, $datos);
		
		return $id;
	}
	
	public function updateAnnonceInfo($datos) {
		$db = $this->getDefaultAdapter();
		$ref = $datos['ref'];
		unset($datos['ref']);
		$datos = array_intersect_key($datos, array_flip($this->_getCols()));
		$where = " ref = ". $ref;
		$id = $db->update($this->_name, $datos, $where);
	
		return $id;
	}


}