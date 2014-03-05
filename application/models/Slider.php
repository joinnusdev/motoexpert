<?php
class App_Model_Slider extends App_Db_Table_Abstract {

    protected $_name = 'hicone-mobile-datas-bannieres';

    public function listSlider(){
        $query = "select * from `hicone-mobile-datas-bannieres`
                    where  right(id,3) = 'img'";
            try{
                return $this->getAdapter()->fetchAll($query);

            }catch (Exception $e){
                        var_dump($e->getMessage());
            }
    }
}