<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogues extends FC_Controller
{

    public function __construct()
    {
        parent::__construct();
        /* KIỂM TRA TÌNH TRẠNG WEBSITE */
        $this->fc_lang = $this->config->item('fc_lang');
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
        $DetailCatalogues = $this->FrontendGallerysCatalogues_Model->ReadByField('id', $id, $this->fc_lang);
        if (!isset($DetailCatalogues) && !is_array($DetailCatalogues) && count($DetailCatalogues) == 0) {
            $this->session->set_flashdata('message-danger', 'Danh mục hình ảnh không tồn tại');
            redirect(base_url());
        }
        $data['listcat'] = $this->FrontendGallerysCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, lft, rgt,description', 'where' => array('trash' => 0, 'publish' => 1, 'parentid' => $id, 'alanguage' => '' . $this->fc_lang . ''), 'limit' => 1000, 'order_by' => 'order asc, id desc'));
        if (isset($data['listcat']) && is_array($data['listcat']) && count($data['listcat'])) {
            foreach ($data['listcat'] as $key => $val) {

                $data['listcat'][$key]['child'] = $this->FrontendGallerysCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, lft, rgt,description', 'where' => array('trash' => 0, 'publish' => 1, 'parentid' => $val['id'], 'alanguage' => '' . $this->fc_lang . ''), 'limit' => 1000, 'order_by' => 'order asc, id desc'));
                if (isset($data['listcat'][$key]['child']) && is_array($data['listcat'][$key]['child']) && count($data['listcat'][$key]['child'])) {
                    foreach ($data['listcat'][$key]['child'] as $keyP => $valP) {

                        $data['listcat'][$key]['child'][$keyP]['post'] = $this->FrontendGallerys_Model->_read_condition(array(
                            'modules' => 'gallerys',
                            'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`description`, `pr`.`t1`, `pr`.`t2`, `pr`.`t3`, `pr`.`t4`, `pr`.`t5`, `pr`.`t6`, `pr`.`t7`, `pr`.`t8`, `pr`.`t9`, `pr`.`t10`, `pr`.`t11`, `pr`.`t12`',
                            'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1  AND `pr`.`alanguage` = \'' . $this->fc_lang . '\'',
                            'limit' => 100,
                            'order_by' => '`pr`.`order` asc, `pr`.`id` asc',
                            'cataloguesid' => $valP['id'],
                        ));

                    }
                }
            }
        }



        //echo "<pre>";var_dump($data['listcat']);die;

        $data['Breadcrumb'] = $this->FrontendGallerysCatalogues_Model->Breadcrumb($DetailCatalogues['lft'], $DetailCatalogues['rgt']);

        $data['idgoc'] = showcatidgoc($DetailCatalogues['id'], $DetailCatalogues['parentid'], 'gallerys');

        $data['parentid_cat'] = $this->FrontendGallerysCatalogues_Model->ReadAllByField('parentid', $data['idgoc'], $this->fc_lang);


        /* -- đếm số bản ghi -- */

        $config['total_rows'] = $this->FrontendGallerys_Model->_count(array(
            'select' => '`pr`.`id`',
            'modules' => 'gallerys',
        ), $DetailCatalogues, $this->fc_lang);
        /* --- */

        $config['base_url'] = rewrite_url($DetailCatalogues['canonical'], $DetailCatalogues['slug'], $DetailCatalogues['id'], 'gallerys_catalogues', FALSE, TRUE);


        if ($config['total_rows'] > 0) {
            $this->load->library('pagination');
            $config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
            $config['prefix'] = 'trang-';
            $config['first_url'] = $config['base_url'] . $config['suffix'];
            $config['per_page'] = 30;
            $config['uri_segment'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['full_tag_open'] = '<ul class="pagination pull-right">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a class="">';
            $config['cur_tag_close'] = '</a></li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
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
            $data['gallerysList'] = $this->FrontendGallerys_Model->_view(array(
                'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`description`, `pr`.`created`, `pr`.`albums`',
                'modules' => 'gallerys',
                'start' => ($page * $config['per_page']),
                'limit' => $config['per_page'],
            ), $DetailCatalogues, $this->fc_lang);
            if (isset($data['gallerysList']) && is_array($data['gallerysList']) && count($data['gallerysList'])) {
                foreach ($data['gallerysList'] as $key => $val) {
                    $data['gallerysList'][$key]['tag'] = $this->FrontendProducts_Model->ReadAllTagsbyProducts($val['id'], 'gallerys');
                }
            }
        }

        $data['danhmuchome'] = $this->FrontendGallerys_Model->_read_condition(array(
            'modules' => 'gallerys',
            'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`created`, `pr`.`description`',
            'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1 AND `pr`.`alanguage` = \'' . $this->fc_lang . '\'',
            'limit' => 10,
            'order_by' => '`pr`.`id` asc',
            'cataloguesid' => $DetailCatalogues['id'],
        ));

        $data['tagall'] = $this->FrontendTags_Model->ReadByModules();

        $data['meta_title'] = (!empty($DetailCatalogues['meta_title']) ? $DetailCatalogues['meta_title'] : $DetailCatalogues['title']) . $seoPage;
        $data['meta_keyword'] = $DetailCatalogues['meta_keyword'];
        $data['meta_description'] = (!empty($DetailCatalogues['meta_description']) ? $DetailCatalogues['meta_description'] : cutnchar(strip_tags($DetailCatalogues['description']), 255)) . $seoPage;
        $data['meta_images'] = !empty($DetailCatalogues['images']) ? base_url($DetailCatalogues['images']) : '';
        $data['DetailCatalogues'] = $DetailCatalogues;
        if (!isset($data['canonical']) || empty($data['canonical'])) {
            $data['canonical'] = $config['base_url'] . $this->config->item('url_suffix');
        }
        $data['template'] = 'gallerys/frontend/catalogues/view';
        $this->load->view('homepage/frontend/layouts/home', isset($data) ? $data : NULL);
    }
}
