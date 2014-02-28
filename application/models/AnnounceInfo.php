<?php
class App_Model_AnnounceInfo extends App_Db_Table_Abstract {

	protected $_name = 'annonces_info';
	
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


}