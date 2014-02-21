<?php

/**
 * Description of User
 *
 * @author James Otiniano
 */
class App_Model_Client extends App_Db_Table_Abstract {

	protected $_name = 'client';

	const STATE_ACTIVO = '1';
	const TABLE_CLIENT = 'client';
	
	private function _save($datos) {
		$id = 0;
		if (!empty($datos['cid'])) {
			$id = (int) $datos['cid'];
		}
		unset($datos['cid']);
		$datos = array_intersect_key($datos, array_flip($this->_getCols()));
	
		if ($id > 0) {
			$cantidad = $this->update($datos, 'cid = ' . $id);
			$id = ($cantidad < 1) ? 0 : $id;
		} else {
			$id = $this->insert($datos);
		}
		return $id;
	}
	
	public function saveClient($datos) {
		return $this->_save($datos);
	}
	
	
	
	public function loguinUsuario($username, $passwordIng)
	{
	
		//$passwordIng = "c4ca4238a0b923820dcc509a6f75849b";
		Zend_Loader::loadClass('Zend_Auth_Adapter_DbTable');
	
		try {
			$db = $this->getAdapter();
			$adapter = new Zend_Auth_Adapter_DbTable($db);
			$adapter->setTableName(array('u' => self::TABLE_CLIENT))
			->setIdentityColumn('email')
			->setCredentialColumn('pass')
			->setCredentialTreatment('md5(?)')
			->setIdentity($username)
			->setCredential($passwordIng);
			
			$adapter->getDbSelect()
			->joinLeft(array('cc' => App_Model_ClientConnexion::TABLE_CLIENTCON), 'u.cid = cc.id_client')			
			;
	
			$auth = Zend_Auth::getInstance();
			$result = $auth->authenticate($adapter);
	
	
			if ($result->isValid()) {				
				$data = $adapter->getResultRowObject(null, 'pass');				
				$auth->getStorage()->write($data);	
				return $data;	
			} else {
				$auth->clearIdentity();
				return false;
			}
		} catch (Zend_Exception $e) {
			$mens = "Auth" . $e->getMessage() . ' - ' . $e->getTraceAsString();
				
			Zend_Registry::get('log')->log($mens, Zend_Log::CRIT);
			return false;
		}
	}
	public function validUser($email) {
		$db = $this->getDefaultAdapter(); 
		$query = $db->select()->from($this->_name, array('cid'))
		->where('email = ?', $email);
		
		$result = $db->fetchAll($query);
		
		if ($result)
			return true;
		return false;
	}
	

	
}
