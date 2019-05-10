<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends FC_Controller{

	public function __construct(){
		parent::__construct();
		$this->fc_lang = $this->config->item('fc_lang');
		/* KIỂM TRA TÌNH TRẠNG WEBSITE */
		if($this->fcSystem['homepage_website'] == 1){
			echo '<img src="'.base_url().'templates/backend/images/close.jpg'.'" style="width:100%;" />';die();
		}
		/* -------------------------- */
	}

	public function View($page = 1){

		$page = (int)$page;
		$seoPage = '';
		if( $this->input->get('key') ){
			$data['keys'] = $this->input->get('key');
		}
		$config['total_rows'] = $this->FrontendProductsCatalogues_Model->countsearch($this->fc_lang);
		$data['countsp'] = $config['total_rows'];
		$data['products_cat'] = $this->FrontendProductsCatalogues_Model->ReadByCondition(array(
            'select' => 'id, title, slug, canonical, description, lft, rgt, parentid',
            'where' => array('trash' => 0,'publish' => 1, 'alanguage' => ''.$this->fc_lang.''),
            'order_by' => 'order asc, id desc',
        ));
		$config['base_url'] = rewrite_url('tim-kiem', '','', '', FALSE, TRUE);
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
			$data['productsList'] = $this->FrontendProductsCatalogues_Model->search( ($page * $config['per_page']), $config['per_page'], $this->fc_lang );
		}
		$data['danhmuchome'] = $this->FrontendProductsCatalogues_Model->ReadByCondition(array(
			'select' => 'id, title, slug, canonical, albums, images, lft, rgt','where'
			=> array('trash' => 0,'publish' => 1, 'ishome' => 1,  'parentid' => 0,  'alanguage' => ''.$this->fc_lang.''),
			'limit' => 5,'order_by' => 'order asc, id desc'));
		if(isset($data['danhmuchome']) && is_array($data['danhmuchome']) && count($data['danhmuchome'])){
			foreach($data['danhmuchome'] as $key => $val){
				$data['danhmuchome'][$key]['child'] = $this->FrontendProductsCatalogues_Model->ReadByCondition(array(
					'select' => 'id, title, slug, canonical, albums, images, lft, rgt',
					'where' => array('trash' => 0,'publish' => 1, 'parentid' => $val['id'], 'alanguage' => ''.$this->fc_lang.''),
					'limit' => 5,
					'order_by' => 'order asc, id desc',
				));
			}
		}
		$data['productshighlight'] = $this->FrontendProducts_Model->ReadByCondition(array(
			'select' => 'id, title, slug, canonical, images, highlight',
			'table' => 'products',
			'where' => array('highlight' => 1,'trash' => 0, 'alanguage' => $this->fc_lang),
			'limit' => 3,
			'order_by' => 'order asc, id desc',
		));
		$data['support'] = $this->Frontendsupports_Model->ReadByCondition(array(
			'select' => 'id,fullname,skype,facebook,phone',
			'where' => array('trash' => 0,'publish' => 1),
			'limit' => 2,
			'order_by' => 'id desc'
		));

		$data['meta_title'] = 'Tim kiếm '.$this->input->post('key');
		$data['meta_keywords'] = $this->input->post('key');
		$data['meta_description'] = $this->input->post('key');
		$data['total_rows'] = $config['total_rows'];

		$data['template'] = 'products/frontend/search/view';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}
}
