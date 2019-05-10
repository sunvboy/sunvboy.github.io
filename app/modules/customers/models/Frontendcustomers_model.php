<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontendCustomers_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function ReadByCustomersParam($param = NULL, $select = 'customers.id, customers.email, customers.fullname, customers.phone, customers.address, customers.created,'){
		$this->db->select($select);
		$this->db->from('customers');
		$this->db->join('customers_groups', 'customers.groupsid = customers_groups.id'); 
		$this->db->where($param)->limit(1, 0);
		$result = $this->db->get()->row_array();
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
	public function CountByALL(){
		$this->db->select('id');
		$this->db->from('customers');
		$this->db->where(array(
			'trash' => 0,
			'publish' => 1,
		));
		$count = $this->db->count_all_results();
		$this->db->flush_cache();
		return $count;
	}

	public function CountReadByFieldArr($field = '', $value = 0){
		$this->db->where(array($field => $value));
		$this->db->select('id');
		$this->db->from('customers_tracuu');
		$this->db->where(array(
			'trash' => 0,
			'publish' => 1,
		));
		$count = $this->db->count_all_results();
		$this->db->flush_cache();
		return $count;
	}
	public function ReadByFieldArrAll($field = '', $value = 0, $start = 0, $limit = 0, $colunm = ''){
		$this->db->where(array($field => $value));
		$this->db->select('customers_tracuu.*, (SELECT fullname FROM customers WHERE customers.id = customers_tracuu.'.$colunm.' ) as fullname, (SELECT code FROM customers WHERE customers.id = customers_tracuu.'.$colunm.' ) as code ');
		$this->db->from('customers_tracuu');
		$this->db->where(array(
			'trash' => 0,
			'publish' => 1,
		));
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

	public function DeleteByFieldTraCuu($field = 'id', $value = 0){
		$this->db->where(array($field => $value))->update('customers_tracuu', array('trash' => 1));
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}

	public function Deletepayment($array = ''){
		$this->db->where($array)->delete('customers_payment');
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}
	public function ReadAllFieldPayment($array = ''){
		$this->db->where($array);
		$this->db->from('customers_payment');
		$this->db->order_by('id DESC');
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}
	public function Createpayment($userid = 0){
		$data = array(
			'customersid' =>$userid,
			'money' => $this->input->post('money'),
			'method' => $this->input->post('method'),
			'bank_name' => $this->input->post('bank_name'),
			'bank_number' => $this->input->post('bank_number'),
			'bank_code' => $this->input->post('bank_code'),
			'company' => $this->input->post('company'),
			'message' => $this->input->post('message'),
			'status' => 0,
			'trash' => 1,
			'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
		);
		$this->db->insert('customers_payment', $data);
		$result = $this->db->affected_rows();
		if($result > 0){
			$result = $this->db->insert_id();
		}
		$this->db->flush_cache();
		return $result;
	}
	public function Createpayment2($value = 0){
		$data = array(
			'customersid' =>$this->input->post('customersid'),
			'money' => $this->input->post('money'),
			'customer_name' => $this->input->post('customer_name'),
			'message' => $this->input->post('message'),
			'status' => 0,
			'trash' => $value,
			'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
		);
		$this->db->insert('customers_payment', $data);
		$result = $this->db->affected_rows();
		if($result > 0){
			$result = $this->db->insert_id();
		}
		$this->db->flush_cache();
		return $result;
	}
	
	public function LoadLotoByday($today = '', $user = ''){
		$this->db->select('*');
		$this->db->from('customers_loto');
		$this->db->where(array(
			'days' => $today,
			'publish' => 1,
			'customers_id' => $user,
		));
		$this->db->order_by('id DESC');
		$this->db->limit(1, 0);
		$result = $this->db->get()->row_array();
		$this->db->flush_cache();
		return $result;
	}

	public function ThongkechotsoByday($today = '', $field = ''){
		$this->db->select(''.$field.', count('.$field.') as total');
		$this->db->from('customers_chotso');
		$this->db->where(array(
			'date' => $today,
		));
		$this->db->group_by(''.$field.'');
		$this->db->order_by('id ASC');

		$this->db->limit(5, 0);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}

	public function LoadChotsoBydayALL($today = ''){
		$this->db->select('customers_chotso.*, customers.fullname, customers.id as id_user');
		$this->db->from('customers_chotso');
		$this->db->join('customers', 'customers_chotso.customers_id = customers.id');
		$this->db->where(array('customers.trash' => 0, 'customers_chotso.date' => $today));
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}

	public function LoadChotsoByday($today = '', $user = ''){
		$this->db->select('*');
		$this->db->from('customers_chotso');
		$this->db->where(array(
			'date' => $today,
			'customers_id' => $user,
		));
		$this->db->order_by('id DESC');
		$this->db->limit(1, 0);
		$result = $this->db->get()->row_array();
		$this->db->flush_cache();
		return $result;
	}


	public function LoadMoney($user = ''){
		$this->db->select('*');
		$this->db->from('customers');
		$this->db->where(array(
			'trash' => 0,
			'publish' => 1,
		));
		$this->db->order_by('id DESC');
		$this->db->limit(1, 0);
		$result = $this->db->get()->row_array();
		$this->db->flush_cache();
		return $result;
	}

	public function UpdateChotso($field ='', $value ='', $param =''){
		$param['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
		$this->db->where(array($field => $value))->update('customers_chotso', $param);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}

	public function Create_Loto($user ='', $diviner ='', $hotgirl ='', $days ='' ){
		$data = array(
			'customers_id' => $user,
			'diviner' => $diviner,
			'hotgirl' => $hotgirl,
			'publish' => 1,
			'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
			'days'	=>	$days,
		);
		$this->db->insert('customers_loto', $data);
		$result = $this->db->affected_rows();
		if($result > 0){
			$result = $this->db->insert_id();
		}
		$this->db->flush_cache();
		return $result;
	}

	public function Create(){
		$salt = random();
		$password = password_encode($this->input->post('password'), $salt);
		$data = array(
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
			'fullname' => $this->input->post('fullname'),
			'address' => $this->input->post('address'),
			'lock' => 1,
			'password' => $password,
			'salt' => $salt,
			'groupsid' => 5,
			'publish' => 1,
			'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
		);
		$this->db->insert('customers', $data);
		$result = $this->db->affected_rows();
		if($result > 0){
			$result = $this->db->insert_id();
		}
		$this->db->flush_cache();
		return $result;
	}

	public function ReadByField($field = 'id', $value = 0){
		$this->db->where(array('trash' => 0));
		$this->db->from('customers');
		$this->db->where(array($field => $value))->limit(1, 0);
		$result = $this->db->get()->row_array();
		$this->db->flush_cache();
		return $result;
	}

	public function ReadByFieldArr($field = 'id', $value = 0){
		$this->db->where(array('trash' => 0));
		$this->db->from('customers');
		$this->db->where(array($field => $value));
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}
	
	public function ReadAllField($start = 0, $limit = 0, $field){
		$this->db->where(array('trash' => 0));
		$this->db->from('customers');
		$this->db->order_by(''.$field.' DESC');
		$this->db->limit($limit, $start);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}

	public function UpdateByField($field = 'id', $value = 0, $param = NULL){
		$this->db->where(array($field => $value))->update('customers', $param);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}
	
	
	public function Location(){
		$this->db->select('id, title');
		$this->db->from('province');
		$this->db->where('parentid', 0);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}
	public function district($cityid = 0){
		$this->db->select('id, title');
		$this->db->from('province');
		$this->db->where('parentid', $cityid);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}
	
	public function CountOrder($customerid = 0){
		$this->db->select('id');
		$this->db->from('payments');
		if(!empty($keyword)){
			$keyword = $this->db->escape_like_str($keyword);
			$this->db->where('(address LIKE \'%'.$keyword.'%\' OR phone LIKE \'%'.$keyword.'%\')');
		}
		$start_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');
		
		if(!empty($start_date) && !empty($end_date)){
			$start_date = explode('/',$start_date);
			$start_date = $start_date[2].'-'.$start_date[1].'-'.$start_date[0].' 00:00:00';
			$end_date = explode('/',$end_date);
			$end_date = $end_date[2].'-'.$end_date[1].'-'.$end_date[0].' 23:59:00';
			
			$this->db->where(array(
				'created >=' => $start_date,
				'created <=' => $end_date,
			));
		}
		$this->db->where(array(
			'trash' => 0,
			'userid_created' => $customerid,
		));
		$count = $this->db->count_all_results();
		$this->db->flush_cache();
		return $count;
	}
	
	public function ReadAllOrder($start = 0, $limit = 0, $customerid = 0){
		$this->db->where(array('trash' => 0));
		$keyword = $this->input->get('keyword');
		$start_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');
		
		if(!empty($start_date) && !empty($end_date)){
			$start_date = explode('/',$start_date);
			$start_date = $start_date[2].'-'.$start_date[1].'-'.$start_date[0].' 00:00:00';
			$end_date = explode('/',$end_date);
			$end_date = $end_date[2].'-'.$end_date[1].'-'.$end_date[0].' 23:59:00';
			
			$this->db->where(array(
				'created >=' => $start_date,
				'created <=' => $end_date,
			));
		}
		if(!empty($keyword)){
			$keyword = $this->db->escape_like_str($keyword);
			$this->db->where('(address LIKE \'%'.$keyword.'%\' OR phone LIKE \'%'.$keyword.'%\')');
		}
		$this->db->from('payments');
		$this->db->order_by('created DESC');
		$this->db->limit($limit, $start);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}
	
	public function ReadDetailOrder($paymentsid = 0, $customer = 0){
		$this->db->select('payments.*, payments_items.productsid, payments_items.quantity, payments_items.price');
		$this->db->where(array('payments.trash' => 0, 'payments.userid_created' => $customer['id'],'payments_items.paymentsid' => $paymentsid));
		$this->db->from('payments');
		$this->db->join('payments_items', 'payments.id = payments_items.paymentsid');
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}

}
