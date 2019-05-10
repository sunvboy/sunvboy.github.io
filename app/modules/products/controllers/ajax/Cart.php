<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends FC_Controller{

    public function __construct(){
        parent::__construct();
        $this->fc_lang = $this->config->item('fc_lang');
        $this->load->model(array(
            'BackendProducts_Model',
            'FrontendProducts_Model'
        ));
        $this->load->library('cart');
    }


    public function addpayment(){
        $alert = array(
            'error' => '',
            'message' => '',
            'result' => ''
        );
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', ' / ');
        $this->form_validation->set_rules('fullname', 'Họ và tên', 'trim|required');
        $this->form_validation->set_rules('phone', 'Số điện thoại', 'trim|required');
        if ($this->form_validation->run($this)){
            $post = $this->input->post('post');
            $data = '';
            if(isset($post) && is_array($post) && count($post)){
                foreach($post as $key => $val){
                    $data[$val['name']] = nl2br($val['value']) ;
                }
            }
            $Products = $this->FrontendProducts_Model->ReadByField('id', $data['productsid'], $this->fc_lang );
            $arr = array(
                '0' => array(
                    'id' => $data['productsid'],
                    'name' => $Products['title'],
                    'qty' => $data['quantity'],
                    'price' => $data['price'],
                    'subtotal' => $data['price'],
                    'detail' => array(
                        'id' => $Products['id'],
                        'title' => $Products['title'],
                        'slug' => $Products['slug'],
                        'canonical' => $Products['canonical'],
                        'images' => $Products['images'],
                        'price' => $Products['price'],
                        'saleoff' => $Products['saleoff'],
                    ),
                ),
            );
            $_paymentid = $this->Autoload_Model->_create(array(
                'table' => 'payments',
                'data' => array(
                    'type' => 'cart',
                    'fullname' => $data['fullname'],
                    'phone' => $data['phone'],
                    'address' => $data['address'],
                    'quantity' => $data['quantity'],
                    'total_price' => $data['price'],
                    'data' => json_encode($arr),
                    'publish' => 1,
                    'status' => 'wait',
                    'send' => 0,
                    'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
                ),
            ));
            if($_paymentid > 0){
                if(isset($cart) && is_array($cart) && count($cart)){
                    $_insert_ = '';
                    $_product_ = '';
                    foreach($cart as $key => $val){
                        $_insert_[] = array(
                            'paymentsid' => $_paymentid,
                            'productsid' => $data['productsid'],
                            'quantity' => $data['quantity'],
                            'price' => $data['price'],
                            'publish' => 1,
                            'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
                        );

                    }
                    if(isset($_insert_) && is_array($_insert_) && count($_insert_)){
                        $flag = $this->Autoload_Model->create_batch(array('table' => 'payments_items', 'data' => $_insert_));
                    }
                }
            }
        }else{
            $alert['error'] = validation_errors();
        }
        echo json_encode($alert); die();
    }


    public function save(){
        sleep(1);
        $post = $this->input->post('post');
        $data = '';
        $flag = 0;
        if(isset($post) && is_array($post) && count($post)){
            foreach($post as $key => $val){
                // if(($val['name'] != 'cityid' || $val['name'] != 'districtid')) continue;
                $data[$val['name']] = $val['value'];
            }
        }
        if(isset($data) && is_array($data) && count($data)){
            $this->db->where('id', $data['id']);
            $this->db->update('payments', $data);
            $this->db->flush_cache();
            $flag = 1;
        }
        echo $flag;die();
    }


    public function notification(){
        echo json_encode(array(
            'item' => number_format($this->cart->total_items()),
            'total' => number_format($this->cart->total()),
        ));
    }

    public function ajax_location(){
        $cityid = $this->input->post('cityid');
        $result = location_dropdown('Quận/Huyện', array('parentid' => $cityid));
        $option = '';
        if(isset($result) && is_array($result) && count($result)){
            foreach($result as $key => $val){
                $option = $option.'<option value="'.$key.'">'.$val.'</option>';
            }
        }
        echo json_encode(array(
            'option' => $option,
        )); die();
    }

    public function updateitemcart(){
        $qty = $this->input->post('qty');
        $rowid = $this->input->post('rowid');
        $cart = $this->cart->contents();
        $result = NULL;
        if(isset($cart) && is_array($cart) && count($cart)){
            foreach($cart as $keyMain => $valMain){
                if ($valMain['rowid'] == $rowid) {
                    $valMain['qty'] = $qty;
                }
                $result[] = $valMain;
            }
            $cart = $valMain;
        }
        $this->cart->update($result);
        print_r($result);
    }

    public function deletecart(){
        $id = $this->input->post('idprd');

        // $cart = $this->cart->contents();

        $cart = $this->cart->remove($id);
        $this->cart->update();
        print_r($id);
    }
    public function addtocart(){
        $id = (int)$this->input->post('id');
        $quantity = (int)$this->input->post('quantity');
        $products = $this->FrontendProducts_Model->ReadByField('id', $id, $this->fc_lang);
        $globalprice = ($products['saleoff'])?$products['saleoff']:$products['price'];


        $data = array(
            'id' => $id,
            'name' => $products['title'],
            'qty' => $quantity,
            'price' => $globalprice,
        );

        $this->cart->insert($data);
        $cart = $this->cart->contents();


        if(isset($cart) && is_array($cart) && count($cart)){
            $temp = NULL;
            foreach($cart as $keyMain => $valMain){
                $temp[] = $valMain['id'];
            }
            if(isset($temp) && is_array($temp) && count($temp)){
                $product = $this->FrontendProducts_Model->_get_where(array(
                    'select' => 'id, title, slug, canonical, images, price, saleoff',
                    'where' => array('publish' => 1,'trash' => 0, 'alanguage' => $this->fc_lang),
                    'table'=> 'products',
                    'where_in' => $temp,
                    'where_in_field' => 'id',
                ), TRUE);
            }
            $temp = NULL;
            foreach($cart as $keyMain => $valMain){
                foreach($product as $keyItem => $valItem){
                    if($valItem['id'] == $valMain['id']){
                        $valMain['detail'] = $valItem;
                    }
                }
                $temp[] = $valMain;
            }
            $cart = $temp;
        }

        $html = '';

        $html = $html . '<div id="ec-module-cart">';
        $html = $html . '<section class="uk-panel buynow-2">';
        $html = $html . '<form action="" id="ajax-cart-form">';
        $html = $html . '<header class="panel-head mb15">';
        $html = $html . '<h1 class="heading"><span class="text">'.$this->lang->line('cart_products_title').' ('.number_format($this->cart->total_items()).' '.$this->lang->line('products').')</span></h1>';
        $html = $html . '</header><!-- .header -->';
        $html = $html . '<div class="panel-body">';
        $html = $html . '<ul class="uk-list uk-clearfix list-cart-heading">';
        $html = $html . '<li class="item product">'.$this->lang->line('products').'</li>';
        $html = $html . '<li class="item prices uk-text-right">'.$this->lang->line('cart_products_price').'</li>';
        $html = $html . '<li class="item count uk-text-center">'.$this->lang->line('cart_products_number').'</li>';
        $html = $html . '<li class="item prices uk-text-right">'.$this->lang->line('cart_products_total').'</li>';
        $html = $html . '</ul>';
        $html = $html . '<div id="scrollbar" class="uk-overflow-container cart-scrrolbar">';
        $html = $html . '<div class="list-order">';
        $i = 1;
        foreach($cart as $key => $val){
            $val['detail']['href'] = rewrite_url($val['detail']['canonical'], $val['detail']['slug'], $val['detail']['id'], 'products');
            $html = $html . '<div class="item">';
            $html = $html . '<ul class="uk-list uk-clearfix list-item">';
            $html = $html . '<li class="product">';
            $html = $html . '<div class="uk-flex">';
            $html = $html . '<div class="thumb"><a class="link ec-scaledown" href="'.$val['detail']['href'].'" title="'.htmlspecialchars($val['detail']['title']).'" target="_blank"><img src="'.getthumb($val['detail']['images']).'" alt="'.htmlspecialchars($val['detail']['title']).'" /></a></div>';
            $html = $html . '<div class="info">';
            $html = $html . '<div class="title ec-line-3 mb10"><a class="link" href="'.$val['detail']['href'].'" title="'.htmlspecialchars($val['detail']['title']).'" target="_blank">'.$val['detail']['title'].'</a></div>';
            $html = $html . '<button class="delete"><i class="fa fa-trash"></i> '.$this->lang->line('remove_cart_item').'</button>';
            $html = $html . '</div>';
            $html = $html . '</div>';
            $html = $html . '</li>';
            $html = $html . '<li class="prices uk-text-right">';
            $price = ($val['detail']['saleoff'])?$val['detail']['saleoff']:$val['detail']['price'];
            if(($val['detail']['saleoff']) && ($val['detail']['saleoff'] > 0)){
                $html = $html . '<span class="new1">'.number_format($val['detail']['saleoff']).$this->lang->line('products_currency').'</span>';
                if($val['detail']['price'] > 0){
                    $html = $html . '<span class="old">'.number_format($val['detail']['price']).$this->lang->line('products_currency').'</span>';
                }
                if( $val['detail']['saleoff'] < $val['detail']['price']){
                    $html = $html . '<span class="saleoff">-'.round((($val['detail']['price'] - $val['detail']['saleoff']) / $val['detail']['price']) * 100).'%</span>';
                }
            }
            else{
                $html = $html . '<span class="new1">'.number_format($val['detail']['price']).$this->lang->line('products_currency').'</span>';
            }
            $html = $html . '</li>';
            $html = $html . '<li class="count">';
            $html = $html . '<div class="uk-position-relative">';
            $html = $html . form_hidden($i.'[rowid]', $val['rowid']);
            $html = $html . form_input(array(
                    'name' => $i.'[qty]',
                    'value' => set_value($i.'[qty]', $val['qty']),
                    'class' => 'quantity ajax-quantity',
                ));
            $html = $html . '<span class="btns abate"></span>';
            $html = $html . '<span class="btns augment"></span>';
            $html = $html . '</div>';
            $html = $html . '</li>';
            $html = $html . '<li class="prices uk-text-right"><span>'.number_format($price * $val['qty']).$this->lang->line('products_currency').'</span></li>';
            $html = $html . '</ul><!-- .list-order -->';
            $html = $html . '</div>';
            $i++;
        }
        $html = $html . '</div>';
        $html = $html . '</div>';
        $html = $html . '</div><!-- .panel-body -->';
        $html = $html . '<div class="panel-foot">';
        $html = $html . '<div class="total uk-text-right mb10">';
        $html = $html . '<span class="price_tt">'.$this->lang->line('cart_money_total').': <strong id="ajax-cart-totalprice">'.number_format($this->cart->total()).'₫</strong></span>';
        // $html = $html . '<p>Giá đã bao gồm VAT</p>';
        $html = $html . '</div>';
        $html = $html . '<div class="action uk-flex uk-flex-middle uk-flex-space-between">';
        $html = $html . '<a class="continue ec-cart-continue"><i class="fa fa-caret-left"></i> '.$this->lang->line('cart_continnue').'</a>';
        $html = $html . '<a href="'.site_url('dat-mua').'" title="'.$this->lang->line('cart_payment').'" class="purchase">'.$this->lang->line('cart_payment').'</a>';
        $html = $html . '</div>';
        $html = $html . '</div><!-- .panel-foot -->';
        $html = $html . '</form>';
        $html = $html . '</section><!-- .buynow-2 -->';
        $html = $html . '</div>';
        echo json_encode(array(
            'item' => number_format($this->cart->total_items()),
            'total' => number_format($this->cart->total()),
            'html' => $html,
        ));
    }



    public function updatetocart(){
        $this->cart->update($this->input->post());
        $cart = $this->cart->contents();


        if(isset($cart) && is_array($cart) && count($cart)){
            $temp = NULL;
            foreach($cart as $keyMain => $valMain){
                $temp[] = $valMain['id'];
            }
            if(isset($temp) && is_array($temp) && count($temp)){
                $product = $this->FrontendProducts_Model->_get_where(array(
                    'select' => 'id, title, slug, canonical, images, price, saleoff',
                    'where' => array('publish' => 1,'trash' => 0, 'alanguage' => $this->fc_lang),
                    'table'=> 'products',
                    'where_in' => $temp,
                    'where_in_field' => 'id',
                ), TRUE);
            }
            $temp = NULL;
            foreach($cart as $keyMain => $valMain){
                foreach($product as $keyItem => $valItem){
                    if($valItem['id'] == $valMain['id']){
                        $valMain['detail'] = $valItem;
                    }
                }
                $temp[] = $valMain;
            }
            $cart = $temp;
        }
        $html = '';

        $html = $html . '<header class="panel-head mb15">';
        $html = $html . '<h1 class="heading"><span class="text">'.$this->lang->line('cart_products_title').' ('.number_format($this->cart->total_items()).' '.$this->lang->line('cart_products_price').')</span></h1>';
        $html = $html . '</header><!-- .header -->';
        $html = $html . '<div class="panel-body">';
        $html = $html . '<ul class="uk-list uk-clearfix list-cart-heading">';
        $html = $html . '<li class="item product">'.$this->lang->line('products').'</li>';
        $html = $html . '<li class="item prices uk-text-right">'.$this->lang->line('cart_products_price').'</li>';
        $html = $html . '<li class="item count uk-text-center">'.$this->lang->line('cart_products_number').'</li>';
        $html = $html . '<li class="item prices uk-text-right">'.$this->lang->line('cart_products_total').'</li>';
        $html = $html . '</ul>';
        $html = $html . '<div id="scrollbar" class="uk-overflow-container cart-scrrolbar">';
        $html = $html . '<div class="list-order">';
        $i = 1;
        foreach($cart as $key => $val){
            $val['detail']['href'] = rewrite_url($val['detail']['canonical'], $val['detail']['slug'], $val['detail']['id'], 'products');
            $html = $html . '<div class="item">';
            $html = $html . '<ul class="uk-list uk-clearfix list-item">';
            $html = $html . '<li class="product">';
            $html = $html . '<div class="uk-flex">';
            $html = $html . '<div class="thumb"><a class="link ec-scaledown" href="'.$val['detail']['href'].'" title="'.htmlspecialchars($val['detail']['title']).'" target="_blank"><img src="'.getthumb($val['detail']['images']).'" alt="'.htmlspecialchars($val['detail']['title']).'" /></a></div>';
            $html = $html . '<div class="info">';
            $html = $html . '<div class="title ec-line-3 mb10"><a class="link" href="'.$val['detail']['href'].'" title="'.htmlspecialchars($val['detail']['title']).'" target="_blank">'.$val['detail']['title'].'</a></div>';
            $html = $html . '<button class="delete"><i class="fa fa-trash"></i> '.$this->lang->line('remove_cart_item').'</button>';
            $html = $html . '</div>';
            $html = $html . '</div>';
            $html = $html . '</li>';
            $html = $html . '<li class="prices uk-text-right">';
            $price = ($val['detail']['saleoff'])?$val['detail']['saleoff']:$val['detail']['price'];
            if(($val['detail']['saleoff'])){
                $html = $html . '<span class="new1">'.number_format($val['detail']['saleoff']).$this->lang->line('products_currency').'</span>';
                $html = $html . '<span class="old">'.number_format($val['detail']['price']).$this->lang->line('products_currency').'</span>';
                $html = $html . '<span class="saleoff">-'.round((($val['detail']['price'] - $val['detail']['saleoff']) / $val['detail']['price']) * 100).'%</span>';
            }
            else{
                $html = $html . '<span class="new1">'.number_format($val['detail']['price']).$this->lang->line('products_currency').'</span>';
            }
            $html = $html . '</li>';
            $html = $html . '<li class="count">';
            $html = $html . '<div class="uk-position-relative">';
            $html = $html . form_hidden($i.'[rowid]', $val['rowid']);
            $html = $html . form_input(array(
                    'name' => $i.'[qty]',
                    'value' => set_value($i.'[qty]', $val['qty']),
                    'class' => 'quantity ajax-quantity',
                ));
            $html = $html . '<span class="btns abate"></span>';
            $html = $html . '<span class="btns augment"></span>';
            $html = $html . '</div>';
            $html = $html . '</li>';
            $html = $html . '<li class="prices uk-text-right"><span>'.number_format($price * $val['qty']).$this->lang->line('products_currency').'</span></li>';
            $html = $html . '</ul><!-- .list-order -->';
            $html = $html . '</div>';
            $i++;
        }
        $html = $html . '</div>';
        $html = $html . '</div>';
        $html = $html . '</div><!-- .panel-body -->';
        $html = $html . '<div class="panel-foot">';
        $html = $html . '<div class="total uk-text-right mb10">';
        $html = $html . '<span class="price_tt">'.$this->lang->line('cart_money_total').': <strong id="ajax-cart-totalprice">'.number_format($this->cart->total()).$this->lang->line('products_currency').'</strong></span>';
        // $html = $html . '<p>Giá đã bao gồm VAT</p>';
        $html = $html . '</div>';
        $html = $html . '<div class="action uk-flex uk-flex-middle uk-flex-space-between">';
        $html = $html . '<a class="continue ec-cart-continue"><i class="fa fa-caret-left"></i> '.$this->lang->line('cart_continnue').'</a>';
        $html = $html . '<a href="'.site_url('dat-mua').'" title="'.$this->lang->line('cart_payment').'" class="purchase">'.$this->lang->line('cart_payment').'</a>';
        $html = $html . '</div>';
        $html = $html . '</div><!-- .panel-foot -->';
        echo json_encode(array(
            'item' => number_format($this->cart->total_items()),
            'total' => number_format($this->cart->total()),
            'html' => $html,
        ));
    }
}
