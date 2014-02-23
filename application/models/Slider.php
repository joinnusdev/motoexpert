<?php
class App_Model_Slider extends App_Db_Table_Abstract {

    protected $_name = 'hicone-mobile-datas-bannieres';

    public function listSlider(){
       /* $query = $this->_db
        ->select()->from(array('s' => $this->_name), array('id', 'value'));
        return $this->_db->fetchAll($query);*/
    }
}