<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends FC_Controller{

	public function __construct(){
		parent::__construct();
		$this->fc_lang = $this->config->item('fc_lang');
	}

	public function View($id = 0, $canonical = '', $page = 1){
		$id = (int)$id;
		$page = (int)$page;
		$crc32 = sprintf("%u", crc32($canonical));
		$seoPage = '';
		if($id > 0){
			$DetailTags = $this->FrontendTags_Model->ReadByField('id', $id);
		}
		else{
			$DetailTags = $this->FrontendTags_Model->ReadByField('crc32', $crc32);
		}
		if(!isset($DetailTags) && !is_array($DetailTags) && count($DetailTags) == 0){
			$this->session->set_flashdata('message-danger', 'Chủ đề không tồn tại');
			redirect(base_url());
		}
		$config['total_rows'] = $this->FrontendProducts_Model->CountAllTags($DetailTags['id'], 'products');
		// echo $DetailTags['id'];die;
		// echo $config['total_rows'];die;
		$config['base_url'] = rewrite_url(NULL, $DetailTags['slug'], $DetailTags['id'], 'articles_tags', FALSE);
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['prefix'] = 'trang-';
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 10;
			$config['uri_segment'] = 3;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<div class="fc-pagination"><ul class="uk-pagination">';
			$config['full_tag_close'] = '</ul></div>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="uk-active"><span>';
			$config['cur_tag_close'] = '</span></li>';
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
			$data['ArticlesList'] = $this->FrontendProducts_Model->ReadAllTags($DetailTags['id'], 'products', ($page * $config['per_page']), $config['per_page']);
			if(isset($data['ArticlesList']) && is_array($data['ArticlesList']) && count($data['ArticlesList'])){
				foreach($data['ArticlesList'] as $key => $val){
					$data['ArticlesList'][$key]['tag'] =  $this->FrontendProducts_Model->ReadAllTagsbyProducts($val['id']);
				}
			}
		}

		$data['danhmuchome'] = $this->FrontendProducts_Model->ReadByCondition(array(
			'select' => 'id, title, slug, canonical, images, description, cataloguesid, created',
			'table' => 'products',
			'where' => array('publish' => 1, 'trash' => 0, 'alanguage' => $this->fc_lang),
			'limit' => 10,
			'order_by' => 'id desc',
		));

		$data['tagall'] = $this->FrontendTags_Model->ReadByModules('products');

		$data['meta_title'] = (!empty($DetailTags['meta_title'])?$DetailTags['meta_title']:$DetailTags['title']).$seoPage;
		$data['meta_keyword'] = $DetailTags['meta_keyword'];
		$data['meta_description'] = $DetailTags['meta_description'].$seoPage;
		$data['DetailTags'] = $DetailTags;
		if(!isset($data['canonical']) || empty($data['canonical'])){
			$data['canonical'] = $config['base_url'].$this->config->item('url_suffix');
		}
		$data['template'] = 'tags/frontend/articles/view';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}
}
