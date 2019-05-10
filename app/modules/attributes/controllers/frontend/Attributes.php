<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Attributes extends FC_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->fc_lang = $this->config->item('fc_lang');
        $this->load->model(array('slides/FrontendSlides_Model', 'address/Frontendaddress_Model', 'lichhoc/FrontendChungchi_Model'));
        $this->load->library(array('lichhoc/configbie'));
        $this->fcCustomer = $this->config->item('fcCustomer');

    }

    public function View($id = 0, $page = 1)
    {

        $catid = intval($this->input->get('catid'));


        $data['DetailCatalogues'] = $this->FrontendProductsCatalogues_Model->ReadByField('id', $catid);


        $id = (int)$id;
        $page = (int)$page;
        $seoPage = '';
        $DetailAttributes = $this->FrontendAttributes_Model->ReadByField('id', $id);
        $config['total_rows'] = $this->FrontendAttributes_Model->CountAllAtrributes($id);
        $config['base_url'] = '' . slug($DetailAttributes['title']) . '-' . 'att' . $DetailAttributes['id'];
        if ($config['total_rows'] > 0) {
            $this->load->library('pagination');
            $config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
            $config['prefix'] = 'trang-';
            $config['first_url'] = $config['base_url'] . $config['suffix'];
            $config['per_page'] = 16;
            $config['uri_segment'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['full_tag_open'] = '<div class="fc-pagination uk-text-center margin-top-25px"><ul class="uk-pagination uk-display-inline-block uk-margin-remove">';
            $config['full_tag_close'] = '</ul></div>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><span>';
            $config['cur_tag_close'] = '</span></li>';
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
            $data['AttributesList'] = $this->FrontendAttributes_Model->ReadAllAttribute($id, ($page * $config['per_page']), $config['per_page']);

        }
        if (isset($data['AttributesList']) && is_array($data['AttributesList']) && count($data['AttributesList'])) {
            foreach ($data['AttributesList'] as $key => $val) {
                $data['AttributesList'][$key]['attributes'] = $this->FrontendProducts_Model->AttributesAllTheTime($val['id']);
            }
        }

        $data['attrid'] = array($id);
        $data['DetailAttributes'] = $DetailAttributes;
        $data['base_url'] = $config['base_url'];
        $data['meta_title'] = $DetailAttributes['title'];
        $data['meta_keyword'] = $DetailAttributes['title'];
        $data['meta_description'] = $DetailAttributes['title'];
        $data['meta_images'] = '';
        $data['header'] = 'homepage/frontend/common/header_detail';
        $data['template'] = 'attributes/frontend/attributes/view';
        $this->load->view('homepage/frontend/layouts/home', isset($data) ? $data : NULL);
    }

    public function Filter($cataloguesid = 0, $attrid = 0, $page = 1)
    {
        $catalogues = '';
        if ($cataloguesid > 0) {
            $catalogues = catalogues_relationship($cataloguesid, 'products', array('BackendProducts', 'BackendProductsCatalogues'), 'products_catalogues');
        }

        $config['total_rows'] = $this->FrontendAttributes_Model->CountAllFilter($catalogues, $attrid);
        $segment = $this->uri->segment(1);
        $config['base_url'] = $segment;
        if ($config['total_rows'] > 0) {
            $this->load->library('pagination');
            $config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
            $config['prefix'] = 'trang-';
            $config['first_url'] = $config['base_url'] . $config['suffix'];
            $config['per_page'] = 16;
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
            $totalPage = ceil($config['total_rows'] / $config['per_page']);
            $page = ($page <= 0) ? 1 : $page;
            $page = ($page > $totalPage) ? $totalPage : $page;
            $seoPage = ($page >= 2) ? (' - Trang ' . $page) : '';
            if ($page >= 2) {
                $data['canonical'] = $config['base_url'] . '/trang-' . $page . $this->config->item('url_suffix');
            }
            $page = $page - 1;
            $data['productsList'] = $this->FrontendAttributes_Model->ReadAllFilter($catalogues, $attrid, ($page * $config['per_page']), $config['per_page']);

        }
        if (isset($data['productsList']) && is_array($data['productsList']) && count($data['productsList'])) {
            foreach ($data['productsList'] as $key => $val) {
                $data['productsList'][$key]['attributes'] = $this->FrontendProducts_Model->AttributesAllTheTime($val['id']);

                if (isset($data['productsList'][$key]['attributes']) && is_array($data['productsList'][$key]['attributes']) && count($data['productsList'][$key]['attributes'])) {


                }

            }

        }

        $data['meta_title'] = 'Tìm ki?m';
        $data['meta_keyword'] = '';
        $data['meta_description'] = '';
        $data['template'] = 'attributes/frontend/attributes/filter';
        $this->load->view('homepage/frontend/layouts/home', isset($data) ? $data : NULL);
    }
}
