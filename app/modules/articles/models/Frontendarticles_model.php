<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontendArticles_Model extends FC_Model{

	public function __construct(){
		parent::__construct();
	}
	public function ReadAllItems( $start = 0, $limit = 0, $order='desc'){
		$this->db->select('id, title,fullname,created,title,message,description');
		$this->db->where(array('type' => 0,'publish' => 1, 'trash' => 0));
		$this->db->from('mailsubricre');
		$this->db->order_by('id '.$order.'');
		$this->db->limit($limit, $start);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}

	public function CountAllItems(){
		$this->db->select('id, title,fullname,created,title,message,description');
		$this->db->where(array('type' => 0,'publish' => 1, 'trash' => 0));
		$this->db->from('mailsubricre');
		$this->db->order_by('id desc');
		$result = $this->db->count_all_results();
		$this->db->flush_cache();
		return $result;
	}
	public function getComent($id_alat)
	{
		$query =$this->db->query("SELECT * FROM comments WHERE parentid=0 and moduleid='$id_alat'");//cahnge table name, and argument that you want
		$result = $query->result_array();
		$count = count($result);
		return $count;
	}
	function getRows($params = array()){
		$this->db->select('*');
		$this->db->where(array('trash' => 0, 'alanguage' => 'vietnamese'));
		$this->db->from('articles');
		//set start and limit
		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit'],$params['start']);
		}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit']);
		}
		//get records
		$query = $this->db->get();
		//return fetched data
		return ($query->num_rows() > 0)?$query->result_array():FALSE;
	}


	//-----------------------------------------------------
	// Xem chi tiết bài viết
	//-----------------------------------------------------
	public function ReadByField($field = '', $value = 0, $lang = 'vietnamese'){
		$this->db->where(array('trash' => 0, 'alanguage' => $lang, 'created <=' => gmdate('Y-m-d H:i:s', time() + 7*3600)));
		$this->db->from('articles');
		$this->db->where(array($field => $value))->limit(1, 0);
		$result = $this->db->get()->row_array();
		$this->db->flush_cache();
		return $result;
	}
	public function ReadByFieldusers($id){
		$this->db->select('fullname');
		$this->db->from('users');
		$this->db->where(array('id' => $id))->limit(1, 0);
		$result = $this->db->get()->row_array();
		$this->db->flush_cache();
		return $result;
	}

	//-----------------------------------------------------
	// Cập nhật lượt xem bài viết
	//-----------------------------------------------------
	public function UpdateViewed($field = '', $value = 0, $lang = 'vietnamese'){
		$this->db->where(array($field => $value, 'alanguage' => $lang,'id'=>$value))->set('viewed', 'viewed+1', FALSE)->update('articles');
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}

	//-----------------------------------------------------
	// Xem bài viết cùng chủ đề
	//-----------------------------------------------------
	public function ReadByTags($id = 0, $tags = NULL, $limit = 6, $select = 'articles.id, articles.title, articles.slug, articles.canonical, articles.images, articles.description, articles.viewed, articles.created, articles_catalogues.id as cat_id, articles_catalogues.title as cat_title, articles_catalogues.slug as cat_slug, articles_catalogues.canonical as cat_canonical'){
		if(isset($tags) && is_array($tags) && count($tags)){
			// Danh sách tag
			$tagid = '';
			foreach($tags as $key => $val){
				$tagid = $tagid . $val['id'].', ';
			}
			$tagid = substr($tagid, 0, -2);
			$this->db->select($select);
			$this->db->where(array('articles.trash' => 0, 'articles.created <=' => gmdate('Y-m-d H:i:s', time() + 7*3600)));
			// Khác bài hiện tại
			$this->db->where(array('articles.id !=' => $id));
			$this->db->where('articles.id IN (SELECT modulesid FROM tags_relationship WHERE modules = \'articles\' AND tagsid IN ('.$tagid.'))');
			$this->db->from('articles');
			$this->db->join('articles_catalogues', 'articles.cataloguesid = articles_catalogues.id');
			$this->db->limit($limit, 0);
			$this->db->order_by('articles.created DESC');
			$result = $this->db->get()->result_array();
			$this->db->flush_cache();
			return $result;
		}
	}

	//-----------------------------------------------------
	// Xem bài viết cho sitemap
	//-----------------------------------------------------
	public function ReadAllForSitemap($lang = 'vietnamese', $cataloguesid = 0, $lft = 0, $rgt = 0,  $id = 0, $limit = 5,  $select = 'articles.id, articles.title, articles.slug, articles.canonical, articles.images, articles.description, articles.viewed, articles.created, articles_catalogues.id as cat_id, articles_catalogues.title as cat_title, articles_catalogues.slug as cat_slug, articles_catalogues.canonical as cat_canonical'){
		$this->db->select($select);
		$this->db->where(array('articles.trash' => 0, 'articles.publish' => 1, 'articles.alanguage' => $lang, 'articles.created <=' => gmdate('Y-m-d H:i:s', time() + 7*3600)));
		$this->db->join('articles_catalogues', 'articles.cataloguesid = articles_catalogues.id');
		if($cataloguesid > 0){
			if($rgt - $lft == 1){
				$this->db->where(array('articles.cataloguesid' => $cataloguesid));
			}
			else{
				$this->db->where('(articles.cataloguesid IN (SELECT id FROM articles_catalogues WHERE lft >= '.$lft.' AND rgt <= '.$rgt.'))');
			}
		}
		$this->db->from('articles');
		$this->db->limit($limit, 0);
		$this->db->order_by('articles.created DESC');
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}

	//-----------------------------------------------------
	// Đếm bài viết cho tag
	//-----------------------------------------------------
	public function CountAllTags($id = 0, $modules = 'articles'){
		$this->db->where(array('modules' => $modules, 'tagsid' => $id));
		$this->db->from('tags_relationship');
		$result = $this->db->count_all_results();
		$this->db->flush_cache();
		return $result;
	}

	//-----------------------------------------------------
	// Xem bài viết cho tag
	//-----------------------------------------------------
	public function ReadAllTags($id = 0, $modules = 'articles', $start = 0, $limit = 10, $select = 'articles.id, articles.title, articles.slug, articles.canonical, articles.images, articles.description, articles.viewed, articles.created, articles_catalogues.id as cat_id, articles_catalogues.title as cat_title, articles_catalogues.slug as cat_slug, articles_catalogues.canonical as cat_canonical'){

		$this->db->select($select);
		$this->db->from('tags_relationship');
		$this->db->join('articles', 'tags_relationship.modulesid = articles.id');
		$this->db->join('articles_catalogues', 'articles.cataloguesid = articles_catalogues.id');
		$this->db->where(array('tags_relationship.modules' => $modules, 'tags_relationship.tagsid' => $id));
		$this->db->order_by('articles.order ASC, articles.created DESC');
		$this->db->limit($limit, $start);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}
	public function ReadByCondition($param = ''){
		$param['select'] = ((isset($param['select'])) ? $param['select'] : 'id, title, slug, canonical');
		$param['where'] = ((isset($param['where'])) ? $param['where'] : '');
		$param['order_by'] = ((isset($param['order_by'])) ? $param['order_by'] : 'id desc');
		$param['limit'] = ((isset($param['limit'])) ? $param['limit'] : 5);
		$param['lft'] = ((isset($param['lft'])) ? $param['lft'] : 0);
		$param['rgt'] = ((isset($param['rgt'])) ? $param['rgt'] : 0);
		
		$this->db->select($param['select']);
		$this->db->from('articles');
		$this->db->where('trash', 0);
		$this->db->where($param['where']);

		if(isset($param['where_not_in']) && is_array($param['where_not_in']) && isset($param['where_not_in_field']) && !empty($param['where_not_in_field'])){
			$this->db->where_not_in($param['where_not_in_field'], $param['where_not_in']);
		}

		if($param['lft'] > 0 && $param['rgt'] > 0){
			$this->db->where('(articles.cataloguesid IN (SELECT id FROM articles_catalogues WHERE lft >= '.$param['lft'].' AND rgt <= '.$param['rgt'].'))');
		}
		$this->db->limit($param['limit'], 0);
		$this->db->order_by($param['order_by']);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}

}
