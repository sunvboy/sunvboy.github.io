<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontendTags_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function ReadByModule($modulesid = 0, $modules = 'articles'){
		$this->db->where(array('tags.trash' => 0));
		$this->db->select('id, slug, title, canonical');
		$this->db->from('tags');
		$this->db->where('(id IN (SELECT tagsid FROM tags_relationship WHERE modules = \''.$modules.'\' AND modulesid = '.$modulesid.'))');
		$this->db->order_by('order ASC, title ASC');
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}

	public function ReadByModules($modules = 'articles'){
		$this->db->where(array('tags.trash' => 0));
		$this->db->select('id, slug, title, canonical');
		$this->db->from('tags');
		$this->db->where('(id IN (SELECT tagsid FROM tags_relationship))');
		$this->db->order_by('order ASC, title ASC');
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}

	public function ReadByField($field = '', $value = 0){
		$this->db->where(array('trash' => 0));
		$this->db->from('tags');
		$this->db->where(array($field => $value))->limit(1, 0);
		$result = $this->db->get()->row_array();
		$this->db->flush_cache();
		return $result;
	}

	public function ReadAllByField($field = '', $value = 0){
		$this->db->where(array('trash' => 0));
		$this->db->from('tags');
		$this->db->where(array($field => $value));
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}
	
	public function ReadTagsCondition($param = ''){
		$this->db->select('*');
		$this->db->from('tags');
		$this->db->where(array('trash' => 0,'publish' => 1));
		$this->db->where($param);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}

}
