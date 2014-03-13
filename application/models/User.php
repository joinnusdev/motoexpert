<?php

/**
 * Description of User
 *
 * @author James Otiniano
 */
class App_Model_User extends App_Db_Table_Abstract {

	protected $_name = 'user';

	const STATE_ACTIVO = '1';
	const TABLE_USER = 'user';
	
	public function loguinUsuario($username, $passwordIng)
	{
	
		//$passwordIng = "c4ca4238a0b923820dcc509a6f75849b";
		Zend_Loader::loadClass('Zend_Auth_Adapter_DbTable');
	
		try {
			$db = $this->getAdapter();
			$adapter = new Zend_Auth_Adapter_DbTable($db);
			$adapter->setTableName(array('u' => self::TABLE_USER))
			->setIdentityColumn('email')
			->setCredentialColumn('password')
			->setCredentialTreatment('md5(?)')
			->setIdentity($username)
			->setCredential($passwordIng);
	
			$auth = Zend_Auth::getInstance();
			$result = $auth->authenticate($adapter);
	
	
			if ($result->isValid()) {				
				$data = $adapter->getResultRowObject(null, 'password');
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
        
      	
}
