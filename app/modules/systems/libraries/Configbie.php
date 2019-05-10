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
            'logo1' => array('type' => 'images', 'label' => 'Logo footer'),
            'logo2' => array('type' => 'images', 'label' => 'Logo đăng ký'),
            'logo3' => array('type' => 'images', 'label' => 'Logo popup'),
            'slogan' => array('type' => 'text', 'label' => 'Slogan đăng ký'),
//
//			'cover' => array('type' => 'editor', 'label' => 'Giới thiệu chân trang'),
            'note' => array('type' => 'textarea', 'label' => 'Lưu ý'),
//            'links_map' => array('type' => 'images', 'label' => 'Hình ảnh dưới về chúng tôi'),
//            'email2' => array('type' => 'text', 'label' => 'Links hình ảnh popup'),
//            'slogan' => array('type' => 'images', 'label' => 'Số điện thoại tổng đài'),
			'website' => array('type' => 'dropdown', 'label' => 'Trạng thái website','value' => array('Mở cửa website','Đóng Website bảo trì')),

        );
        $data['contact'] = array(

            'phone' => array('type' => 'text', 'label' => 'Điện thoại'),
            'hotline_hanoi' => array('type' => 'text', 'label' => 'Hotline hà nội'),
            'hotline_hcm' => array('type' => 'text', 'label' => 'Hotline TP. Hồ Chí Minh'),
            'email' => array('type' => 'text', 'label' => 'Địa chỉ Email'),
            'web' => array('type' => 'text', 'label' => 'Web'),
            'map' => array('type' => 'textarea', 'label' => 'Bản đồ'),
//			'time_lv' => array('type' => 'text','label' => 'Thời gian làm việc'),
        );
        $data['MENU'] = array(
            'menu_tintuc' => array('type' => 'text','label' => 'Tin tức'),
            'link_menu_tintuc' => array('type' => 'text','label' => 'Link tin tức'),
            'menu_blog' => array('type' => 'text','label' => 'BLog chia sẻ'),
            'link_menu_blog' => array('type' => 'text','label' => 'Link BLog chia sẻ'),
//            'content' => array('type' => 'editor','label' => 'Thông tin sản phẩm'),
        );
//        $data['common'] = array(
//            'support' => array('type' => 'text', 'label' => 'Tiêu đề'),
//            'aboutus' => array('type' => 'editor', 'label' => 'Mô tả'),
//            'skype_1' => array('type' => 'images', 'label' => 'Images thành phần'),
//            'skype_2' => array('type' => 'images', 'label' => 'Images địa chỉ'),
//        );

        $data['seo'] = array(
            'meta_title' => array('type' => 'text', 'label' => 'Meta Title'),
            'meta_keywords' => array('type' => 'text', 'label' => 'Meta Keyword'),
            'meta_description' => array('type' => 'text', 'label' => 'Meta Description'),
            'meta_image' => array('type' => 'images', 'label' => 'Meta Image'),
        );
        $data['social'] = array(
			'bocongthuong' => array('type' => 'text', 'label' => 'Bộ công thương'),
//            'google' => array('type' => 'text', 'label' => 'Google+'),
            'facebook' => array('type' => 'text', 'label' => 'Facebook'),
//            'linkedin' => array('type' => 'text', 'label' => 'Instagram'),
//            'twitter' => array('type' => 'text', 'label' => 'Twitter'),
            'youtube' => array('type' => 'text', 'label' => 'Youtube'),
//			'skype' => array('type' => 'text', 'label' => 'skype'),
        );
        $data['banner'] = array(

            'banner1' => array('type' => 'images', 'label' => 'Banner tin tức'),

        );
        $data['script'] = array(
            'header' => array('type' => 'textarea', 'label' => 'Script đầu trang'),
            'body' => array('type' => 'textarea', 'label' => 'Script thân trang'),
        );
//         $data['FAQ'] =  array(
//         	'FAQ_images' => array('type' => 'images', 'label' => 'Ảnh FAQ'),
//         	'FAQ_title' => array('type' => 'text', 'label' => 'Tiêu đề FAQ'),
//         );
        // $data['loto'] =  array(
        // 	'thayboi' => array('type' => 'text', 'label' => 'Thầy bói phán'),
        // 	'nguoidep' => array('type' => 'text', 'label' => 'Người đẹp phán'),
        // );

        return $data;
    }
}