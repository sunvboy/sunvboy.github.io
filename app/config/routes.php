<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'homepage/home/index';
$route['404_override'] = '';

$route['trang-([0-9]+)'] = 'homepage/home/index/$1';

// Customers
$route['register'] = 'customers/frontend/auth/register';
$route['members/login'] = 'customers/frontend/auth/login';
$route['members/logout'] = 'customers/frontend/auth/logout';
$route['members/recovery'] = 'customers/frontend/auth/recovery';
$route['xac-minh'] = 'customers/ajax/auth/verify';
$route['members/profile'] = 'customers/frontend/account/information';
$route['members/password'] = 'customers/frontend/account/password';

$route['members/list-post/trang-([0-9]+)$'] = 'customers/frontend/account/orderlist/$1';
$route['members/list-post$'] = 'customers/frontend/account/orderlist';
$route['members/edit-post/([0-9]+)$'] = 'customers/frontend/account/edit/$1';
$route['members/delete-post/([0-9]+)$'] = 'customers/frontend/account/delete/$1';


$route['members/list-doctor/trang-([0-9]+)$'] = 'customers/frontend/account/listview2/$1';
$route['members/list-doctor$'] = 'customers/frontend/account/listview2';

$route['members/list-customers/trang-([0-9]+)$'] = 'customers/frontend/account/listview/$1';
$route['members/list-customers$'] = 'customers/frontend/account/listview';


/* Đặt mua */
$route['dat-mua'] = 'products/frontend/cart/payment';
$route['dat-mua-thanh-cong'] = 'products/frontend/cart/success';
$route['inquiry'] = 'products/frontend/cart/inquiry';
/* ------------------------------------------------*/

$route['lich-hoc/trang-([0-9]+)$'] = 'lichhoc/frontend/catalogues/view/$2';
$route['lich-hoc$'] = 'lichhoc/frontend/catalogues/view';
$route['([a-zA-Z0-9/-]+)-lh([0-9]+)$'] = 'lichhoc/frontend/lichhoc/view/$2';

$route['from-dat-hang$'] = 'homepage/home/dathang';
$route['dat-ban$'] = 'homepage/home/datban';


//Tag
$route['tags/([a-zA-Z0-9/-]+)-tag([0-9]+)$'] = 'tags/frontend/articles/view/$2';

/*mailsubricre*/
$route['mailsubricre$'] = 'mailsubricre/frontend/mailsubricre/create';
$route['cartorder$'] = 'mailsubricre/frontend/mailsubricre/cartorder';
$route['cartonline$'] = 'mailsubricre/frontend/mailsubricre/cartonline';
$route['mailsubricrectv$'] = 'mailsubricre/frontend/mailsubricre/createctv';
$route['mailsubricreguiyeucau$'] = 'mailsubricre/frontend/mailsubricre/createguiyeucau';
$route['formlx$'] = 'mailsubricre/frontend/mailsubricre/formlx';
$route['contact$'] = 'mailsubricre/frontend/mailsubricre/createcontact';

// Sitemap
$route['sitemap'] = 'homepage/home/sitemap';
$route['getCountry'] = 'homepage/home/getCountry';
$route['sitemap.xml'] = 'homepage/home/sitemap/xml';
$route['he-thong-nha-hang-ha-noi'] = 'homepage/home/hanoi';
$route['he-thong-nha-hang-vinh'] = 'homepage/home/vinh';

//Attributes
$route['([a-zA-Z0-9/-]+)-att([0-9]+)/trang-([0-9]+)$'] = 'attributes/frontend/attributes/view/$2/$3';
$route['([a-zA-Z0-9/-]+)-att([0-9]+)$'] = 'attributes/frontend/attributes/view/$2';
$route['([a-zA-Z0-9/-]+)-pc([0-9]+)at([0-9]+)/trang-([0-9]+)$'] = 'attributes/frontend/attributes/filter/$2/$3/$4';
$route['([a-zA-Z0-9/-]+)-pc([0-9]+)at([0-9]+)$'] = 'attributes/frontend/attributes/filter/$2/$3';
// Frontend Articles
$route['([a-zA-Z0-9/-]+)-ac([0-9]+)/trang-([0-9]+)$'] = 'articles/frontend/catalogues/view/$2/$3';
$route['([a-zA-Z0-9/-]+)-ac([0-9]+)$'] = 'articles/frontend/catalogues/view/$2';
$route['([a-zA-Z0-9/-]+)-a([0-9]+)$'] = 'articles/frontend/articles/view/$2';
$route['hoi-dap'] = 'articles/frontend/catalogues/hoidap/$2';
$route['dat-mua-online'] = 'articles/frontend/catalogues/online';


//Introducts
$route['introducts'] = 'articles/frontend/introducts/view';

// Frontend Projects
$route['([a-zA-Z0-9/-]+)-qh([0-9]+)px([0-9]+)/trang-([0-9]+)$'] = 'projects/frontend/projects/location/$2/$3/$4';
$route['([a-zA-Z0-9/-]+)-qh([0-9]+)px([0-9]+)$'] = 'projects/frontend/projects/location/$2/$3';

$route['([a-zA-Z0-9/-]+)-jc([0-9]+)/trang-([0-9]+)$'] = 'projects/frontend/catalogues/view/$2/$3';
$route['([a-zA-Z0-9/-]+)-jc([0-9]+)$'] = 'projects/frontend/catalogues/view/$2';

