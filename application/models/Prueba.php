<?php

/**
 * Description of Prueva
 *
 * @author James
 */
class App_Model_Prueba extends App_Db_Table_Abstract {

	protected $_name = 'rbt';

	const TABLA_RBT = 'rbt';
	const ESTADO_PENDIENTE = 2;
	const ESTADO_ACTIVO = 1;
	const ESTADO_ELIMINADO = 0;


	private function _guardar($datos, $condicion = NULL) {
		$id = 0;
		if (!empty($datos['idrbt'])) {
			$id = (int) $datos['idrbt'];
		}
		unset($datos['idrbt']);
		$datos = array_intersect_key($datos, array_flip($this->_getCols()));

		if ($id > 0) {
			$condicion = '';
			if (!empty($condicion)) {
				$condicion = ' AND ' . $condicion;
			}

			$cantidad = $this->update($datos, 'idrbt = ' . $id . $condicion);
			$id = ($cantidad < 1) ? 0 : $id;
		} else {
			$id = $this->insert($datos);
		}
		return $id;
	}

	public function actualizarDatos($datos) {
		return $this->_guardar($datos);
	}


	public function addUser($datos) {

		$db = $this->getDefaultAdapter();
		//$db->beginTransaction();
		try {
			$id = $this->_guardar($datos);
			if ($id) {
				$datos['clave'] = md5($datos['clave']);
				$datos['idrbt'] = $id;
				$datos['estado'] = self::ESTADO_ACTIVO;
				$model = new App_Model_UsuarioRbt();
				$iduseremp = $model->actualizarDatos($datos);
				return $iduseremp;
			}

			//$db->commit();
		} catch (Zend_Exception $e) {
			//$db->rollBack();
			return false;
		}

	}


	public function listRbt($flag = NULL, $busqueda = NULL, $pendiente=FALSE)
	{
		$db = $this->getAdapter();
		$query = $db->select()->from(array('r' => $this->_name),
				array('idrbt', 'cancion', 'artista', 'cancion_formato_mp', 'cancion_formato_wav',
						'fecha_registro', 'fecha_valido', 'estado', 'idempresa', 'precio'))
						->joinInner(array('e' => App_Model_Empresa::TABLA_EMPRESA),
								'e.idempresa = r.idempresa', array('empresa' => 'nombre'))
								->joinInner(array('g' => App_Model_Genero::TABLA_GENERO),
										'r.idgenero = g.idgenero', array('genero' => 'descripcion'));
			
		;
		if (isset($flag) and ($flag == "cancion") and $busqueda)
			$query->where('r.cancion like (?) ', '%'.$busqueda.'%');
		if (isset($flag) and ($flag == "artista") and $busqueda)
			$query->where('r.artista like (?) ', '%'.$busqueda.'%');
		if (isset($flag) and ($flag == "empresa") and $busqueda)
			$query->where('e.nombre like (?) ', '%'.$busqueda.'%');
		if ($pendiente)
			$query->where('r.estado = ?', self::ESTADO_PENDIENTE);
		
			
		$query->limit(50);

		return $db->fetchAll($query);
	}

	public function listUserForRbt($idRbt, $flag = NULL, $busqueda = NULL)
	{
		$db = $this->getAdapter();
		$query = $db->select()->from(array('e' => $this->_name))
		->joinInner(array('ue' => App_Model_UsuarioRbt::TABLA_USUARIOEMPRESA),
				'ue.idrbt = e.idrbt')
				//->where('ue.estado = ?', self::ESTADO_ACTIVO)
		;
		if (isset($flag) and ($flag == "nombre") and $busqueda)
			$query->where('e.nombre = ? ', $busqueda);
		if (isset($flag) and ($flag == "usuario") and $busqueda)
			$query->where('ue.usuario like (?) ', '%'.$busqueda.'%');
			
		$query->where('e.idrbt = ?', $idRbt);
			
		$tipo = array('1', '2', '3', '4');
		$query->where('ue.tipousuario IN (?)', $tipo);
		return $db->fetchAll($query);
	}

	public function getUserRbt($idUserRbt)
	{
		$db = $this->getAdapter();
		$query = $db->select()->from(array('e' => $this->_name))
		->joinInner(array('ue' => App_Model_UsuarioRbt::TABLA_USUARIOEMPRESA),
				'ue.idrbt = e.idrbt')
				->where('ue.iduser_rbt = ?', $idUserRbt)
				;
				return $db->fetchRow($query);
	}
	
	public function getRbtById($idRbt)
	{
		$db = $this->getAdapter();
		$query = $db->select()->from(array('r' => $this->_name))		
				->where('r.idrbt = ?', $idRbt)
				;
				return $db->fetchRow($query);
	}



}