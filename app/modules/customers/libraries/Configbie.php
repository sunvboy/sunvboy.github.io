<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ConfigBie{
	
	function __construct($params = NULL){
		$this->params = $params;
	}

	public function data($field = 'process', $value = -1){
		$data['process'] = array(
			-1 => '- Chọn tình trạng -',
			0 => 'Chưa xử lý',
			1 => 'Đang xử lý',
			2 => 'Đã xử lý xong'
		);
		$data['level'] = array(
			-1 => '- Chọn Mức độ -',
			0 => 'Rất quan trọng',
			1 => 'Quan trọng'
		);
		$data['publish'] = array(
			-1 => '- Chọn xuất bản -',
			0 => 'Không xuất bản',
			1 => 'Xuất bản',
		);
		
		$data['status'] = array(
			0 => 'Chưa xem',
			1 => 'Đang xử lý',
		);
		$data['method'] = array(
			0=> '- Hình thức -',
			1 => 'Nạp tiền',
			2 => 'Rút tiền',
			3 => 'Chuyển tiền',
		);
		$data['send'] = array(
			0 => 'Chưa giao hàng',
			1 => 'Đã giao hàng',
		);
		$data['sex'] = array(
			0 => 'Chọn giới tính',
			1 => 'Nam',
			2 => 'Nữ',
		);
		$data['subjects'] = array(
			0 => 'Chọn đối tượng',
			1 => 'Môi Giới BDS - Công Ty BDS',
			2 => 'Chính Chủ - Chủ Nhà',
		);
		if($value == -1){
			return $data[$field];
		}
		else{
			return $data[$field][$value];
		}
	}
}