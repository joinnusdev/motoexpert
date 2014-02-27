<?php

class Default_NewsController extends App_Controller_Action_Default
{

    public function init()
    {
        parent::init();
    }
    
    public function indexAction()
    {
        $modelNoticia = new App_Model_Noticia();
        $result = $modelNoticia->listNews();
        $i=0;
        foreach ($result as $item) {
            $i++;
            $arrayItem = explode('-', $item['id']);
            print_r($arrayItem);
            
            for($x=0;$x<count($arrayItem);$x++){
                $a = $arrayItem[1];
                $b = explode('_', $a);
                
                if(count($b)==2){
                    $idTienda = $b[1];
                    if('news-mag_'.$idTienda == $arrayItem[0].'-'.$arrayItem[1]){
                        echo $item['id']."<br>";
                    }
                }
                
            }
        }
        exit;
    } 
    
}

?>
