<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends FC_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model(array('FrontendCustomers_Model'));
	}
	public function changecustomers(){
		$id = $this->input->post('id');
		$html = '';
		$customer = $this->FrontendCustomers_Model->ReadByFieldArr('groupsid', $id);
		if (is_array($customer) && isset($customer) && count($customer)) {
			$html = $html.'<option value="0">[-- Danh sách thành viên --]</option>';
			foreach ($customer as $key => $val) {
				$html = $html.'<option value="'.$val['id'].'">'.$val['fullname'].'</option>';
			}
		}else{
			$html = $html.'<option value="0">[-- Danh sách thành viên --]</option>';
		}
		echo json_encode(array('html' => $html));die();
	}
	public function Delete(){
		$error = true;
		$message = '';
		$id = $this->input->post('post');
		if(isset($id) && is_array($id) && count($id)){
			foreach($id as $key => $val){
				$DetailArticles = $this->FrontendCustomers_Model->ReadByFieldTraCuu('id', $val);
				$flag = $this->FrontendCustomers_Model->DeleteByFieldTraCuu('id', $val);
				if($flag > 0){
					$error = false;
					$message = 'Bản ghi đã được xóa thành công';
				}
			}
		}else{
			$message = 'Có lỗi trong quá trình xóa bản ghi, vui lòng kiểm tra lại';
		}
		echo json_encode(array(
			'error' => $error,
			'message' => $message,
		)); die();
	}
	public function Deletepay(){
		$id = $this->input->post('id');
		$trash = $this->input->post('trash');
		$uid = $this->input->post('uid');
		$customer = $this->FrontendCustomers_Model->ReadByField('id', $uid);
		if (is_array($customer) && isset($customer) && count($customer)) {
			$flag = $this->FrontendCustomers_Model->Deletepayment(array(
				'id' => $id, 
				'customersid' => $uid, 
				'status' => 0, 
			));
			if($flag > 0){
				echo json_encode(array(
					'message' => 'Success: Bạn đã xóa thành công bản ghi này!.',
					'flag' => TRUE,
				));die();
			}else{
				echo json_encode(array(
					'message' => 'Error: Bạn không quyền xóa bản ghi này or bản ghi không tồn tại',
					'flag' => false,
				));die();
			}
		}else{
			echo json_encode(array(
				'message' => 'Error: Bạn không quyền xóa bản ghi này',
				'flag' => false,
			));die();
		}
	}

	public function ajax_upload(){
		if (! empty($_FILES)) {

			$config['upload_path'] = './uploads/images/members';
			$config['allowed_types'] = 'gif|jpg|png|mp4|ogv';

			$this->load->library('upload');

			$files = $_FILES;

			$number_of_file = count($_FILES['file']['name']);
			$errors = 0;
			$images_arr = array();
			for ($i=0; $i < $number_of_file ; $i++) { 

				$_FILES['file']['name'] = $files['file']['name'][$i];
				$_FILES['file']['type'] = $files['file']['type'][$i];
				$_FILES['file']['tmp_name'] = $files['file']['tmp_name'][$i];
				$_FILES['file']['error'] = $files['file']['error'][$i];
				$_FILES['file']['size'] = $files['file']['size'][$i];

				$this->upload->initialize($config);

				if (!$this->upload->do_upload('file')) {
					$errors++;
				}
				else
				{
					$extra_info = $_FILES['file']['name'];
		        	$images_arr[] = removeutf8(preg_replace('/\s+/', '_', $extra_info));
				}

			}

			if ($errors > 0) {
				$errors = $errors . 'File(s) cannot be upload';
			}
			else
			{
				$errors = '';
			}

		    $html = '';
		    if(!empty($images_arr)){ 
			    foreach($images_arr as $image_src){ 
		            $html = $html .'<li class="list-group-item mb10" style="width: 80px;">';
		            	$html = $html .'<img src="/uploads/images/members/'.$image_src.'" alt="'.$image_src.'" />';
		            	$html = $html .'<div class="pull-right">';
		            		$html = $html .'<a href="javascript:void(0)" data-file="'.$image_src.'" class="remove-file">';
		            			$html = $html .' <i class="fa fa-close" aria-hidden="true"></i>';
		            		$html = $html .' </a>';
		            	$html = $html .' </div>';
		            	$html = $html .'<input name="avatar" value="/uploads/images/members/'.$image_src.'" type="hidden">';
		            $html = $html .' </li>';
				}
			}
			 // print_r($images_arr);
			echo json_encode(array(
				'error' => $errors,
				'html' => $html,
			));
		}
		elseif ($this->input->post('file_to_remove')) {
			$file_to_remove = $this->input->post('file_to_remove');
			unlink("./uploads/images/members/".$file_to_remove);
		}
		else
		{
			$this->listFile();
		}
	}
	public function Logingoogle(){
		$this->load->library('google');
		$google_client_id 		= '350612453785-gddulta7rcvn423he5sb3pplj78gkhmn.apps.googleusercontent.com';
		$google_client_secret 	= 'ldljCDWf5v0EbeB0urZ-2UD-';
		$google_redirect_url 	= BASE_URL.'members/login.html'; //path to your script
		$google_developer_key 	= 'AIzaSyBhdYD31JancbDYVmU35xtDIxfvXTYKxT4';

		$gClient = new Google();
		$gClient->setApplicationName('Login to Infotivi.com.vn');
		$gClient->setClientId($google_client_id);
		$gClient->setClientSecret($google_client_secret);
		$gClient->setRedirectUri($google_redirect_url);
		$gClient->setDeveloperKey($google_developer_key);

		$google_oauthV2 = new Google_Oauth2Service($gClient);

		//If user wish to log out, we just unset Session variable
		if (isset($_REQUEST['reset']))
		{
		  unset($_SESSION['token']);
		  $gClient->revokeToken();
		  header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL)); //redirect user back to page
		}

		//If code is empty, redirect user to google authentication page for code.
		//Code is required to aquire Access Token from google
		//Once we have access token, assign token to session variable
		//and we can redirect user back to page and login.
		if (isset($_GET['code']))
		{
			$gClient->authenticate($_GET['code']);
			$_SESSION['token'] = $gClient->getAccessToken();
			header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
			return;
		}


		if (isset($_SESSION['token']))
		{
			$gClient->setAccessToken($_SESSION['token']);
		}


		if ($gClient->getAccessToken())
		{
			  //For logged in user, get details from google using access token
			  $user 				= $google_oauthV2->userinfo->get();
			  $user_id 				= $user['id'];
			  $user_name 			= filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
			  $email 				= filter_var($user['email'], FILTER_SANITIZE_EMAIL);
			  // $profile_url 			= filter_var($user['link'], FILTER_VALIDATE_URL);
			  $profile_image_url 	= filter_var($user['picture'], FILTER_VALIDATE_URL);
			  $personMarkup 		= "$email<div><img src='$profile_image_url?sz=50'></div>";
			  $_SESSION['token'] 	= $gClient->getAccessToken();
		}
		else {
			//For Guest user, get google login url
			$authUrl = $gClient->createAuthUrl();
		}

		if(isset($authUrl)) //user is not logged in, show login button
		{
			header("Location: ".$authUrl);
		}
		else // user logged in
		{
			$customer = $this->FrontendCustomers_Model->ReadByField('email', $email);
			if(!isset($customer) || is_array($customer) == FALSE || count($customer) == 0){
				// Lần đầu đăng ký
				$salt = random();
				$password = password_encode($user_id, $salt);
				$_insert = array(
					'email' => $email,
					'password' => $password,
					'salt' => '',
					'publish' => 1,
					'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
					'fullname' => $user_name,
					'groupsid' => 1,
				);
				$this->db->insert('customers', $_insert);
				$resultid = $this->db->insert_id();
				if($resultid > 0){
					$this->session->set_userdata('fc_customer_auth', json_encode(array(
						'id' => $customer['id'],
						'email' => $customer['email'],
						'fullname' => $customer['fullname'],
					)));
					$this->session->set_flashdata('message-success', 'Đăng nhập thành công');
					redirect(base_url());
				}
			}else{
				if ($customer['type'] != 'google') {
					$this->session->set_flashdata('message-danger', 'Email đã được sử dụng cho hình thức đăng ký khác');
					redirect('members/login');
				}else{
					$flag = $this->FrontendCustomers_Model->UpdateByField('email', $customer['email'], array(
						'last_login' => gmdate('Y-m-d H:i:s', time() + 7*3600),
						'user_agent' => $_SERVER['HTTP_USER_AGENT'],
						'remote_addr' => $_SERVER['REMOTE_ADDR']
					));
					if($flag > 0){
						$remember = 1;
						if($remember == 1){
							$this->session->set_userdata('fc_customer_auth', json_encode(array(
								'id' => $customer['id'],
								'email' => $customer['email'],
								'fullname' => $customer['fullname'],
							)));
						}
						$this->session->set_flashdata('message-success', 'Đăng nhập thành công');
						redirect(base_url());
					}
				}
			}
			
		}
	}
	public function Login(){
		$email = $this->input->post('email');
		$type = $this->input->post('type');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', ' / ');
		$this->form_validation->set_rules('email', 'Tên tài khoản', 'trim|required');
		$this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required|callback__AuthLogin');
		if($this->form_validation->run($this)){
			$customer = $this->FrontendCustomers_Model->ReadByField('email', $this->input->post('email'));
			if ($customer['groupsid'] == 1 && $type == 2) {
				$href = site_url('members/list-customers');
			}elseif ($customer['groupsid'] == 2 && $type == 1){
				$href = site_url('members/list-doctor');
			}else{
				echo json_encode(array(
					'message' => 'Có lỗi khi đăng nhập. Vui lòng thao tác lại!',
					'flag' => false,
				));die();
			}
			$flag = $this->FrontendCustomers_Model->UpdateByField('email', $customer['email'], array(
				'last_login' => gmdate('Y-m-d H:i:s', time() + 7*3600),
				'user_agent' => $_SERVER['HTTP_USER_AGENT'],
				'remote_addr' => $_SERVER['REMOTE_ADDR']
			));
			if($flag > 0){
				$remember = 1;
				if($remember == 1){
					$this->session->set_userdata('fc_customer_auth', json_encode(array(
						'id' => $customer['id'],
						'email' => $customer['email'],
						'password' => $customer['password'],
						'fullname' => $customer['fullname'],
						'money' => $customer['money'],
					)) );
				}
				
				echo json_encode(array(
					'message' => 'Đăng nhập thành công',
					'href' => $href,
					'flag' => true,
				));die();
			}
		}else{
			$error = validation_errors();
			echo json_encode(array(
				'message' => $error,
				'flag' => false,
			));die();
		}
		
	}
	
	public function Register(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$re_password = $this->input->post('re_password');
		$fullname = $this->input->post('fullname');
		// $service = $this->input->post('service');
		// $store = $this->input->post('store');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', ' / ');
		
		$this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required');
		$this->form_validation->set_rules('fullname', 'Họ và tên', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback__Email');
		$this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'trim|required|matches[password]');
		if ($this->form_validation->run($this)){
			$salt = random();
			$password = password_encode($password, $salt);
			$_insert = array(
				'email' => $email,
				'password' => $password,
				'salt' => $salt,
				'publish' => 1,
				// 'store' => $store,
				// 'service' => $service,
				'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
				'fullname' => $fullname,
				'groupsid' => 1,
			);
			$this->db->insert('customers', $_insert);
			$resultid = $this->db->insert_id();
			if($resultid > 0){
				$verify = random(68, TRUE);
				$this->load->library(array('mailbie'));
				$this->mailbie->sent(array(
					'to' => $this->input->post('email'),
					'cc' => '',
					'subject' => $this->fcSystem['contact_web'].' - Xác nhận tài khoản',
					'message' => 'Click vào link dưới để xác nhận tài khoản của bạn: '.'<br>'.'<a href="'.BASE_URL.'xac-minh.html?id='.$resultid.'&verify='.$verify.'" style="color:#3b5998;text-decoration:none;font-size:11px" target="_blank">'.(site_url('xac-minh').'?id='.$resultid.'&verify='.$verify).'</a>'
				));
				
				
				
				$flag = $this->FrontendCustomers_Model->UpdateByField('id', $resultid, array(
					'verify' => $verify,
				));
				if($flag > 0){
					$error = validation_errors();
					echo json_encode(array(
						'message' => 'Đăng ký tài khoản thành công, một email đã được gửi đến tài khoản của bạn',
						'flag' => true,
					));die();
				}
				
			}
		}else{
			$error = validation_errors();
			echo json_encode(array(
				'message' => $error,
				'flag' => false,
			));die();
		}
	}
	
	public function Logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
	
	
	public function Verify(){
		$verify = $this->input->get('verify');
		$id = $this->input->get('id');
		if(isset($id) && $id > 0 && isset($verify) && !empty($verify)){
			$customer = $this->FrontendCustomers_Model->ReadByField('customers.id', $id);
			if(!isset($customer) || is_array($customer) == FALSE || count($customer) == 0){
				$this->session->set_flashdata('message-success', 'Tài khoản không tồn tại');
				redirect(base_url());
			}
			if($customer['verify'] != $verify){
				$this->session->set_flashdata('message-success', 'Mã xác nhận không hợp lệ');
				redirect(base_url());
			}
			$flag = $this->FrontendCustomers_Model->UpdateByField('id', $customer['id'], array(
				'verify' => '',
			));
			if($flag > 0){
				$this->session->set_flashdata('message-success', 'Xác minh tài khoản thành công, Bạn đã có thể đăng nhập vào hệ thống sau thông báo này');
				redirect(base_url());
			}
		}
	}

	
	public function _AuthLogin(){
		$account = $this->input->post('email');
		$password = $this->input->post('password');
		$customer = $this->FrontendCustomers_Model->ReadByField('email', $account); // get infor email
		if(!isset($customer) && !is_array($customer) || count($customer) == 0 ){
			$customer = $this->FrontendCustomers_Model->ReadByField('phone', $account); // get infor phone
		}
		
		if(!isset($customer) || is_array($customer) == FALSE || count($customer) == 0){
			$this->form_validation->set_message('_AuthLogin', 'Tài khoản không tồn tại');
			return FALSE;
		}
		if(isset($customer) && $customer['verify'] != ''){
			$this->form_validation->set_message('_AuthLogin', 'Tài khoản chưa được xác minh');
			return FALSE;
		}
		$password_encode = password_encode($password, $customer['salt']);
		if($customer['password'] != $password_encode){
			$this->form_validation->set_message('_AuthLogin', 'Mật khẩu không đúng');
			return FALSE;
		}
		return TRUE;
	}
	
	public function _Email(){
		$email = $this->input->post('email');
		$count = $this->FrontendCustomers_Model->CheckFieldByCondition('email', $email);
		if($count > 0){
			$this->form_validation->set_message('_Email','Email đã tồn tại');
			return false;
		}
		return true;
	}
	
	
	public function _Phone(){
		$phone = $this->input->post('phone');
		$count = $this->FrontendCustomers_Model->CheckFieldByCondition('phone', $phone);
		if($count > 0){
			$this->form_validation->set_message('_Phone','Số điện thoại đã tồn tại');
			return false;
		}
		return true;
	}
	
	public function loaddistrict(){
		$cityid = $this->input->post('cityid');
		$district = $this->FrontendCustomers_Model->district($cityid);
		$str = '';
		$str = $str.'<option value="0">--Chọn Quận huyện--</option>';
		if(isset($district) && is_array($district) && count($district)){
			foreach($district as $key => $val){
				$str = $str.'<option value="'.$val['id'].'">'.$val['title'].'</option>';
			}
		}
		echo $str;die();
	}
	
	public function _EmailCallBack(){
		$email = $this->input->post('email');
		$original_email = $this->input->post('original_email');
		if($email != $original_email){
			$count = $this->FrontendCustomers_Model->CheckFieldByCondition('email', $email);
			if($count > 0){
				$this->form_validation->set_message('_EmailCallBack','Email đã tồn tại');
				return false;
			}
		}
		return true;
	}
	public function __Phone(){
		$phone = $this->input->post('phone');
		$original_phone = $this->input->post('original_phone');
		if($phone != $original_phone){
			$count = $this->FrontendCustomers_Model->CheckFieldByCondition('phone', $phone);
			if($count > 0){
				$this->form_validation->set_message('__Phone','Số điện thoại đã tồn tại');
				return false;
			}
		}
		return true;
	}

}
