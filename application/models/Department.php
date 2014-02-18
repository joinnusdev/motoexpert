<?php
class App_Model_Department extends App_Db_Table_Abstract {

    protected $_name = 'departements';

    public function listDepartment(){
        $query = $this->_db
        ->select()->from(array('d' => $this->_name));
        return $this->_db->fetchAll($query);
    }
}
?>