$route['([a-zA-Z0-9/-]+)-j([0-9]+)$'] = 'projects/frontend/projects/view/$2';
$route['members/dang-tin$'] = 'projects/frontend/projects/create';

$route['project-search/trang-([0-9]+)$'] = 'projects/frontend/projects/search/$2';
$route['project-search$'] = 'projects/frontend/projects/search/';

$route['dang-ky-dang-tin-tron-goi$'] = 'projects/frontend/projects/register/';
$route['members/payment$'] = 'projects/frontend/projects/payment/';
$route['members/history$'] = 'projects/frontend/projects/history/';

// Frontend Gallerys
$route['([a-zA-Z0-9/-]+)-gc([0-9]+)/trang-([0-9]+)$'] = 'gallerys/frontend/catalogues/view/$2/$3';
$route['([a-zA-Z0-9/-]+)-gc([0-9]+)$'] = 'gallerys/frontend/catalogues/view/$2';
$route['([a-zA-Z0-9/-]+)-g([0-9]+)$'] = 'gallerys/frontend/gallerys/view/$2';

// Frontend Videos
$route['([a-zA-Z0-9/-]+)-vc([0-9]+)/trang-([0-9]+)$'] = 'videos/frontend/catalogues/view/$2/$3';
$route['([a-zA-Z0-9/-]+)-vc([0-9]+)$'] = 'videos/frontend/catalogues/view/$2';
$route['([a-zA-Z0-9/-]+)-v([0-9]+)$'] = 'videos/frontend/videos/view/$2';

// Frontend Products
$route['products/trang-([0-9]+)$'] = 'products/frontend/home/view/$2';
$route['products$'] = 'products/frontend/home/view';

$route['([a-zA-Z0-9/-]+)-pc([0-9]+)/trang-([0-9]+)$'] = 'products/frontend/catalogues/view/$2/$3';
$route['([a-zA-Z0-9/-]+)-pc([0-9]+)$'] = 'products/frontend/catalogues/view/$2';
$route['([a-zA-Z0-9/-]+)-p([0-9]+)$'] = 'products/frontend/products/view/$2/$3';
$route['([a-zA-Z0-9/-]+)-p([0-9]+)$'] = 'products/frontend/products/view/$2';



// Frontend Documents
$route['([a-zA-Z0-9/-]+)-dc([0-9]+)/trang-([0-9]+)$'] = 'documents/frontend/catalogues/view/$2/$3';
$route['([a-zA-Z0-9/-]+)-dc([0-9]+)$'] = 'documents/frontend/catalogues/view/$2';
$route['([a-zA-Z0-9/-]+)-d([0-9]+)$'] = 'documents/frontend/documents/view/$2';


//Frontend Address
$route['documents/trang-([0-9]+)$'] = 'address/frontend/address/index/$2';
$route['documents$'] = 'address/frontend/address/index';
$route['([a-zA-Z0-9/-]+)-ad([0-9]+)$'] = 'address/frontend/address/view/$2';


// Frontend Cart
$route['cart$'] = 'products/frontend/cart/view';
$route['payment$'] = 'products/frontend/cart/payment';
$route['step$'] = 'products/frontend/cart/step';


// Contacts 
$route['lien-he$'] = 'contacts/frontend/contacts/view';
$route['them-lien-he$'] = 'contacts/frontend/contacts/create';

//DAi lys
$route['dai-ly$'] = 'dailys/frontend/dailys/view';

//Tìm kiếm
// $route['tim-kiem-nang-cao'] = 'products/frontend/advancedsearch/view';
//$route['tim-kiem/trang-([0-9]+)$'] = 'articles/frontend/search/view/$1';
//$route['tim-kiem'] = 'articles/frontend/search/view';
$route['tim-kiem/trang-([0-9]+)$'] = 'products/frontend/search/view/$1';
$route['tim-kiem'] = 'products/frontend/search/view';
//$route['san-pham-son/trang-([0-9]+)$'] = 'products/frontend/products/viewall/$1';
//$route['san-pham-son'] = 'products/frontend/products/viewall';
//$route['san-pham/trang-([0-9]+)$'] = 'products/frontend/products/viewall/$1';
//$route['san-pham'] = 'products/frontend/products/viewall';
//$route['dich-vu/trang-([0-9]+)$'] = 'products/frontend/products/viewall/$1';
//$route['dich-vu'] = 'products/frontend/products/viewall';
//$route['san-pham-moi/trang-([0-9]+)$'] = 'products/frontend/products/viewnew/$1';
//$route['san-pham-moi'] = 'products/frontend/products/viewnew';
//$route['bang-mau'] = 'videos/frontend/Catalogues/view_bangmau';
//$route['dat-hang'] = 'homepage/home/datban';
//$route['he-thong-nha-thuoc'] = 'homepage/home/hethongnhathuoc';
//$route['he-thong-nha-thuoc-maps'] = 'homepage/home/hethongnhathuocmaps';
// Routers
$route['^([a-zA-Z0-9-]+)/trang-([0-9]+)$'] = 'homepage/routers/index/$1/$2';
$route['^([a-zA-Z0-9-]+)$'] = 'homepage/routers/index/$1';

$route[BACKEND_DIRECTORY] = 'dashboard/home/index';
$route[BACKEND_DIRECTORY.'/login'] = 'users/backend/auth/login';
$route[BACKEND_DIRECTORY.'/recovery'] = 'users/backend/auth/recovery';
$route['translate_uri_dashes'] = FALSE;
