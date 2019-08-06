<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BackendProducts_Model extends FC_Model{

	public function __construct(){
		parent::__construct();
	}

	public function CountAll($_list_id = '', $param = '', $lang = 'vietnamese'){
		$this->db->where(array('trash' => 0, 'alanguage' => $lang));
		$keyword = $this->input->get('keyword');
		$cataloguesid = (int)$this->input->get('cataloguesid');
		if($param['userid'] > 0){
			$this->db->where('userid_created', $param['userid']);
		}
		$userid = (int)$this->input->get('userid');
		if($userid > 0){
			$this->db->where('userid_created', $userid);
		}
		if(!empty($keyword)){
			$keyword = $this->db->escape_like_str($keyword);
			$this->db->where('(title LIKE \'%'.$keyword.'%\' OR description LIKE \'%'.$keyword.'%\' OR content LIKE \'%'.$keyword.'%\')');
		}
		if(isset($_list_id) && is_array($_list_id) && count($_list_id)){
			$this->db->where_in('id', $_list_id);
		}
		if($cataloguesid > 0 && empty($_list_id)){
			return 0;
		}
		if(isset($param['where']) && $param['where'] != '' ){
			$this->db->where($param['where']);
		}
		
		$this->db->from('products');
		$result = $this->db->count_all_results();
		$this->db->flush_cache();
		return $result;
	}

	public function ReadAll($start = 0, $limit = 0, $_list_id = '', $param = '', $lang = 'vietnamese'){
		$this->db->where(array('products.trash' => 0, 'products.alanguage' => $lang));
		$this->db->select('products.*, (SELECT fullname FROM users WHERE users.id = products.userid_created) as fullname,(SELECT fullname FROM users WHERE users.id = products.userid_updated) as fullname_update, (SELECT title FROM products_catalogues WHERE products.cataloguesid = products_catalogues.id) as catalogue');
		$keyword = $this->input->get('keyword');
		$userid = (int)$this->input->get('userid');
		if($param['userid'] > 0){
			$this->db->where('userid_created', $param['userid']);
		}
		if($userid > 0){
			$this->db->where('userid_created', $userid);
		}
		if(!empty($keyword)){
			$keyword = $this->db->escape_like_str($keyword);
			$this->db->where('(title LIKE \'%'.$keyword.'%\' OR description LIKE \'%'.$keyword.'%\' OR content LIKE \'%'.$keyword.'%\')');
		}
		if(isset($_list_id) && is_array($_list_id) && count($_list_id)){
			$this->db->where_in('id', $_list_id);
		}
		if(isset($param['where']) && $param['where'] != '' ){
			$this->db->where($param['where']);
		}
		$this->db->from('products');
		$this->db->order_by('order DESC, created DESC');
		$this->db->limit($limit, $start);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}

	public function ReadByField($field = '', $value = 0, $lang = 'vietnamese'){
		$this->db->where(array('trash' => 0, 'alanguage' => $lang));
		$this->db->from('products');
		$this->db->where(array($field => $value))->limit(1, 0);
		$result = $this->db->get()->row_array();
		$this->db->flush_cache();
		return $result;
	}
	public function Update_Img($table, $id, $data)
	{
		if (isset($data) && $data != NULL) {
			$this->db->where('id', $id);
			$this->db->update($table, $data);
		}
	}
	public function Create($user = '', $catalogues = NULL, $albums = '', $lang = 'vietnamese'){
		$price = (int)str_replace('.','',$this->input->post('price'));
		$saleoff = (int)str_replace('.','',$this->input->post('saleoff'));
		$data = array(
			'title' => $this->input->post('title'),
			'slug' => slug($this->input->post('title')),
			'canonical' => slug($this->input->post('canonical')),
			'cataloguesid' => $this->input->post('cataloguesid'),
			'catalogues' => json_encode($catalogues),
			'images' => $this->input->post('images'),
			'price' => $price,
			'saleoff' => $saleoff,
			'albums' => json_encode($albums),
			'order' => $this->input->post('order'),
			'description' => $this->input->post('description'),
			'content' => $this->input->post('content'),
			'meta_title' => $this->input->post('meta_title'),
			'meta_keyword' => $this->input->post('meta_keyword'),
			'meta_description' => $this->input->post('meta_description'),
			'publish' => $this->input->post('publish'),
			'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
			'userid_created' => $user['id'],
			'alanguage' => $lang,
		);
		$this->db->insert('products', $data);
		$result = $this->db->affected_rows();
		if($result > 0){
			$result = $this->db->insert_id();
		}
		$this->db->flush_cache();
		return $result;
	}

	public function UpdateByPost($field = '', $value = 0, $user = '',  $catalogues = NULL, $albums = ''){
		$price = (int)str_replace('.','',$this->input->post('price'));
		$saleoff = (int)str_replace('.','',$this->input->post('saleoff'));
		$data = array(
			'title' => $this->input->post('title'),
			'slug' => slug($this->input->post('title')),
			'canonical' => slug($this->input->post('canonical')),
			'cataloguesid' => $this->input->post('cataloguesid'),
			'catalogues' => json_encode($catalogues),
			'images' => $this->input->post('images'),
			'price' => $price,
			'saleoff' => $saleoff,
			'albums' => json_encode($albums),
			'order' => $this->input->post('order'),
			'description' => $this->input->post('description'),
			'content' => $this->input->post('content'),
			'meta_title' => $this->input->post('meta_title'),
			'meta_keyword' => $this->input->post('meta_keyword'),
			'meta_description' => $this->input->post('meta_description'),
			'publish' => $this->input->post('publish'),
			'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600),
			'userid_updated' => $user['id'],
		);
		$this->db->where(array($field => $value))->update('products', $data);
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}

	public function UpdateBatchByField($data = NULL, $field = 'id'){
		$result = $this->db->update_batch('products', $data, $field); 
		$this->db->flush_cache();
		return $result;
	}

	public function DeleteByField($field = '', $value = 0){
		$this->db->where(array($field => $value))->update('products', array('canonical' => '', 'trash' => 1));
		$result = $this->db->affected_rows();
		$this->db->flush_cache();
		return $result;
	}
	
	public function delete_attribute($id = 0){
		$this->db->where(array('productsid' => $id));
		$this->db->delete('attributes_relationship');
	}
	public function location_dropdown($param = '', $root = true){
		$this->db->select('*');
		$this->db->from('province');
		if(isset($param['where'])){
			$this->db->where($param['where']);
		}
		$this->db->order_by('order desc, title asc');
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		if($root == true){
			$_listDropdown[0] = '[Chọn]';
		}
		if(isset($result) && is_array($result) && count($result)){
			foreach($result as $key => $val){
				$_listDropdown[$val['id']] = $val['title'];
			}
		}
		return $_listDropdown;
	}

	public function Dropdown(){
		$this->db->select('*');
		$this->db->from('products');
		$result = $this->db->get()->result_array();
		$temp = '';
		$temp[0] = '--Chọn sản phẩm--';
		if(isset($result) && is_array($result) && count($result)){
			foreach($result as $key => $val){
				$temp[$val['id']] = $val['title'];
			}
		}
		return $temp;
	}
	function insert($data)
	{
		$this->db->insert_batch('products', $data);
	}
}
