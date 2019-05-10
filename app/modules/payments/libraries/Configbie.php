<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ConfigBie{
	
	function __construct($params = NULL){
		$this->params = $params;
	}

	public function data($field = 'process', $value = -1){
		$data['status'] = array(
			'wait' => 'Chưa xem',
			'opened' => 'Đã xem',
			'processing' => 'Đang xử lý',
			'success' => 'Hoàn thành',
			'cancle' => 'Đã hủy',
		);
		$data['send'] = array(
			0 => 'Chưa giao hàng',
			1 => 'Đã giao hàng',
			
		);
		if($value == -1){
			return $data[$field];
		}
		else{
			return $data[$field][$value];
		}
	}
}