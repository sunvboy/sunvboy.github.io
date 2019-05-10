<script src="templates/frontend/resources/uikit/js/uikit.min.js"></script>
<link href="templates/frontend/resources/uikit/css/uikit.modify.css" rel="stylesheet" />
<link href="templates/frontend/resources/library/css/library.css" rel="stylesheet" />
<link href="templates/frontend/resources/library/css/reset.css" rel="stylesheet" />
<link href="templates/frontend/resources/library/css/cart.css" rel="stylesheet" />
<link href="templates/frontend/resources/style.css" rel="stylesheet" />
<section class="sec-content-page">
    <div class="bread">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() ?>">Trang ch?</a></li>
                <?php foreach ($Breadcrumb as $key => $val) { ?>
                    <?php
                    $title = $val['title'];
                    $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles_catalogues');
                    ?>
                    <li><?php echo $title; ?></li>
                <?php } ?>
            </ol>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-9 col-xs-12 fl-right">
                <div class="wp-page-ct">
                    <div class="row">
                        <div class="col-md-5 col-sm-6 col-xs-12">

                            <div class="wp-img-zoom">
                                <input type="hidden" id="__VIEWxSTATE"/>
                                <ul id='zoom1' class='gc-start'>
                                    <li><img src="<?php echo $DetailProducts['images']; ?>"
                                             alt='<?php echo $DetailProducts['title'] ?>'/></li>

                                    <?php $listItem = json_decode($DetailProducts['albums'], TRUE); ?>
                                    <?php if (isset($listItem) && is_array($listItem) && count($listItem)) { ?>
                                        <?php foreach ($listItem as $key => $val) { ?>
                                            <li><img src="<?php echo $val['images']; ?>"
                                                     alt='<?php echo $val['title'] ?>'/></li>
                                            <?php } ?>
                                        <?php } ?>

                                </ul>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                            <div class="wp-text-ctsp">
                                <h1 class="h1-ctsp"><?php echo $DetailProducts['title']; ?></h1>

                                <p>
                                    <?php links_share() ?>
                                </p>
                                <?php echo $DetailProducts['description']; ?>
                                <?php
                                $DetailProductsprice = $DetailProducts['price'];
                                $DetailProductssaleoff = $DetailProducts['saleoff'];
                                if ($DetailProductsprice > 0) {
                                    $DetailProductsgiaold = '<p>' . str_replace(',', '.', number_format($DetailProductsprice)) . ' ?</p>';
                                } else {
                                    $DetailProductsgiaold = '';
                                }
                                if ($DetailProductssaleoff > 0) {
                                    $DetailProductsgia = '<p>' . str_replace(',', '.', number_format($DetailProductssaleoff)) . ' ?</p> ';
                                } else {
                                    $DetailProductsgia = $this->lang->line('contact');
                                }
                                if ($DetailProductsprice > 0 && $DetailProductssaleoff > 0 && $DetailProductsprice > $DetailProductssaleoff) {
                                    $sale_tour = '<span class="icon icon-promotion hidden-xs"></span><span>Early Bird - ' . ceil((($DetailProductsprice - $DetailProductssaleoff) / $DetailProductssaleoff) * 100) . '% off</span>';
                                } else {
                                    $sale_tour = '';
                                }
                                ?>
                                <div class="price-ctsp">
                                    <?php echo $DetailProductsgia ?>
                                </div>
                                <div class="add-to-cart">
                                    <p>S? l??ng:</p>

                                    <div class="pull-left">
                                        <div class="custom pull-left">
                                            <button class="increase items-count btn-down"><i class="fa fa-plus">
                                                    &nbsp;</i></button>
                                            <input type="text" class="input-text qty quantity" title="Qty" value="1"
                                                   maxlength="12" id="qty" name="quantity">
                                            <button class="reduced items-count btn-up"><i class="fa fa-minus">&nbsp;</i>
                                            </button>
                                        </div>
                                    </div>
                                    <button
                                        class="button btn-cart  btn-add-to-cart action-button btn-addtocart ajax-addtocart"
                                        data-href="dat-mua.html" data-quantity="1" title="Thêm gi? hàng"
                                        data-id="<?php echo $DetailProducts['id'] ?>"
                                        data-price="<?php echo $DetailProductssaleoff ?>">
                                        <span><i class="fa fa-shopping-cart"></i> Thêm vào gi? hàng</span>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-tab-ctsp">
                        <div class="btn-tab-ctsp">
                            <ul class="nav nav-pills">
                                <li class="active"><a data-toggle="pill" href="#tab1">Thông tin s?n ph?m</a></li>
                                <li class=""><a data-toggle="pill" href="#tab2">Bình lu?n</a></li>
                            </ul>
                        </div>
                        <div class="wp-tab-content">
                            <div class="tab-content">
                                <div id="tab1" class="tab-pane fade active in">
                                    <div class="sau-tab">
                                        <?php echo $DetailProducts['content']; ?>
                                    </div>
                                </div>
                                <div id="tab2" class="tab-pane fade">
                                    <div class="sau-tab">

                                        <?php coment_fb() ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if (isset($products_same) && is_array($products_same) && count($products_same)) { ?>
                        <div class="box-sp-lienquan">
                        <h2 class="h2-tinkhac">S?n ph?m liên quan</h2>

                        <div class="row">
                            <?php foreach ($products_same as $keyp => $val) { ?>
                                <?php
                                $title = $val['title'];
                                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products');
                                $image = getthumb($val['images'], FALSE);
                                $price = $val['price'];
                                $saleoff = $val['saleoff'];
                                if ($price > 0) {
                                    $giaold = str_replace(',', '.', number_format($price)) . '?';
                                } else {
                                    $giaold = '';
                                }
                                if ($saleoff > 0) {
                                    $gia = str_replace(',', '.', number_format($saleoff)) . '?';
                                } else {
                                    $gia = 'Liên h?';
                                }
                                if ($saleoff > 0 && $price > 0 && $saleoff < $price) {
                                    $sale = ceil(($price - $saleoff) / $price * 100);
                                    $price_sale = str_replace(',', '.', number_format($price - $saleoff)) . '?';
                                } else {
                                    $sale = $price_sale = '';
                                }
                                ?>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="wp-item-sp">
                                        <div class="wp-img-sp">
                                            <a href="<?php echo $href ?>" class="h_10"><img src="<?php echo $image ?>"
                                                                                            alt="<?php echo $title ?>"></a>
                                        </div>
                                        <div class="wp-text-sp">
                                            <h4 class="h4-title-sp"><a
                                                        href="<?php echo $href ?>"><?php echo $title ?></a></h4>

                                            <div class="price">
                                                <span class="ins"><?php echo $gia ?></span>
                                                <span class="del"><?php echo $giaold ?></span>
                                            </div>

                                            <div class="btn-xem">
                                                <a href="<?php echo $href; ?>" class="btn">Xem chi ti?t</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        </div>
                    <?php } ?>


                </div>
            </div>
            <?php echo $this->load->view('homepage/frontend/common/aside'); ?>
        </div>
    </div>
</section>


<section class="sec-banner-page">
    <div class="wp-banner-page">
        <img src="<?php echo $this->fcSystem['banner_banner1'] ?>" alt="<?php echo $DetailProducts['title']; ?>">

    </div>
</section>

<section class="sec-bread">
    <div class="container">
        <ul>
            <li><a href="<?php echo base_url() ?>">Home</a></li>
            <?php foreach ($Breadcrumb as $key => $val) { ?>
                <?php
                $title = $val['title'];
                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products_catalogues');
                ?>
                <li>
                    <a href="<?php echo $href; ?>"
                       title="<?php echo $title; ?>"><?php echo $title; ?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
</section>

<section class="sec-content-page content-danhsach-sp">
    <div class="container">
        <div class="row row-edit-768">
            <div class="col-md-9 col-sm-9 col-xs-12 col-edit-768 fl-right">
                <div class="wp-content-ctsp">
                    <div class="wp-box1-ctsp">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="wp-img-ctsp-a" style="width: 100% !important">
                                    <input type="hidden" id="__VIEWxSTATE"/>
                                    <script src="templates/frontend/resources/js/modernizr.custom.js"
                                            type="text/javascript"></script>

                                    <link rel="stylesheet"
                                          href="templates/frontend/resources/css/glasscase.minf195.css">
                                    <ul id='zoom1' class='gc-start'>

                                        <li><img src="<?php echo $DetailProducts['images']; ?>"
                                                 alt='<?php echo $DetailProducts['title'] ?>'/></li>

                                        <?php $listItem = json_decode($DetailProducts['album'], TRUE); ?>
                                        <?php if (isset($listItem) && is_array($listItem) && count($listItem)) { ?>
                                            <?php foreach ($listItem as $key => $val) { ?>
                                                <li><img src="<?php echo $val['images']; ?>"
                                                         alt='<?php echo $val['title'] ?>'/></li>
                                            <?php } ?>
                                        <?php } ?>

                                    </ul>
                                    <script src="templates/frontend/resources/js/jquery.glasscase.minf195.js"></script>

                                    <script>/*js chi ti?t s?n ph?m */
                                        $(function () {
                                            $("#zoom1").glassCase({
                                                'widthDisplay': 655,
                                                'heightDisplay': 400,
                                                'nrThumbsPerRow': 4,
                                                'isSlowZoom': true,
                                                'colorIcons': '#F15129',
                                                'colorActiveThumb': '#F15129'
                                            });

                                        });
                                    </script>

                                </div>
                            </div>
                            <div class="col-md-6 col-dm-12 col-xs-12">
                                <div class="wp-text-ctsp-a">
                                    <h1 class="ten-ctsp"><?php echo $DetailProducts['title']; ?></h1>

                                    <p class="ma-sp"><?php echo $DetailProducts['content1']; ?></p>

                                    <?php echo $DetailProducts['description']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wp-banner-ads">
                        <a href="#"><img src="images/banner-ads.jpg" alt=""></a>
                    </div>
                    <?php $listItem = json_decode($DetailProducts['album3'], TRUE); ?>
                    <?php if (isset($listItem) && is_array($listItem) && count($listItem)) { ?>
                        <div class="wp-box2-ctsp">
                            <h2 class="title-box-ctsp">Feature</h2>

                            <div class="row">

                                <?php foreach ($listItem as $key => $val) { ?>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="wp-iteam-feature">
                                            <div class="img-feature">
                                                <a href="javascript:void();"><img src="<?php echo $val['images'] ?>"
                                                                                  alt="<?php echo $val['title'] ?>"></a>
                                            </div>
                                            <div class="text-feature">
                                                <h4><a href="javascript:void();"><?php echo $val['title'] ?></a></h4>

                                                <p><?php echo $val['description'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>


                            </div>
                        </div>
                    <?php } ?>

                    <div class="wp-box3-ctsp">
                        <?php $listItem1 = json_decode($DetailProducts['album4'], TRUE); ?>
                        <?php if (isset($listItem1) && is_array($listItem1) && count($listItem1)) { ?>
                        <h2 class="title-box-ctsp">Specification</h2>

                        <div class="content-box3-ctsp">
                            <div class="table-ctsp">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr class="a" style="background-color: #333333">
                                        <td colspan="4"
                                            style="color: #fff;text-align: center;"><?php echo $DetailProducts['title']; ?>
                                        </td>
                                    </tr>
                                    <?php foreach ($listItem1 as $key => $val) { ?>
                                        <tr>
                                            <td><?php echo $val['title'] ?></td>
                                            <td><?php echo $val['description'] ?></td>
                                            <td><?php echo $val['content1'] ?></td>
                                            <td><?php echo $val['content2'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <?php } ?>
                            <div class="text-p">
                                <?php echo $DetailProducts['content']; ?>
                            </div>

                        </div>
                    </div>

                    <div class="back-list text-center">
                        <a href="javascript: history.back();" class="btn">Back to list&nbsp;<i
                                class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <?php echo $this->load->view('homepage/frontend/common/aside'); ?>
        </div>
    </div>
</section>


<link href="templates/frontend/resources/uikit/css/uikit.modify.css" rel="stylesheet"/>
<link href="templates/frontend/resources/library/css/reset.css" rel="stylesheet"/>
<link href="templates/frontend/resources/library/css/library.css" rel="stylesheet"/>
<script src="templates/frontend/resources/uikit/js/uikit.min.js"></script>
<?php
$DetailProductsprice = $DetailProducts['price'];
$DetailProductssaleoff = $DetailProducts['saleoff'];
if ($DetailProductsprice > 0) {
    $DetailProductsgiaold = '<font>' . str_replace(',', '.', number_format($DetailProductsprice)) . ' <sub>?</sub></font>';
} else {
    $DetailProductsgiaold = '';
}
if ($DetailProductssaleoff > 0) {
    $DetailProductsgia = '<span>' . str_replace(',', '.', number_format($DetailProductssaleoff)) . ' <sub>?</sub></span> ';
} else {
    $DetailProductsgia = $this->lang->line('contact');
}
if ($DetailProductsprice > 0 && $DetailProductssaleoff > 0 && $DetailProductsprice > $DetailProductssaleoff) {
    $sale_tour = '<span class="icon icon-promotion hidden-xs"></span><span>Early Bird - ' . ceil((($DetailProductsprice - $DetailProductssaleoff) / $DetailProductssaleoff) * 100) . '% off</span>';
} else {
    $sale_tour = '';
}
?>
<section class="content-ct-sp pd-30">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-9 col-xs-12 fl-right">
                <div class="wp-right-ctsp">
                    <div class="bread-page">
                        <ul>
                            <li><a href="<?php echo base_url() ?>">Trang ch?</a></li>
                            <?php foreach ($Breadcrumb as $key => $val) { ?>
                                <?php
                                $title = $val['title'];
                                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products_catalogues');
                                ?>
                                <li>
                                    <a href="<?php echo $href; ?>"
                                       title="<?php echo $title; ?>"><?php echo $title; ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="content-ctsp">
                        <div class="ctsp-top">
                            <div class="row">
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="wp-img-ctsp">
                                        <div class="slider-for slider img-to">
                                            <div><img src="<?php echo $DetailProducts['images']; ?>" alt='image1'/>
                                            </div>
                                            <?php $listItem = json_decode($DetailProducts['album'], TRUE); ?>
                                            <?php if (isset($listItem) && is_array($listItem) && count($listItem)) { ?>
                                                <?php foreach ($listItem as $key => $val) { ?>
                                                    <?php if ($val['images'] == '') continue; ?>
                                                    <div><img src="<?php echo $val['images']; ?>"
                                                              alt="<?php echo $val['title'] ?>"/></div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                        <div class="slider-nav slider img-nho">
                                            <div><img src="<?php echo $DetailProducts['images']; ?>" alt='image1'/>
                                            </div>
                                            <?php $listItem = json_decode($DetailProducts['album'], TRUE); ?>
                                            <?php if (isset($listItem) && is_array($listItem) && count($listItem)) { ?>
                                                <?php foreach ($listItem as $key => $val) { ?>
                                                    <?php if ($val['images'] == '') continue; ?>
                                                    <div><img src="<?php echo $val['images']; ?>"
                                                              alt="<?php echo $val['title'] ?>" style="height: 81px"/>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="wp-thong-tin-sp">
                                        <div class="div-ten-thuoctinh list-tt-sp">
                                            <p>Tên s?n ph?m:</p>

                                            <h1><?php echo $DetailProducts['title'] ?></h1>
                                            <?php echo $DetailProducts['description'] ?>
                                        </div>
                                        <form action="addtocart.html" class="uk-form form">
                                            <input type="hidden" name="href" value="dat-mua.html">
                                            <input type="hidden" name="id" value="<?php echo $DetailProducts['id'] ?>">
                                            <?php if (isset($products_attr) && is_array($products_attr) && count($products_attr)) { ?>
                                                <div class="cleboxatrr" style="margin-top: 5px">
                                                    <?php foreach ($products_attr as $key => $val) {
                                                        if (isset($val['attr']) && is_array($val['attr']) && count($val['attr'])) { ?>
                                                            <span class="lbLeft"><?php echo $val['title'] ?></span>
                                                            <div id="property">
                                                                <?php foreach ($val['attr'] as $key => $valattr) { ?>
                                                                    <input type="radio"
                                                                           name="color"
                                                                           value="<?php echo $valattr['title'] ?>"
                                                                           style="background:<?php echo $valattr['title'] ?>;margin:0px;border-radius: 0px;border: none;padding: 12px;">

                                                                <?php } ?>
                                                            </div>
                                                        <?php }
                                                    } ?>
                                                </div>

                                            <?php } ?>
                                            <div style="clear: both;height: 20px;"></div>
                                            <div class="wp-soluong">
                                                <div class="custom input_number_product custom-btn-number form-control">
                                                    <div class="quantity-box uk-clearfix">


                                                        <span class="btn_num num_1 button button_qty btn btn-up"><i
                                                                class="fa fa-caret-down"></i>
                                                        </span>
                                                        <input type="text" name="quantity" value="1"
                                                               class="form-control prd_quantity quantity">
                                                        <span class="btn_num num_2 button button_qty btn btn-down"><i
                                                                class="fa fa-caret-up"></i>
                                                        </span>

                                                    </div>
                                                </div>

                                                <div class="btn-datmua">
                                                    <a class="action-button btn-addtocart ajax-addtocart "
                                                       data-href="dat-mua.html"
                                                       title="" data-attr="" data-quantity="1" title="Thêm gi? hàng"
                                                       id="" data-id="<?php echo $DetailProducts['id'] ?>"
                                                       data-price="<?php echo $DetailProductssaleoff ?>">??t hàng</a>

                                                </div>
                                                <style>
                                                    .action-button {
                                                        height: 32px;
                                                        line-height: 32px;
                                                        float: left;
                                                        padding: 0px 30px;
                                                        background-color: #ba1e24 !important;
                                                        color: #fff;
                                                        border: none;
                                                    }

                                                    .lbLeft {
                                                        margin-bottom: 5px;
                                                    }
                                                </style>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <div class="wp-slogan">
                                        <ul>
                                            <li>
                                                <h4><b>Cam k?t giá t?t nh?t</b></h4>

                                                <p>Chúng tôi cam k?t t?i khách hàng nh?ng s?n ph?m t?t nh?t v?i m?c th?p
                                                    nh?t </p>
                                            </li>
                                            <li>
                                                <h4><B>Giao hàng toàn qu?c</B></h4>

                                                <p>Giao hàng v?i 64 t?nh thành v?i giá c??c h?p lý và c?nh tranh
                                                    cao </p>
                                            </li>
                                            <li>
                                                <h4><b>Giao hàng toàn qu?c</b></h4>

                                                <p>Giao hàng v?i 64 t?nh thành v?i giá c??c h?p lý </p>
                                            </li>
                                            <li>
                                                <p><b>B?N C?N TR? GIÚP? HÃY LIÊN H? V?I CHÚNG TÔI <span
                                                            style="color: #ba1e24;"><?php echo $this->fcSystem['contact_phone'] ?>
                                                            - <?php echo $this->fcSystem['contact_hotline'] ?></span></b>
                                                </p>

                                                <p>Th?i gian làm vi?c <br>Th? 2 - 7 : T? 7h30 - 17h.</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ctsp-middle">
                            <div class="wp-tab-ctsp">
                                <ul class="nav nav-pills">
                                    <li class="active"><a data-toggle="pill" href="#tskt">Thông tin s?n ph?m</a></li>
                                    <li><a data-toggle="pill" href="#menu1">Bình lu?n</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="tskt" class="tab-pane fade in active">
                                        <div class="div-sautab p-mb10">
                                            <?php echo $DetailProducts['content'] ?>
                                        </div>
                                    </div>
                                    <div id="menu1" class="tab-pane fade">
                                        <div class="div-sautab">
                                            <div class="fb-comments" data-href="<?php echo $canonical ?>"
                                                 data-numposts="5" data-width="100%"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($products_same) && is_array($products_same) && count($products_same)) { ?>

                            <div class="ctsp-bottom">
                                <div class="title-sec-sp title-sp-lq">
                                    <h4><a href="#">S?n ph?m cùng danh m?c</a></h4>
                                    <span><a href="#">Xem t?t c?</a></span>
                                </div>
                                <div class="list-sp-lq">
                                    <div class="row">
                                        <?php foreach ($products_same as $keyp => $val) { ?>
                                            <?php
                                            $title = $val['title'];
                                            $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products');
                                            $image = getthumb($val['images'], FALSE);

                                            ?>
                                            <div class="col-md-4 col-sm-6 col-xs-6 mg-b-20">
                                                <div class="wp-item-sp">
                                                    <div class="wp-img-sp">
                                                        <a href="<?php echo $href ?>"><img src="<?php echo $image ?>"
                                                                                           alt="<?php echo $title ?>"></a>
                                                    </div>
                                                    <div class="ten-sp">
                                                        <h4><a href="<?php echo $href ?>"><?php echo $title ?></a></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php echo $this->load->view('homepage/frontend/common/aside'); ?>
        </div>
    </div>
</section>
<script type="text/javascript">
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: true,
        centerMode: true,
        focusOnSelect: true
    });
</script>
<article id="body_home">

    <!--main-->
    <div class="container">
        <div class="row">

            <div class="col-lg-9 col-md-9 col-sm-8 col-1200-80">
                <div class="back_link">
                    <ul>
                        <li><a href="<?php echo BASE_URL ?>">Trang ch?</a></li>
                        <?php foreach ($Breadcrumb as $key => $val) { ?>
                            <?php
                            $title = $val['title'];
                            $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products_catalogues');
                            ?>
                            <li class="uk-active">
                                <a href="<?php echo $href; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
                            </li>
                        <?php } ?>                    </ul>
                </div>

                <div class="clearfix-10"></div>

                <div class="qts_mid_content">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <input type="hidden" id="__VIEWxSTATE"/>
                            <script src="templates\frontend\resources\js\modernizr.custom.js"
                                    type="text/javascript"></script>
                            <link href="templates\frontend\resources\css\glasscase.minf195.css" rel="stylesheet"/>
                            <ul id='zoom1' class='gc-start'>
                                <li><img src="<?php echo $DetailProducts['images']; ?>" alt='image1'/></li>
                                <?php $listItem = json_decode($DetailProducts['album'], TRUE); ?>
                                <?php foreach ($listItem as $key => $val) { ?>
                                    <?php if ($val['images'] == '') continue; ?>
                                    <li data-thumb="<?php echo $val['images']; ?>">
                                        <img src="<?php echo $val['images']; ?>" alt="<?php echo $val['title'] ?>"/>

                                    </li>
                                <?php } ?>

                            </ul>


                            <script src="templates\frontend\resources\js\jquery.glasscase.minf195.js"></script>
                            <script type="text/javascript">
                                $(function () {
                                    //ZOOM
                                    $("#zoom1").glassCase({
                                        'widthDisplay': 500,
                                        'heightDisplay': 315,
                                        'nrThumbsPerRow': 3,
                                        'isSlowZoom': true,
                                        'colorIcons': '#F15129',
                                        'colorActiveThumb': '#F15129'
                                    });

                                });
                            </script>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <h1 class="name_prod_detail"><?php echo $DetailProducts['title'] ?></h1>

                            <div class="price price_d">

                                <span class="price_new">Giá : Liên h?</span>
                            </div>

                            <div class="clearfix"></div>
                            <div class="info_prod_dt">
                                <?php echo $DetailProducts['description'] ?>

                            </div>
                            <div class="clearfix clearfix-10"></div>
							<span>Chia s? v?i b?n bè: <script type="text/javascript"
                                                              src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59e812e6b22460be"></script>
                                        <div class="addthis_inline_share_toolbox_v5tc"></div>
                                       </span>
                            <style>
                                #at-cv-toaster .at-cv-toaster-bottomLeft {
                                    display: none;
                                }
                            </style>
                        </div>

                    </div>

                </div>
                <div class="clearfix-20"></div>

                <h2 class="tit_cat"><a href="http://khokyguinhanh.com/nhan-sam.html">Mô t?</a></h2>

                <div class="clearfix-10"></div>
                <div class="txt_prod_dt" style="font-size: 14px;color: black;line-height: 20px;text-align: justify">
                    <?php echo $DetailProducts['content'] ?>
                </div>
                <?php if (isset($products_same) && is_array($products_same) && count($products_same)) { ?>

                    <div class="clearfix clearfix-5"></div>
                    <div class="clearfix-10"></div>
                    <h2 class="tit_cat"><a href="http://khokyguinhanh.com/nhan-sam.html">S?n ph?m khác</a></h2>

                    <div class="clearfix-20"></div>
                    <div class="row_12">
                        <?php foreach ($products_same as $keyp => $val) { ?>
                            <?php
                            $title = $val['title'];
                            $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products');
                            $image = getthumb($val['images'], FALSE);

                            ?>
                            <div class="col-sm-4 col-xs-4 col-480-12">
                                <div class="row_3">
                                    <div class="box_prod_hot">
                                        <a href="<?php echo $href ?>"
                                           class="img_prod_hot"><img class="w_100"
                                                                     src="<?php echo $image ?>"
                                                                     alt="<?php echo $title ?>" style="height: 201px;"></a>

                                        <h3 class="name_prod_hot"><a href="<?php echo $href ?>"><?php echo $title ?></a>
                                        </h3>

                                        <div class="price">

                                            <span class="price_new">Giá: Liên h?</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                <?php } ?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-1200-20">
                <div class="box_product">
                    <div class="menu_left_prod">
                        <h2 class="tit_left"><span><i class="fa fa-bars"
                                                      aria-hidden="true"></i>S?n ph?m n?i b?t</span>
                        </h2>

                        <?php if (isset($productshighlight) && is_array($productshighlight) && count($productshighlight)) { ?>
                            <?php foreach ($productshighlight as $key => $val) { ?>
                                <?php
                                $title = $val['title'];
                                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products');
                                $image = getthumb($val['images'], FALSE);
                                ?>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box">
                                    <div class="row">
                                        <div class="box_prod_home clearfix">
                                            <div class="col-md-6 col-sm-4 col-xs-4">
                                                <div class="row text-center">
                                                    <a href="<?php echo $href ?>" class="img_prod_home"> <img
                                                            class="w_100" src="<?php echo $image ?>"
                                                            alt="<?php echo $title; ?>">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-sm-8 col-xs-8">
                                                <div class="row">
                                                    <div class="sub_prod_home">
                                                        <h3 class="name_prod_home"><a
                                                                href="<?php echo $href ?>"><?php echo $title; ?></a>
                                                        </h3>

                                                        <div class="clearfix"></div>
                                                        <div class="clearfix"></div>
                                                        <div class="price_new_home">Giá: <span>Liên h?</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>


                    </div>
                </div>
                <div class="clearix clearfix-10"></div>
                <div class="suport">
                    <img class="w_100" src="templates\frontend\resources\css\img\support.png"
                         alt="H? tr? tr?c tuy?n">

                    <div class="tit_sup">Hotline:</div>
                    <div class="phone_sup"><?php echo $this->fcSystem['contact_hotline'] ?></div>
                    <ul class="list_sp">
                        <div class="clearfix-10"></div>
                        <?php if (isset($support) && is_array($support) && count($support)): ?>
                            <?php foreach ($support as $key => $val) { ?>
                                <p class="nhanvien"><?php echo $val['fullname']; ?></p>
                                <li class="clearfix">
                                    <div class="name_sp pull-left">
                                        <a href="<?php echo $val['facebook']; ?>"><img
                                                src="templates\frontend\resources\css\img\nv1.png"
                                                alt="<?php echo $val['facebook']; ?>"></a>
                                    </div>
                                    <div class="zs pull-right">
                                        <a href="skype:<?php echo $val['facebook']; ?>?call"><img
                                                src="templates\frontend\resources\css\img\nv2.png"
                                                alt="<?php echo $val['skype']; ?>"></a>
                                    </div>
                                </li>
                                <div class="clearfix"></div>
                            <?php }; ?>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="clearfix-10"></div>
                <div class="page_fb">

                </div>
                <div class="clearfix-10"></div>
                <div class="counter">
                    <h2 class="tit_counter"></h2>

                    <?php
                    $this->db->select('*')->from('counter_values');
                    $row = $this->db->get()->row_array();
                    //echo "<pre>";var_dump($row);die();
                    $this->db->select('*')->from('counter_ips');
                    $online = $this->db->count_all_results();
                    ?>
                    <div class="cover_connect">
                        <div class="text_connect">
                            <div><span>Online</span><?php echo $online; ?>
                            </div>
                            <div><span>Hôm nay</span><?php echo $row['day_id']; ?>
                            </div>
                            <div><span>Hôm qua</span><?php echo $row['yesterday_id']; ?>
                            </div>
                            <div><span>T?ng truy c?p</span><?php echo $row['all_value']; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</article>
<?php
$hrefC = rewrite_url($DetailProducts['canonical'], $DetailProducts['slug'], $DetailProducts['id'], 'products');
$DetailProductsprice = $DetailProducts['price'];
$DetailProductssaleoff = $DetailProducts['saleoff'];
if ($DetailProductsprice > 0) {
    $DetailProductsgiaold = str_replace(',', '.', number_format($DetailProductsprice)) . '<sup>?</sup>';
} else {
    $DetailProductsgiaold = '';
}
if ($DetailProductssaleoff > 0) {
    $DetailProductsgia = str_replace(',', '.', number_format($DetailProductssaleoff)) . '<sup>?</sup>';
} else {
    $DetailProductsgia = $this->lang->line('contact');
}
if ($DetailProductsprice > 0 && $DetailProductssaleoff > 0 && $DetailProductsprice > $DetailProductssaleoff) {
    $sale_tour = ceil((($DetailProductsprice - $DetailProductssaleoff) / $DetailProductssaleoff) * 100);
} else {
    $sale_tour = '';
}
?>
<section class="bread-sec">
    <div class="container">
        <div class="bg-ff pd-10 mg-b-0">
            <ul class="ul-bread">
                <li><a href="<?php echo base_url() ?>">Trang ch?</a></li>
                <?php foreach ($Breadcrumb as $key => $val) { ?>
                    <?php
                    $title = $val['title'];
                    $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products_catalogues');
                    ?>
                    <li>
                        <a href="<?php echo $href; ?>"
                           title="<?php echo $title; ?>"><?php echo $title; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</section>
<section class="sec-chitiet-sp">
    <div id="sticky-wrapper" class="sticky-wrapper">
        <div class="main-menu-bar sticky-header-enable">
            <div class="wp-title-ctsp-a">
                <div class="container">
                    <div class="bg-ff pd-10 mg-b-0 bd-1">
                        <div class="title-ctsp disp-flex-ctsp">
                            <div class="ten-sp">
                                <h1><span>-<?php echo $sale_tour ?>%</span><?php echo $DetailProducts['title'] ?></h1>
                            </div>
                            <div class="gia-sp">
                                <div class="top_product_price_number">
                                    <span></span> <?php echo $DetailProductsgia ?> <sup></sup>
                                </div>
                                <div class="product_price_old"><span></span> <?php echo $DetailProductsgiaold ?>
                                    <sup></sup></div>
                            </div>
                            <div class="dat-mua">
                                <div class="hidden">
                                    <div class="label uk-hidden" style="width: 90px;line-height: 32px;">S? l??ng</div>
                                    <div class="quantity-box uk-clearfix uk-hidden">
                                        <span class="btn btn-up">-</span>
                                        <input type="text" name="" value="1" class="quantity"/>
                                        <span class="btn btn-down">+</span>
                                    </div>

                                </div>
                                <div class="product_inventory"><span class="have_product">Còn hàng</span></div>
                                <div class="btn-mua-ngay">
                                    <div class="action-button ajax-addtocart btn btn-mua" data-quantity="1"
                                         data-id="<?php echo $DetailProducts['id'] ?>"
                                         data-price="<?php echo $DetailProductssaleoff ?>">??t mua
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wp-main-ctsp-chinh">
        <div class="container ">
            <div class="wp-div-ctsp pd-top-10 bg-ff pd-10">
                <div class="img-ctsp-left">
                    <div class="row">
                        <div class="col-md-5 col-sm-5 col-xs-12">
                            <input type="hidden" id="__VIEWxSTATE"/>
                            <script src="templates/frontend/resources/js/modernizr.custom.js"
                                    type="text/javascript"></script>
                            <link href="templates/frontend/resources/css/glasscase.minf195.css" rel="stylesheet"/>
                            <ul id='zoom1' class='gc-start'>
                                <li><img src="<?php echo $DetailProducts['images']; ?>" alt='image1'/></li>


                                <?php $listItem = json_decode($DetailProducts['album'], TRUE); ?>
                                <?php if (isset($listItem) && is_array($listItem) && count($listItem)) { ?>
                                    <?php foreach ($listItem as $key => $val) { ?>
                                        <?php if ($val['images'] == '') continue; ?>
                                        <li><img src="<?php echo $val['images']; ?>" alt='<?php echo $val['title'] ?>'/>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>


                            <script src="templates/frontend/resources/js/jquery.glasscase.minf195.js"></script>
                            <script type="text/javascript">
                                $(function () {
                                    //ZOOM
                                    $("#zoom1").glassCase({
                                        'widthDisplay': 655,
                                        'heightDisplay': 400,
                                        'nrThumbsPerRow': 5,
                                        'isSlowZoom': true,
                                        'colorIcons': '#F15129',
                                        'colorActiveThumb': '#F15129'
                                    });

                                });
                            </script>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="wp-tt-ctsp1">
                                <div class="wp-tt-right">
                                    <h4 class="title_product_info">thông tin s?n ph?m</h4>
                                    <?php echo $DetailProducts['description']; ?>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="wp-tt-right">
                                <div class="ads-banner-ctsp" style="margin-bottom: 15px;">
                                    <a href="#"><img src="templates/frontend/resources/images/doi-tra.png"></a>
                                </div>
                                <div class="content_why_buy">
                                    <div class="content_why_buy_header"><img
                                            src="templates/frontend/resources/images/bg_product_why.jpg"></div>
                                    <div class="slimScrollDiv"
                                         style="position: relative; width: auto;padding: 5px">
                                        <?php echo $DetailProducts['content3']; ?>
                                    </div>
                                </div>
                                <?php echo $this->fcSystem['homepage_fax'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pd-top-10">
                <div class="wp-tskt">
                    <div class="row">
                        <div class="col-md-8 col-sm-12 col-xs-12 content_product_right">
                            <div class="product_info_center pg-details pd-10 bg-ff">
                                <div class="gioi-thieu-sp">
                                    <div class="wp-gt-sp box-content">
                                        <?php echo $DetailProducts['content']; ?>
                                    </div>
                                    <div class="btn-view-all">Xem thêm <i class="fa fa-caret-down"
                                                                          aria-hidden="true"></i></div>
                                    <a href="<?php echo $hrefC ?>#prd_left">
                                        <div class="btn-view-small" hidden="true">Thu g?n <i class="fa fa-caret-up"
                                                                                             aria-hidden="true"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="wp-danhgia-sp bg-ff">


                                    <?php $this->load->view('homepage/frontend/common/comments') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 content_product_left">
                            <div class="wp-side-bar-right-2 bg-ff pd-10">
                                <div class="wp-thongso">
                                    <h3 class="title_thongso_kythuat title_product_info">Thông s? k? thu?t</h3>

                                    <div class="content_thongso_kythuat product_info_center pg-details">
                                        <?php echo $DetailProducts['content4']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="wp-video bg-ff pd-10">
                                <h3 class="title_video title_product_info">Video s?n ph?m</h3>

                                <div class="if-maychieu">
                                    <?php echo $DetailProducts['content2']; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (isset($products_same) && is_array($products_same) && count($products_same)) { ?>
                <div class="wp-sp-lienquan bg-ff pd-10">
                    <h3 class="title_video title_product_info">S?n ph?m liên quan</h3>

                    <div id="sp-lq" class="owl-carousel owl-theme">
                        <?php foreach ($products_same as $keyp => $value) { ?>
                            <?php
                            $title = $value['title'];
                            $href = rewrite_url($value['canonical'], $value['slug'], $value['id'], 'products');
                            $image = getthumb($value['images'], FALSE);
                            $price = $value['price'];
                            $saleoff = $value['saleoff'];
                            if ($price > 0) {
                                $giaold = str_replace(',', '.', number_format($price)) . '?';
                            } else {
                                $giaold = '';
                            }
                            if ($saleoff > 0) {
                                $gia = str_replace(',', '.', number_format($saleoff)) . '?';
                            } else {
                                $gia = '';
                            }
                            if ($saleoff > 0 && $price > 0 && $saleoff < $price) {
                                $sale = ceil(($price - $saleoff) / $price * 100);
                                $price_sale = str_replace(',', '.', number_format($price - $saleoff)) . '?';
                            } else {
                                $sale = $price_sale = '';
                            }

                            ?>
                            <div class="item">
                                <div class="wp-item-sp">
                                    <a href="<?php echo $href ?>">
                                        <img src="<?php echo $image ?>" alt="<?php echo $title ?>"
                                             style="max-height: 196px">
                                    </a>

                                    <div class="clearfix"></div>
                                    <h3><a href="<?php echo $href ?>"><?php echo $title ?></a></h3>

                                    <div class="width-70p">
                                        <span class="text-price price-new"> <b><?php echo $gia ?></b></span>
                                        <span class="text-price price-old"> <b><?php echo $giaold ?></b></span>
                                    </div>
                                    <div class="width-30p">
                                        <a class="read-more-product" href="<?php echo $href ?>">Xem thêm</a>
                                    </div>
                                    <div class="clearfix"></div>

                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<style>
    .gc-icon.gc-icon-download {
        display: none !important;
    }

    .gc-thumbs-area-next .gc-icon.gc-icon-next:before {
        content: "\f105" !important;
        font: normal normal normal 24px/1 fontawesome !important;
        width: 24px;
        height: 24px;
        text-align: center;
    }

    .gc-thumbs-area-prev .gc-icon.gc-icon-prev:before {
        content: "\f104" !important;
        font: normal normal normal 24px/1 fontawesome !important;
        width: 24px;
        height: 24px;
        text-align: center;
    }

    .gc-display-area .gc-icon.gc-icon-next {
        width: 36px !important;
        height: 50px !important;
        right: 10px;
    }

    .gc-display-area .gc-icon.gc-icon-next:before {
        content: "\f105" !important;
        font: normal normal normal 48px/1 fontawesome !important;
        width: 36px;
        color: #fff;
        height: 50px;
        text-align: center;
    }

    .gc-display-area .gc-icon.gc-icon-prev {
        width: 36px !important;
        height: 50px !important;
        left: 10px;
    }

    .gc-display-area .gc-icon.gc-icon-prev:before {
        content: "\f104" !important;
        font: normal normal normal 48px/1 fontawesome !important;
        width: 36px;
        color: #fff;
        height: 50px;
        text-align: center;
    }

    .gc-overlay-right-icons .gc-icon.gc-icon-next {
        width: 36px !important;
        height: 50px !important;
        text-align: center;
    }

    .gc-overlay-right-icons .gc-icon.gc-icon-next:before {
        content: "\f105" !important;
        font: normal normal normal 48px/1 fontawesome !important;
        width: 36px !important;
        height: 50px !important;
        color: #fff;
    }

    .gc-overlay-left-icons .gc-icon.gc-icon-prev {
        width: 36px !important;
        height: 50px !important;
        text-align: center;
    }

    .gc-overlay-left-icons .gc-icon.gc-icon-prev:before {
        content: "\f104" !important;
        font: normal normal normal 48px/1 fontawesome !important;
        width: 36px !important;
        height: 50px !important;
        color: #fff;
    }

    .gc-icon.gc-icon-enlarge {
        display: none !important;
    }

    .gc-overlay-top-icons .gc-icon.gc-icon-close:before {
        content: "\f00d" !important;
        font: normal normal normal 25px/1 fontawesome !important;
        color: #fff;
        width: 24px;
        text-align: center;
    }

    .glass-case {
        margin: auto;
    }
</style>
<script type="text/javascript">
    $('.btn-view-all').click(function () {
        $('.box-content').addClass('box-content-full');
        $(this).hide();
        $('.btn-view-small').show();
    })
    $('.btn-view-small').click(function () {
        $('.box-content').removeClass('box-content-full');
        $(this).hide();
        $('.btn-view-all').show();
    })
</script>
<script>
    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function () {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<style>

    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 999999999999999; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 320px;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    #myBtn {
        display: block;
        width: 100%;
        margin: 30px 0;
        padding: 10px;
        border: 1px solid #191919;
        text-align: center;
        color: #191919;
        text-decoration: none;
    }

    #myBtn span:before {
        font-size: 10px;
        content: "+";
        margin-left: 20px;
        color: #ced1d6;
    }

    .productSpecification_title {
        font-weight: bold;
        text-align: left;
    }

    .productSpecification_table tbody tr td {
        padding-top: 10px;
        vertical-align: top;
    }
</style>
<script>
    $(document).ready(function () {
        load_attribute();

    });
    function load_attribute() {
        var atrr = $('#select-size').val();
        $('.ajax-addtocart').attr('data-option', atrr);
    }
</script>
<style>
    .detail-products.mt20.mb20 ul, .detail-products.mt20.mb20 ol {
        padding-left: 15px;
    }

    @media (max-width: 767px) {
        #cfacebook, #Cp7hVNq {
            display: none !important;
        }

        .fixed-detail {
            display: block !important;
            visibility: inherit !important;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 9999999999;
        }

        .fixed-detail .item-flex a {
            text-align: center;
            padding: 5px 10px;
            color: #fff;
            font-size: 13px;
            display: block;
        }

        .fixed-detail .item-flex a > * {
            display: block
        }

        .fixed-detail {
            background: #e02626;
        }

        .fixed-detail .item-flex .ic_market {
            width: 100%;
            height: 18px;
            background-image: url('templates/frontend/resources/img/map.png');
            display: block;
            background-size: 12px;
            background-position: center center;
            background-repeat: no-repeat;
        }

        .fixed-detail .item-flex .ic_cart {
            width: 100%;
            height: 18px;
            background-image: url('templates/frontend/resources/img/it-2.png');
            display: block;
            background-size: 20px;
            background-position: center center;
            background-repeat: no-repeat;
        }
    }
</style>


<script src="templates/frontend/resources/js/modernizr.custom.js" type="text/javascript"></script>
<script src="templates/frontend/resources/js/jquery.glasscase.minf195.js"></script>
<link href="templates/frontend/resources/css/glasscase.minf195.css" rel="stylesheet"/>
<section class="sec-content-page">
    <div class="container">
        <div class="bread-page">
            <ul>
                <li><a href="<?php echo base_url() ?>">Trang ch?</a></li>
                <?php foreach ($Breadcrumb as $key => $val) { ?>
                    <?php
                    $title = $val['title'];
                    $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products_catalogues');
                    ?>
                    <li>
                        <a href="<?php echo $href; ?>"
                           title="<?php echo $title; ?>"><?php echo $title; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="row row-edit-10">
            <?php echo $this->load->view('homepage/frontend/common/aside'); ?>
            <div class="col-md-6 col-sm-8 col-xs-12 col-edit-10 width-55">
                <div class="wp-content-ctsp">
                    <div class="content-ctsp">
                        <div class="row row-edit-10">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-edit-10">
                                <div class="wp-img-ctsp-a">
                                    <input type="hidden" id="__VIEWxSTATE"/>
                                    <ul id='zoom1' class='gc-start'>
                                        <li><img src="<?php echo $DetailProducts['images']; ?>"
                                                 alt='<?php echo $DetailProducts['title']; ?>'/></li>
                                        <?php $listItem = json_decode($DetailProducts['album'], TRUE); ?>
                                        <?php if (isset($listItem) && is_array($listItem) && count($listItem)) { ?>
                                            <?php foreach ($listItem as $key => $val) { ?>
                                                <?php if ($val['images'] == '') continue; ?>
                                                <li><img src="<?php echo $val['images']; ?>"
                                                         alt='<?php echo $val['title']; ?>'/></li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 col-edit-10">
                                <div class="wp-text-ctsp">
                                    <h1 class="ten-ctsp"><?php echo $DetailProducts['title']; ?></h1>

                                    <p>
                                        <?php

                                        $price = $DetailProducts['price'];
                                        $saleoff = $DetailProducts['saleoff'];
                                        if ($price > 0) {
                                            $giaold = str_replace(',', '.', number_format($price)) . '?';
                                        } else {
                                            $giaold = '';
                                        }
                                        if ($saleoff > 0) {
                                            $gia = str_replace(',', '.', number_format($saleoff)) . '?';
                                        } else {
                                            $gia = 'Liên h?';
                                        }
                                        if ($saleoff > 0 && $price > 0 && $saleoff < $price) {
                                            $sale = ceil(($price - $saleoff) / $price * 100);
                                            $price_sale = str_replace(',', '.', number_format($price - $saleoff)) . '?';
                                        } else {
                                            $sale = $price_sale = '';
                                        }
                                        ?>

                                    <p class="gia gia-ctsp">??n giá: <b class="do"><?php echo $gia ?></b></p></p>
                                    <?php echo $DetailProducts['description']; ?>

                                    <div class="div-share">
                                        <p>Chia s? m?ng xã h?i: <?php echo links_share() ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-thongtin-ct">
                            <div class="title-danhmuc">
                                <h3>Thông tin s?n ph?m</h3>
                            </div>
                            <div class="text-box-tt-ct">
                                <?php echo $DetailProducts['content']; ?>
                            </div>
                            <div class="div-sautab">
                                <div class="fb-comments" data-href="<?php echo $canonical ?>"
                                     data-numposts="5" data-width="100%"></div>

                            </div>
                        </div>
                        <?php if (isset($products_same) && is_array($products_same) && count($products_same)) { ?>
                            <div class="box-danhmuc box-danh-muc-sp-khac">
                                <div class="title-danhmuc danhmuc-sp">
                                    <h3>S?n ph?m khác</h3>
                                </div>
                                <div class="list-sp-danhmuc">
                                    <div class="row row-edit-12">
                                        <?php foreach ($products_same as $keyp => $val) { ?>
                                            <?php
                                            $title = $val['title'];
                                            $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products');
                                            $image = getthumb($val['images'], FALSE);
                                            $price = $val['price'];
                                            $saleoff = $val['saleoff'];
                                            if ($price > 0) {
                                                $giaold = str_replace(',', '.', number_format($price)) . '?';
                                            } else {
                                                $giaold = '';
                                            }
                                            if ($saleoff > 0) {
                                                $gia = str_replace(',', '.', number_format($saleoff)) . '?';
                                            } else {
                                                $gia = 'Liên h?';
                                            }
                                            if ($saleoff > 0 && $price > 0 && $saleoff < $price) {
                                                $sale = ceil(($price - $saleoff) / $price * 100);
                                                $price_sale = str_replace(',', '.', number_format($price - $saleoff)) . '?';
                                            } else {
                                                $sale = $price_sale = '';
                                            }
                                            ?>
                                            <div class="col-md-4 col-sm-6 col-xs-6 col-edit-12">
                                                <div class="wp-item-sp col-item-sp">
                                                    <div class="img-sp">
                                                        <a href="<?php echo $href ?>" class="h_813"><img
                                                                src="<?php echo $image ?>"
                                                                alt="<?php echo $title ?>"></a>
                                                    </div>
                                                    <div class="text-sp">
                                                        <h4><a href="<?php echo $href ?>"><?php echo $title ?></a></h4>

                                                        <p class="gia">Giá: <b class="do"><?php echo $gia ?></b></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php echo $this->load->view('homepage/frontend/common/block'); ?>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(function () {
        //ZOOM
        $("#zoom1").glassCase({
            'widthDisplay': 655,
            'heightDisplay': 400,
            'nrThumbsPerRow': 5,
            'isSlowZoom': true,
            'colorIcons': '#F15129',
            'colorActiveThumb': '#F15129'
        });

    });
</script>
