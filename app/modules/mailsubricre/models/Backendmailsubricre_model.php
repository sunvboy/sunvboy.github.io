<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backendmailsubricre_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function create(){
		$data = array(
			'fullname' => $this->input->post('fullname'),
			'phone' => $this->input->post('phone'),
			'birthday' => $this->input->post('birthday'),
			'school' => $this->input->post('school'),
			'address' => $this->input->post('address'),
			'email' => $this->input->post('email'),
			'publish' => $this->input->post('publish'),
			'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
		);
		$this->db->insert('mailsubricre', $data);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}

	public function update($id = 0, $user){
		$data = array(
			'fullname' => $this->input->post('fullname'),
			'phone' => $this->input->post('phone'),
			'message' => $this->input->post('message'),
			'address' => $this->input->post('address'),
			'email' => $this->input->post('email'),
			'publish' => $this->input->post('publish'),
			'description' => $this->input->post('description'),
			'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600),
			'userid_updated' => $user['id'],
		);
		$this->db->where(array('id' => $id))->update('mailsubricre', $data);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}

	public function update_field($param = NULL, $id = 0){
		$this->db->where(array('id' => $id))->update('mailsubricre', $param);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}

	public function countall(){
		$this->db->where(array('trash' => 0,'type'=>'1'));
		$keyword = $this->input->get('keyword');
		if(!empty($keyword)){
			$keyword = $this->db->escape_like_str($keyword);
			$this->db->where('(fullname LIKE \'%'.$keyword.'%\' OR phone LIKE \'%'.$keyword.'%\'OR email LIKE \'%'.$keyword.'%\')');
		}
		$this->db->from('mailsubricre');

		$result = $this->db->count_all_results();
		$this->db->flush_cache();
		return $result;
	}

	public function view($start = 0, $limit = 0){
		$this->db->where(array('trash' => 0,'type'=>'1'));
		$keyword = $this->input->get('keyword');

		if(!empty($keyword)){
			$keyword = $this->db->escape_like_str($keyword);
			$this->db->where('(fullname LIKE \'%'.$keyword.'%\' OR phone LIKE \'%'.$keyword.'%\'OR email LIKE \'%'.$keyword.'%\')');
		}
		$this->db->from('mailsubricre');
		$this->db->order_by('created DESC');
		$this->db->limit($limit, $start);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}


	public function countallguiyeucau(){
		$this->db->where(array('trash' => 0,'type'=>'0'));
		$keyword = $this->input->get('keyword');
		if(!empty($keyword)){
			$keyword = $this->db->escape_like_str($keyword);
			$this->db->where('(fullname LIKE \'%'.$keyword.'%\' OR phone LIKE \'%'.$keyword.'%\'OR email LIKE \'%'.$keyword.'%\')');
		}
		$this->db->from('mailsubricre');

		$result = $this->db->count_all_results();
		$this->db->flush_cache();
		return $result;
	}

	public function viewguiyeucau($start = 0, $limit = 0){
		$this->db->where(array('trash' => 0,'type'=>'0'));
		$keyword = $this->input->get('keyword');

		if(!empty($keyword)){
			$keyword = $this->db->escape_like_str($keyword);
			$this->db->where('(fullname LIKE \'%'.$keyword.'%\' OR phone LIKE \'%'.$keyword.'%\'OR email LIKE \'%'.$keyword.'%\')');
		}
		$this->db->from('mailsubricre');
		$this->db->order_by('created DESC');
		$this->db->limit($limit, $start);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}


	public function countallctv(){
		$this->db->where(array('trash' => 0,'type'=>'2'));
		$keyword = $this->input->get('keyword');
		if(!empty($keyword)){
			$keyword = $this->db->escape_like_str($keyword);
			$this->db->where('(fullname LIKE \'%'.$keyword.'%\' OR phone LIKE \'%'.$keyword.'%\'OR email LIKE \'%'.$keyword.'%\')');
		}
		$this->db->from('mailsubricre');

		$result = $this->db->count_all_results();
		$this->db->flush_cache();
		return $result;
	}

	public function viewctv($start = 0, $limit = 0){
		$this->db->where(array('trash' => 0,'type'=>'2'));
		$keyword = $this->input->get('keyword');

		if(!empty($keyword)){
			$keyword = $this->db->escape_like_str($keyword);
			$this->db->where('(fullname LIKE \'%'.$keyword.'%\' OR phone LIKE \'%'.$keyword.'%\'OR email LIKE \'%'.$keyword.'%\')');
		}
		$this->db->from('mailsubricre');
		$this->db->order_by('created DESC');
		$this->db->limit($limit, $start);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}


	public function read($id = 0){
		$this->db->where(array('mailsubricre.trash' => 0));
		$this->db->select('mailsubricre.*');
		$this->db->from('mailsubricre');
		$this->db->where(array('mailsubricre.id' => $id))->limit(1, 0);
		$result = $this->db->get()->row_array();
		$this->db->flush_cache();
		return $result;
	}

	public function delete($id = 0){
		// $this->db->where(array('id' => $id))->delete('mailsubricre');
		$this->db->where(array('id' => $id))->update('mailsubricre', array('trash' => 1));
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}
	public function CountMessage($param = NULL){
		$this->db->where(array('trash' => 0));
		if(isset($param) && is_array($param) && count($param)){
			$this->db->where($param);
		}
		$this->db->from('mailsubricre');
		$result = $this->db->count_all_results();
		$this->db->flush_cache();
		return $result;
	}
	public function ReadByField($feild = NULL, $id = 0){
		$this->db->where(array('trash' => 0, $feild => $id));
		$this->db->from('mailsubricre');
		$result = $this->db->get()->row_array();
		$this->db->flush_cache();
		return $result;
	}
	
	public function ReadByCondition($param = '', $flag = FALSE){
		$param['select'] = ((isset($param['select'])) ? $param['select'] : 'id');
		$param['where'] = ((isset($param['where'])) ? $param['where'] : '');
		$param['order_by'] = ((isset($param['order_by'])) ? $param['order_by'] : 'id desc');
		$param['limit'] = ((isset($param['limit'])) ? (int)$param['limit'] : 0);
		
		
		$this->db->select($param['select']);
		$this->db->from('mailsubricre');
		$this->db->where($param['where']);
		if($param['limit'] > 0){
			$this->db->limit($param['limit'], 0);
		}
		
		$this->db->order_by($param['order_by']);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		
		return $result;
	}


	public function ReadByConditionDH($param = '', $flag = FALSE){
		$param['select'] = ((isset($param['select'])) ? $param['select'] : 'id');
		$param['where'] = ((isset($param['where'])) ? $param['where'] : '');
		$param['order_by'] = ((isset($param['order_by'])) ? $param['order_by'] : 'id desc');
		$param['limit'] = ((isset($param['limit'])) ? (int)$param['limit'] : 0);


		$this->db->select($param['select']);
		$this->db->from('product_items');
		$this->db->where($param['where']);
		if($param['limit'] > 0){
			$this->db->limit($param['limit'], 0);
		}

		$this->db->order_by($param['order_by']);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();

		return $result;
	}
	

}