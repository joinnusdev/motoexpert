<?php

/**
 * Description of User
 *
 * @author James Otiniano
 */
class App_Model_Newsletter extends App_Db_Table_Abstract {

	protected $_name = 'contact';

	const STATE_ACTIVO = '1';
	const TABLE_CLIENT = 'contact';
	
	private function _save($datos) {
		    $id = 0;
                    if (!empty($datos['id'])) {
                        $id = (int) $datos['id'];
                    }
                    unset($datos['id']);
                    $datos = array_intersect_key($datos, array_flip($this->_getCols()));

                    if ($id > 0) {
                        $condicion = '';
                        if (!empty($condicion)) {
                            $condicion = ' AND ' . $condicion;
                        }

                        $cantidad = $this->_db->update($this->_name, $datos, 'id = ' . $id . $condicion);
                        $id = ($cantidad < 1) ? 0 : $id;
                    } else {
                        $id = $this->_db->insert($this->_name, $datos);
                    }
                    return $id;
	}
	
	public function saveNewsletter($datos) {
            	return $this->_save($datos);
	}
	
}
