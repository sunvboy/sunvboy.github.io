<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BackendCustomers_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function Query($select,$table){
		$this->db->select($select);
		$this->db->from($table);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}

	public function CountAll(){
		$this->db->where(array('trash' => 0));
		$keyword = $this->input->get('keyword');
		if(!empty($keyword)){
			$keyword = $this->db->escape_like_str($keyword);
			$this->db->where('(nickname LIKE \'%'.$keyword.'%\' OR email LIKE \'%'.$keyword.'%\' OR fullname LIKE \'%'.$keyword.'%\' OR description LIKE \'%'.$keyword.'%\' OR phone LIKE \'%'.$keyword.'%\')');
		}
		$groupsid = $this->input->get('groupsid');
		if($groupsid > 0){
			$this->db->where(array('groupsid' => $groupsid));
		}
		$this->db->from('customers');
		$result = $this->db->count_all_results();
		$this->db->flush_cache();
		return $result;
	}

	public function ReadAll($start = 0, $limit = 0){
		$this->db->where(array('customers.trash' => 0));
		$this->db->select('customers.*, (SELECT title FROM customers_groups WHERE customers_groups.id = customers.groupsid ) as group_title');
		$keyword = $this->input->get('keyword');
		if(!empty($keyword)){
			$keyword = $this->db->escape_like_str($keyword);
			$this->db->where('(nickname LIKE \'%'.$keyword.'%\' OR email LIKE \'%'.$keyword.'%\' OR fullname LIKE \'%'.$keyword.'%\' OR description LIKE \'%'.$keyword.'%\' OR phone LIKE \'%'.$keyword.'%\')');
		}
		$groupsid = $this->input->get('groupsid');
		if($groupsid > 0){
			$this->db->where(array('groupsid' => $groupsid));
		}
		$this->db->from('customers');
		$this->db->order_by('created DESC');
		$this->db->limit($limit, $start);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}

	public function ReadByFieldTraCuu($field = 'id', $value = 0){
		$this->db->where(array('trash' => 0));
		$this->db->from('customers_tracuu');
		$this->db->where(array($field => $value))->limit(1, 0);
		$result = $this->db->get()->row_array();
		$this->db->flush_cache();
		return $result;
	}

	public function ReadByField($field = 'id', $value = 0){
		$this->db->select('customers.*, customers_groups.title');
		$this->db->where(array('customers.trash' => 0));
		$this->db->from('customers');
		$this->db->join('customers_groups', 'customers.groupsid = customers_groups.id');
		$this->db->where(array($field => $value))->limit(1, 0);
		$result = $this->db->get()->row_array();
		$this->db->flush_cache();
		return $result;
	}
	public function Read($userid = 0){
		$this->db->select('*');
		$this->db->from('customers');
		$this->db->where('trash', 0);
		$this->db->where('id', $userid);
		$result = $this->db->get()->row_array();
		$this->db->flush_cache();
		return $result;
	}

	public function Create(){
		$salt = random();
		$password = password_encode($this->input->post('password'), $salt);
		$data = array(
			'email' => $this->input->post('email'),
			'password' => $password,
			'salt' => $salt,
			'groupsid' => $this->input->post('groupsid'),
			'fullname' => $this->input->post('fullname'),
			'sex' => $this->input->post('sex'),
			'skype' => $this->input->post('skype'),
			'code' => $this->input->post('code'),
			'phone' => $this->input->post('phone'),
			'address' => $this->input->post('address'),
			'description' => $this->input->post('description'),
			'meta_title' => $this->input->post('meta_title'),
			'meta_keyword' => $this->input->post('meta_keyword'),
			'meta_description' => $this->input->post('meta_description'),
			'publish' => $this->input->post('publish'),
			'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
			'lock' => 1,
		);
		$this->db->insert('customers', $data);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}

	public function UpdateByPost($field = 'id', $value = 0){
		$data = array(
			'email' => $this->input->post('email'),
			'groupsid' => $this->input->post('groupsid'),
			'fullname' => $this->input->post('fullname'),
			'sex' => $this->input->post('sex'),
			'skype' => $this->input->post('skype'),
			'code' => $this->input->post('code'),
			'phone' => $this->input->post('phone'),
			'address' => $this->input->post('address'),
			'description' => $this->input->post('description'),
			'meta_title' => $this->input->post('meta_title'),
			'meta_keyword' => $this->input->post('meta_keyword'),
			'meta_description' => $this->input->post('meta_description'),
			'publish' => $this->input->post('publish'),
			'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600),
		);
		$this->db->where(array($field => $value))->update('customers', $data);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}

	public function CreateForm($user = '', $arr = ''){
		$data = array(
			'date' => $this->input->post('date'),
			'room' => $this->input->post('room'),
			'doctorid' => (int)$this->input->post('doctorid'),
			'customersid' => (int)$this->input->post('customersid'),
			'publish' => (int)$this->input->post('publish'),
			'result_note' => $this->input->post('result_note'),
			'note' => $this->input->post('note'),
			'note_note' => $this->input->post('note_note'),
			'type' => $this->input->post('type'),
			'result' => json_encode($arr),
			'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
			'userid_created' => $user['id'],
		);
		$this->db->insert('customers_tracuu', $data);
		$result = $this->db->affected_rows();
		if($result > 0){
			$result = $this->db->insert_id();
		}
		$this->db->flush_cache();
		return $result;
	}

	public function UpdateByPostTraCuu($field = 'id', $value = 0, $arr = '', $user = ''){
		$data = array(
			'date' => $this->input->post('date'),
			'room' => $this->input->post('room'),
			'doctorid' => (int)$this->input->post('doctorid'),
			'customersid' => (int)$this->input->post('customersid'),
			'publish' => (int)$this->input->post('publish'),
			'result_note' => $this->input->post('result_note'),
			'note' => $this->input->post('note'),
			'note_note' => $this->input->post('note_note'),
			'type' => $this->input->post('type'),
			'result' => json_encode($arr),
			'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600),
			'userid_updated' => $user['id'],
		);
		$this->db->where(array($field => $value))->update('customers_tracuu', $data);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}

	public function UpdateByField($field = 'id', $value = 0, $param = NULL){
		$this->db->where(array($field => $value))->update('customers', $param);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}

	public function UpdateBatchByField($data = NULL, $field = 'id'){
		$result = $this->db->update_batch('customers', $data, $field); 
		$this->db->flush_cache();
		return $result;
	}

	public function DeleteByField($field = 'id', $value = 0){
		$this->db->where(array($field => $value))->update('customers', array('trash' => 1));
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}
	
	public function CheckFieldByCondition($field = '', $value = ''){
		$this->db->select('id');
		$this->db->from('customers');
		$this->db->where(array(
			$field => $value,
			'trash' => 0,
			'publish' => 1,
		));
		$count = $this->db->count_all_results();
		$this->db->flush_cache();
		return $count;
	}
	
	
	public function Dropdown($groupsid = 1){
		$this->db->select('id, fullname, nickname, code');
		$this->db->from('customers');
		$this->db->where(array(
			'publish' => 1,
			'trash' => 0,
			'groupsid' => $groupsid,
		));
		$this->db->order_by('fullname asc, id desc');
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		$temp = '';
		$temp[0] = '[Chọn khách hàng]';
		if(isset($result) && is_array($result) && count($result)){
			foreach($result as $key => $val){
				$temp[$val['id']] = $val['fullname'];
			}
		}
		return $temp;
	}
	
	public function CountAllPay(){
		$this->db->from('customers_payment');
		$method = $this->input->get('method');
		if($method > 0){
			$this->db->where(array('trash' => $method));
		}
		$result = $this->db->count_all_results();
		$this->db->flush_cache();
		return $result;
	}

	public function ReadAllPay($start = 0, $limit = 0){
		$this->db->select('customers_payment.*, (SELECT fullname FROM customers WHERE customers.id = customers_payment.customersid  ) as group_title');
		$this->db->from('customers_payment');
		$method = $this->input->get('method');
		if($method > 0){
			$this->db->where(array('trash' => $method));
		}
		$this->db->order_by('id DESC');
		$this->db->limit($limit, $start);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}

	public function CountAllTraCuu(){
		$this->db->from('customers_tracuu');
		$method = $this->input->get('method');
		if($method > 0){
			$this->db->where(array('trash' => $method));
		}
		$result = $this->db->count_all_results();
		$this->db->flush_cache();
		return $result;
	}

	public function ReadAllTraCuu($start = 0, $limit = 0){
		$this->db->select('customers_tracuu.*, (SELECT fullname FROM customers WHERE customers.id = customers_tracuu.customersid  ) as customers_title,  (SELECT fullname FROM customers WHERE customers.id = customers_tracuu.doctorid  ) as doctor_title');
		$this->db->from('customers_tracuu');
		$method = $this->input->get('method');
		if($method > 0){
			$this->db->where(array('trash' => $method));
		}
		$this->db->order_by('id DESC');
		$this->db->limit($limit, $start);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}

	public function ReadByFieldPay($field = 'id', $value = 0){
		$this->db->select('customers_payment.*, customers.fullname');
		$this->db->from('customers_payment');
		$this->db->join('customers', 'customers_payment.customersid = customers.id');
		$this->db->where(array($field => $value))->limit(1, 0);
		$result = $this->db->get()->row_array();
		$this->db->flush_cache();
		return $result;
	}
	public function UpdateByPostPay($field = 'id', $value = 0, $user = ''){
		$data = array(
			'note_admin' => $this->input->post('note_admin'),
			'user_update' => $user['id'],
			'status' => $this->input->post('status'),
			'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600),
		);
		$this->db->where(array($field => $value))->update('customers_payment', $data);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}
	public function DeleteByFieldPay($field = 'id', $value = 0){
		$this->db->where(array($field => $value))->delete('customers_payment');
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}

}
