<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends FC_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $this->fc_lang = $this->config->item('fc_lang');
//        $this->load->model(array('slides/FrontendSlides_Model', 'address/Frontendaddress_Model', 'lichhoc/FrontendChungchi_Model', 'articles/BackendArticlesCatalogues_Model'));
        $this->load->library(array('configbie'));
        $this->fcCustomer = $this->config->item('fcCustomer');
        $this->perPage = 1;
    }

//    public function getCountry()
//    {
//        $page = $_GET['page'];
//
//        $danhmuchome = $this->FrontendProductsCatalogues_Model->ReadByCondition(array(
//            'select' => 'id, title, slug, canonical, albums, images, lft, rgt', 'where'
//            => array('trash' => 0, 'publish' => 1, 'ishome' => 1, 'alanguage' => '' . $this->fc_lang . ''),
//            'limit' => 1, 'order_by' => 'order asc, id desc'));
//
//        if (is_array($danhmuchome) && isset($danhmuchome) && count($danhmuchome)) {
//            foreach ($danhmuchome as $key => $val) {
//                $danhmuchome[$key]['post'] = $this->FrontendProductsCatalogues_Model->ReadByConditionajax(array(
//                    'select' => 'id, title, slug, canonical, albums, images,,description', 'where'
//                    => array('cataloguesid' => $val['id'], 'trash' => 0, 'publish' => 1, 'alanguage' => '' . $this->fc_lang . ''),
//                    'limit' => $page, 'order_by' => 'order asc, id desc'), $page);
//            }
//
//        }
//        if (is_array($danhmuchome) && isset($danhmuchome) && count($danhmuchome)) {
//            $i = 0;
//            foreach ($danhmuchome as $key => $value) {
//                $i++;
//                if (is_array($value['post']) && isset($value['post']) && count($value['post'])) {
//                    $i = 0;
//                    foreach ($value['post'] as $keyP => $val) {
//                        $i++;
//                        echo '<div class="col-md-3 col-sm-6 col-xs-12">
//                            <div class="item">
//                                <div class="images">
//                                    <a href="javascript:void();"><img src="' . $val['images'] . '"
//                                                    alt="' . $val['title'] . '"></a>
//                                </div>
//                                <div class="nav-img">
//                                    <h3 class="title2">' . $val['title'] . '</h3>
//
//                                    <p class="price">' . cutnchar(strip_tags($val['description']), 50) . '</p>
//                                </div>
//                            </div>
//                        </div>';
//                    }
//                }
//
//            }
//        }
//        exit;
//    }


    public function Index()
    {


        /* KIỂM TRA TÌNH TRẠNG WEBSITE */
        if ($this->fcSystem['homepage_website'] == 1) {
            echo '<img src="' . base_url() . 'templates/backend/images/close.jpg' . '" style="width:100%;" />';
            die();
        }
//        $data['sanphamkhuyenmai'] = $this->FrontendProducts_Model->ReadByCondition(array(
//            'select' => 'id, title, slug, canonical,saleoff,price,images',
//            'table' => 'articles',
//            'where' => array('psale' => 1, 'publish' => 1, 'trash' => 0, 'alanguage' => $this->fc_lang),
//            'limit' => 6,
//            'order_by' => 'order asc, id desc',
//        ));
        //var_dump($data['sanphambanchay'] );die;
//        $data['cackhoahoc'] = $this->FrontendArticles_Model->ReadByCondition(array(
//            'select' => 'id, title, slug, canonical,description,images,content,albums',
//            'table' => 'articles',
//            'where' => array('ishome' => 1,'publish' => 1, 'trash' => 0, 'alanguage' => $this->fc_lang),
//            'limit' => 6,
//            'order_by' => 'order asc, id desc',
//        ));
        $data['thanhtichcao'] = $this->FrontendArticles_Model->ReadByCondition(array(
            'select' => 'id, title, slug, canonical,description,images,albums',
            'table' => 'articles',
            'where' => array('ishome' => 1,'publish' => 1, 'trash' => 0, 'alanguage' => $this->fc_lang),
            'limit' => 1,
            'order_by' => 'order asc, id desc',
        ));
        $data['phuhuynh'] = $this->FrontendArticles_Model->ReadByCondition(array(
            'select' => 'id, title, slug, canonical,description,images,album	',
            'table' => 'articles',
            'where' => array('highlight' => 1,'publish' => 1, 'trash' => 0, 'alanguage' => $this->fc_lang),
            'limit' => 1,
            'order_by' => 'order asc, id desc',
        ));

//
        $data['cackhoahoc'] = $this->FrontendArticlesCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, lft, rgt,description', 'where' => array('trash' => 0, 'publish' => 1, 'isaside' => 1, 'alanguage' => '' . $this->fc_lang . ''), 'limit' => 1, 'order_by' => 'order asc, id desc'));
        if (isset($data['cackhoahoc']) && is_array($data['cackhoahoc']) && count($data['cackhoahoc'])) {
            foreach ($data['cackhoahoc'] as $key => $val) {
                $data['cackhoahoc'][$key]['post'] = $this->FrontendArticles_Model->_read_condition(array(
                    'modules' => 'articles',
                    'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`description`, `pr`.`content`, `pr`.`cataloguesid`, `pr`.`viewed`, `pr`.`created`',
                    'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1 AND `pr`.`alanguage` = \'' . $this->fc_lang . '\'',
                    'limit' => 4,
                    'order_by' => '`pr`.`order` asc, `pr`.`id` desc',
                    'cataloguesid' => $val['id'],
                ));
            }
        }
        $data['sukienuudai'] = $this->FrontendArticlesCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, lft, rgt,description', 'where' => array('trash' => 0, 'publish' => 1, 'isfooter' => 1, 'alanguage' => '' . $this->fc_lang . ''), 'limit' => 1, 'order_by' => 'order asc, id desc'));
        if (isset($data['sukienuudai']) && is_array($data['sukienuudai']) && count($data['sukienuudai'])) {
            foreach ($data['sukienuudai'] as $key => $val) {
                $data['sukienuudai'][$key]['post'] = $this->FrontendArticles_Model->_read_condition(array(
                    'modules' => 'articles',
                    'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`description`, `pr`.`content`, `pr`.`cataloguesid`, `pr`.`viewed`, `pr`.`created`',
                    'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1 AND `pr`.`alanguage` = \'' . $this->fc_lang . '\'',
                    'limit' => 3,
                    'order_by' => '`pr`.`order` asc, `pr`.`id` desc',
                    'cataloguesid' => $val['id'],
                ));
            }
        }
        $data['truyenthong'] = $this->FrontendArticlesCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, lft, rgt,description', 'where' => array('trash' => 0, 'publish' => 1, 'highlight' => 1, 'alanguage' => '' . $this->fc_lang . ''), 'limit' => 1, 'order_by' => 'order asc, id desc'));
        if (isset($data['truyenthong']) && is_array($data['truyenthong']) && count($data['truyenthong'])) {
            foreach ($data['truyenthong'] as $key => $val) {
                $data['truyenthong'][$key]['post'] = $this->FrontendArticles_Model->_read_condition(array(
                    'modules' => 'articles',
                    'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`description`, `pr`.`content`, `pr`.`cataloguesid`, `pr`.`viewed`, `pr`.`created`',
                    'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1 AND `pr`.`alanguage` = \'' . $this->fc_lang . '\'',
                    'limit' => 3,
                    'order_by' => '`pr`.`order` asc, `pr`.`id` desc',
                    'cataloguesid' => $val['id'],
                ));
            }
        }

        $data['doingugiangvien'] = $this->FrontendArticlesCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, lft, rgt,description', 'where' => array('trash' => 0, 'publish' => 1, 'ishome' => 1, 'alanguage' => '' . $this->fc_lang . ''), 'limit' => 1, 'order_by' => 'order asc, id desc'));
        if (isset($data['doingugiangvien']) && is_array($data['doingugiangvien']) && count($data['doingugiangvien'])) {
            foreach ($data['doingugiangvien'] as $key => $val) {
                $data['doingugiangvien'][$key]['post'] = $this->FrontendArticles_Model->_read_condition(array(
                    'modules' => 'articles',
                    'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`description`, `pr`.`content`, `pr`.`cataloguesid`, `pr`.`viewed`, `pr`.`created`',
                    'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1 AND `pr`.`alanguage` = \'' . $this->fc_lang . '\'',
                    'limit' => 1000,
                    'order_by' => '`pr`.`order` asc, `pr`.`id` desc',
                    'cataloguesid' => $val['id'],
                ));
            }
        }
//        $data['trainghiem'] = $this->FrontendArticlesCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, lft, rgt,images,description', 'where' => array('trash' => 0, 'publish' => 1, 'ishome' => 1, 'parentid' => 0, 'alanguage' => '' . $this->fc_lang . ''), 'limit' => 1, 'order_by' => 'order asc, id desc'));
//        if (isset($data['trainghiem']) && is_array($data['trainghiem']) && count($data['trainghiem'])) {
//            foreach ($data['trainghiem'] as $key => $val) {
//                $data['trainghiem'][$key]['post'] = $this->FrontendArticles_Model->_read_condition(array(
//                    'modules' => 'articles',
//                    'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`description`, `pr`.`cataloguesid`,`pr`.`content`, `pr`.`viewed`, `pr`.`created`',
//                    'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1 AND `pr`.`alanguage` = \'' . $this->fc_lang . '\'',
//                    'limit' => 2,
//                    'order_by' => '`pr`.`order` asc, `pr`.`id` desc',
//                    'cataloguesid' => $val['id'],
//                ));
////                $data['trainghiem'][$key]['child'] = $this->FrontendArticlesCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, lft, rgt,description', 'where' => array('trash' => 0, 'publish' => 1, 'parentid' => $val['id'], 'alanguage' => '' . $this->fc_lang . ''), 'limit' => 10, 'order_by' => 'order asc, id desc'));
////                if (isset($data['trainghiem'][$key]['child']) && is_array($data['trainghiem'][$key]['child']) && count($data['trainghiem'][$key]['child'])) {
////                    foreach ($data['trainghiem'][$key]['child'] as $keyCP => $valCP) {
////                        $data['trainghiem'][$key]['child'][$keyCP]['postCP'] = $this->FrontendArticles_Model->_read_condition(array(
////                            'modules' => 'articles',
////                            'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`description`, `pr`.`cataloguesid`,`pr`.`content`, `pr`.`viewed`, `pr`.`created`',
////                            'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1 AND `pr`.`alanguage` = \'' . $this->fc_lang . '\'',
////                            'limit' => 5,
////                            'order_by' => '`pr`.`order` asc, `pr`.`id` desc',
////                            'cataloguesid' => $valCP['id'],
////                        ));
////                    }
////                }
//            }
//        }
//        $data['hinhanh'] = $this->FrontendGallerysCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, lft, rgt', 'where' => array('trash' => 0, 'publish' => 1, 'ishome' => 1, 'alanguage' => '' . $this->fc_lang . ''), 'limit' => 1, 'order_by' => 'order asc, id desc'));
//        if (isset($data['hinhanh']) && is_array($data['hinhanh']) && count($data['hinhanh'])) {
//            foreach ($data['hinhanh'] as $key => $val) {
//                $data['hinhanh'][$key]['post'] = $this->FrontendGallerys_Model->_read_condition(array(
//                    'modules' => 'gallerys',
//                    'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`description`',
//                    'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1  AND `pr`.`alanguage` = \'' . $this->fc_lang . '\'',
//                    'limit' => 1000,
//                    'order_by' => '`pr`.`order` asc, `pr`.`id` asc',
//                    'cataloguesid' => $val['id'],
//                ));
//            }
//        }
        $data['hinhanh'] = $this->FrontendGallerys_Model->ReadByCondition(array(
            'select' => 'id, title, slug, canonical,description,albums',
            'table' => 'gallerys',
            'where' => array('highlight' => 1,'publish' => 1, 'trash' => 0, 'alanguage' => $this->fc_lang),
            'limit' => 1,
            'order_by' => 'order asc, id desc',
        ));
        //var_dump($data['hinhanh']);die;
        $data['videos'] = $this->FrontendVideosCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, lft, rgt,description', 'where' => array('trash' => 0, 'publish' => 1, 'ishome' => 1, 'alanguage' => '' . $this->fc_lang . ''), 'limit' => 1, 'order_by' => 'order asc, id desc'));
        if (isset($data['videos']) && is_array($data['videos']) && count($data['videos'])) {
            foreach ($data['videos'] as $key => $val) {
                $data['videos'][$key]['post'] = $this->FrontendVideos_Model->_read_condition(array(
                    'modules' => 'videos',
                    'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`viewed`, `pr`.`videos_code`',
                    'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1  AND `pr`.`alanguage` = \'' . $this->fc_lang . '\'',
                    'limit' => 5,
                    'order_by' => '`pr`.`order` asc, `pr`.`id` asc',
                    'cataloguesid' => $val['id'],
                ));
            }
        }
//
//        $data['danhmuchome'] = $this->FrontendProductsCatalogues_Model->ReadByCondition(array(
//            'select' => 'id, title, slug, canonical, description, images, lft, rgt', 'where'
//            => array('trash' => 0, 'publish' => 1, 'ishome' => 1, 'alanguage' => '' . $this->fc_lang . ''),
//            'limit' => 1, 'order_by' => 'order asc, id desc'));

//
//
//
//        $data['danhmuchighlight'] = $this->FrontendProductsCatalogues_Model->ReadByCondition(array(
//            'select' => 'id, title, slug, canonical, attributes, images, lft, rgt', 'where'
//            => array('trash' => 0, 'publish' => 1, 'ishome' => 1, 'alanguage' => '' . $this->fc_lang . ''),
//            'limit' => 100, 'order_by' => 'order asc, id desc'));
//        if (isset($data['danhmuchighlight']) && is_array($data['danhmuchighlight']) && count($data['danhmuchighlight'])) {
//            foreach ($data['danhmuchighlight'] as $key => $val) {
//                $data['danhmuchighlight'][$key]['post'] = $this->FrontendProducts_Model->_read_condition(array(
//                    'modules' => 'products',
//                    'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`price`, `pr`.`saleoff`, `pr`.`description`, `pr`.`content`, `pr`.`content1`',
//                    'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1 AND `pr`.`alanguage` = \'' . $this->fc_lang . '\'',
//                    'limit' => 8,
//                    'order_by' => '`pr`.`order` asc, `pr`.`id` asc',
//                    'cataloguesid' => $val['id'],
//                ));
////                $data['danhmuchighlight'][$key]['child'] = $this->FrontendProductsCatalogues_Model->ReadByCondition(array(
////                    'select' => 'id, title, slug, canonical, albums, images, lft, rgt',
////                    'where' => array('trash' => 0, 'publish' => 1, 'parentid' => $val['id'], 'alanguage' => '' . $this->fc_lang . ''),
////                    'limit' => 100,
////                    'order_by' => 'order asc, id desc',
////                ));
////                if (isset($data['danhmuchighlight'][$key]['child']) && is_array($data['danhmuchighlight'][$key]['child']) && count($data['danhmuchighlight'][$key]['child'])) {
////                    foreach ($data['danhmuchighlight'][$key]['child'] as $keyC => $valC) {
////                        $data['danhmuchighlight'][$key]['child'][$keyC]['post'] = $this->FrontendProducts_Model->_read_condition(array(
////                            'modules' => 'products',
////                            'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`price`, `pr`.`saleoff`, `pr`.`description`, `pr`.`content`, `pr`.`content1`',
////                            'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1 AND `pr`.`alanguage` = \'' . $this->fc_lang . '\'',
////                            'limit' => 8,
////                            'order_by' => '`pr`.`order` asc, `pr`.`id` asc',
////                            'cataloguesid' => $valC['id'],
////                        ));
////
////                    }
////                }
//            }
//        }
        //echo "<pre>";var_dump($data['danhmuchighlight']);die();


        $data['meta_title'] = $this->fcSystem['seo_meta_title'];
        $data['meta_keyword'] = $this->fcSystem['seo_meta_keywords'];
        $data['meta_description'] = $this->fcSystem['seo_meta_description'];
        $data['template'] = 'homepage/frontend/home/index';
        $this->load->view('homepage/frontend/layouts/home', isset($data) ? $data : NULL);
    }


    public function load_items()
    {

        $page = $this->input->post('page');

        $order = $this->input->post('order');
        $page = (int)$page;
        $config['total_rows'] = $this->FrontendArticles_Model->CountAllItems();
//        var_dump($config['total_rows']);
        if ($config['total_rows'] > 0) {
            $this->load->library('pagination');
            $config['base_url'] = '#" data-page="';
            $config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
            $config['first_url'] = $config['base_url'] . $config['suffix'];
            $config['per_page'] = 10;
            $config['cur_page'] = $page;
            $config['page'] = $page;
            $config['uri_segment'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['full_tag_open'] = '<div class="list-bottom-left-main"><ul id="ajax-pagination" class="pagination pull-right">';
            $config['full_tag_close'] = '</ul></div>';
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
            $data['listPagination'] = $this->pagination->create_links();
            $totalPage = ceil($config['total_rows'] / $config['per_page']);
            $page = ($page <= 0) ? 1 : $page;
            $page = ($page > $totalPage) ? $totalPage : $page;
            $page = $page - 1;
            $ListProductItems = $this->FrontendArticles_Model->ReadAllItems(($page * $config['per_page']), $config['per_page'], $order);
            // echo $this->db->last_query();die;
        }

        // var_dump($ListProductItems);die();
        $html = '';
        // $ListProductItems = $this->FrontendProducts_Model->ReadAllItems();
        if (isset($ListProductItems) && is_array($ListProductItems) && count($ListProductItems)) {
            foreach ($ListProductItems as $key => $val) {

                $html .= '<div class="fitwp_question"><p class="question-title"><a href="" title="Mình muốn đặt hàng">' . $val['title'] . '</a><br>Hỏi bởi: <span class="name-name">' . $val['fullname'] . '</span><br>Đăng ngày: <span class="question-time">' . $val['created'] . '</span><br><br>Câu hỏi: <span class="question-time">' . $val['message'] . '</span>';

                $html .= '<div class="answer-title1">Trả lời:</div> <div class="answer-content">' . $val['description'] . '</div></p></div> <div class="clearfix"></div>';
            }
            $html = $html . $data['listPagination'];
        }
        echo json_encode(
            array('html' => $html, 'page' => (4))
        );
        die();
    }
    /*
      public function load_items_xemnhieu()
      {

          $page = $this->input->post('page');

          $order = $this->input->post('order');
          $page = (int)$page;
          $config['total_rows'] = $this->FrontendHomePage_Model->CountAllItemsViewed();
  //        var_dump($config['total_rows']);
          if ($config['total_rows'] > 0) {
              $this->load->library('pagination');
              $config['base_url'] = '#" data-page="';
              $config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
              $config['first_url'] = $config['base_url'] . $config['suffix'];
              $config['per_page'] = 5;
              $config['cur_page'] = $page;
              $config['page'] = $page;
              $config['uri_segment'] = 2;
              $config['use_page_numbers'] = TRUE;
              $config['reuse_query_string'] = TRUE;
              $config['full_tag_open'] = '<div class="list-number"><ul id="ajax-pagination-xemnhieu">';
              $config['full_tag_close'] = '</ul></div>';
              $config['first_tag_open'] = '<li>';
              $config['first_tag_close'] = '</li>';
              $config['last_tag_open'] = '<li>';
              $config['last_tag_close'] = '</li>';
              $config['cur_tag_open'] = '<li class="active"><a style="color: #ff5912">';
              $config['cur_tag_close'] = '</a></li>';
              $config['next_tag_open'] = '<li>';
              $config['next_tag_close'] = '</li>';
              $config['prev_tag_open'] = '<li>';
              $config['prev_tag_close'] = '</li>';
              $config['num_tag_open'] = '<li>';
              $config['num_tag_close'] = '</li>';
              $this->pagination->initialize($config);
              $data['listPagination'] = $this->pagination->create_links();
              $totalPage = ceil($config['total_rows'] / $config['per_page']);
              $page = ($page <= 0) ? 1 : $page;
              $page = ($page > $totalPage) ? $totalPage : $page;
              $page = $page - 1;
              $ListProductItems = $this->FrontendHomePage_Model->ReadAllItemsViewed(($page * $config['per_page']), $config['per_page'], $order);
              // echo $this->db->last_query();die;
          }
          // var_dump($ListProductItems);die();
          $html = '';
          // $ListProductItems = $this->FrontendProducts_Model->ReadAllItems();
          if (isset($ListProductItems) && is_array($ListProductItems) && count($ListProductItems)) {
              foreach ($ListProductItems as $key => $val) {
                  $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');

                  $description = cutnchar(strip_tags($val['description']), 300);
                  $html .= '<li class="title-heading-img-text" id="itemsid-' . ($key + 1) . '" data-id="' . ($key + 1) . '" style="    margin-bottom: 0px;">';

                  $html .= '<div class="img-next-tt">';
                  $html .= '<a href="' . $href . '"><img src="' . getthumb($val['images'], TRUE) . '" class="ui small image"></a></div>';

                  $html .= '<div class="text-next-tt"><a href="' . $href . '">';
                  $html .= $val['title'];
                  $html .= '</a></div>';
                  $html .= '</li>';
              }
              $html = $html . $data['listPagination'];
          }
          echo json_encode(
              array('html' => $html, 'page' => (4))
          );
          die();
      }

      public function load_items_moinhat()
      {

          $page = $this->input->post('page');

          $order = $this->input->post('order');
          $page = (int)$page;
          $config['total_rows'] = $this->FrontendHomePage_Model->CountAllItemsId();
  //        var_dump($config['total_rows']);
          if ($config['total_rows'] > 0) {
              $this->load->library('pagination');
              $config['base_url'] = '#" data-page="';
              $config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
              $config['first_url'] = $config['base_url'] . $config['suffix'];
              $config['per_page'] = 5;
              $config['cur_page'] = $page;
              $config['page'] = $page;
              $config['uri_segment'] = 2;
              $config['use_page_numbers'] = TRUE;
              $config['reuse_query_string'] = TRUE;
              $config['full_tag_open'] = '<div class="list-number"><ul id="ajax-pagination-moinhat">';
              $config['full_tag_close'] = '</ul></div>';
              $config['first_tag_open'] = '<li>';
              $config['first_tag_close'] = '</li>';
              $config['last_tag_open'] = '<li>';
              $config['last_tag_close'] = '</li>';
              $config['cur_tag_open'] = '<li class="active"><a style="color: #ff5912">';
              $config['cur_tag_close'] = '</a></li>';
              $config['next_tag_open'] = '<li>';
              $config['next_tag_close'] = '</li>';
              $config['prev_tag_open'] = '<li>';
              $config['prev_tag_close'] = '</li>';
              $config['num_tag_open'] = '<li>';
              $config['num_tag_close'] = '</li>';
              $this->pagination->initialize($config);
              $data['listPagination'] = $this->pagination->create_links();
              $totalPage = ceil($config['total_rows'] / $config['per_page']);
              $page = ($page <= 0) ? 1 : $page;
              $page = ($page > $totalPage) ? $totalPage : $page;
              $page = $page - 1;
              $ListProductItems = $this->FrontendHomePage_Model->ReadAllItemsId(($page * $config['per_page']), $config['per_page'], $order);
              // echo $this->db->last_query();die;
          }
          // var_dump($ListProductItems);die();
          $html = '';
          // $ListProductItems = $this->FrontendProducts_Model->ReadAllItems();
          if (isset($ListProductItems) && is_array($ListProductItems) && count($ListProductItems)) {
              foreach ($ListProductItems as $key => $val) {
                  $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');

                  $description = cutnchar(strip_tags($val['description']), 300);
                  $html .= '<li class="title-heading-img-text" id="itemsid-' . ($key + 1) . '" data-id="' . ($key + 1) . '" style="    margin-bottom: 0px;">';

                  $html .= '<div class="img-next-tt">';
                  $html .= '<a href="' . $href . '"><img src="' . getthumb($val['images'], TRUE) . '" class="ui small image"></a></div>';

                  $html .= '<div class="text-next-tt"><a href="' . $href . '">';
                  $html .= $val['title'];
                  $html .= '</a></div>';
                  $html .= '</li>';
              }
              $html = $html . $data['listPagination'];
          }
          echo json_encode(
              array('html' => $html, 'page' => (4))
          );
          die();
      }

      public function load_items_cmt()
      {

          $page = $this->input->post('page');

          $order = $this->input->post('order');
          $page = (int)$page;
          $config['total_rows'] = $this->FrontendHomePage_Model->CountAllItemsCmt();
  //        var_dump($config['total_rows']);
          if ($config['total_rows'] > 0) {
              $this->load->library('pagination');
              $config['base_url'] = '#" data-page="';
              $config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
              $config['first_url'] = $config['base_url'] . $config['suffix'];
              $config['per_page'] = 5;
              $config['cur_page'] = $page;
              $config['page'] = $page;
              $config['uri_segment'] = 2;
              $config['use_page_numbers'] = TRUE;
              $config['reuse_query_string'] = TRUE;
              $config['full_tag_open'] = '<div class="list-number"><ul id="ajax-pagination-cmt">';
              $config['full_tag_close'] = '</ul></div>';
              $config['first_tag_open'] = '<li>';
              $config['first_tag_close'] = '</li>';
              $config['last_tag_open'] = '<li>';
              $config['last_tag_close'] = '</li>';
              $config['cur_tag_open'] = '<li class="active"><a style="color: #ff5912">';
              $config['cur_tag_close'] = '</a></li>';
              $config['next_tag_open'] = '<li>';
              $config['next_tag_close'] = '</li>';
              $config['prev_tag_open'] = '<li>';
              $config['prev_tag_close'] = '</li>';
              $config['num_tag_open'] = '<li>';
              $config['num_tag_close'] = '</li>';
              $this->pagination->initialize($config);
              $data['listPagination'] = $this->pagination->create_links();
              $totalPage = ceil($config['total_rows'] / $config['per_page']);
              $page = ($page <= 0) ? 1 : $page;
              $page = ($page > $totalPage) ? $totalPage : $page;
              $page = $page - 1;
              $ListProductItems = $this->FrontendHomePage_Model->ReadAllItemsCmt(($page * $config['per_page']), $config['per_page'], $order);
              // echo $this->db->last_query();die;
          }
          // var_dump($ListProductItems);die();
          $html = '';
          // $ListProductItems = $this->FrontendProducts_Model->ReadAllItems();
          if (isset($ListProductItems) && is_array($ListProductItems) && count($ListProductItems)) {
              foreach ($ListProductItems as $key => $val) {
                  $module = $val['module'];
                  $moduleid = $val['moduleid'];
                  $object = $this->Autoload_Model->_get_where(array(
                      'select' => 'id, title, slug, canonical',
                      'table' => $module,
                      'where' => array('publish' => 1, 'trash' => 0, 'id' => $moduleid),
                      'limit' => 1,
                  ));
                  $href = rewrite_url($object['canonical'], $object['slug'], $object['id'], $module);
                  $html .= '<li class="title-heading-img-text" id="itemsid-' . ($key + 1) . '" data-id="' . ($key + 1) . '" style="    margin-bottom: 0px;">';

                  $html .= '<div class="text-next-tt"><a href="' . $href . '">';
                  $html .= $val['fullname'];
                  $html .= '</a><div>' . $val['message'] . '</div></div>';
                  $html .= '</li>';
              }
              $html = $html . $data['listPagination'];
          }
          echo json_encode(
              array('html' => $html, 'page' => (4))
          );
          die();
      }

      public function Sitemap($type = 'html')
      {
          $data['ArticlesNews'] = $this->FrontendArticles_Model->ReadAllForSitemap($this->fc_lang, 0, 0, 100);
          $data['ArticlesCatalogues'] = $this->FrontendArticlesCatalogues_Model->ReadAllForSitemap($this->fc_lang);
          $this->load->view('homepage/frontend/home/sitemap_' . $type, isset($data) ? $data : NULL);
      }

      public function _City()
      {
          $cityid = $this->input->post('cityid');
          if (!isset($cityid) || $cityid == 0 || $cityid == '') {
              $this->form_validation->set_message('_City', 'Địa điểm làm việc trường bắt buộc');
              return FALSE;
          }
          return TRUE;
      }

      public function _Degree()
      {
          $degree = $this->input->post('degree');
          if (!isset($degree) || $degree == 0 || $degree == '') {
              $this->form_validation->set_message('_Degree', 'Trình độ học vấn trường bắt buộc');
              return FALSE;
          }
          return TRUE;
      }

      public function _Form()
      {
          $form = $this->input->post('form');
          if (!isset($form) || $form == 0 || $form == '') {
              $this->form_validation->set_message('_Form', 'Hình thức làm việc trường bắt buộc');
              return FALSE;
          }
          return TRUE;
      }

      public function _Money()
      {
          $money = $this->input->post('money');
          if (!isset($money) || $money == 0 || $money == '') {
              $this->form_validation->set_message('_Money', 'Mức lương trường bắt buộc');
              return FALSE;
          }
          return TRUE;
      }

      public function _Classify()
      {
          $classify = $this->input->post('classify');
          if (!isset($classify) || $classify == 0 || $classify == '') {
              $this->form_validation->set_message('_Classify', 'Xếp loại tốt nghiệp trường bắt buộc');
              return FALSE;
          }
          return TRUE;
      }
      */

}
