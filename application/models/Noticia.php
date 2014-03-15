<?php
class App_Model_Noticia extends App_Db_Table_Abstract {

	protected $_name = 'hicone-mobile-datas-news';
	

	public function listNewsSearch($data){
		$query = "select * from `hicone-mobile-datas-news` n
		inner join `hicone-mobile-datas-news-cat-assoc`ca on n.id_news = ca.id_news
                inner join `hicone-mobile-datas-news-cat`categoria on ca.id_cat = categoria.id_cat
		where ca.id_parent !='franchise'
		and n.titre !=''";
                
                if (isset($data['magasin']) and $data['magasin'] > 0) 
                    $query.= " and ca.id_parent =  'mag_".$data['magasin']."'";
                
                if (isset($data['category'])and $data['category']!="") 
                    $query.= " and categoria.name =  '".$data['category']."'";
                
                if (isset($data['deparment'])and $data['deparment']!="") 
                   $query.= " and categoria.name =  '".$data['deparment']."'";
                //echo $query;
                try{
			return $this->getAdapter()->fetchAll($query);
	
		}catch (Exception $e){
			var_dump($e->getMessage());
		}

	

	}

	public function listNews($cod=NULL){
		$query = "select * from `hicone-mobile-datas-news` n
		inner join `hicone-mobile-datas-news-cat-assoc`ca on n.id_news = ca.id_news
		where ca.id_parent !='franchise'
		and n.titre !=''";
		if ($cod)
			$query.= " and n.id_news <> '". $cod. "'";
		
				try{
			return $this->getAdapter()->fetchAll($query);

		}catch (Exception $e){
			var_dump($e->getMessage());
		}
	}
	

	public function listNewsDeta($cod=NULL){
		$query = "select * from `hicone-mobile-datas-news` n
		inner join `hicone-mobile-datas-news-cat-assoc`ca on n.id_news = ca.id_news
		where ca.id_parent !='franchise'
		and n.titre !=''";
		if ($cod) 
			$query.= " and n.id_news = '". $cod. "'";
		
	
		try{
			return $this->getAdapter()->fetchAll($query);
	
		}catch (Exception $e){
			var_dump($e->getMessage());
		}

	

	}

	public function listHomeNews(){
		$query = "select * from `hicone-mobile-datas-news`
		where titre !=''
		and image_1 !=''
		order by rand()
		limit 3";
		return $this->_db->fetchAll($query);
		 
	}

}