<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontendComments_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function Countall($module = '', $moduleid = 0, $pageid = 0){
		$this->db->where(array('comments.trash' => 0, 'comments.publish' => 1, 'comments.module' => $module, 'comments.moduleid' => $moduleid));
		$this->db->from('comments');
		$result = $this->db->count_all_results();
		$this->db->flush_cache();
		return $result;
	}

	public function View($start = 0, $limit = 0, $module = '', $moduleid = 0, $pageid = 0){
		$this->db->select('comments.*');
		$this->db->where(array('comments.trash' => 0, 'comments.publish' => 1, 'comments.module' => $module, 'comments.moduleid' => $moduleid));
		$this->db->from('comments');
		$this->db->order_by('comments.id DESC');
		$this->db->limit($limit, $start);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}

	public function ReadByCondition($param = ''){
		$param['select'] = ((isset($param['select'])) ? $param['select'] : 'id, title, slug, canonical');
		$param['where'] = ((isset($param['where'])) ? $param['where'] : '');
		$param['order_by'] = ((isset($param['order_by'])) ? $param['order_by'] : 'id desc');
		$param['limit'] = ((isset($param['limit'])) ? $param['limit'] : 5);

		$this->db->select($param['select']);
		$this->db->from('comments');
		$this->db->where('trash', 0);
		$this->db->where($param['where']);
		$this->db->limit($param['limit'], 0);
		$this->db->order_by($param['order_by']);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}


	// public function countall($module = '', $moduleid = 0){

	// 	$count = $this->db->query('
	//    		SELECT `cm`.`id`, `cm`.`message`, `cm`.`created`, `us`.`fullname`, `us`.`avatar`
	// 		FROM `comments` as `cm`
	//    		INNER JOIN `customers` as `us` ON `cm`.`star` = `us`.`id`

	//    		WHERE `cm`.`trash` = 0 AND `cm`.`publish` = 1 ORDER BY `cm`.`id` desc')->num_rows();

	//   	$this->db->flush_cache();
	//   	return $count;

	// }

	// public function view($start = 0, $limit = 0, $module = '', $moduleid = 0){
	// 	$result = $this->db->query('
	//    		SELECT `cm`.`id`, `cm`.`message`, `cm`.`created`, `us`.`fullname`, `us`.`avatar`
	// 		FROM `comments` as `cm`
	//    		INNER JOIN `customers` as `us` ON `cm`.`star` = `us`.`id`

	//    		WHERE `cm`.`trash` = 0 AND `cm`.`publish` = 1 ORDER BY `cm`.`id` desc LIMIT '.($start).', '.$limit.'')->result_array();
	// 	$this->db->flush_cache();
	// 	return $result;
	// }


}