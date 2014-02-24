<?php
class App_Model_Department extends App_Db_Table_Abstract {

    protected $_name = 'departements';

    public function listDepartment(){
        $query = $this->_db
        ->select()->from(array('d' => $this->_name), array("numero AS NUM", "CONCAT(numero, ' - ',nom) AS NOM"));
        
        return $this->_db->fetchPairs($query);
    }
}
