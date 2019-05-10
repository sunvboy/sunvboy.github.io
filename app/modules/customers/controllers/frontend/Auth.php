<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends FC_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model(array('FrontendCustomers_Model', 'projects/BackendProjects_Model'));
		$this->fc_lang = $this->config->item('fc_lang');
		$this->load->library(array('ConfigBie'));
		$this->fcCustomer = $this->config->item('fcCustomer');
		$this->load->library('google');
		$this->load->library('facebook');
		$this->config->load('google_config');
	}

	public function Login(){
		if (isset($this->fcCustomer) && is_array($this->fcCustomer) && count($this->fcCustomer)) {
			$this->session->set_flashdata('message-danger', 'Bạn đã đăng nhập');
			redirect(base_url());
		}
		// Đăng ký tài khoản
		if ($this->input->post('register')) {
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');
			$this->form_validation->set_rules('fullname', 'Tên đầy đủ', 'trim|required');
			$this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required');
			$this->form_validation->set_rules('phone', 'Điện thoại', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback__Email');
			$this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'trim|required|matches[password]');
			if ($this->form_validation->run($this)){
				$salt = random();
				$password = password_encode($this->input->post('password'), $salt);
				$_insert = array(
					'email' => $this->input->post('email'),
					'password' => $password,
					'salt' => $salt,
					'publish' => 1,
					'fullname' => $this->input->post('fullname'),
					'phone' => $this->input->post('phone'),
					'skype' => $this->input->post('skype'),
					'cityid' => $this->input->post('cityid'),
					'sex' => $this->input->post('sex'),
					'subjects' => $this->input->post('subjects'),
					'address' => $this->input->post('address'),
					'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
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
						$this->session->set_flashdata('message-success', 'Đăng ký tài khoản thành công, một email đã được gửi đến địa chỉ email bạn đăng ký. Vui lòng kiểm tra và xác nhận!.');
						redirect(base_url());
					}else{
						$this->session->set_flashdata('message-danger', $error);
						redirect('members/login');
					}
				}
			}
		}
		// Đăng nhập tk email
		if ($this->input->post('login')) {
			$email = $this->input->post('email_log');
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');
			$this->form_validation->set_rules('email_log', 'Email đăng nhập', 'trim|required');
			$this->form_validation->set_rules('password_log', 'Mật khẩu', 'trim|required|callback__AuthLogin');
			if($this->form_validation->run($this)){
				$customer = $this->FrontendCustomers_Model->ReadByField('email', $email);
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
						)));
					}
					$this->session->set_flashdata('message-success', 'Đăng nhập thành công');
					redirect(base_url());
				}
				else{
					$this->session->set_flashdata('message-danger', 'Đăng nhập thất bại, Có lỗi xác định xảy ra. Vui lòng liên hệ với BQT, xin cảm ơn!.');
					redirect('members/login');
				}
			}
		}

		$data['google_login_url']=$this->google->get_login_url();
		$data['social'] = $this->facebook->getLoginUrl(array(
            'redirect_uri' => site_url('loginfacebook'), 
            'scope' => array("email") // permissions here
        ));

		$data['meta_title'] = 'Đăng ký, đăng nhập thành viên';
		$data['template'] = 'customers/frontend/auth/login';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}
	
	public function Loginfacebook(){
		$app_path = substr(APPPATH, 0, -4);
  		require($app_path.'/plugins/php-graph-sdk-5.5/src/Facebook/autoload.php');
  		$fb = new Facebook\Facebook([
    		'app_id' => $this->config->item('appId'), // Replace {app-id} with your app id
		    'app_secret' => $this->config->item('secret'),
		    'default_graph_version' => 'v2.2',
		]);
   
 	 	$helper = $fb->getRedirectLoginHelper();
  		$permissions = ['email']; // Optional permissions
  		$loginUrl = $helper->getLoginUrl(base_url('customers/frontend/auth/fbcallback'), $permissions);
  		echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
 	}
 
 	public function fbcallback(){
 		$app_path = substr(APPPATH, 0, -4);
  		require($app_path.'/plugins/php-graph-sdk-5.5/src/Facebook/autoload.php');
  		$fb = new Facebook\Facebook([
		    'app_id' => $this->config->item('appId'), // Replace {app-id} with your app id
		    'app_secret' => $this->config->item('secret'),
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
   			$session_data = array(
				'id' => $this->customer['facebook_id'],
				'email' => $this->customer['email'],
				'type' => 'facebook',
			);
			$this->session->set_userdata('logged_in', $session_data);
   			$this->session->set_flashdata('message-success', 'Đăng nhập thành công');
  		}else{
		   	$data['groupsid'] = 1;
		  	$data['publish'] = 1;
		  	$data['affiliate_id'] = random(12,TRUE);
		   	//Nếu chưa tồn tại thì insert vào trong dataabse sau đó set cookie.
		   	$this->db->insert('customers', $data);
   			$session_data = array(
				'id' => $data['facebook_id'],
				'email' => $data['email'],
				'type' => 'facebook',
			);
			$this->session->set_userdata('logged_in', $session_data);
   			$this->session->set_flashdata('message-success', 'Đăng nhập thành công');
  		}
  		redirect(base_url());
 	}

 	public function Logingoogle(){

		$user=$this->google->validate();

		// $google_client_id 		= '350612453785-gddulta7rcvn423he5sb3pplj78gkhmn.apps.googleusercontent.com';
		// $google_client_secret 	= 'ldljCDWf5v0EbeB0urZ-2UD-';
		// $google_redirect_url 	= BASE_URL.'logingoogle.html'; //path to your script
		// $google_developer_key 	= 'AIzaSyBhdYD31JancbDYVmU35xtDIxfvXTYKxT4';

		$customer = $this->FrontendCustomers_Model->ReadByField('email', $user['email']);
		if (isset($customer) && is_array($customer) && count($customer)) {
			if ($customer['nickname'] == 'google') {
				$customer = $this->FrontendCustomers_Model->ReadByField('email', $user['email']);
				if (isset($customer) && is_array($customer) && count($customer)) {
					$flag = $this->FrontendCustomers_Model->UpdateByField('email', $customer['email'], array(
						'last_login' => gmdate('Y-m-d H:i:s', time() + 7*3600),
						'user_agent' => $_SERVER['HTTP_USER_AGENT'],
						'remote_addr' => $_SERVER['REMOTE_ADDR']
					));
					if($flag > 0){
						$session_data = array(
							'id' => $customer['id'],
							'email' => $customer['email'],
							'fullname' => $customer['fullname'],
							'phone' => $customer['phone'],
							'password' => $customer['password'],
						);
						$this->session->set_userdata('logged_in', $session_data);
						$this->session->set_flashdata('message-success', 'Đăng nhập thành công');
						redirect(base_url());
					}
				}
			}else{
				$this->session->set_flashdata('message-danger', 'Địa chỉ Email đã sử dụng cho thành phần khác');
				redirect('login');
			}
		}
		else
		{
			$salt = random();
			$password = password_encode($user['id'], $salt);
			$_insert = array(
				'email' => $user['email'],
				'password' => $password,
				'salt' => $salt,
				'publish' => 1,
				'fullname' => $user['name'],
				'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
				'phone' => '',
				'groupsid' => 1,
				'avatar' => $user['profile_pic'],
				'nickname' => 'google',
			);
			$this->db->insert('customers', $_insert);
			$resultid = $this->db->insert_id();
			if($resultid > 0){
				$customer = $this->FrontendCustomers_Model->ReadByField('email', $user['email']);
				if (isset($customer) && is_array($customer) && count($customer)) {
					$flag = $this->FrontendCustomers_Model->UpdateByField('email', $customer['email'], array(
						'last_login' => gmdate('Y-m-d H:i:s', time() + 7*3600),
						'user_agent' => $_SERVER['HTTP_USER_AGENT'],
						'remote_addr' => $_SERVER['REMOTE_ADDR']
					));
					if($flag > 0){
						$session_data = array(
							'id' => $customer['id'],
							'email' => $customer['email'],
							'fullname' => $customer['fullname'],
							'phone' => $customer['phone'],
							'password' => $customer['password'],
						);
						$this->session->set_userdata('logged_in', $session_data);
						$this->session->set_flashdata('message-success', 'Đăng nhập thành công');
						redirect(base_url());
					}
				}
			}
		}	
	}

	public function Register(){
		if(isset($this->session->userdata['logged_in'])){
			$this->session->set_flashdata('message-danger', 'Bạn đã đăng nhập');
			redirect(base_url());
		}

		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$re_password = $this->input->post('re_password');
		$phone = $this->input->post('phone');
		$fullname = $this->input->post('fullname');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', ' / ');
		$this->form_validation->set_rules('fullname', 'Tên đầy đủ', 'trim|required');
		$this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required');
		$this->form_validation->set_rules('phone', 'Điện thoại', 'trim|required');
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
				'fullname' => $fullname,
				'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
				'phone' => $phone,
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
					$this->session->set_flashdata('message-success', 'Đăng ký tài khoản thành công, một email đã được gửi đến tài khoản của bạn');
					redirect('register');
				}
				else{
					$this->session->set_flashdata('message-success', $error);
					redirect('register');
				}
			}
		}
		$data['template'] = 'customers/frontend/auth/register';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}
	
	public function Logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
	
	public function Recovery(){
		if(isset($this->session->userdata['logged_in'])){
			$this->session->set_flashdata('message-danger', 'Bạn đã đăng nhập');
			redirect(base_url());
		}
		$email = $this->input->get('email');
		$verify = $this->input->get('verify');
		if(isset($email) && !empty($email) && isset($verify) && !empty($verify)){
			$user = $this->FrontendCustomers_Model->ReadByField('email', $email);
			if(!isset($user) || is_array($user) == FALSE || count($user) == 0){
				$this->session->set_flashdata('message-success', 'Tài khoản không tồn tại');
				redirect('login');
			}
			if($user['verify'] != $verify){
				$this->session->set_flashdata('message-success', 'Mã xác nhận không hợp lệ');
				redirect('login');
			}
			$salt = random();
			$newpassword = random(5, TRUE);
			$password = password_encode($newpassword, $salt);
			$flag = $this->FrontendCustomers_Model->UpdateByField('email', $user['email'], array(
				'verify' => '',
				'salt' => $salt,
				'password' => $password,
			));
			if($flag > 0){
				$this->session->set_flashdata('message-success', 'Mật khẩu mới: <strong>'.$newpassword.'</strong>');
				redirect('login');
			}
		}
		if($this->input->post('recovery')){
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			if ($this->form_validation->run($this)){
				$this->load->library(array('mailbie'));
				$user = $this->FrontendCustomers_Model->ReadByField('email', $this->input->post('email'));
				$verify = random(68, TRUE);
				$this->mailbie->sent(array(
					'to' => $user['email'],
					'cc' => '',
					'subject' => 'Kenh37 - Kênh rao vặt Nghệ An',
					'message' => 'Kenh37.vn nhận được yêu cầu lấy lại mật khẩu của bạn. Bạn vui lòng Click link dưới để lấy mật khẩu mới cho tài khoản của bạn: <br/><a href="'.(site_url('quen-mat-khau').'?email='.$user['email'].'&verify='.$verify).'" style="color:#3b5998;text-decoration:none;font-size:11px" target="_blank">'.(site_url('recovery').'?email='.$user['email'].'&verify='.$verify).'</a>'
					)
				);
				$flag = $this->FrontendCustomers_Model->UpdateByField('email', $user['email'], array(
					'verify' => $verify,
				));
				if($flag > 0){
					$this->session->set_flashdata('message-success', 'Bạn gửi yêu cầu thành công!. Kiểm tra Email để xác nhận');
					redirect('login');
				}
			}
		}
		$data['template'] = 'customers/frontend/auth/recovery';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
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
		$data['template'] = 'customers/frontend/auth/verify';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}

	
	public function _AuthLogin(){
		$account = $this->input->post('email_log');
		$password = $this->input->post('password_log');
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
