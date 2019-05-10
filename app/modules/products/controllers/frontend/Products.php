<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends FC_Controller{

	public function __construct(){
		parent::__construct();
		$this->fc_lang = $this->config->item('fc_lang');
		/* KIỂM TRA TÌNH TRẠNG WEBSITE */
		if($this->fcSystem['homepage_website'] == 1){
			echo '<img src="'.base_url().'templates/backend/images/close.jpg'.'" style="width:100%;" />';die();
		}
		/* -------------------------- */
	}
	public function View($id = 0){
		$id = (int)$id;
		$DetailProducts = $this->FrontendProducts_Model->ReadByField('id', $id, $this->fc_lang );
		$data['listItem'] = json_decode($DetailProducts['albums'], TRUE);
		//echo "<pre>";var_dump($data['listItem']);die();
		if(!isset($DetailProducts) && !is_array($DetailProducts) && count($DetailProducts) == 0){
			$this->session->set_flashdata('message-danger',  $this->lang->line('error_products_detail'));
			redirect(base_url());
		}
		$DetailCatalogues = $this->FrontendProductsCatalogues_Model->ReadByField('id', $DetailProducts['cataloguesid'], $this->fc_lang );
		if(!isset($DetailCatalogues) && !is_array($DetailCatalogues) && count($DetailCatalogues) == 0){
			$this->session->set_flashdata('message-danger',  $this->lang->line('error_products_catalogues'));
			redirect(base_url());
		}
		// UPdate Feild
		$this->FrontendProducts_Model->UpdateViewed('id', $DetailProducts['id'], $this->fc_lang);
		$data['Breadcrumb'] = $this->FrontendProductsCatalogues_Model->Breadcrumb($DetailCatalogues['lft'], $DetailCatalogues['rgt'], $this->fc_lang);
		$data['TagsList'] = $this->FrontendTags_Model->ReadByModule($id, 'products');
		$data['idgoc'] = showcatidgoc($DetailCatalogues['id'], $DetailCatalogues['parentid'], 'products');
		$data['parentid_cat'] = $this->FrontendGallerysCatalogues_Model->ReadAllByField('parentid', $data['idgoc'], $this->fc_lang);
		$data['products_cat'] = $this->FrontendProductsCatalogues_Model->ReadByCondition(array(
            'select' => 'id, title, slug, canonical, description, lft, rgt, parentid',
            'where' => array('trash' => 0,'publish' => 1, 'alanguage' => ''.$this->fc_lang.''),
            'order_by' => 'order asc, id desc',
        ));
		$cataloguesid = $this->FrontendProducts_Model->_get_where(array(
			'select' => 'cataloguesid',
			'table' => 'catalogues_relationship',
			'where' => array(
				'modulesid' => $id,
				'modules' => 'products',
			),
		), TRUE);
		
		$data['products_same'] = $this->FrontendProducts_Model->_read_condition(array(
			'modules' => 'products',
			'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`description`, `pr`.`content2`, `pr`.`price`, `pr`.`saleoff`, `pr`.`psale`, `pr`.`created`, `pr`.`highlight`',
			'where' => '`pr`.`trash` = 0 AND `pr`.`id` != '.$id.' AND `pr`.`publish` = 1 AND `pr`.`alanguage` = \''.$this->fc_lang .'\'',
			'limit' => 8,
			'order_by' => '`pr`.`id` desc',
		), $cataloguesid);

		//sản phẩm vừa xem
		if(isset($_SESSION['watched'])) {
			$watched = $this->session->userdata('watched');
			if(!in_array($id, $watched)){
				if(count($watched) >= 100) {
					array_splice($watched, 0, 1);
				}
				$watched[] = $id;
				$this->session->set_userdata('watched',$watched);
			}
		} else {
			$watched = array();
			$watched[] = $id;
			$this->session->set_userdata('watched',$watched);
		}
		//echo "<pre>";var_dump($watched);die();
		//session_destroy();
		//$this->session->set_userdata($newdata);
		// print_r($_SESSION['watched']);
		// get all product watched
		$productWatched = array();
		foreach ($watched as $value) {
			$productWatched[] = $this->FrontendProducts_Model->ReadByField('id', $value, $this->fc_lang );
		}
		$data['module'] = 'products';
		$data['moduleid'] = $DetailProducts['id'];
		$data['products_attr'] = $this->FrontendProducts_Model->AttributesAllTheTime($id);
		$data['productWatched'] = $productWatched;
		//end
		$data['urlbl'] = rewrite_url($DetailCatalogues['canonical'], $DetailCatalogues['slug'], $DetailCatalogues['id'], 'products_catalogues');
		$data['meta_title'] = !empty($DetailProducts['meta_title'])?$DetailProducts['meta_title']:$DetailProducts['title'];
		$data['meta_keyword'] = $DetailProducts['meta_keyword'];
		$data['meta_description'] = !empty($DetailProducts['meta_description'])?$DetailProducts['meta_description']:cutnchar(strip_tags($DetailProducts['description']), 255);
		$data['meta_images'] = !empty($DetailProducts['images'])?base_url($DetailProducts['images']):'';
		$data['DetailProducts'] = $DetailProducts;
		$data['DetailCatalogues'] = $DetailCatalogues;
		$data['canonical'] = rewrite_url($DetailProducts['canonical'], $DetailProducts['slug'], $DetailProducts['id'], 'products', TRUE, TRUE);
		$data['template'] = 'products/frontend/products/view';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
		
	}

	public function ViewAll($page = 1){
		$config['total_rows'] = $this->FrontendProducts_Model->CountSP();
		$data['countsp'] = $config['total_rows'];
		//echo $config['total_rows'];die;

		$config['base_url'] = rewrite_url('san-pham', '','', '', FALSE, TRUE);
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['prefix'] = 'trang-';
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 16;
			$config['uri_segment'] = 2;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<ul class=" pull-right"><span>';
			$config['full_tag_close'] = '</span></ul>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a >';
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
			$data['productsList'] = $this->FrontendProducts_Model->ReadAllSP( ($page * $config['per_page']), $config['per_page']);
			//echo "<pre>";var_dump($data['result']);die();
		}
		$data['meta_title'] = 'Sản phẩm';
		$data['meta_keywords'] = 'Sản phẩm';
		$data['meta_description'] = 'Sản phẩm';
		$data['total_rows'] = $config['total_rows'];
		$data['template'] = 'products/frontend/products/view_all';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}
	public function ViewNew($page = 1){
		$config['total_rows'] = $this->FrontendProducts_Model->CountNews();
		//echo $config['total_rows'];die;

		$config['base_url'] = rewrite_url('san-pham', '','', '', FALSE, TRUE);
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['prefix'] = 'trang-';
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 20;
			$config['uri_segment'] = 2;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<div class="pagination">';
			$config['full_tag_close'] = '</div>';
			$config['first_tag_open'] = '';
			$config['first_tag_close'] = '';
			$config['last_tag_open'] = '';
			$config['last_tag_close'] = '';
			$config['cur_tag_open'] = '<a class="active">';
			$config['cur_tag_close'] = '</a>';
			$config['next_tag_open'] = '';
			$config['next_tag_close'] = '';
			$config['prev_tag_open'] = '';
			$config['prev_tag_close'] = '';
			$config['num_tag_open'] = '';
			$config['num_tag_close'] = '';
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
			$data['result'] = $this->FrontendProducts_Model->ReadAllNews( ($page * $config['per_page']), $config['per_page']);
			//echo "<pre>";var_dump($data['result']);die();
		}
		$data['meta_title'] = 'Sản phẩm mới';
		$data['meta_keywords'] = 'Sản phẩm mới';
		$data['meta_description'] = 'Sản phẩm mới';
		$data['total_rows'] = $config['total_rows'];
		$data['template'] = 'products/frontend/products/view_news';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}
}
