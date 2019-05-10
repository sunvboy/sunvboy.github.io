<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends FC_Controller{

	public function __construct(){
		parent::__construct();
		$this->fcCustomer = $this->config->item('fcCustomer');
		if(!isset($this->fcCustomer) || is_array($this->fcCustomer) == FALSE || count($this->fcCustomer) == 0){
			$this->session->set_flashdata('message-danger', 'Bạn chưa đăng nhập');
			redirect(base_url());
		}
		$this->load->model(array('FrontendCustomers_Model'));
		$this->load->library('configbie');
	}

	
	public function Information(){
		if($this->input->post('update')){
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');
			$this->form_validation->set_rules('phone', 'Số điện thoại', 'trim|required');
			if ($this->form_validation->run($this)){
				$data = array(
					'fullname' => $this->input->post('fullname'),
					'phone' => $this->input->post('phone'),
					'bank_account' => $this->input->post('bank_account'),
					'bankcode' => $this->input->post('bankcode'),
					'bank_name' => $this->input->post('bank_name'),
					'address' => $this->input->post('address'),
					'cityid' => $this->input->post('cityid'),
					'districtid' => $this->input->post('districtid'),
				);
				$flag = $this->FrontendCustomers_Model->UpdateByField('id', $this->fcCustomer['id'], $data);
				if($flag > 0){
					$this->session->set_flashdata('message-success', 'Cập nhật thông tin thành công');
					redirect('thong-tin-tai-khoan');
				}
			}
		}
		$data['city'] = $this->FrontendCustomers_Model->Location();
		$data['active'] = 'thong-tin-tai-khoan';
		$data['customer'] = $this->FrontendCustomers_Model->ReadByField('id', $this->fcCustomer['id']);
		$data['meta_title'] = 'Thông tin tài khoản';
		$data['template'] = 'customers/frontend/account/information';
		$this->load->view('customers/manage/layouts/home', isset($data)?$data:NULL);
	}
	
	public function Password(){
		if($this->input->post('save')){
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');
			$this->form_validation->set_rules('password', 'Mật khẩu mới', 'trim|required|min_length[6]|max_length[12]');
			$this->form_validation->set_rules('re_password', 'Xác nhận mật khẩu mới', 'trim|required|min_length[6]|max_length[12]|matches[password]');
			if ($this->form_validation->run($this)){
				$salt = random();
				$password = password_encode($this->input->post('password'), $salt);
				
				$_update = array(
					'salt' => $salt,
					'password' => $password,
				);
				$flag = $this->FrontendCustomers_Model->UpdateByField('id', $this->fcCustomer['id'], $_update);
				if($flag > 0){
					$this->session->set_flashdata('message-success', 'Cập nhật thông tin thành công');
					redirect('thong-tin-tai-khoan');
				}
			}
		}
		$data['meta_title'] = 'Thay đổi mật khẩu';
		$data['template'] = 'customers/frontend/account/password';
		$this->load->view('customers/manage/layouts/home', isset($data)?$data:NULL);
	}
	
	public function Order($page = 1){
		
		$customerid = (int)$this->fcCustomer['id'];
		$config['total_rows'] = $this->FrontendCustomers_Model->CountOrder($customerid);
		$config['base_url'] = 'quan-ly-van-don';
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['prefix'] = 'trang-';
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 8;
			$config['uri_segment'] = 2;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<div class="pagination mb30"><ul class="uk-pagination uk-pagination-right">';
			$config['full_tag_close'] = '</ul></div>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="uk-active"><a>';
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
			$data['OrderList'] = $this->FrontendCustomers_Model->ReadAllorder($page * $config['per_page'], $config['per_page'], $customerid);
		}
		$data['meta_title'] = 'Quản lý vận đơn';
		$data['template'] = 'customers/frontend/account/order';
		$this->load->view('customers/manage/layouts/home', isset($data)?$data:NULL);
	}
	
	public function detail($paymentid = 0){
		$paymentid = (int)$paymentid;
		$data['ListDetail'] = $this->FrontendCustomers_Model->ReadDetailOrder($paymentid, $this->fcCustomer);
		$data['meta_title'] = 'Quản lý vận đơn';
		$data['template'] = 'customers/frontend/account/order_detail';
		$this->load->view('customers/manage/layouts/home', isset($data)?$data:NULL);
	}
	public function google(){
	  	/*
	   		* Configuration and setup Google API
	   	*/
	  	$clientId = '436185409308-5mdtrpoqk3044hoivg0hfu3eg20feauv.apps.googleusercontent.com';
	  	$clientSecret = '5umQA9kH-xpELQKUSiLYX0xH';
	  	$redirectURL = 'http://aromaplaza.vn/customers/manage/manage/google';

	  	//Call Google API
	  	$gClient = new Google_Client();
	  	$gClient->setApplicationName('Login to CodexWorld.com');
	  	$gClient->setClientId($clientId);
	  	$gClient->setClientSecret($clientSecret);
	  	$gClient->setRedirectUri($redirectURL);
	  
	  	if(isset($_GET['code'])){
	   		$gClient->authenticate($_GET['code']);
	   		$_SESSION['token'] = $gClient->getAccessToken();
	   		header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
	  	}
	  	if (isset($_SESSION['token'])) {
	   		$gClient->setAccessToken($_SESSION['token']);
	  	}
	  	if ($gClient->getAccessToken()) {
	   		$gClient->setAccessToken($_SESSION['token']);
	   		$plus = new Google_Service_Plus($gClient);
	   		$person = $plus->people->get('me');
	   		$data['google_id']=$person['id'];
	   		$data['email']=$person['emails'][0]['value'];
	   		$data['fullname']=$person['displayName'];
	   		// $data['link']=$person['url'];
	   		$data['avatar']=substr($person['image']['url'],0,strpos($person['image']['url'],"?sz=50")) . '?sz=800';
	   		$this->customer = $this->FrontendCustomers_Model->ReadByField('google_id', $data['google_id']);
	   		if(isset($this->customer) && is_array($this->customer) && count($this->customer)){
	    		setcookie(CODE.'customer', json_encode(array(
		     		'id' => $this->customer['google_id'],
		     		'email' => $this->customer['email'],
		     		'type' => 'google',
		    	)), time() + (86400 * 30), '/');
		    	$this->session->set_flashdata('message-success', 'Đăng nhập thành công');
	   		}else{
	    		$data['groupsid'] = 1;
	    		$data['publish'] = 1;
	    		//Nếu chưa tồn tại thì insert vào trong dataabse sau đó set cookie.
	    		$this->db->insert('customers', $data);
				setcookie(CODE.'customer', json_encode(array(
	     			'id' => $data['google_id'],
	     			'email' => $data['email'],
	     			'type' => 'google',
	    		)), time() + (86400 * 30), '/');
	    		$this->session->set_flashdata('message-success', 'Đăng nhập thành công');
	   		}
	   		redirect(base_url());
	  	}
	}
	public function Login(){
  		$fb = new Facebook\Facebook([
    		'app_id' => '256408298179364', // Replace {app-id} with your app id
		    'app_secret' => '3f80035865379a6e0f12159d87004921',
		    'default_graph_version' => 'v2.2',
		]);
   
 	 	$helper = $fb->getRedirectLoginHelper();
  		$permissions = ['email']; // Optional permissions
  		$loginUrl = $helper->getLoginUrl(base_url('customers/manage/manage/fbcallback'), $permissions);
  		echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
 	}
 
 	public function fbcallback(){
  		$fb = new Facebook\Facebook([
		    'app_id' => '256408298179364', // Replace {app-id} with your app id
		    'app_secret' => '3f80035865379a6e0f12159d87004921',
		    'default_graph_version' => 'v2.2',
  		]);
  		$helper = $fb->getRedirectLoginHelper();
  		try {
			$accessToken = $helper->getAccessToken();
  		} catch(Facebook\Exceptions\FacebookResponseException $e) {
    		// When Graph returns an error
    		echo 'Graph returned an error: ' . $e->getMessage();
    		exit;
  		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		    // When validation fails or other local issues
		    echo 'Facebook SDK returned an error: ' . $e->getMessage();
		    exit;
  		}
  		try {
		    // Get the Facebook\GraphNodes\GraphUser object for the current user.
		    // If you provided a 'default_access_token', the '{access-token}' is optional.
    		$response = $fb->get('/me?fields=id,name,email,first_name,last_name, picture', $accessToken->getValue());
  			//  print_r($response);
  		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		    // When Graph returns an error
		    echo 'ERROR: Graph ' . $e->getMessage();
		    exit;
  		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		    // When validation fails or other local issues
		    echo 'ERROR: validation fails ' . $e->getMessage();
		    exit;
  		}
  		$me = $response->getGraphUser();
  		$data['facebook_id'] = $me->getProperty('id');
  		$data['fullname'] = $me->getProperty('name');
  		$data['email'] = (($me->getProperty('email') != '') ? $me->getProperty('email') : '');
  		$data['avatar'] = 'http://graph.facebook.com/'.$me->getProperty('id').'/picture?type=square';
  
  
  		$this->customer = $this->FrontendCustomers_Model->ReadByField('facebook_id', $data['facebook_id']);
		// Nếu đã tồn tại facebook_id thì lấy ra thông tin và setcookie
  		if(isset($this->customer) && is_array($this->customer) && count($this->customer)){
   			//Cập nhật nếu chưa có mã affiliate
   			if($this->customer['affiliate_id'] == ''){
    			$_update['affiliate_id'] = random(12,TRUE);
			    $this->db->where('id', $this->customer['id']);
			    $this->db->update('customers', $_update);
   			}
   			setcookie(CODE.'customer', json_encode(array(
			    'id' => $this->customer['facebook_id'],
			    'email' => $this->customer['email'],
			    'type' => 'facebook',
   			)), time() + (86400 * 30), '/');
   			$this->session->set_flashdata('message-success', 'Đăng nhập thành công');
  		}else{
		   	$data['groupsid'] = 1;
		  	$data['publish'] = 1;
		  	$data['affiliate_id'] = random(12,TRUE);
		   	//Nếu chưa tồn tại thì insert vào trong dataabse sau đó set cookie.
		   	$this->db->insert('customers', $data);
   			setcookie(CODE.'customer', json_encode(array(
			    'id' => $data['facebook_id'],
			    'email' => $data['email'],
			    'type' => 'facebook',
   			)), time() + (86400 * 30), '/');
   			$this->session->set_flashdata('message-success', 'Đăng nhập thành công');
  		}
  		redirect(base_url());
 	}
 
 	public function Logout(){
  		$this->fcCustomer = $this->config->item('fcCustomer');
		if(!$this->fcCustomer) redirect(base_url());
		unset($_COOKIE[CODE.'customer']);
		setcookie(CODE.'customer', null, -1, '/');
		redirect(base_url());
	}
}
