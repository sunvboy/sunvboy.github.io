<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontendmailsubricre_Model extends FC_Model{

	public function __construct(){
		parent::__construct();
	}

	public function create_cart($data = ''){
		$this->db->insert('payments', $data);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}
	public function create($data = ''){
		$this->db->insert('mailsubricre', $data);
		$result = $this->db->affected_rows();
		if($result > 0){
			$objectid = $this->db->insert_id();
			$this->db->flush_cache();
		}
		return $objectid;
	}
	public function createcontact($data = ''){
		$this->db->insert('mailsubricre', $data);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}
	public function ReadByField($array= ''){
		$this->db->where(array('trash' => 0, 'publish' => 1));
		$this->db->from('mailsubricre');
		$this->db->where($array)->order_by('id desc')->limit(1, 0);
		$result = $this->db->get()->row_array();
		$this->db->flush_cache();
		return $result;
	}
	public function ReadByFieldAddress($param = ''){
		$this->db->where(array('trash' => 0,'publish' => 1,'created <=' => gmdate('Y-m-d H:i:s', time() + 7*3600)));
		$this->db->from('address');
		$this->db->where($param)->limit(1, 0);
		$result = $this->db->get()->row_array();
		$this->db->flush_cache();
		return $result;
	}
	public function ReadByCondition($param = ''){
		$param['select'] = ((isset($param['select'])) ? $param['select'] : 'id, title, fullname, phone,email');
		$param['where'] = ((isset($param['where'])) ? $param['where'] : '');
		$param['order_by'] = ((isset($param['order_by'])) ? $param['order_by'] : 'id desc');
		$param['limit'] = ((isset($param['limit'])) ? $param['limit'] : 5);
		
		$this->db->select($param['select']);
		$this->db->from('mailsubricre');
		$this->db->where($param['where']);
		$this->db->limit($param['limit'], 0);
		$this->db->order_by($param['order_by']);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}
	
}
