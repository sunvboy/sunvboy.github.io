<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogues extends FC_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->fc_lang = $this->config->item('fc_lang');
        $this->fcCustomer = $this->config->item('fcCustomer');
        /* KIỂM TRA TÌNH TRẠNG WEBSITE */
        if ($this->fcSystem['homepage_website'] == 1) {
            echo '<img src="' . base_url() . 'templates/backend/images/close.jpg' . '" style="width:100%;" />';
            die();
        }
        /* -------------------------- */
    }

    public function View($id = 0, $page = 1)
    {
        $id = (int)$id;
        $page = (int)$page;
        $seoPage = '';
        $DetailCatalogues = $this->FrontendArticlesCatalogues_Model->ReadByField('id', $id, $this->fc_lang);
        //var_dump($DetailCatalogues);die();
        if (!isset($DetailCatalogues) && !is_array($DetailCatalogues) && count($DetailCatalogues) == 0) {
            $this->session->set_flashdata('message-danger', $this->lang->line('error_articles_catalogues'));
            redirect(base_url());
        }
        $data['Breadcrumb'] = $this->FrontendArticlesCatalogues_Model->Breadcrumb($DetailCatalogues['lft'], $DetailCatalogues['rgt'], $this->fc_lang);
        //var_dump($data['Breadcrumb']);die();
        $config['total_rows'] = $this->FrontendArticles_Model->_count(array(
            'select' => '`pr`.`id`',
            'modules' => 'articles',
        ), $DetailCatalogues, $this->fc_lang);
        $data['count_cate'] = $config['total_rows'];
        $data['tagall'] = $this->FrontendTags_Model->ReadByModules('products');

        $idgoc = showcatidgoc($DetailCatalogues['id'], $DetailCatalogues['parentid'], 'articles');
        $Cataloguesgoc = $this->FrontendArticlesCatalogues_Model->ReadByField('id', $idgoc, $this->fc_lang);
        if ($Cataloguesgoc['rgt'] - $Cataloguesgoc['lft'] > 1) {
            $data['list_child'] = $this->FrontendProductsCatalogues_Model->_get_where(array(
                'select' => 'id, title, slug, canonical',
                'table' => 'articles_catalogues',
                'where' => array('publish' => 1, 'alanguage' => $this->fc_lang, 'trash' => 0, 'lft >=' => $Cataloguesgoc['lft'], 'rgt <=' => $Cataloguesgoc['rgt']),
            ), TRUE);
        }

        $data['listcat'] = $this->FrontendArticlesCatalogues_Model->ReadByFieldRow('id,title,slug,canonical', array('parentid' => $DetailCatalogues['id']), $this->fc_lang);
        if (isset($data['listcat']) && is_array($data['listcat']) && count($data['listcat'])) {
            if (isset($data['listcat']) && is_array($data['listcat']) && count($data['listcat'])) {
                foreach ($data['listcat'] as $key => $val) {
                    $data['listcat'][$key]['post'] = $this->FrontendArticles_Model->_read_condition(array(
                        'modules' => 'articles',
                        'select' => '`pr`.`description`, `pr`.`title`, `pr`.`id`, `pr`.`canonical`, `pr`.`slug`',
                        'where' => '`pr`.`trash` = 0',
                        'limit' => 10000,
                        'order_by' => '`pr`.`viewed` desc',
                        'cataloguesid' => $val['id'],
                    ));
                }
            }
        }
        //echo "<pre>";var_dump($data['listcat']);die();

        $config['base_url'] = rewrite_url($DetailCatalogues['canonical'], $DetailCatalogues['slug'], $DetailCatalogues['id'], 'articles_catalogues', FALSE, TRUE);
        if ($config['total_rows'] > 0) {
            $this->load->library('pagination');
            $config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
            $config['prefix'] = 'trang-';
            $config['first_url'] = $config['base_url'] . $config['suffix'];
                $config['per_page'] = (($DetailCatalogues['description'] != '') ? 10 : 10);
            $config['uri_segment'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['full_tag_open'] = '<ul class="pull-right pagination">';
            $config['full_tag_close'] = '</ul>';
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
            $totalPage = ceil($config['total_rows'] / $config['per_page']);
            $page = ($page <= 0) ? 1 : $page;
            $page = ($page > $totalPage) ? $totalPage : $page;
            $seoPage = ($page >= 2) ? (' - Trang ' . $page) : '';
            if ($page >= 2) {
                $data['canonical'] = $config['base_url'] . '/trang-' . $page . $this->config->item('url_suffix');
            }
            $page = $page - 1;
            $data['ArticlesList'] = $this->FrontendArticles_Model->_view(array(
                'select' => '`pr`.`id`, `pr`.`viewed`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`description`, `pr`.`created`, `pr`.`catalogues`, `pr`.`content`,(SELECT fullname FROM users WHERE users.id = `pr`.`userid_created`) as fullname',
                'modules' => 'articles',
                'start' => ($page * $config['per_page']),
                'limit' => $config['per_page'],
                'order_by' => '`pr`.`order` asc,`pr`.`id` desc',
            ), $DetailCatalogues, $this->fc_lang);
            //echo "<pre>";var_dump($data['ArticlesList']);die;
        }
        if (!isset($data['canonical']) || empty($data['canonical'])) {
            $data['canonical'] = $config['base_url'] . $this->config->item('url_suffix');
        }
        // }


        $data['meta_title'] = (!empty($DetailCatalogues['meta_title']) ? $DetailCatalogues['meta_title'] : $DetailCatalogues['title']) . $seoPage;
        $data['meta_keyword'] = $DetailCatalogues['meta_keyword'];
        $data['meta_description'] = (!empty($DetailCatalogues['meta_description']) ? $DetailCatalogues['meta_description'] : cutnchar(strip_tags($DetailCatalogues['description']), 255)) . $seoPage;
        $data['meta_images'] = !empty($DetailCatalogues['images']) ? base_url($DetailCatalogues['images']) : '';
        $data['DetailCatalogues'] = $DetailCatalogues;
//		$data['canonicalcata'] = rewrite_url($DetailCatalogues['canonical'], $DetailCatalogues['slug'], $DetailCatalogues['id'], 'articles_catalogues');

        $data['template'] = 'articles/frontend/catalogues/view';


        $this->load->view('homepage/frontend/layouts/home', isset($data) ? $data : NULL);
    }
    public function hoidap(){
        $data['meta_title'] = "Hỏi đáp";
        $data['meta_keyword'] = "Hỏi đáp";
        $data['meta_description'] = "Hỏi đáp";
        $data['template'] = 'articles/frontend/catalogues/hoidap';
        $this->load->view('homepage/frontend/layouts/home', isset($data) ? $data : NULL);
    }
    public function online(){


        $data['meta_title'] = "Đặt mua online";
        $data['meta_keyword'] = "Đặt mua online";
        $data['meta_description'] = "Đặt mua online";
        $data['template'] = 'articles/frontend/catalogues/online';
        $this->load->view('homepage/frontend/layouts/home', isset($data) ? $data : NULL);
    }

}
