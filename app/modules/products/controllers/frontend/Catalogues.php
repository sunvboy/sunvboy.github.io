<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogues extends FC_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->fc_lang = $this->config->item('fc_lang');
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
        $sort = $this->input->get('sort');
        $checkin = $this->input->get('checkin');
        $checkout = $this->input->get('checkout');
        $data['adultsget'] = $this->input->get('adults');
        $data['Childrenget'] = $this->input->get('children');
        $data['titleget'] = $this->input->get('title');

        $DetailCatalogues = $this->FrontendProductsCatalogues_Model->ReadByField('id', $id, $this->fc_lang);
        if (!isset($DetailCatalogues) && !is_array($DetailCatalogues) && count($DetailCatalogues) == 0) {
            $this->session->set_flashdata('message-danger', $this->lang->line('error_products_catalogues'));
            redirect(base_url());
        }
        $data['cat_child'] = $this->FrontendProductsCatalogues_Model->ReadByCondition(array(
            'select' => 'id, title, slug, canonical, albums, images, lft, rgt,description', 'where'
            => array('trash' => 0, 'publish' => 1, 'parentid' => $id, 'alanguage' => '' . $this->fc_lang . ''),
            'limit' => 1000, 'order_by' => 'order asc, id desc'));


        $data['Breadcrumb'] = $this->FrontendProductsCatalogues_Model->Breadcrumb($DetailCatalogues['lft'], $DetailCatalogues['rgt'], $this->fc_lang);

        $config['total_rows'] = $this->FrontendProducts_Model->_count(array(
            'select' => '`pr`.`id`',
            'modules' => 'products',
        ), $DetailCatalogues, $this->fc_lang);

        $config['base_url'] = rewrite_url($DetailCatalogues['canonical'], $DetailCatalogues['slug'], $DetailCatalogues['id'], 'products_catalogues', FALSE, TRUE);
        if ($config['total_rows'] > 0) {
            $this->load->library('pagination');
            $config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
            $config['prefix'] = 'trang-';
            $config['first_url'] = $config['base_url'] . $config['suffix'];
            $config['per_page'] = 10;
            $config['uri_segment'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['full_tag_open'] = '<ul class="pull-right pagination text-center" style="display: flex;justify-content: center">';
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

            if ($sort != null) {
                if ($sort == 'new') {
                    $order = '`pr`.`id` desc';
                }
                if ($sort == 'price-asc') {
                    $order = '`pr`.`saleoff` asc';
                }
                if ($sort == 'price-desc') {
                    $order = '`pr`.`saleoff` desc';
                }
                if ($sort == 'name-asc') {
                    $order = '`pr`.`title` asc';
                }
                if ($sort == 'name-desc') {
                    $order = '`pr`.`title` desc';
                }
            } else {
                $order = '`pr`.`id` desc';
            }
            $page = $page - 1;
            $data['productsList'] = $this->FrontendProducts_Model->_viewproducts(array(
                'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`description`, `pr`.`price`, `pr`.`saleoff`, `pr`.`content4`, `pr`.`isfooter`, `pr`.`albums`, `pr`.`content`',
                'modules' => 'products',
                'order_by' => '' . $order . '',
                'start' => ($page * $config['per_page']),
                'limit' => $config['per_page'],
            ), $DetailCatalogues, $this->fc_lang);
            //echo $this->db->last_query();die;
            if (!isset($data['canonical']) || empty($data['canonical'])) {
                $data['canonical'] = $config['base_url'] . $this->config->item('url_suffix');
            }
        }
        $data['link'] = 'products.html';
        $data['meta_title'] = (!empty($DetailCatalogues['meta_title']) ? $DetailCatalogues['meta_title'] : $DetailCatalogues['title']) . $seoPage;
        $data['meta_keyword'] = $DetailCatalogues['meta_keyword'];
        $data['meta_description'] = (!empty($DetailCatalogues['meta_description']) ? $DetailCatalogues['meta_description'] : cutnchar(strip_tags($DetailCatalogues['description']), 255)) . $seoPage;
        $data['meta_images'] = !empty($DetailCatalogues['images']) ? base_url($DetailCatalogues['images']) : '';
        $data['DetailCatalogues'] = $DetailCatalogues;
//        if($data['DetailCatalogues']['ishome']==1){
//            $data['template'] = 'products/frontend/catalogues/view';
//
//        }else{
//            if ($data['DetailCatalogues']['rgt'] - $data['DetailCatalogues']['lft'] > 1) {
//                $data['template'] = 'products/frontend/catalogues/child_2';
//            }else{
//                $data['template'] = 'products/frontend/catalogues/child';
//
//            }
//        }
        if ($data['DetailCatalogues']['rgt'] - $data['DetailCatalogues']['lft'] > 1 && $data['DetailCatalogues']['parentid']==0) {
            $data['template'] = 'products/frontend/catalogues/view';
        } else {
            $data['template'] = 'products/frontend/catalogues/child';

        }
        $this->load->view('homepage/frontend/layouts/home', isset($data) ? $data : NULL);
    }
}
