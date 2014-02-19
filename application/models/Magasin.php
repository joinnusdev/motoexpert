<?php
class App_Model_Magasin extends App_Db_Table_Abstract {

    protected $_name = 'moto_expert';
    const ESTADO_ACTIVO = 1;
    const PAIS = 'fr';

    public function listMagasin(){
        $query = $this->_db
        ->select()->from(array('m' => $this->_name), array('id_me', 'ville'))
        ->where('m.actif = ?', App_Model_Magasin::ESTADO_ACTIVO)
        ->order('m.ville');       
        return $this->_db->fetchPairs($query);
    }
    
    public function countMagasinFrance(){
        $query = $this->_db
        ->select()->from(array('m' => $this->_name), array('count(*) as magasin'))
        ->where('m.actif = ?', App_Model_Magasin::ESTADO_ACTIVO)
        ->where('m.pays= ?', App_Model_Magasin::PAIS)
        ->order('m.ville');       
        return $this->getAdapter()->fetchRow($query);
        try{
                return $this->getAdapter()->fetchRow($query);

        }catch (Exception $e){
                var_dump($e->getMessage());			
        }
    }

}