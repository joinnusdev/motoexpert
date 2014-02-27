<?php
class App_Model_Noticia extends App_Db_Table_Abstract {

	protected $_name = 'hicone-mobile-datas-news';

	public function listNews(){
            $query = $this->_db
                ->select()->from(array('n' => $this->_name))
                ->limit(2000);
            return $this->_db->fetchAll($query);
        }



}
?>