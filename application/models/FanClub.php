<?php
class App_Model_FanClub extends App_Db_Table_Abstract {

    protected $_name = 'hicone-mobile-datas-fan-club';

    public function getDatos(){
         $query = "select * from `hicone-mobile-datas-fan-club`";
            try{
                return $this->getAdapter()->fetchAll($query);

            }catch (Exception $e){
                        var_dump($e->getMessage());
            }
    }
}