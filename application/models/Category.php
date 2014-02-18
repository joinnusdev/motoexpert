<?php
class App_Model_Category extends App_Db_Table_Abstract {

    protected $_name = 'categories';

    public function listCategory(){
        $query = $this->_db
        ->select()->from(array('c' => $this->_name));
        return $this->_db->fetchAll($query);
    }
}
?>