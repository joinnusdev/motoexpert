<?php
class App_Model_Noticia extends App_Db_Table_Abstract {

	protected $_name = 'hicone-mobile-datas-news';

	public function listNews($data = NULL){
		$query = "select * from `hicone-mobile-datas-news` n
		inner join `hicone-mobile-datas-news-cat-assoc`ca on n.id_news = ca.id_news
		where ca.id_parent !='franchise'
		and n.titre !=''";
		
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