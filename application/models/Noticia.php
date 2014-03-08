<?php
class App_Model_Noticia extends App_Db_Table_Abstract {

	protected $_name = 'hicone-mobile-datas-news';
	
<<<<<<< HEAD
	public function listNewsSearch($data){
		$query = "select * from `hicone-mobile-datas-news` n
		inner join `hicone-mobile-datas-news-cat-assoc`ca on n.id_news = ca.id_news
		where ca.id_parent !='franchise'
		and n.titre !=''";
		//if ($data)		
	
		try{
			return $this->getAdapter()->fetchAll($query);
	
		}catch (Exception $e){
			var_dump($e->getMessage());
		}
=======
	public function listNewsSearch($data){
		$query = "select * from `hicone-mobile-datas-news` n
		inner join `hicone-mobile-datas-news-cat-assoc`ca on n.id_news = ca.id_news
		where ca.id_parent !='franchise'
		and n.titre !=''";
		//if ($data)		
	
		try{
			return $this->getAdapter()->fetchAll($query);
	
		}catch (Exception $e){
			var_dump($e->getMessage());
		}
>>>>>>> cde70fb1a6825b62e299ee2dd180fd45e30e52f8
	}

	public function listNews($codigo){
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
	
<<<<<<< HEAD
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
=======
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
>>>>>>> cde70fb1a6825b62e299ee2dd180fd45e30e52f8
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