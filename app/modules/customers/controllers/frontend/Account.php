<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends FC_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model(array(
			'FrontendCustomers_Model', 
			'projects/BackendProjects_Model', 
			'attributes/BackendAttributes_Model',
			'projects/FrontendProjects_Model',
			'tags/BackendTags_Model'
		));
		$this->load->library(array('ConfigBie'));
		$this->fc_lang = $this->config->item('fc_lang');
		$this->fcCustomer = $this->config->item('fcCustomer');
	}
	public function listview($page = 1){
		// Khách hàng
		$page = (int)$page;
		if (!isset($this->fcCustomer) && !is_array($this->fcCustomer) && count($this->fcCustomer) == 0) {
			$this->session->set_flashdata('message-danger', 'Vui lòng đăng nhập');
			redirect(BASE_URL);
		}
		$data['DetailUsers'] = $this->FrontendCustomers_Model->ReadByField('id', $this->fcCustomer['id']);

		$config['total_rows'] = $this->FrontendCustomers_Model->CountReadByFieldArr('customersid', $this->fcCustomer['id']);

		$config['base_url'] = rewrite_url('members/list-customers', '','', '', FALSE, TRUE);
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['prefix'] = 'trang-';
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 10;
			$config['uri_segment'] = 3;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<div class="pagination" itemscope itemtype="http://schema.org/SiteNavigationElement/Pagination"><ul class="uk-pagination uk-pagination-left">';
			$config['full_tag_close'] = '</ul></div>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="uk-active"><a itemprop="relatedLink/pagination">';
			$config['cur_tag_close'] = '</a></li>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['PaginationList'] = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$seoPage = ($page >= 2)?(' - Trang '.$page):'';
			if($page >= 2){
				$data['canonical'] = $config['base_url'].'/trang-'.$page.$this->config->item('url_suffix');
			}
			$page = $page - 1;
			$data['List'] = $this->FrontendCustomers_Model->ReadByFieldArrAll('customersid', $this->fcCustomer['id'], ($page * $config['per_page']), $config['per_page'], 'doctorid');
		}
		$data['meta_title'] = 'Khách hàng - '.$data['DetailUsers']['fullname'];
		$data['meta_keywords'] = $this->fcSystem['seo_meta_keywords'];
		$data['meta_description'] = $this->fcSystem['seo_meta_description'];
		$data['template'] = 'customers/frontend/account/listview';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}
	public function listview2($page = 1){
		// Đơn vị gửi mẫu
		$page = (int)$page;
		if (!isset($this->fcCustomer) && !is_array($this->fcCustomer) && count($this->fcCustomer) == 0) {
			$this->session->set_flashdata('message-danger', 'Vui lòng đăng nhập');
			redirect(BASE_URL);
		}
		$data['DetailUsers'] = $this->FrontendCustomers_Model->ReadByField('id', $this->fcCustomer['id']);

		$config['total_rows'] = $this->FrontendCustomers_Model->CountReadByFieldArr('doctorid', $this->fcCustomer['id']); 

		$config['base_url'] = rewrite_url('members/list-doctor', '','', '', FALSE, TRUE);
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['prefix'] = 'trang-';
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 10;
			$config['uri_segment'] = 3;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<div class="pagination" itemscope itemtype="http://schema.org/SiteNavigationElement/Pagination"><ul class="uk-pagination uk-pagination-left">';
			$config['full_tag_close'] = '</ul></div>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="uk-active"><a itemprop="relatedLink/pagination">';
			$config['cur_tag_close'] = '</a></li>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['PaginationList'] = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$seoPage = ($page >= 2)?(' - Trang '.$page):'';
			if($page >= 2){
				$data['canonical'] = $config['base_url'].'/trang-'.$page.$this->config->item('url_suffix');
			}
			$page = $page - 1;
			$data['List'] = $this->FrontendCustomers_Model->ReadByFieldArrAll('doctorid', $this->fcCustomer['id'], ($page * $config['per_page']), $config['per_page'], 'customersid');
		}

		$data['meta_title'] = 'Đơn vị gửi mẫu - '.$data['DetailUsers']['fullname'];
		$data['meta_keywords'] = $this->fcSystem['seo_meta_keywords'];
		$data['meta_description'] = $this->fcSystem['seo_meta_description'];
		$data['template'] = 'customers/frontend/account/listview2';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}

	public function Detail($id = 0){
		$id = (int)$id;
		if (!isset($this->fcCustomer) && !is_array($this->fcCustomer) && count($this->fcCustomer) == 0) {
			$this->session->set_flashdata('message-danger', 'Vui lòng đăng nhập');
			redirect(BASE_URL);
		}
		$data['DetailUsers'] = $this->FrontendCustomers_Model->ReadByField('id', $this->fcCustomer['id']);
		$data['DetailTracuu'] = $this->FrontendCustomers_Model->ReadByFieldTraCuu('id', $id);
		if(!isset($data['DetailTracuu']) && !is_array($data['DetailTracuu']) && count($data['DetailTracuu']) == 0){
			$this->session->set_flashdata('message-danger', 'Bản ghi không tồn tại');
			redirect('list-customers');
		}

		$data['meta_title'] = 'Chi tiết biểu mẫu '.$data['DetailTracuu']['date'].' - '.$data['DetailUsers']['fullname'];
		$data['meta_keywords'] = $this->fcSystem['seo_meta_keywords'];
		$data['meta_description'] = $this->fcSystem['seo_meta_description'];
		$data['template'] = 'customers/frontend/account/detail';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}
	public function Information(){
		$this->load->library(array('ConfigBie'));
		if (isset($this->fcCustomer) && is_array($this->fcCustomer) && count($this->fcCustomer)) {
			$data['location_dropdown'] = $this->BackendProjects_Model->location_dropdown(array(
				'where' => array('parentid' => 0)
			));
			$data['DetailUsers'] = $this->FrontendCustomers_Model->ReadByField('id', $this->fcCustomer['id']);

			if($this->input->post('update')){
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('', ' / ');
				$this->form_validation->set_rules('fullname', 'Tên đầy đủ', 'trim|required');
				$avatar = $this->input->post('avatar');
				if ($avatar != '' && $avatar != $data['DetailUsers']['avatar']) {
					unlink(".".$data['DetailUsers']['avatar']);
				}
				if ($this->form_validation->run($this)){
					$flag = $this->FrontendCustomers_Model->UpdateByField('email', $data['DetailUsers']['email'], array(
						'fullname' => $this->input->post('fullname'),
						'address' => $this->input->post('address'),
						'phone' => $this->input->post('phone'),
						'avatar' => $this->input->post('avatar'),
						'description' => $this->input->post('description'),
						'sex' => $this->input->post('sex'),
						'subjects' => $this->input->post('subjects'),
						'cityid' => $this->input->post('cityid'),
						'skype' => $this->input->post('skype'),
						'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600),
					));
					if($flag > 0){
						$this->session->set_flashdata('message-success', 'Cập nhật hồ sơ thành công');
						redirect('members/profile');
					}
				}
			}
			$data['meta_title'] = 'Hồ sơ: '.$data['DetailUsers']['fullname'];
			$data['meta_keywords'] = $this->fcSystem['seo_meta_keywords'];
			$data['meta_description'] = $this->fcSystem['seo_meta_description'];
			$data['template'] = 'customers/frontend/account/information';
			$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
		}
		else
		{
			$this->session->set_flashdata('message-danger', 'Vui lòng đăng nhập');
			redirect(BASE_URL);
		}
	}

	public function Password(){
		if (!isset($this->fcCustomer) && !is_array($this->fcCustomer) && count($this->fcCustomer) == 0) {
			$this->session->set_flashdata('message-danger', 'Vui lòng đăng nhập');
			redirect(BASE_URL);
		}
		$data['DetailUsers'] = $this->FrontendCustomers_Model->ReadByField('id', $this->fcCustomer['id']);
		if($this->input->post('update')){
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');
			$this->form_validation->set_rules('newpassword', 'Mật khẩu mới', 'trim|required');
			$this->form_validation->set_rules('renewpassword', 'Xác nhận mật khẩu mới', 'trim|required|matches[newpassword]');			
			if ($this->form_validation->run($this)){
				$salt = random();
				$password = password_encode($this->input->post('newpassword'), $salt);
				$flag = $this->FrontendCustomers_Model->UpdateByField('email', $this->fcCustomer['email'], array(
					'password' => $password,
					'salt' => $salt,
					'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600),
				));
				if($flag > 0){
					$this->session->set_flashdata('message-success', 'Thay đổi mật khẩu thành công, bạn cần đăng nhập lại');
					redirect('members/login');
				}
			}
		}
		$data['meta_title'] = 'Đổi mật khẩu';
		$data['meta_keywords'] = $this->fcSystem['seo_meta_keywords'];
		$data['meta_description'] = $this->fcSystem['seo_meta_description'];
		$data['template'] = 'customers/frontend/account/password';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}
	
	public function orderlist($page = 1){
		$this->load->library(array('projects/ConfigBie'));
		$page = (int)$page;
		if (!isset($this->fcCustomer) && !is_array($this->fcCustomer) && count($this->fcCustomer) == 0) {
			$this->session->set_flashdata('message-danger', 'Vui lòng đăng nhập');
			redirect(BASE_URL);
		}
		$data['Data_arr'] = $this->load->library(array('projects/ConfigBie'));
		$data['DetailUsers'] = $this->FrontendCustomers_Model->ReadByField('id', $this->fcCustomer['id']);

		$config['total_rows'] = $this->FrontendProjects_Model->CountReadByFieldArr('userid_created', $this->fcCustomer['id']);
		$config['base_url'] = rewrite_url('members/list-post', '','', '', FALSE, TRUE);
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['prefix'] = 'trang-';
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 10;
			$config['uri_segment'] = 3;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<div class="pagination" itemscope itemtype="http://schema.org/SiteNavigationElement/Pagination"><ul class="uk-pagination uk-pagination-left">';
			$config['full_tag_close'] = '</ul></div>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="uk-active"><a itemprop="relatedLink/pagination">';
			$config['cur_tag_close'] = '</a></li>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['PaginationList'] = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$seoPage = ($page >= 2)?(' - Trang '.$page):'';
			if($page >= 2){
				$data['canonical'] = $config['base_url'].'/trang-'.$page.$this->config->item('url_suffix');
			}
			$page = $page - 1;
			$data['OrderList'] = $this->FrontendProjects_Model->ReadByFieldArr('userid_created', $this->fcCustomer['id'], ($page * $config['per_page']), $config['per_page']);

		}


		

		$data['meta_title'] = 'Quản lý tin đăng';
		$data['meta_keywords'] = $this->fcSystem['seo_meta_keywords'];
		$data['meta_description'] = $this->fcSystem['seo_meta_description'];
		$data['template'] = 'customers/frontend/account/list_post';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
		
	}
	public function Edit($id = 0){
		// echo $id;die;
		$this->load->library(array('projects/ConfigBie'));
		if (!isset($this->fcCustomer) && !is_array($this->fcCustomer) && count($this->fcCustomer) == 0) {
			$this->session->set_flashdata('message-danger', 'Bạn phải đăng nhập để sử dụng tính năng này!');
			redirect('login');
		}
		$data['DetailUsers'] = $this->FrontendCustomers_Model->ReadByField('id', $this->fcCustomer['id']);
		$DetailProjects = $this->FrontendProjects_Model->ReadByFieldArrCus(array('id'=> $id, 'userid_created' => $this->fcCustomer['id']));
		if(!isset($DetailProjects) && !is_array($DetailProjects) && count($DetailProjects) == 0){
			$this->session->set_flashdata('message-danger', 'Tin đăng không tồn tại');
			redirect('members/list-post');
		}
		if($this->input->post('update')){
			$data['cityPost'] = $this->input->post('cityid');
			$attr = $this->input->post('attr');
			$data['catalogue'] = $this->input->post('catalogue'); // mảng danh mục
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');
			$this->form_validation->set_rules('title', 'Tiêu đề đăng bài', 'trim|required');
			$this->form_validation->set_rules('catalogue', 'Loại bất động sản', 'trim|callback__Catalogue');
			$this->form_validation->set_rules('description','Thông tin liên hệ', 'trim|required');
			$this->form_validation->set_rules('content', 'Nội dung', 'trim|required');
			if ($this->form_validation->run($this)){
				$album = $this->input->post('album');
				$album_data = '';
				$images_ = '';
				if(isset($album['images']) && is_array($album['images'])  && count($album['images'])) {
					foreach ($album['images'] as $key => $val) {
						if ($key == 0) { $images_ = $val; }
						$album_data[] = array('images' => $val); 
					}
				}
				if(isset($album_data) && is_array($album_data)  && count($album_data) && isset($album['title']) && is_array($album['title']) && count($album['title']) && isset($album['description']) && is_array($album['description']) && count($album['description'])) {
					foreach ($album_data as $key => $val) {
						$album_data[$key]['title'] = $album['title'][$key];
						$album_data[$key]['description'] = $album['description'][$key];
					}
				}

				$resultid = $this->FrontendProjects_Model->Update($this->fcCustomer['id'], $data['catalogue'], $album_data, $images_, 'id', $id);
				if($resultid > 0){
					$temp = '';
					foreach($data['catalogue'] as $key => $val){
						$temp[] = array(
							'modules' => 'projects',
							'modulesid' => $resultid,
							'cataloguesid' => $val,
							'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
						);
					}
					$this->BackendProjects_Model->create_batch(array('data' => $temp,'table' => 'catalogues_relationship'));
					$this->BackendAttributes_Model->InsertAttr($resultid, $attr);
					$this->session->set_flashdata('message-success', 'Cập nhật bài đăng thành công!');
					redirect('members/list-post');
				}
			}
		}
		$data['DetailProjects'] = $DetailProjects;
		$data['DetailCatalogues'] = $this->FrontendProjectsCatalogues_Model->ReadByCondition(array('select' => 'id, title, parentid, slug, canonical, images, lft, rgt','where' => array('trash' => 0,'publish' => 1), 'order_by' => 'order asc, id asc'));

		$data['meta_title'] = 'Đăng tin bất động sản';
		$data['meta_keyword'] = '';
		$data['meta_description'] = '';
		$data['meta_images'] = '';
		$data['canonical'] = 'members/list-post';
		$data['template'] = 'customers/frontend/account/edit_post';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}
	public function Delete($id = 0){
		if (!isset($this->fcCustomer) && !is_array($this->fcCustomer) && count($this->fcCustomer) == 0) {
			$this->session->set_flashdata('message-danger', 'Bạn phải đăng nhập để sử dụng tính năng này!');
			redirect('login');
		}
		$data['DetailUsers'] = $this->FrontendCustomers_Model->ReadByField('id', $this->fcCustomer['id']);
		$DetailProjects = $this->FrontendProjects_Model->ReadByFieldArrCus(array('id'=> $id, 'userid_created' => $this->fcCustomer['id']));
		if(!isset($DetailProjects) && !is_array($DetailProjects) && count($DetailProjects) == 0){
			$this->session->set_flashdata('message-danger', 'Tin đăng không tồn tại');
			redirect('members/list-post');
		}
		if($this->input->post('delete')){
			$flag = $this->BackendProjects_Model->DeleteByField('id', $id);
			if($flag > 0){
				if(!empty($DetailProjects['canonical'])){
					$this->BackendRouters_Model->Delete($DetailProjects['canonical'], 'projects/frontend/projects/view', $DetailProjects['id'], 'number');
				}
				$this->BackendProjects_Model->_delete_relationship('projects', $id);
				$this->BackendTags_Model->DeleteByModule($id, 'projects');
				if ($DetailProjects['filterid'] != 0) {
					$this->BackendProjects_Model->delete_attribute($id);
				}
				$this->session->set_flashdata('message-success', 'Xóa dự án thành công');
				redirect('members/list-post');
			}
		}

		$data['DetailProjects'] = $DetailProjects;
		$data['DetailCatalogues'] = $this->FrontendProjectsCatalogues_Model->ReadByCondition(array('select' => 'id, title, parentid, slug, canonical, images, lft, rgt','where' => array('trash' => 0,'publish' => 1), 'order_by' => 'order asc, id asc'));
		$data['meta_title'] = 'Đăng tin bất động sản';
		$data['meta_keyword'] = '';
		$data['meta_description'] = '';
		$data['meta_images'] = '';
		$data['canonical'] = 'members/delete-post';
		$data['template'] = 'customers/frontend/account/delete_post';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}
	public function _Information(){
		$email = $this->input->post('email');
		$old_email = $this->input->post('old_email');
		if($old_email != $email){
			$user = $this->FrontendCustomers_Model->ReadByField('email', $email);
			if(isset($user) && is_array($user) && count($user)){
				$this->form_validation->set_message('_Information', 'Email đã tồn tại');
				return FALSE;
			}
			return TRUE;
		}
		return TRUE;
	}
	public function _Catalogue() {
		$catalogue = $this->input->post('catalogue');
		if(!isset($catalogue) || count($catalogue) == 0 || !is_array($catalogue)) {
			$this->form_validation->set_message('_Catalogue','Danh mục cha trường bắt buộc');
			return FALSE;
		}
		return TRUE;
	}
}
