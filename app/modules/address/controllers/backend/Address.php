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

	public function view($page = 1){
		$page = (int)$page;
		$config['total_rows'] = $this->Backendaddress_Model->countall(0);
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['base_url'] = base_url('address/backend/address/view');
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 10;
			$config['uri_segment'] = 5;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
			$config['full_tag_close'] = '</ul>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['listPagination'] = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$data['listSupport'] = $this->Backendaddress_Model->view(($page * $config['per_page']), $config['per_page'], 0);
		}
		$data['template'] = 'address/backend/address/view';
		$this->load->view('dashboard/backend/layouts/home', isset($data)?$data:NULL);
	}

	public function create(){
		if($this->input->post('create')){
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');
			$this->form_validation->set_rules('title', 'Tên đầy đủ', 'trim|required');
//			$this->form_validation->set_rules('attachs', 'Files', 'trim|required');
			if ($this->form_validation->run()){

				$album = $this->input->post('album');
				$album_data = '';
				if(isset($album['images']) && is_array($album['images'])  && count($album['images'])) {
					foreach ($album['images'] as $key => $val) {
						$album_data[] = array('images' => $val);
					}
				}
				if(isset($album_data) && is_array($album_data)  && count($album_data) && isset($album['title']) && is_array($album['title']) && count($album['title']) && isset($album['description']) && is_array($album['description']) && count($album['description'])) {
					foreach ($album_data as $key => $val) {
						$album_data[$key]['title'] = $album['title'][$key];
						$album_data[$key]['description'] = $album['description'][$key];
					}
				}


				$flag = $this->Backendaddress_Model->create($this->fcUser, $album_data);
				if($flag > 0){
					$this->session->set_flashdata('message-success', 'Thêm  mới thành công');
					redirect('address/backend/address/view');
				}
			}
		}
		$data['template'] = 'address/backend/address/create';
		$this->load->view('dashboard/backend/layouts/home', isset($data)?$data:NULL);
	}

	public function read($id = 0){
		
		$data['Detailaddress'] = $this->Backendaddress_Model->read($id);
		if(!isset($data['Detailaddress']) && !is_array($data['Detailaddress']) && count($data['Detailaddress']) == 0){
			$this->session->set_flashdata('message-danger', ' không tồn tại');
			redirect_custom('address/backend/address/view');
		}
		
		$data['template'] = 'address/backend/address/read';
		$this->load->view('dashboard/backend/layouts/home', isset($data)?$data:NULL);
	}

	public function update($id = 0){
		$id = (int)$id;
		$data['Detailaddress'] = $this->Backendaddress_Model->read($id);
		if(!isset($data['Detailaddress']) && !is_array($data['Detailaddress']) && count($data['Detailaddress']) == 0){
			$this->session->set_flashdata('message-danger', ' không tồn tại');
			redirect_custom('address/backend/address/view');
		}
		if($this->input->post('update')){
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');
			$this->form_validation->set_rules('title', 'Tên đầy đủ', 'trim|required');
//			$this->form_validation->set_rules('attachs', 'Files', 'trim|required');
			if ($this->form_validation->run()){

				$album = $this->input->post('album');
				$album_data = '';
				if(isset($album['images']) && is_array($album['images'])  && count($album['images'])) {
					foreach ($album['images'] as $key => $val) {
						$album_data[] = array('images' => $val);
					}
				}
				if(isset($album_data) && is_array($album_data)  && count($album_data) && isset($album['title']) && is_array($album['title']) && count($album['title']) && isset($album['description']) && is_array($album['description']) && count($album['description'])) {
					foreach ($album_data as $key => $val) {
						$album_data[$key]['title'] = $album['title'][$key];
						$album_data[$key]['description'] = $album['description'][$key];
					}
				}

				$flag = $this->Backendaddress_Model->update($id, $this->fcUser,$album_data);
				if($flag > 0){
					$this->session->set_flashdata('message-success', 'Cập nhật  thành công');
					redirect_custom('address/backend/address/view');
				}
			}
		}
		$data['template'] = 'address/backend/address/update';
		$this->load->view('dashboard/backend/layouts/home', isset($data)?$data:NULL);
	}

	public function delete($id = 0){
		$id = (int)$id;
		$data['Detailaddress'] = $this->Backendaddress_Model->read($id);
		if(!isset($data['Detailaddress']) && !is_array($data['Detailaddress']) && count($data['Detailaddress']) == 0){
			$this->session->set_flashdata('message-danger', ' không tồn tại');
			redirect_custom('address/backend/address/view');
		}
		if($this->input->post('delete')){
			$flag = $this->Backendaddress_Model->delete($id);
			if($flag > 0){
				$this->session->set_flashdata('message-success', 'Xóa  thành công');
				redirect('address/backend/address/view');
			}
		}
		$data['template'] = 'address/backend/address/delete';
		$this->load->view('dashboard/backend/layouts/home', isset($data)?$data:NULL);
	}
	public function set($type = NULL, $id = 0){
		$redirect = $this->input->get('redirect');
		$id = (int)$id;
		$data['articles'] = $this->Backendaddress_Model->read($id);
		$temp[$type] = (($data['articles'][$type] == 1)?0:1);
		$temp['userid_updated'] = $this->fcUser['id'];
		$temp['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
		$this->db->where('id', $id);
		$this->db->update('address', $temp);
		redirect((!empty($redirect)) ? $redirect : 'address/backend/catalogues/view');
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
}
