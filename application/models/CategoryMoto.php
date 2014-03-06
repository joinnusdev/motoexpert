<?php
class App_Model_CategoryMoto extends App_Db_Table_Abstract {

    protected $_name = 'hicone-mobile-datas-news-cat';

    public function listCategory()
    {
        $query = $this->_db
        ->select()->from(array('c' => $this->_name), array('id_cat', 'name'))
        ->order('name');
        
        return $this->_db->fetchPairs($query);
    }    
    
}