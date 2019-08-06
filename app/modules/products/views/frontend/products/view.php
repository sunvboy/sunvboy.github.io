<div class="clear" style="height:20px;"></div>

<main id="main">
    <section id="content">
        <link href="templates/frontend/css/magiczoomplus.css" rel="stylesheet" type="text/css" media="screen"/>
        <script src="templates/frontend/js/magiczoomplus.js" type="text/javascript"></script>
        <script src="templates/frontend/js/jquery.colorbox-min.js" type="text/javascript" charset="utf-8" ></script>
        <link rel="stylesheet" href="templates/frontend/css/jquery.colorbox-min.css"/>
        <div id="sanpham">
            <div class="container">
                <div class="box">
                    <div class="thanh_index"><h1 class="fn org"><?php echo $DetailProducts['title']; ?></h1></div>
                    <div class="clear" style="height:20px;"></div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xx-12 col-xs-12">
                        <div class="frame_images wow fadeInUp" data-wow-delay='0.3s'>
                            <div class="app-figure" id="zoom-fig">
                                <a href="<?php echo $DetailProducts['images']; ?>" id="Zoom-1" class="MagicZoom"  title="<?php echo $DetailProducts['title']; ?>"><img src="<?php echo $DetailProducts['images']; ?>" alt="<?php echo $DetailProducts['title']; ?>"/></a>
                            </div>
                            <div class="selectors">
                                <script>
                                    $(document).ready(function () {

                                        var owl = $("#owl-demo-dt");

                                        owl.owlCarousel({
                                            loop: true,
                                            margin: 5,
                                            nav: true,
                                            responsiveClass: true,
                                            responsive: {
                                                0: {
                                                    items: 3
                                                },
                                                600: {
                                                    items: 4
                                                },
                                                1000: {
                                                    items: 5
                                                }
                                            }

                                        });
                                    });
                                </script>
                                <style type="text/css">
                                    #owl-demo-dt.owl-theme .owl-controls .owl-nav .owl-prev{top:35% !important;left:0px !important;background:url(images/pre-menu.png) no-repeat top center !important;width:14px !important;height:20px !important;}
                                    #owl-demo-dt.owl-theme .owl-controls .owl-nav .owl-next{top:35% !important;right:0px !important;background:url(images/next-menu.png) no-repeat top center !important;width:14px !important;height:20px !important;}
                                </style>
                                <div class="clear" style="height:10px;"></div>
                                <div id="owl-demo-dt" class="owl-carousel" style="padding: 0px 15px">
                                    <a data-zoom-id="Zoom-1" href="<?php echo $DetailProducts['images']; ?>"
                                       data-image="<?php echo $DetailProducts['images']; ?>">
                                        <img u="image" src="<?php echo $DetailProducts['images']; ?>" style="height: 80px;object-fit: cover;width: 100%"/></a>
                                    <?php $listItem = json_decode($DetailProducts['albums'], TRUE); ?>
                                    <?php if (isset($listItem) && is_array($listItem) && count($listItem)) { ?>
                                    <?php foreach ($listItem as $key => $val) { ?>
                                    <a data-zoom-id="Zoom-1" href="<?php echo $val['images']; ?>"
                                       data-image="<?php echo $val['images']; ?>">
                                        <img u="image" src="<?php echo $val['images']; ?>" style="height: 80px;object-fit: cover;width: 100%"/></a>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xx-12 col-xs-12">
                        <div class="khung_thongtin wow fadeInUp" data-wow-delay='0.4s'>
                            <ul class="thongtinsanpham">
                                <li><b>Mô tả dịch vụ</b></li>
                                <li>
                                    <?php echo $DetailProducts['description']; ?>
                                </li>
                                <?php
                                $DetailProductsprice = $DetailProducts['price'];
                                $DetailProductssaleoff = $DetailProducts['saleoff'];
                                if ($DetailProductsprice > 0) {
                                    $DetailProductsgiaold = '<p>' . str_replace(',', '.', number_format($DetailProductsprice)) . ' ?</p>';
                                } else {
                                    $DetailProductsgiaold = '';
                                }
                                if ($DetailProductssaleoff > 0) {
                                    $DetailProductsgia = str_replace(',', '.', number_format($DetailProductssaleoff)) .' VNĐ';
                                } else {
                                    $DetailProductsgia = $this->lang->line('contact');
                                }
                                if ($DetailProductsprice > 0 && $DetailProductssaleoff > 0 && $DetailProductsprice > $DetailProductssaleoff) {
                                    $sale_tour = '<span class="icon icon-promotion hidden-xs"></span><span>Early Bird - ' . ceil((($DetailProductsprice - $DetailProductssaleoff) / $DetailProductssaleoff) * 100) . '% off</span>';
                                } else {
                                    $sale_tour = '';
                                }
                                ?>
                                <li class="pdprice">
                                    <b>Giá: </b><span><?php echo $DetailProductsgia?></span>
                                </li>
                                <li><img src="templates/frontend/images/best-price.png" alt="lx"/>&nbsp;&nbsp;<?php echo $DetailProducts['viewed']; ?> lượt xem</li>
                                <li><b>Chia sẻ trên:</b>

                                    <div class="clear"></div>
                                    <div class="social-share" style="float: left;text-align: left;">
                                        <script type="text/javascript"
                                                src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59e812e6b22460be"></script>
                                        <div class="addthis_inline_share_toolbox_i92u"></div>
                                    </div>
                                    <style>
                                        #at4-share, #at4-soc, #at-cv-toaster.at-cv-mask, #at-share-dock {
                                            display: none !important;
                                        }

                                        #fld_8111642_2 {
                                            width: auto;
                                            float: right;
                                            background: #0057af;
                                            color: #fff;
                                            height: 40px;
                                            line-height: 36px;
                                            padding: 0 10px 15px;
                                        }
                                        .nav-baihoc img{
                                            max-width: 100% !important;
                                            height: auto !important;

                                        }
                                    </style>


                                </li>

                                <li>
                                    <div class="lhmh"><p><span style="font-size:20px;"><strong>Liên hệ : <span
                                                        style="color:#FF0000;"><?php echo $this->fcSystem['contact_phone']?> - <?php echo $this->fcSystem['contact_hotline']?></span></strong></span>
                                        </p>

                                        <p><span style="font-size:18px;">(Cả thứ 7 & Chủ nhật)</span></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="clear" style="height:15px;"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xx-12 col-xs-12">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xx-12 col-xs-12">
                            <ul id="tabs" class=" wow fadeInUp " data-wow-delay='0.6s'>
                                <li id="current"><a href="#" class="active" title="tab1">Chi tiết</a></li>
                            </ul>
                            <div class="clear"></div>
                            <div id="content_tab" class=" wow fadeInUp " data-wow-delay='0.5s'>
                                <div id="tab1">
                                    <div class="noidung_chitiet">
                                        <div class="updating">

                                            <?php echo $DetailProducts['content']; ?>
                                            <?php coment_fb() ?>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <?php if (isset($products_same) && is_array($products_same) && count($products_same)) { ?>

                                <div class="clear" style="height:25px;"></div>
                                <div class="thanh_index"><h2>Sản phẩm cùng loại</h2></div>
                                <div class="clear" style="height:20px;"></div>
                                <div class="boxsp">
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
                                        <div class="item">
                                            <div class="box_item">
                                                <div class="content_item">
                                                    <div class="img_item">
                                                        <a href="<?php echo $href; ?>" title="<?php echo $title ?>">
                                                            <img
                                                                src="<?php echo $image ?>"
                                                                alt="<?php echo $title ?>" style="height: 275px;object-fit: cover;width: 100%"/></a>

                                                        <div class="info_item">
                                                            <h3><a href="<?php echo $href; ?>" title="<?php echo $title ?>"><?php echo $title ?></a></h3>

                                                            <div class="clear" style="height:10px;"></div>
                                                            <div class="g">
                                                                <div class="gb">Giá: <span><?php echo $gia ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="clear"></div>


                            <?php } ?>

                        </div>
                    </div>

                </div>
                <div class="clear" style="height:20px;"></div>
            </div>
        </div>
    </section>
    <div class="clear"></div>
</main>