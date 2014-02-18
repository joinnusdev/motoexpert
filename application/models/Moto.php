<?php
class App_Model_Moto extends App_Db_Table_Abstract {

    protected $_name = 'motos';

    public function listarMarca(){
        /*
        $query = $this->_db
        ->select()->from(array('m' => $this->_name));
        return $this->_db->fetchAll($query);
        */
       $query = "SELECT marque as id, marque as value FROM  motos where id_mot>1 GROUP BY marque";
       try{
        return $this->getAdapter()->fetchAll($query);
        
       }catch (Exception $e){
                var_dump($e->getMessage());
       }
        
    }
    
    public function listarModelo($idMarca){
      /*  $query = $this->_db
                ->select()->from(array('m' => $this->_name))
                ->where('m.id = ?', $idMarca);
      return $this->_db->fetchAll($query);
       */
       $query = "SELECT id_mot as id, modele as value FROM  `motos` where marque='".addslashes(stripslashes($idMarca))."'  
                and id_mot > 1 order by modele";
       try{
        return $this->getAdapter()->fetchAll($query);
       }catch (Exception $e){
                var_dump($e->getMessage());
       }
    }
    
    
	
}
?>