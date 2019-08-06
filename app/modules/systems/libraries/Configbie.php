<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ConfigBie
{
    function __construct($params = NULL)
    {
        $this->params = $params;
    }
    // meta_title là 1 row -> seo_meta_title
    // contact_address
    // chưa có thì insert
    // có thì update
    public function system()
    {
        $data['homepage'] = array(
            'brandname' => array('type' => 'text', 'label' => 'Tên thương hiệu'),
//            'brandname1' => array('type' => 'text', 'label' => 'Tên thương hiệu ở ảnh'),
            'company' => array('type' => 'text', 'label' => 'Tên công ty'),
            'logo' => array('type' => 'images', 'label' => 'Logo'),
            'favicon' => array('type' => 'images', 'label' => 'Favicon'),
            'Link' => array('type' => 'text', 'label' => 'LInks PDF'),
//            'slogan' => array('type' => 'images', 'label' => 'Slogan đăng ký'),
			'website' => array('type' => 'dropdown', 'label' => 'Trạng thái website','value' => array('Mở cửa website','Đóng Website bảo trì')),

        );
        $data['contact'] = array(

            'address' => array('type' => 'text', 'label' => 'Địa chỉ'),
            'addressL' => array('type' => 'text', 'label' => 'LInk google map'),
            'phone' => array('type' => 'text', 'label' => 'Điện thoại'),
//            'hotline' => array('type' => 'text', 'label' => 'Hotline'),
            'email' => array('type' => 'text', 'label' => 'Địa chỉ Email'),
//            'web' => array('type' => 'text', 'label' => 'Web'),
            'map' => array('type' => 'textarea', 'label' => 'Bản đồ'),
            'contact' => array('type' => 'editor', 'label' => 'Liên hệ'),
        );

        $data['seo'] = array(
            'meta_title' => array('type' => 'text', 'label' => 'Meta Title'),
            'meta_keywords' => array('type' => 'text', 'label' => 'Meta Keyword'),
            'meta_description' => array('type' => 'text', 'label' => 'Meta Description'),
            'meta_image' => array('type' => 'images', 'label' => 'Meta Image'),
        );
        $data['social'] = array(
//			'bocongthuong' => array('type' => 'text', 'label' => 'Bộ công thương'),
//            'google' => array('type' => 'text', 'label' => 'Google+'),
            'facebook' => array('type' => 'text', 'label' => 'Facebook'),
//            'linkedin' => array('type' => 'text', 'label' => 'Instagram'),
//            'twitter' => array('type' => 'text', 'label' => 'Twitter'),
            'youtube' => array('type' => 'text', 'label' => 'Youtube'),
//			'skype' => array('type' => 'text', 'label' => 'skype'),
        );
        $data['banner'] = array(

            'banner1' => array('type' => 'images', 'label' => 'Ảnh nền liên hệ'),
            'banner2' => array('type' => 'images', 'label' => 'Banner trang chi tiết'),
        );
        $data['SODOMATBANGTONGTHE'] = array(
            'title' => array('type' => 'text', 'label' => 'Tiêu đề'),
            'images' => array('type' => 'images', 'label' => 'Ảnh'),
        );
        $data['script'] = array(
            'header' => array('type' => 'textarea', 'label' => 'Script đầu trang'),
            'body' => array('type' => 'textarea', 'label' => 'Script thân trang'),
        );


        return $data;
    }
}