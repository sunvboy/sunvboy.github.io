<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends FC_Controller{
	public function __construct(){
		parent::__construct();
		$this->fc_lang = $this->config->item('fc_lang');
		$this->fcCustomer = $this->config->item('fcCustomer');
		/* KIỂM TRA TÌNH TRẠNG WEBSITE */
		if($this->fcSystem['homepage_website'] == 1){
			echo '<img src="'.base_url().'templates/backend/images/close.jpg'.'" style="width:100%;" />';die();
		}
		/* -------------------------- */
	}
	public function View($id = 0){
		$id = (int)$id;
		$DetailArticles = $this->FrontendArticles_Model->ReadByField('id', $id, $this->fc_lang);
		$data['DetailArticlesUser'] = $this->FrontendArticles_Model->ReadByFieldusers($DetailArticles['userid_created']);
		$data['countComment'] = $this->FrontendArticles_Model->getComent($DetailArticles['id']);
		if(!isset($DetailArticles) && !is_array($DetailArticles) && count($DetailArticles) == 0){
			$this->session->set_flashdata('message-danger', $this->lang->line('error_articles_detial'));
			redirect(base_url());
		}
		$DetailCatalogues = $this->FrontendArticlesCatalogues_Model->ReadByField('id', $DetailArticles['cataloguesid'], $this->fc_lang);
		if(!isset($DetailCatalogues) && !is_array($DetailCatalogues) && count($DetailCatalogues) == 0){
			$this->session->set_flashdata('message-danger', $this->lang->line('error_articles_catalogues'));
			redirect(base_url());
		}
		$data['articles_cat'] = $this->FrontendArticlesCatalogues_Model->ReadByCondition(array(
            'select' => 'id, title, slug, canonical, description, lft, rgt',
            'where' => array('trash' => 0,'publish' => 1, 'parentid' => 0, 'alanguage' => ''.$this->fc_lang.''),
            'order_by' => 'order asc, id desc',
        ));
		$data['Breadcrumb'] = $this->FrontendArticlesCatalogues_Model->Breadcrumb($DetailCatalogues['lft'], $DetailCatalogues['rgt'], $this->fc_lang);
		$data['TagsList'] = $this->FrontendTags_Model->ReadByModule($id, 'articles');
		$cataloguesid = $this->FrontendArticles_Model->_get_where(array(
			'select' => 'cataloguesid',
			'table' => 'catalogues_relationship',
			'where' => array(
				'modulesid' => $id,
				'modules' => 'articles',
			),
		), TRUE);
		$data['articles_same'] = $this->FrontendArticles_Model->_read_condition(array(
			'modules' => 'articles',
			'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`description`, `pr`.`created`, `pr`.`viewed`',
			'where' => '`pr`.`trash` = 0 AND `pr`.`id` != '.$id.' AND `pr`.`alanguage` = \''.$this->fc_lang.'\' ',
			'limit' => 6,
			'order_by' => '`pr`.`id` desc',
		), $cataloguesid);
		$data['module'] = 'articles';
		$data['moduleid'] = $DetailArticles['id'];
		$data['meta_title'] = !empty($DetailArticles['meta_title'])?$DetailArticles['meta_title']:$DetailArticles['title'];
		$data['meta_keyword'] = $DetailArticles['meta_keyword'];
		$data['meta_description'] = !empty($DetailArticles['meta_description'])?$DetailArticles['meta_description']:cutnchar(strip_tags($DetailArticles['description']), 255);
		$data['meta_images'] = !empty($DetailArticles['images'])?base_url($DetailArticles['images']):'';
		$data['DetailArticles'] = $DetailArticles;
		$data['DetailCatalogues'] = $DetailCatalogues;
		$data['canonical'] = rewrite_url($DetailArticles['canonical'], $DetailArticles['slug'], $DetailArticles['id'], 'articles', TRUE, TRUE);
		$data['canonicalcata'] = rewrite_url($DetailCatalogues['canonical'], $DetailCatalogues['slug'], $DetailCatalogues['id'], 'articles_catalogues');
		$data['created'] = show_time($DetailArticles['created'], 'd/m/Y');
		$data['view'] = $DetailArticles['viewed'];
		$this->FrontendArticles_Model->UpdateViewed('id', $DetailArticles['id'], $this->fc_lang);

		if($data['DetailCatalogues']['isaside']==1){
			$data['template'] = 'articles/frontend/articles/baidichvu';

		}
		else{
			$data['template'] = 'articles/frontend/articles/view';

		}

		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}
}
