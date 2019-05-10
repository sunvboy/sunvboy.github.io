<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Address extends FC_Controller{

	public function __construct(){
		parent::__construct();
		$this->fcUser = $this->config->item('fcUser');
		$this->fclang = $this->config->item('fclang');
		if(!$this->fcUser) redirect('admin/login');
		$this->load->model(array('Backendaddress_Model'));
		$this->load->library('ConfigBie');
	}
	public function sort()
	{
		$data = NULL;
		$post = $this->input->post();
		foreach ($post['order'] as $key => $val) {
			$data[] = array(
				'id' => $key,
				'order' => $val,
			);
		}
		$flag = $this->Backendaddress_Model->UpdateBatchByField($data, 'id');
	}

	public function sort_order()
	{
		$data = NULL;
		$post = $this->input->post();
		foreach ($post['order'] as $key => $val) {
			$data[] = array(
				'id' => $key,
				'order' => $val,
			);
		}
		$flag = $this->Backendaddress_Model->UpdateBatchByField($data, 'id');
	}
}
