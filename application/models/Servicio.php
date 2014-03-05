<?php
class App_Model_Servicio extends App_Db_Table_Abstract {

    protected $_name = 'hicone-mobile-datas-fan-club';

    public function getFanClub(){
         $query = "select * from `hicone-mobile-datas-fan-club`";
            try{
                return $this->getAdapter()->fetchAll($query);

            }catch (Exception $e){
                        var_dump($e->getMessage());
            }
    }
    
    public function getOcasion(){
         $query = "select * from `hicone-mobile-datas-occasion-moto`";
            try{
                return $this->getAdapter()->fetchAll($query);

            }catch (Exception $e){
                        var_dump($e->getMessage());
            }
    }
}