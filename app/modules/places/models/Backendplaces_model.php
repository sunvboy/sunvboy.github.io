<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BackendPlaces_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function create(){
		$data = array(
			'title' => $this->input->post('title'),
			'cityid' => $this->input->post('cityid'),
			'districtid' => $this->input->post('districtid'),
			'wardid' => $this->input->post('wardid'),
			'address' => $this->input->post('address'),
			'phone' => $this->input->post('phone'),
			'publish' => $this->input->post('publish'),
			'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
		);
		$this->db->insert('places', $data);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}

	public function update($id = 0){
		$data = array(
			'title' => $this->input->post('title'),
			'cityid' => $this->input->post('cityid'),
			'districtid' => $this->input->post('districtid'),
			'wardid' => $this->input->post('wardid'),
			'publish' => $this->input->post('publish'),
			'address' => $this->input->post('address'),
			'phone' => $this->input->post('phone'),
			'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600),
		);
		$this->db->where(array('id' => $id))->update('places', $data);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}

	public function update_field($param = NULL, $id = 0){
		$this->db->where(array('id' => $id))->update('places', $param);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}

	public function countall(){
		$this->db->where(array('trash' => 0));
		$keyword = $this->input->get('keyword');
		if(!empty($keyword)){
			$keyword = $this->db->escape_like_str($keyword);
			$this->db->where('(title LIKE \'%'.$keyword.'%\')');
		}
		$this->db->from('places');
		$result = $this->db->count_all_results();
		$this->db->flush_cache();
		return $result;
	}

	public function view($start = 0, $limit = 0){
		$this->db->where(array('trash' => 0));
		$keyword = $this->input->get('keyword');
		if(!empty($keyword)){
			$keyword = $this->db->escape_like_str($keyword);
			$this->db->where('(title LIKE \'%'.$keyword.'%\')');
		}
		$this->db->from('places');
		$this->db->order_by('created DESC');
		$this->db->limit($limit, $start);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}

	public function read($id = 0){
		$this->db->where(array('places.trash' => 0));
		$this->db->select('places.*');
		$this->db->from('places');
		$this->db->where(array('places.id' => $id))->limit(1, 0);
		$result = $this->db->get()->row_array();
		$this->db->flush_cache();
		return $result;
	}

	public function delete($id = 0){
		// $this->db->where(array('id' => $id))->delete('places');
		$this->db->where(array('id' => $id))->update('places', array('trash' => 1));
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}
	
	public function ReadByField($param = NULL, $limit = 5){
		$this->db->where(array('trash' => 0));
		if(isset($param) && is_array($param) && count($param)){
			$this->db->where($param);
		}
		$this->db->from('places');
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}
	

}