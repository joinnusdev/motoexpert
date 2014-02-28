<?php
class App_Model_Photo extends App_Db_Table_Abstract {

	protected $_name = 'annonces_photos';

	private function _save($datos) {
		$id = 0;
		if (!empty($datos['id_photo'])) {
			$id = (int) $datos['id_photo'];
		}
		unset($datos['id_photo']);

		$datos = array_intersect_key($datos, array_flip($this->_getCols()));

		if ($id > 0) {			
			$cantidad = $this->update($datos, 'id = ' . $id);
			$id = ($cantidad < 1) ? 0 : $id;
		} else {			
			$id = $this->insert($datos);
		}
		return $id;
	}

	public function savePhotos($datos) {
		return $this->_save($datos);
	}
	
	public function getPhotosByAnnonce($idAnnonce) {
		$db = $this->getDefaultAdapter();
		
		$query = $db->select()->from($this->_name)
		->where('id_annonce = ?', $idAnnonce);
		
		$result =  $db->fetchAll($query);
		
		foreach ($result as $item):
			$total[$item['ordre']] = $item;		
		endforeach;
		
		return $total;
		
		

	}
	public function deletePhotos($idAnnonce) {
		$where = "id_annonce = ". $idAnnonce;
		$this->delete($where);
	}


}