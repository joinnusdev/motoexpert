<?php
class App_Model_Magasin extends App_Db_Table_Abstract {

    protected $_name = 'moto_expert';
    const ESTADO_ACTIVO = 1;
    

    public function listMagasin(){
        $query = $this->_db
        ->select()->from(array('m' => $this->_name))
        ->where('m.actif = ?', App_Model_Magasin::ESTADO_ACTIVO)
        ->order('m.ville');       
        return $this->_db->fetchAll($query);
    }
}
?>