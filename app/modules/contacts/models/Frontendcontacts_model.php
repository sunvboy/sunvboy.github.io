<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontendContacts_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function create(){
		$data = array(
			'fullname' => $this->input->post('fullname'),
			'email' => $this->input->post('email'),
			'address' => $this->input->post('address'),
			'phone' => $this->input->post('phone'),
			'message' => $this->input->post('message'),
			'read' => 0,
			'publish' => 1,
			'receiverid' => 1,
			'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
		);
		$this->db->insert('contacts', $data);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}
	
	public function InsertByParam($data =  ''){
		$this->db->insert('contacts', $data);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}
	public function Updatefile($table, $id, $data)
	{
		if (isset($data) && $data != NULL) {
			$this->db->where('id', $id);
			$this->db->update($table, $data);
		}
	}
	
	

}