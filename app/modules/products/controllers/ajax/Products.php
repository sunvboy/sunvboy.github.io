<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends FC_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'BackendProducts_Model',
            'FrontendProducts_Model',
            'tags/BackendTags_Model',
        ));
        $this->load->library(array('configbie'));
        $this->fc_lang = $this->config->item('fc_lang');
    }

    public function ajax_change_location_ward(){
        $id = (int)$this->input->post('id');
        $ReadByField = $this->FrontendProducts_Model->ReadByFieldAddress($id);
        $_html2 = '';
        if(isset($ReadByField) && is_array($ReadByField) && count($ReadByField)) {
            $address = $this->FrontendProducts_Model->viewaddress('wardid', $id);
        }
        if(isset($address) && is_array($address) && count($address)){
            foreach($address as $key => $val){
                $_html2 = $_html2 . '<tr>
                                <td>'.$val['title'].'</td>
                                <td><p>'.$val['address'].'</p></td>
                                <td align="center">'.$val['phone'].'</td>
                            </tr>';
            }
        }
        echo json_encode(array(
            'html2' => $_html2,
        ));
        die();
    }
    public function ajax_change_location(){
        $id = $this->input->post('id');
        $ReadByField = $this->FrontendProducts_Model->ReadByFieldAddress($id);

        $_html = '';
        $_html2 = '';
        $district = $this->FrontendProducts_Model->location_dropdown(array(
            'where' => array('parentid' => $id),
        ), true);
        if(isset($district) && is_array($district) && count($district)){
            foreach($district as $key => $val){
                $_html = $_html . '<option value="'.$key.'">'.$val.'</option>';
            }
        }


        if(isset($ReadByField) && is_array($ReadByField) && count($ReadByField)) {
            if ($ReadByField['parentid'] == 0) {
                $address = $this->FrontendProducts_Model->viewaddress('cityid', $id);
            } else {
                $address = $this->FrontendProducts_Model->viewaddress('districtid', $id);

            }
        }
        //var_dump($address);die;
        if(isset($address) && is_array($address) && count($address)){
            foreach($address as $key => $val){
                $_html2 = $_html2 . '<tr>
                                <td>'.$val['title'].'</td>
                                <td><p>'.$val['address'].'</p></td>
                                <td align="center">'.$val['phone'].'</td>
                            </tr>';
            }
        }
        //var_dump($_html2);die;
        echo json_encode(array(
            'html' => $_html,
            'html2' => $_html2,
        ));
        die();

    }

    public function sort()
    {
        $data = NULL;
        $post = $this->input->post();
        foreach ($post['order'] as $key => $val) {
            $data[] = array(
                'id' => $key,
                'order' => $val,
            );
        }
        $flag = $this->BackendProducts_Model->UpdateBatchByField($data, 'id');
    }

    public function viewed()
    {
        $id = $this->input->post('id');
        if (!isset($_COOKIE['products_viewed_' . $id])) {
            $flag = $this->FrontendProducts_Model->UpdateViewed('id', $id);
            setcookie('products_viewed_' . $id, 1, NULL, '/');
        }
    }

    public function createLink()
    {
        $link = $this->input->post('canonical');
        $link = slug($link);
    }

    public function sort_order()
    {
        sleep(0.5);
        $id = $this->input->post('id');
        $table = $this->input->post('table');
        $data = $this->input->post('number');
        if (isset($table) && !empty($table) && $id > 0) {
            $this->BackendProducts_Model->_update_sort_order($table, $id, $data);
        }
    }

    public function convert_commas_price()
    {
        $price = $this->input->post('price');
        $price_explode = explode('.', $price);
        if (count($price_explode) == 1) {
            $price = (int)$price;

        } else {
            $price = str_replace('.', '', $price);
            $price = (int)$price;
        }
        $price = str_replace(',', '.', number_format($price));

        echo $price;
        die();
    }

    public function attributes()
    {
        $post = $this->input->post('post');
        $post_array = explode('-', $post);
        $temp = '';
        $_cat_ = '';
        $_attribute_cat = '';
        $_str = '';
        if (isset($post_array) && is_array($post_array) && count($post_array)) {
            $_cat_ = $this->BackendProducts_Model->_get_where(array(
                'select' => 'id, title, slug, canonical, attributes',
                'table' => 'products_catalogues',
                'where' => array('trash' => 0,),
                'where_in' => $post_array,
                'where_in_field' => 'id',
            ), TRUE);
        }

        if (isset($_cat_) && is_array($_cat_) && count($_cat_)) {
            foreach ($_cat_ as $key => $val) {
                $attributes_decode = json_decode($val['attributes'], TRUE);
                $temp['attribute_catalogue'] = $attributes_decode['attribute_catalogue'];
                $temp['attribute'] = $attributes_decode['attribute'];
            }
        }
        if (count($temp['attribute_catalogue']) == 0 || $temp['attribute_catalogue'][0] == '') {
            echo $_str;
            die();
        }


        if (isset($_cat_) && is_array($_cat_) && count($_cat_)) {
            $_attribute_cat = $this->BackendAttributes_Model->_get_where(array(
                'select' => 'id, title, keyword',
                'table' => 'attributes_catalogues',
                'where' => array('trash' => 0),
                'where_in' => $temp['attribute_catalogue'],
                'where_in_field' => 'id'
            ), TRUE);
        }

        if (isset($_attribute_cat) && is_array($_attribute_cat) && count($_attribute_cat)) {
            foreach ($_attribute_cat as $key => $val) {
                $_attribute_cat[$key]['attributes'] = $this->BackendAttributes_Model->_get_where(array(
                    'select' => 'id, title',
                    'table' => 'attributes',
                    'where' => array('trash' => 0, 'cataloguesid' => $val['id']),
                ), TRUE);
            }
        }

        if (isset($_attribute_cat) && is_array($_attribute_cat) && count($_attribute_cat)) {
            foreach ($_attribute_cat as $key => $val) {
                $_str = $_str . '<div class="form-group">';
                $_str = $_str . '<label class="col-sm-2 control-lanel">' . $val['title'] . '</label>';
                $_str = $_str . '<div class="col-sm-10">';
                if (isset($val['attributes']) && is_array($val['attributes']) && count($val['attributes'])) {
                    $_str = $_str . '<div class="checkbox" style="padding:0;">';
                    foreach ($val['attributes'] as $keyAttr => $valAttr) {
                        if (isset($temp['attribute'][$val['keyword']]) && in_array($valAttr['id'], $temp['attribute'][$val['keyword']]) == false) continue;
                        $_str = $_str . '<label class="tpInputLabel" style="width:168px;">';
                        $_str = $_str . '<input name="attr[' . $valAttr['id'] . ']" type="checkbox" class="tpInputCheckbox" value="' . $valAttr['id'] . '" /><span>' . $valAttr['title'] . '</span>';
                        $_str = $_str . '</label>';
                    }
                    $_str = $_str . '</div>';
                }
                $_str = $_str . '</div>';
                $_str = $_str . '</div>';
                $_str = $_str . '<script>$(document).ready(function() {$(".tpInputLabel").on("click", function() {if($(this).find(".tpInputCheckbox").is(":checked")) {$(this).addClass("checked");}else {$(this).removeClass("checked");}});});</script>';
            }
        }
        echo $_str;
        die();
    }

    public function delete()
    {
        $error = true;
        $message = '';
        $id = $this->input->post('post');
        if (isset($id) && is_array($id) && count($id)) {
            foreach ($id as $key => $val) {
                $DetailProducts = $this->BackendProducts_Model->ReadByField('id', $val);
                $flag = $this->BackendProducts_Model->DeleteByField('id', $val);
                if ($flag > 0) {
                    if (!empty($DetailProducts['canonical'])) {
                        $this->BackendRouters_Model->Delete($DetailProducts['canonical'], 'products/frontend/products/view', $DetailProducts['id'], 'number');
                    }
                    $this->BackendProducts_Model->_delete_relationship('products', $val);
                    $this->BackendTags_Model->DeleteByModule($val, 'products');
                    $error = false;
                    $message = 'Bản ghi đã được xóa thành công';
                }
            }
        } else {
            $message = 'Có lỗi trong quá trình xóa bản ghi, vui lòng kiểm tra lại';
        }
        echo json_encode(array(
            'error' => $error,
            'message' => $message,
        ));
        die();
    }

    public function filter()
    {

        $post = $this->input->post('post');
        $attribute = explode('-', $post);
        $page = $this->input->post('page');
        $temp_attribute['cataloguesid'] = $this->input->post('cataloguesid');
        $page = (int)$page;
        $config['total_rows'] = $this->FrontendProducts_Model->countajaxproduct($attribute, $temp_attribute['cataloguesid'], $this->fc_lang);

        $result = '';

        if ($config['total_rows'] > 0) {
            $this->load->library('pagination');
            $config['base_url'] = '#" data-page="';
            $config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
            $config['first_url'] = $config['base_url'] . $config['suffix'];
            $config['per_page'] = 24;
            $config['cur_page'] = $page;
            $config['page'] = $page;
            $config['uri_segment'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['full_tag_open'] = '<div class="pagination mb30"><ul class="uk-pagination uk-pagination-right" id="ajax-pagination">';
            $config['full_tag_close'] = '</ul></div>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="uk-active"><a>';
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
            $data['listProduct'] = $this->FrontendProducts_Model->viewajaxproduct(($page * $config['per_page']), $config['per_page'], $attribute, $temp_attribute['cataloguesid'], $this->fc_lang);
        }

//		trả về html
        $html = '';
        if (isset($data['listProduct']) && is_array($data['listProduct']) && count($data['listProduct'])) {
            foreach ($data['listProduct'] as $key => $value) {

                $highlight = $value['highlight'];
                if($highlight ==0){
                    $titlehighlight = '<span class="status-product bg-red" style="font-size: 10px;">Hết hàng</span>';
                }else{
                    $titlehighlight = '';
                }
                $title = $value['title'];
                $href = rewrite_url($value['canonical'], $value['slug'], $value['id'], 'products');
                $image = getthumb($value['images'], FALSE);
                $price = $value['price'];
                $saleoff = $value['saleoff'];
                if ($price > 0) {
                    $giaold = str_replace(',', '.', number_format($price)) . 'đ';
                } else {
                    $giaold = '';
                }
                if ($saleoff > 0) {
                    $gia = str_replace(',', '.', number_format($saleoff)) . 'đ';
                } else {
                    $gia = 'Liên hệ';
                }
                if ($saleoff > 0 && $price > 0 && $saleoff < $price) {
                    $sale = ceil(($price - $saleoff) / $price * 100);
                    $price_sale = str_replace(',', '.', number_format($price - $saleoff)) . '?';
                } else {
                    $sale = $price_sale = '';
                }
                $html = $html . '<div class="list-item col-md-3 col-sm-6 col-xs-6"><div class="item-product hover-action-product style-view-2"><div class="img bg-img-142" title="'.$title.'">'.$titlehighlight.'<a href="'.$href.'" title="'.$title.'"><img src="'.$image.'" alt="'.$href.'" class="img-product"></a><div class="action-product"><a href="'.$href.'" class="item-action">Xem chi tiết</a></div></div><div class="info"><h4 class="title-product"><a href="'.$href.'">'.$title.'</a></h4><div class="price price-inline"><p class="price-before">'.$giaold.'</p><p class="price-well">'.$gia.'</p></div></div></div></div>';
            }
        }
//		end
        echo json_encode(array(
            'html' => $html,
        ));
        die();
    }
}
