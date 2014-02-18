<?php
class App_Model_Category extends App_Db_Table_Abstract {

    protected $_name = 'categories';

    public function listCategory(){
        $query = $this->_db
        ->select()->from(array('c' => $this->_name), array('id_cat', 'nom_cat'));
        return $this->_db->fetchPairs($query);
    }
}