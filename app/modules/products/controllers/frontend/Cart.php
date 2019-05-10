<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends FC_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->fc_lang = $this->config->item('fc_lang');
        $this->load->model('Autoload_Model');
        /* KIỂM TRA TÌNH TRẠNG WEBSITE */
        if ($this->fcSystem['homepage_website'] == 1) {
            echo '<img src="' . base_url() . 'templates/backend/images/close.jpg' . '" style="width:100%;" />';
            die();
        }
        /* -------------------------- */
    }
    public function Inquiry()
    {
        $cart = $this->cart->contents();
        if (isset($cart) && is_array($cart) && count($cart)) {
            $temp = NULL;
            foreach ($cart as $keyMain => $valMain) {
                $temp[] = $valMain['id'];
            }
            if (isset($temp) && is_array($temp) && count($temp)) {
                $product = $this->FrontendProducts_Model->_get_where(array(
                    'select' => 'id, title, slug, canonical, images, price, saleoff, content2, (SELECT title FROM products_catalogues WHERE products.cataloguesid = products_catalogues.id) as titlecatelogies,',
                    'where' => array('publish' => 1, 'trash' => 0, 'alanguage' => $this->fc_lang),
                    'table' => 'products',
                    'where_in' => $temp,
                    'where_in_field' => 'id',
                ), TRUE);
            }
            $temp = NULL;
            foreach ($cart as $keyMain => $valMain) {
                foreach ($product as $keyItem => $valItem) {
                    if ($valItem['id'] == $valMain['id']) {
                        $valMain['detail'] = $valItem;
                    }
                }
                $temp[] = $valMain;
            }
            $cart = $temp;
        }

        if ($this->input->post('create')) {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('', ' / ');
            $this->form_validation->set_rules('companyname', 'Tên công ty', 'trim|required');
            $this->form_validation->set_rules('fullname', 'Tên riêng', 'trim|required');
            $this->form_validation->set_rules('namefamily', 'Tên ở gia đình', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('country', 'Thành phố phố', 'trim|required');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'trim|required');
            $this->form_validation->set_rules('fax', 'Fax', 'trim|required');
            $this->form_validation->set_rules('message', 'Nội dung yêu cầu', 'trim|required');
            if ($this->form_validation->run($this)) {
                $_paymentid = $this->Autoload_Model->_create(array(
                    'table' => 'payments',
                    'data' => array(
                        'type' => 'cart',
                        'fullname' => $this->input->post('fullname'),
                        'namefamily' => $this->input->post('namefamily'),
                        'companyname' => $this->input->post('companyname'),
                        'email' => $this->input->post('email'),
                        'phone' => $this->input->post('phone'),
                        'fax' => $this->input->post('fax'),
                        'address' => $this->input->post('country'),
                        'message' => $this->input->post('message'),
                        'data' => json_encode($cart),
                        'quantity' => $this->cart->total_items(),
                        'total_price' => $this->cart->total(),
                        'publish' => 1,
                        'status' => 'wait',
                        'send' => 0,
                        'distributors ' => $this->input->post('distributors '),
                        'created' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
                    ),
                ));
                if ($_paymentid > 0) {
                    if (isset($cart) && is_array($cart) && count($cart)) {
                        $_insert_ = '';
                        $_product_ = '';
                        foreach ($cart as $key => $val) {
                            $_insert_[] = array(
                                'paymentsid' => $_paymentid,
                                'productsid' => $val['id'],
                                'quantity' => $val['qty'],
                                'price' => $val['price'],
                                'publish' => 1,
                                'created' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
                            );

                        }
                        if (isset($_insert_) && is_array($_insert_) && count($_insert_)) {
                            $flag = $this->Autoload_Model->create_batch(array('table' => 'payments_items', 'data' => $_insert_));
                        }
                        $this->cart->destroy();
                        $this->session->set_flashdata('message-success', 'Bạn gửi yêu cầu thành công!. Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất.');
                        redirect(base_url());
                    }
                }
            }
        }
        $data['cart'] = $cart;
        $data['meta_title'] = $this->lang->line('inquiry');
        $data['meta_keyword'] = '';
        $data['meta_description'] = '';
        $data['template'] = 'products/frontend/cart/inquiry';
        $this->load->view('homepage/frontend/layouts/home', isset($data) ? $data : NULL);
    }
    public function Payment()
    {
        $cart = $this->cart->contents();
        //echo "<pre>";var_dump($cart);die();
        if (isset($cart) && is_array($cart) && count($cart)) {
            $temp = NULL;
            foreach ($cart as $keyMain => $valMain) {
                $temp[] = $valMain['id'];
            }
            if (isset($temp) && is_array($temp) && count($temp)) {
                $product = $this->FrontendProducts_Model->_get_where(array(
                    'select' => 'id, title, slug, canonical, images, price, saleoff',
                    'where' => array('publish' => 1, 'trash' => 0, 'alanguage' => $this->fc_lang),
                    'table' => 'products',
                    'where_in' => $temp,
                    'where_in_field' => 'id',
                ), TRUE);
            }
            $temp = NULL;
            foreach ($cart as $keyMain => $valMain) {
                foreach ($product as $keyItem => $valItem) {
                    if ($valItem['id'] == $valMain['id']) {
                        $valMain['detail'] = $valItem;
                    }
                }
                $temp[] = $valMain;
            }
            $cart = $temp;
        }
        if ($this->input->post('create')) {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('', ' / ');
            $this->form_validation->set_rules('hethong', 'Nhà hàng trong hệ thống', 'trim|required');
            $this->form_validation->set_rules('person', 'Số khách(người lớn)', 'trim|required');
            $this->form_validation->set_rules('child', 'Số khách(trẻ em)', 'trim|required');
            $this->form_validation->set_rules('fullname', 'Tên đầy đủ', 'trim|required');
//            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('phone', 'Số điện thoại', 'trim|required');
            if ($this->form_validation->run($this)) {
                $_paymentid = $this->Autoload_Model->_create(array(
                    'table' => 'payments',
                    'data' => array(
                        'type' => 'cart',
                        'gender' => $this->input->post('sex'),
                        'fullname' => $this->input->post('fullname'),
                        'email' => $this->input->post('email'),
                        'phone' => $this->input->post('phone'),
                        'cityid' => $this->input->post('cityid'),
                        'districtid' => $this->input->post('districtid'),
                        'address' => $this->input->post('address'),
//                        'color' => $this->input->post('color'),
                        'message' => $this->input->post('message'),
                        'person' => $this->input->post('person'),
                        'child' => $this->input->post('child'),
                        'hethong' => $this->input->post('hethong'),
                        'data' => json_encode($cart),
                        'quantity' => $this->cart->total_items(),
                        'total_price' => $this->cart->total(),
                        'publish' => 1,
                        'status' => 'wait',
                        'send' => 0,
                        'created' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
                    ),
                ));
                if ($_paymentid > 0) {
                    if (isset($cart) && is_array($cart) && count($cart)) {
                        $_insert_ = '';
                        $_product_ = '';
                        foreach ($cart as $key => $val) {
                            $_insert_[] = array(
                                'paymentsid' => $_paymentid,
                                'productsid' => $val['id'],
                                'quantity' => $val['qty'],
                                'price' => $val['price'],
                                'publish' => 1,
                                // 'option' => $val['option'],
                                'created' => gmdate('Y-m-d H:i:s', time() + 7 * 3600),
                            );

                        }
                        if (isset($_insert_) && is_array($_insert_) && count($_insert_)) {
                            $flag = $this->Autoload_Model->create_batch(array('table' => 'payments_items', 'data' => $_insert_));
                        }
                        $this->cart->destroy();
                        setcookie('payment' . FC_ENCRYPTION, json_encode(array('id' => $_paymentid,)), time() + (86400 * 30), '/');
                        redirect('dat-mua-thanh-cong');
                    }
                }

            }
        }
        $data['cart'] = $cart;
        $data['meta_title'] = $this->lang->line('order_payment_receiving');
        $data['meta_keyword'] = '';
        $data['meta_description'] = '';
        $data['template'] = 'products/frontend/cart/view';
        $this->load->view('homepage/frontend/layouts/home', isset($data) ? $data : NULL);
    }
    public function success()
    {
        $payment = isset($_COOKIE['payment' . FC_ENCRYPTION]) ? $_COOKIE['payment' . FC_ENCRYPTION] : NULL;
        if (!isset($payment) || empty($payment)) {
            redirect(base_url());
            show_error($this->lang->line('error_payment_item'));
        }
        $_paymentid = json_decode($payment, TRUE);
        $_payment = $this->Autoload_Model->_read(array(
            'table' => 'payments',
            'where' => array(
                'id' => $_paymentid['id'],
            ),
        ));
        if (!isset($_payment) || !is_array($_payment) || count($_payment) == 0) {
            redirect(base_url());
            show_error($this->lang->line('error_payment_item'));
        }
        $productlist = json_decode($_payment['data'], TRUE);
        $_product_ = '';

        if ($this->input->post('confirm')) {
            if (isset($productlist) && is_array($productlist) && count($productlist)) {
                //echo "<pre>";var_dump($productlist);die();
                foreach ($productlist as $key => $val) {
                    $_product_ = $_product_ . '<li style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;margin-bottom: 10px;padding-bottom: 10px;border-bottom: 1px solid #ebebeb;display: flex;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;width: 80px;"><a href="" title="" style="display: block;width: 100%;height: 75px;-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"><img src="' . BASE_URL . $val['detail']['images'] . '" alt="" style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;display: block;width: 100%;height: 100%;object-fit: scale-down;"></a></div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;display: flex;-ms-flex-pack: justify;-moz-justify-content: space-between;-o-justify-content: space-between;-ms-justify-content: space-between;-webkit-justify-content: space-between;justify-content: space-between;padding-left: 15px;-webkit-width: calc(100% - 80px);-o-width: calc(100% - 80px);-ms-width: calc(100% - 80px);-moz-width: calc(100% - 80px);width: calc(100% - 80px);"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;font-size: 14px;line-height: 18px;overflow: hidden;-ms-text-overflow: ellipsis;text-overflow: ellipsis;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 2;height: 36px;"><a href="" title="" style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;color: #333;font-weight: bold;text-decoration: none;">' . $val['detail']['title'] . '</a></div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;color: #c10017;font-weight: bold;margin-bottom: 5px;">' . (str_replace(',', '.', number_format($val['price']))) . '₫</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;color: #999;">Số lượng: <span style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;color: #333;font-weight: bold;">' . $val['qty'] . '</span></div></div></div></li>';
                }
            }
            if (isset($_product_) && !empty($_product_)) {
                $this->load->library(array('mailbie'));
                $this->mailbie->sent(array(
                    'to' => $_payment['email'].','.$_payment['hethong'],
                    'cc' => '',
                    'subject' => 'Bạn nhận được email từ hệ thống website: ' . $this->fcSystem['contact_web'],
                    'message' => mail_html(array(
                        'header' => 'Thông tin đặt hàng',
                        'person' => $_payment['person'],
                        'child' => $_payment['child'],
                        'fullname' => $_payment['fullname'],
                        'message' => $_payment['message'],
                        'phoneorder' => $_payment['phone'],
                        'address' => $_payment['address'],
                        'total_price' => $_payment['total_price'],
                        'product' => $_product_,
                        'web' => $this->fcSystem['contact_web'],
                        'hotline' => $this->fcSystem['contact_hotline'],
                        'phone' => $this->fcSystem['contact_phone'],
                        'cover' => base_url($this->fcSystem['homepage_cover']),
                    ))
                ));
            }
            if (isset($_COOKIE['payment' . FC_ENCRYPTION])) {
                unset($_COOKIE['payment' . FC_ENCRYPTION]);
                setcookie('payment' . FC_ENCRYPTION, null, -1, '/');
            }
            $this->session->set_flashdata('message-success', 'Gửi Email thành công, vui lòng kiểm tra hòm thư của bạn');
            redirect(base_url());
        }
        $data['payment'] = $_payment;
        $data['meta_title'] = 'Đặt hàng thành công';
        $data['meta_keyword'] = '';
        $data['meta_description'] = '';
        $data['template'] = 'products/frontend/cart/success';
        $this->load->view('homepage/frontend/layouts/home', isset($data) ? $data : NULL);
    }

}
