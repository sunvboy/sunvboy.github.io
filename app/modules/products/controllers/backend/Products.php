<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends FC_Controller{
	
	public $action;
	
	public function __construct(){
		parent::__construct();
		$this->fcUser = $this->config->item('fcUser');
		$this->fclang = $this->config->item('fclang');
		if(!$this->fcUser) redirect('admin/login');
		$this->load->model(array(
			'BackendProducts_Model',
			'BackendProductsCatalogues_Model',
			'tags/BackendTags_Model',
			'routers/BackendRouters_Model',
		));
		$this->load->library(array('configbie'));
		$this->load->library('excel');
		$this->load->library('nestedsetbie', array('table' => 'products_catalogues'));
		
		$this->action = array(
			'publish' => 'Xuất bản',
			'highlight' => 'Nổi bật'
		);
		
	}


	function import()
	{
		if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++)
				{
					$id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$title = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$slug = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$canonical = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$cataloguesid = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$catalogues = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$images = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$albums = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
					$price = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
					$saleoff = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
					$description = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
					$content = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
					$order = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
					$viewed = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
					$publish = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
					$highlight = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
					$psale = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
					$ishome = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
					$isaside = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
					$isfooter = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
					$trash = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
					$meta_title = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
					$meta_keyword = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
					$meta_description = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
					$userid_created = $worksheet->getCellByColumnAndRow(24, $row)->getValue();
					$userid_updated = $worksheet->getCellByColumnAndRow(25, $row)->getValue();
					$created = $worksheet->getCellByColumnAndRow(26, $row)->getValue();
					$updated = $worksheet->getCellByColumnAndRow(27, $row)->getValue();
					$data[] = array(
						'id'		=>	$id,
						'title'		=>	$title,
						'slug'		=>	$slug,
						'canonical'		=>	$canonical,
						'cataloguesid'		=>	$cataloguesid,
						'catalogues'			=>	$catalogues,
						'images'				=>	$images,
						'albums'		=>	$albums,
						'price'			=>	$price,
						'saleoff'			=>	$saleoff,
						'description'			=>	$description,
						'content'			=>	$content,
						'order'			=>	$order,
						'viewed'			=>	$viewed,
						'publish'			=>	$publish,
						'highlight'			=>	$highlight,
						'psale'			=>	$psale,
						'ishome'			=>	$ishome,
						'isaside'			=>	$isaside,
						'isfooter'			=>	$isfooter,
						'trash'			=>	$trash,
						'meta_title'			=>	$meta_title,
						'meta_description'			=>	$meta_description,
						'meta_keyword'			=>	$meta_keyword,
						'userid_created'			=>	$userid_created,
						'userid_updated'			=>	$userid_updated,
						'created'			=>	$created,
						'updated'			=>	$updated,
					);
				}
			}
			$this->BackendProducts_Model->insert($data);
			echo 'Data Imported Successfully';
		}
	}


	public function View($page = 1){
		$this->commonbie->Permissions(array(
			'uri' => 'products/backend/products/view'
		));
		$page = (int)$page;
		$products_id = '';
		$userid = 0;
		$where = '';
		$cataloguesid = $this->input->get('cataloguesid');
		$filter = $this->input->get('filter');
		if($cataloguesid > 0){
			$products_id = catalogues_relationship($cataloguesid, 'products', array('BackendProducts','BackendProductsCatalogues'), 'products_catalogues');
		}
		if(in_array('products/backend/products/limit', $this->fcUser['group']) == FALSE){
			$userid = $this->fcUser['id'];
		}
		if(isset($this->action[$filter])){
			$where = array($filter => 1);
		}else{
			$prefix = substr($filter, 2);
			if(!empty($prefix)){
				$where = array($prefix.'<=' => 0);
			}
		}
		$config['total_rows'] = $this->BackendProducts_Model->CountAll($products_id, array('userid' => $userid,'where' => $where), $this->fclang);
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['base_url'] = base_url('products/backend/products/view');
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
			$data['ListPagination'] = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$data['Listproducts'] = $this->BackendProducts_Model->ReadAll(($page * $config['per_page']), $config['per_page'], $products_id, array('userid' => $userid, 'where' => $where), $this->fclang);	
		}
		$data['template'] = 'products/backend/products/view';
		$this->load->view('dashboard/backend/layouts/home', isset($data)?$data:NULL);
	}

	public function Create(){
		$this->commonbie->Permissions(array(
			'uri' => 'products/backend/products/create'
		));
		if($this->input->post('create')){
			$attr = $this->input->post('attr');
			$data['tagsid'] = $this->input->post('tagsid');
			$data['avatar'] = $this->input->post('images');
			$data['catalogue'] = $this->input->post('catalogue'); // mảng danh mục
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');
			$this->form_validation->set_rules('title', 'sản phẩm', 'trim|required');
			$this->form_validation->set_rules('canonical', 'Canonical', 'trim|callback__Canonical');
			$this->form_validation->set_rules('cataloguesid', 'Breadcrumb', 'trim|required');
			$this->form_validation->set_rules('catalogue', 'Danh mục cha', 'trim|callback__Catalogue');
//			$this->form_validation->set_rules('description', 'Mô tả', 'trim');
//			$this->form_validation->set_rules('content', 'Nội dung', 'trim|required');
			if ($this->form_validation->run($this)){
				
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


				$albumlist = $this->input->post('albumlist');
				$album_data_2 = '';
				if(isset($albumlist['images']) && is_array($albumlist['images'])  && count($albumlist['images'])) {
					foreach ($albumlist['images'] as $key => $val) {
						$album_data_2[] = array('images' => $val); 
					}
				}
				if(isset($album_data_2) && is_array($album_data_2)  && count($album_data_2) && isset($albumlist['title']) && is_array($albumlist['title']) && count($albumlist['title']) && isset($albumlist['description']) && is_array($albumlist['description']) && count($albumlist['description'])) {
					foreach ($album_data_2 as $key => $val) {
						$album_data_2[$key]['title'] = $albumlist['title'][$key];
						$album_data_2[$key]['description'] = $albumlist['description'][$key];
					}
				}


				$albumlist3 = $this->input->post('albumlist3');
				$album_data_3 = '';
				if(isset($albumlist3['images']) && is_array($albumlist3['images'])  && count($albumlist3['images'])) {
					foreach ($albumlist3['images'] as $key => $val) {
						$album_data_3[] = array('images' => $val);
					}
				}
				if(isset($album_data_3) && is_array($album_data_3)  && count($album_data_3) && isset($albumlist3['title']) && is_array($albumlist3['title']) && count($albumlist3['title']) && isset($albumlist3['description']) && is_array($albumlist3['description']) && count($albumlist3['description'])) {
					foreach ($album_data_3 as $key => $val) {
						$album_data_3[$key]['title'] = $albumlist3['title'][$key];
						$album_data_3[$key]['description'] = $albumlist3['description'][$key];
					}
				}

				$albumlist4 = $this->input->post('albumlist4');
				$album_data_4 = '';
				if(isset($albumlist4['images']) && is_array($albumlist4['images'])  && count($albumlist4['images'])) {
					foreach ($albumlist4['images'] as $key => $val) {
						$album_data_4[] = array('images' => $val);
					}
				}
				if(isset($album_data_4) && is_array($album_data_4)  && count($album_data_4) && isset($albumlist4['title']) && is_array($albumlist4['title']) && count($albumlist4['title']) && isset($albumlist4['description']) && is_array($albumlist4['description']) && count($albumlist4['description'])) {
					foreach ($album_data_4 as $key => $val) {
						$album_data_4[$key]['title'] = $albumlist4['title'][$key];
						$album_data_4[$key]['description'] = $albumlist4['description'][$key];
						$album_data_4[$key]['content1'] = $albumlist4['content1'][$key];
						$album_data_4[$key]['content2'] = $albumlist4['content2'][$key];
					}
				}

				
				$resultid = $this->BackendProducts_Model->Create($this->fcUser,$data['catalogue'], $album_data, $album_data_2,$album_data_3,$album_data_4, $this->fclang);
				//upload file psd
				$config['upload_path']   = './uploads/files/';
				$config['allowed_types'] = 'pdf|docx|xls|doc';
				$config['max_size']      = '5000';
				$config['max_width']     = '3000';
				$config['max_height']    = '2000';
				$this->load->library('upload', $config);

				if ($_FILES['userfilepsd']['name'] != '') {
					if (!$this->upload->do_upload('userfilepsd')) {
						$data['error'] = 'File không hợp lệ!';
					} else {
						$upload = array('upload_data' => $this->upload->data());
						$image  = 'uploads/files/' . $upload['upload_data']['file_name'];
						$this->BackendProducts_Model ->_update(array('table' => 'products','where' => array('id' => $resultid), 'data' => array(
							'file' => $image,
						),));
					}
				}
				//end








				if($resultid > 0){
					$canonical = slug($this->input->post('canonical'));
					if(!empty($canonical)){
						$this->BackendRouters_Model->Create($canonical, 'products/frontend/products/view', $resultid, 'number');
					}
					$temp = '';
					foreach($data['catalogue'] as $key => $val){
						$temp[] = array(
							'modules' => 'products',
							'modulesid' => $resultid,
							'cataloguesid' => $val,
							'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
						);
					}
					$this->BackendProducts_Model->create_batch(array('data' => $temp,'table' => 'catalogues_relationship'));
					$this->BackendTags_Model->InsertByModule($resultid, 'products');
					$this->BackendAttributes_Model->InsertAttr($resultid, $attr);
					$this->session->set_flashdata('message-success', 'Thêm sản phẩm mới thành công');
					redirect('products/backend/products/view');
				}
			}
			$_attribute_cat = '';
			$radio_cat_checked = $this->input->post('cataloguesid');
			$data['attr'] = $this->input->post('attr');
			$cat_checked = $this->BackendProductsCatalogues_Model->ReadByField('id', $radio_cat_checked, $this->fclang);
			$cat_checked = json_decode($cat_checked['attributes'], TRUE);
			$data['cat_checked'] = $cat_checked;
		}
		
		$data['attribute_catalogues'] = $this->BackendAttributesCatalogues_Model->AttributesCataloguesList(FALSE);
		if(isset($data['attribute_catalogues']) && is_array($data['attribute_catalogues']) && count($data['attribute_catalogues'])){
			foreach($data['attribute_catalogues'] as $key => $val){
				$data['attribute_catalogues'][$key]['attributes'] = $this->BackendAttributes_Model->ReadAtrributes($val['id']);
			}
		}
		
		$data['template'] = 'products/backend/products/create';
		$this->load->view('dashboard/backend/layouts/home', isset($data)?$data:NULL);
	}

	public function Read($id = 0){
		$this->commonbie->Permissions(array(
			'uri' => 'products/backend/products/read'
		));
		$id = (int)$id;
		$data['DetailProducts'] = $this->BackendProducts_Model->ReadByField('id', $id, $this->fclang);
		if(!isset($data['DetailProducts']) && !is_array($data['DetailProducts']) && count($data['DetailProducts']) == 0){
			$this->session->set_flashdata('message-danger', 'sản phẩm không tồn tại');
			redirect_custom('products/backend/products/view');
		}
		$data['template'] = 'products/backend/products/read';
		$this->load->view('dashboard/backend/layouts/home', isset($data)?$data:NULL);
	}

	public function Update($id = 0){
		$this->commonbie->Permissions(array(
			'uri' => 'products/backend/products/update'
		));
		$id = (int)$id;
		$data['DetailProducts'] = $this->BackendProducts_Model->ReadByField('id', $id, $this->fclang);
		if(!isset($data['DetailProducts']) && !is_array($data['DetailProducts']) && count($data['DetailProducts']) == 0){
			$this->session->set_flashdata('message-danger', 'sản phẩm không tồn tại');
			redirect_custom('products/backend/products/view');
		}
		$data['tagsid'] = $this->BackendTags_Model->ReadByModule($id, 'products');
		$data['catalogue'] = json_decode($data['DetailProducts']['catalogues'], TRUE);
		$catalogues = $this->input->post('catalogue');
		if($this->input->post('update')){
			$attr = $this->input->post('attr');
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');
			$this->form_validation->set_rules('title', 'sản phẩm', 'trim|required');
			$this->form_validation->set_rules('canonical', 'Canonical', 'trim|callback__Canonical');
			$this->form_validation->set_rules('cataloguesid', 'Breadcrumb', 'trim|required');
			$this->form_validation->set_rules('catalogue', 'Danh mục cha', 'trim|callback__Catalogue');
//			$this->form_validation->set_rules('description', 'Mô tả', 'trim|required');
//			$this->form_validation->set_rules('content', 'Nội dung', 'trim|required');
			if ($this->form_validation->run($this)){
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


				$albumlist = $this->input->post('albumlist');
				$album_data_2 = '';
				if(isset($albumlist['images']) && is_array($albumlist['images'])  && count($albumlist['images'])) {
					foreach ($albumlist['images'] as $key => $val) {
						$album_data_2[] = array('images' => $val); 
					}
				}
				if(isset($album_data_2) && is_array($album_data_2)  && count($album_data_2) && isset($albumlist['title']) && is_array($albumlist['title']) && count($albumlist['title']) && isset($albumlist['description']) && is_array($albumlist['description']) && count($albumlist['description'])) {
					foreach ($album_data_2 as $key => $val) {
						$album_data_2[$key]['title'] = $albumlist['title'][$key];
						$album_data_2[$key]['description'] = $albumlist['description'][$key];
					}
				}



				$albumlist3 = $this->input->post('albumlist3');
				$album_data_3 = '';
				if(isset($albumlist3['images']) && is_array($albumlist3['images'])  && count($albumlist3['images'])) {
					foreach ($albumlist3['images'] as $key => $val) {
						$album_data_3[] = array('images' => $val);
					}
				}
				if(isset($album_data_3) && is_array($album_data_3)  && count($album_data_3) && isset($albumlist3['title']) && is_array($albumlist3['title']) && count($albumlist3['title']) && isset($albumlist3['description']) && is_array($albumlist3['description']) && count($albumlist3['description'])) {
					foreach ($album_data_3 as $key => $val) {
						$album_data_3[$key]['title'] = $albumlist3['title'][$key];
						$album_data_3[$key]['description'] = $albumlist3['description'][$key];
					}
				}



				$albumlist4 = $this->input->post('albumlist4');
				$album_data_4 = '';
				if(isset($albumlist4['images']) && is_array($albumlist4['images'])  && count($albumlist4['images'])) {
					foreach ($albumlist4['images'] as $key => $val) {
						$album_data_4[] = array('images' => $val);
					}
				}
				if(isset($album_data_4) && is_array($album_data_4)  && count($album_data_4) && isset($albumlist4['title']) && is_array($albumlist4['title']) && count($albumlist4['title']) && isset($albumlist4['description']) && is_array($albumlist4['description']) && count($albumlist4['description'])) {
					foreach ($album_data_4 as $key => $val) {
						$album_data_4[$key]['title'] = $albumlist4['title'][$key];
						$album_data_4[$key]['description'] = $albumlist4['description'][$key];
						$album_data_4[$key]['content1'] = $albumlist4['content1'][$key];
						$album_data_4[$key]['content2'] = $albumlist4['content2'][$key];
					}
				}





				
				$flag = $this->BackendProducts_Model->UpdateByPost('id', $id, $this->fcUser, $catalogues, $album_data, $album_data_2,$album_data_3,$album_data_4);
				// upload file

				$config2['upload_path'] = './uploads/files/';
				$config2['allowed_types'] = 'pdf|docx|xls|doc';
				$config2['max_size']      = '9000';
				$config2['max_width']     = '3000';
				$config2['max_height']    = '2000';

				$this->load->library('upload', $config2);
				$this->upload->initialize($config2);
				if ($_FILES['upload']['name'] != '') {
					if (!$this->upload->do_upload('upload')) {
						$data['error'] = 'File không hợp lệ!';
						echo $this->upload->display_errors();
						die;
					} else {

						$upload = array('upload_data' => $this->upload->data());
						$image = 'uploads/files/' . $upload['upload_data']['file_name'];
						$this->BackendProducts_Model ->_update(array('table' => 'products','where' => array('id' => $data['DetailProducts']['id']), 'data' => array(
							'file' => $image,
						),));

						if (isset($data['DetailProducts']) && file_exists($data['DetailProducts']['file'])) {
							@unlink(($data['DetailProducts']['file']));
						}
					}
				}

				if($flag > 0){
					$temp = '';
					foreach($catalogues as $key => $val){
						$temp[] = array(
							'modules' => 'products',
							'modulesid' => $id,
							'cataloguesid' => $val,
							'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
						);
					}
					$this->BackendProducts_Model->_delete_batch('modulesid', $id,'catalogues_relationship','products');
					$this->BackendProducts_Model->create_batch(array('data' => $temp,'table' => 'catalogues_relationship'));
					$canonical = slug($this->input->post('canonical'));
					if(!empty($canonical)){
						$this->BackendRouters_Model->Delete($canonical, 'products/frontend/products/view', $id, 'number');
						$this->BackendRouters_Model->Create($canonical, 'products/frontend/products/view', $id, 'number');
					}
					else{
						$this->BackendRouters_Model->Delete($canonical, 'products/frontend/products/view', $id, 'number');
					}
					$this->BackendTags_Model->DeleteByModule($id, 'products');
					$this->BackendTags_Model->InsertByModule($id, 'products');
					$this->BackendAttributes_Model->DeleteAttr($id);
					$this->BackendAttributes_Model->InsertAttr($id, $attr);
					$this->session->set_flashdata('message-success', 'Cập nhật sản phẩm thành công');
					redirect_custom('products/backend/products/view');
				}
			}
			$_attribute_cat = '';
			$radio_cat_checked = $this->input->post('cataloguesid');
			$data['attr'] = $this->input->post('attr');
			$cat_checked = $this->BackendProductsCatalogues_Model->ReadByField('id', $radio_cat_checked, $this->fclang);
			$cat_checked = json_decode($cat_checked['attributes'], TRUE);
			$data['cat_checked'] = $cat_checked;
		}
		
		$_static_cat_checked = $this->BackendProductsCatalogues_Model->ReadByField('id', $data['DetailProducts']['cataloguesid'], $this->fclang);
		
		$_static_cat_checked = json_decode($_static_cat_checked['attributes'], TRUE);
		$data['_static_cat_checked'] = $_static_cat_checked;
		// print_r($data['_static_cat_checked']);die();
		
		$data['attribute_catalogues'] = $this->BackendAttributesCatalogues_Model->AttributesCataloguesList(FALSE);
		if(isset($data['attribute_catalogues']) && is_array($data['attribute_catalogues']) && count($data['attribute_catalogues'])){
			foreach($data['attribute_catalogues'] as $key => $val){
				$data['attribute_catalogues'][$key]['attributes'] = $this->BackendAttributes_Model->ReadAtrributes($val['id']);
			}
		}
		$data['attribute_checked'] = $this->BackendAttributes_Model->AttributesChecked($id);
		if (!is_array($data['attribute_checked']) || count($data['attribute_checked']) < 0) {
			$data['attribute_checked'] = array('100000');
		}
		$data['template'] = 'products/backend/products/update';
		$this->load->view('dashboard/backend/layouts/home', isset($data)?$data:NULL);
	}

	public function Delete($id = 0){
		$this->commonbie->Permissions(array(
			'uri' => 'products/backend/products/delete'
		));
		$id = (int)$id;
		$data['DetailProducts'] = $this->BackendProducts_Model->ReadByField('id', $id, $this->fclang);
		if(!isset($data['DetailProducts']) && !is_array($data['DetailProducts']) && count($data['DetailProducts']) == 0){
			$this->session->set_flashdata('message-danger', 'sản phẩm không tồn tại');
			redirect_custom('products/backend/products/view');
		}

		if($this->input->post('delete')){
			$flag = $this->BackendProducts_Model->DeleteByField('id', $id);
			if($flag > 0){
				if(!empty($data['DetailProducts']['canonical'])){
					$this->BackendRouters_Model->Delete($data['DetailProducts']['canonical'], 'products/frontend/products/view', $data['DetailProducts']['id'], 'number');

				}
				$this->BackendProducts_Model->_delete_relationship('products', $id);
				$this->BackendTags_Model->DeleteByModule($id, 'products');
				$this->BackendProducts_Model->delete_attribute($id);
				if (file_exists($data['DetailProducts']['file'])){
					@unlink(($data['DetailProducts']['file']));
				}

				$this->session->set_flashdata('message-success', 'Xóa sản phẩm thành công');

				redirect('products/backend/products/view');
			}


		}
		$data['template'] = 'products/backend/products/delete';
		$this->load->view('dashboard/backend/layouts/home', isset($data)?$data:NULL);
	}

	public function _Canonical(){
		$canonical = slug($this->input->post('canonical'));
		$canonical_original = slug($this->input->post('canonical_original'));
		if(empty($canonical)){
			return TRUE;
		}
		if($canonical != $canonical_original){
			$count = $this->BackendRouters_Model->count($canonical);
			if($count > 0){
				$this->form_validation->set_message('_Canonical', 'Canonical đã tồn tại');
				return FALSE;
			}
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
	public function set($type = NULL, $id = 0){
		$redirect = $this->input->get('redirect');
		$id = (int)$id;
		$data['products'] = $this->BackendProducts_Model->ReadByField('id', $id, $this->fclang);
		$temp[$type] = (($data['products'][$type] == 1)?0:1);
		$temp['userid_updated'] = $this->fcUser['id'];
		$temp['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
		$this->db->where('id', $id);
		$this->db->update('products', $temp);
		redirect((!empty($redirect)) ? $redirect : 'products/backend/products/view');
	}
}
