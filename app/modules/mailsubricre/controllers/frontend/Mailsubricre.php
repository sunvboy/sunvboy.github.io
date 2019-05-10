<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mailsubricre extends FC_Controller{

	public function __construct(){
		parent::__construct();

		$this->load->model(array(
			'Frontendmailsubricre_Model'
		));
	}

	public function create(){
		$alert = array(
			'error' => '',
			'message' => '',
			'result' => ''
		);
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '&nbsp/&nbsp');
		$this->form_validation->set_rules('fullname', 'Họ và tên', 'trim|required');
		$this->form_validation->set_rules('phone', 'Số điện thoại', 'trim|required');
//		$this->form_validation->set_rules('time', 'Giờ đặt bàn', 'trim|required');
//		$this->form_validation->set_rules('date', 'Ngày đặt bàn', 'trim|required');
//		$this->form_validation->set_rules('person', 'Số khách(Người lớn)', 'trim|required');
//		$this->form_validation->set_rules('child', 'Số khách(Trẻ em)', 'trim|required');
//		$this->form_validation->set_rules('title', 'Nhà hàng trong hệ thống', 'trim|required');


		if ($this->form_validation->run($this)){
			$att = '';
			$data = array(
				'publish' => 0,
				'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
			);
			$post = $this->input->post('post');
			if(isset($post) && is_array($post)  && count($post)) {
				foreach ($post as $key => $val) {
					$att[$val['name']] = nl2br($val['value']);
				}
				foreach ($data as $key => $val) {
					$att[$key] = $val;
				}
			}
			$flag = $this->Frontendmailsubricre_Model->create($att);
//			$this->load->library(array('mailbie'));
//			$this->mailbie->sent(array(
//				'to' => $att['title'],
//				'cc' => '',
//				'subject' => 'Bạn nhận được email từ hệ thống website: '.$this->fcSystem['contact_web'],
//				'message' => mail_html_email(array(
//					'header' => 'Thông tin đặt bàn',
//					'fullname' => $att['fullname'],
//					'phone' => $att['phone'],
//					'time' => $att['time'],
//					'date' => $att['date'],
//					'person' => $att['person'],
//					'child' => $att['child'],
//					'title' => $att['title'],
//					'message' => $att['message'],
//				))
//			));
		}else{
			$alert['error'] = validation_errors();
		}
		echo json_encode($alert); die();
	}
	public function formlx(){
		$alert = array(
			'error' => '',
			'message' => '',
			'result' => ''
		);
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '&nbsp/&nbsp');
		$this->form_validation->set_rules('tuoi', 'Tuổi', 'trim|required');
		$this->form_validation->set_rules('cannang', 'Cân nặng', 'trim|required');


		if ($this->form_validation->run($this)){
			$att = '';
			$data = array(
				'publish' => 0,
				'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
			);
			$post = $this->input->post('post');
			if(isset($post) && is_array($post)  && count($post)) {
				foreach ($post as $key => $val) {
					$att[$val['name']] = nl2br($val['value']);
				}
				foreach ($data as $key => $val) {
					$att[$key] = $val;
				}
			}


			$address = $this->Frontendmailsubricre_Model->ReadByFieldAddress(array('title'=>$att['tuoi'],'phone'=>$att['cannang']));
			if(is_array($address) && count($address) && isset($address)){
				$return = 'Tỉ lệ loãng xương là: '.$address['size'];
			}else{
				$return = 'Dữ liệu đang được cập nhập';
			}
			//echo $this->db->last_query();die;
			//var_dump($address);die;



			$alert['message'] = $return;
		}else{
			$alert['error'] = validation_errors();

		}
		echo json_encode($alert); die();
	}

	public function createguiyeucau(){
		$alert = array(
			'error' => '',
			'message' => '',
			'result' => ''
		);
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', ' / ');
		$this->form_validation->set_rules('quantiny', 'Số lượng', 'trim|required');
		$this->form_validation->set_rules('fullname', $this->lang->line('fullname_customers'), 'trim|required');
//		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', $this->lang->line('phone_customers'), 'trim|required');
//		$this->form_validation->set_rules('title', 'Tiêu đề câu hỏi', 'trim|required');
//		$this->form_validation->set_rules('message', 'Chi tiết câu hỏi', 'trim|required');

		if ($this->form_validation->run($this)){
			$att = '';
			$data = array(
				'publish' => 0,
				'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
			);
			$post = $this->input->post('post');
			if(isset($post) && is_array($post)  && count($post)) {
				foreach ($post as $key => $val) {
					$att[$val['name']] = nl2br($val['value']);
				}
				foreach ($data as $key => $val) {
					$att[$key] = $val;
				}
			}
			$flag = $this->Frontendmailsubricre_Model->create($att);
			$this->load->library(array('mailbie'));
			$this->mailbie->sent(array(
				'to' => $att['title'],
				'cc' => '',
				'subject' => 'Bạn nhận được email từ hệ thống website: '.$this->fcSystem['contact_web'],
				'message' => mail_html_voucher(array(
					'header' => 'Thông tin đặt Voucher',
					'quantiny' => $att['quantiny'],
					'product' => $att['product'],
					'fullname' => $att['fullname'],
					'phone' => $att['phone'],
					'email' => $att['email'],
					'address' => $att['address'],
					'title' => $att['title'],
					'message' => $att['message'],
				))
			));
		}else{
			$alert['error'] = validation_errors();
		}
		echo json_encode($alert); die();
	}


	public function cartorder(){
		$alert = array(
			'error' => '',
			'message' => '',
			'result' => ''
		);
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', ' / ');
		$this->form_validation->set_rules('fullname', 'Họ và tên', 'trim|required');
		$this->form_validation->set_rules('phone', 'Số điện thoại', 'trim|required');
		$this->form_validation->set_rules('address', 'Địa chỉ', 'trim|required');
		$this->form_validation->set_rules('quantity', 'Số lượng đặt', 'trim|required');
//		$this->form_validation->set_rules('message', 'Ghi chú', 'trim|required');
		if ($this->form_validation->run($this)){
			$att = '';
			$data = array(
				'publish' => 0,
				'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
			);
			$post = $this->input->post('post');
			if(isset($post) && is_array($post)  && count($post)) {
				foreach ($post as $key => $val) {
					$att[$val['name']] = nl2br($val['value']);
				}
				foreach ($data as $key => $val) {
					$att[$key] = $val;
				}
			}
			$_paymentid = $this->Autoload_Model->_create(array(
				'table' => 'payments',
				'data' => array(
					'type' => 'cart',
					'fullname' => $att['fullname'],
					'phone' => $att['phone'],
					'address' => $att['address'],
					'message' => $att['message'],
					'quantity' => $att['quantity'],
					'total_price' => $att['quantity']*$this->fcSystem['sanpham_saleoff'],
					'publish' => 1,
					'status' => 'wait',
					'send' => 0,
					'created' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
				),
			));
			if ($_paymentid > 0) {
				$_items = $this->Autoload_Model->_create(array(
					'table' => 'payments_items',
					'data' => array(
						'price' => $att['saleoff'],
						'quantity' => $att['quantity'],
						'publish' => 1,
						'trash' => 0,
						'created' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
					),
				));
				echo json_encode($alert);
				$this->load->library(array('mailbie'));
				$this->mailbie->sent(array(
					'to' => $this->fcSystem['contact_email'],
					'cc' => '',
					'subject' => 'Bạn nhận được email từ hệ thống website: '.$this->fcSystem['contact_web'],
					'message' => mail_html(array(
						'header' => 'Thông tin liên hệ',
						'fullname' => $att['fullname'],
						'phone' => $att['phone'],
						'address' => $att['address'],
						'message' => $att['message'],
						'quantity' => $att['quantity'],
						'web' => $this->fcSystem['contact_web'],
						'images' => $this->fcSystem['sanpham_images'],
						'title' => $this->fcSystem['sanpham_title'],
						'price' => $this->fcSystem['sanpham_saleoff'],
						'total_price' => $att['quantity']*$this->fcSystem['sanpham_saleoff'],
						'hotline' => $this->fcSystem['contact_phone'],
					))
				));
				die();

			}
		}else{
			$alert['error'] = validation_errors();
			echo json_encode($alert); die();
		}

	}
	public function cartonline(){
		$alert = array(
			'error' => '',
			'message' => '',
			'result' => ''
		);
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', ' / ');
		$this->form_validation->set_rules('fullname', 'Họ và tên', 'trim|required');
		$this->form_validation->set_rules('phone', 'Số điện thoại', 'trim|required');
		$this->form_validation->set_rules('address', 'Địa chỉ', 'trim|required');
		$this->form_validation->set_rules('quantity', 'Số lượng đặt', 'trim|required');
		if ($this->form_validation->run($this)){
			$att = '';
			$data = array(
				'publish' => 0,
				'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
			);
			$post = $this->input->post('post');
			if(isset($post) && is_array($post)  && count($post)) {
				foreach ($post as $key => $val) {
					$att[$val['name']] = nl2br($val['value']);
				}
				foreach ($data as $key => $val) {
					$att[$key] = $val;
				}
			}
			$_paymentid = $this->Autoload_Model->_create(array(
				'table' => 'payments',
				'data' => array(
					'type' => 'cart',
					'fullname' => $att['fullname'],
					'phone' => $att['phone'],
					'address' => $att['address'],
					'quantity' => $att['quantity'],
					'total_price' => $att['total_price'],
					'publish' => 1,
					'status' => 'wait',
					'send' => 0,
					'created' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
				),
			));
			if ($_paymentid > 0) {
				$_items = $this->Autoload_Model->_create(array(
					'table' => 'payments_items',
					'data' => array(
						'price' => $att['saleoff'],
						'quantity' => $att['quantity'],
						'publish' => 1,
						'trash' => 0,
						'created' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
					),
				));
				echo json_encode($alert);
				$this->load->library(array('mailbie'));
				$this->mailbie->sent(array(
					'to' => $this->fcSystem['contact_email'],
					'cc' => '',
					'subject' => 'Bạn nhận được email từ hệ thống website: '.$this->fcSystem['contact_web'],
					'message' => mail_html_online(array(
						'header' => 'Thông tin liên hệ',
						'fullname' => $att['fullname'],
						'phone' => $att['phone'],
						'address' => $att['address'],
						'quantity' => $att['quantity'],
						'web' => $this->fcSystem['contact_web'],
						'images' => $this->fcSystem['sanpham_images'],
						'title' => $this->fcSystem['sanpham_title'],
						'price' => $this->fcSystem['sanpham_saleoff'],
						'total_price' => $att['total_price'],
						'hotline' => $this->fcSystem['contact_phone'],
					))
				));
				die();

			}
		}else{
			$alert['error'] = validation_errors();
			echo json_encode($alert); die();
		}

	}
}
