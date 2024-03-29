<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends FC_Controller{

	public function __construct(){
		parent::__construct();
		/* KIỂM TRA TÌNH TRẠNG WEBSITE */
		$this->fc_lang = $this->config->item('fc_lang');
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
		if( $this->input->get('country') ){
			$data['country'] = $this->Frontendaddress_Model->ReadByField('id',$this->input->get('country'));
		}
		if( $this->input->get('training') ){
			$data['training'] = $this->Frontendaddress_Model->ReadByField('id',$this->input->get('training'));
		}
		
		$config['total_rows'] = $this->FrontendArticlesCatalogues_Model->Countsearch();

		// echo $config['total_rows'];die;

		$config['base_url'] = rewrite_url('tim-kiem', '','', '', FALSE, TRUE);
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['prefix'] = 'trang-';
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 10;
			$config['uri_segment'] = 2;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination pull-right">';
			$config['full_tag_close'] = '</ul></nav>';
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li class="page-item">';
			$config['prev_tag_close'] = '</li>';
			$config['num_tag_open'] = '<li class="page-item">';
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
			$data['result'] = $this->FrontendArticlesCatalogues_Model->search( ($page * $config['per_page']), $config['per_page']);
		}
		
		
		$data['meta_title'] = 'Tim kiếm '.$this->input->post('key');
		$data['meta_keywords'] = $this->input->post('key');
		$data['meta_description'] = $this->input->post('key');
		$data['total_rows'] = $config['total_rows'];

		$data['template'] = 'articles/frontend/search/view';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}
}
