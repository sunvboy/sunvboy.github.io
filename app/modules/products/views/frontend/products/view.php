<script src="templates/frontend/resources/cart/uikit.min.js"></script>
<link href="templates/frontend/resources/cart/uikit.modify.css" rel="stylesheet" />
<link href="templates/frontend/resources/cart/library.css" rel="stylesheet" />
<link href="templates/frontend/resources/cart/reset.css" rel="stylesheet" />
<link href="templates/frontend/resources/cart/cart.css" rel="stylesheet" />
<main>
    <div class="title-bread">
        <h1><?php echo $DetailCatalogues['title'] ?></h1>

        <p id="breadcrumbs">
            <span>
                <span>
                    Trang chủ</a>

                    <?php foreach ($Breadcrumb as $key => $val) { ?>
                        <?php
                        $title = $val['title'];
                        $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products_catalogues');
                        ?>
                        » <span class="breadcrumb_last"><?php echo $title; ?></span>

                    <?php } ?>
                </span>
            </span>
        </p>
    </div>


    <div id="primary" class="content-area">

        <div class="container">
            <div class="row">
                <?php
                $prdprice = $DetailProducts['price'];
                $prdsaleoff = $DetailProducts['saleoff'];
                if ($prdprice > 0) {
                    $DetailProductsgiaold = '<span>' . str_replace(',', '.', number_format($prdprice)) . ' đ</span>';
                } else {
                    $DetailProductsgiaold = '';
                }
                if ($prdsaleoff > 0) {
                    $DetailProductsgia = str_replace(',', '.', number_format($prdsaleoff)) . ' ₫';
                } else {
                    $DetailProductsgia = 'Liên hệ';
                }
                $gallerys = json_decode($DetailProducts['albums'], TRUE);
                ?>
                <div id="main" class="col-lg-9 col-md-9 col-sm-12 col-xs-12 site-main-cat">
                    <div class="wp-right-content">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 style="font-size: 15px;color: #f7941e;font-weight: bold;text-transform: uppercase;"><?php echo $DetailProducts['title'] ?></h1>

                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 col-edit-0">
                                <div class="wp-img-ctsp-a">
                                    <input type="hidden" id="__VIEWxSTATE"/>
                                    <ul id='zoom1' class='gc-start'>

                                        <li><img src="<?php echo $DetailProducts['images'] ?>"
                                                 alt='<?php echo $DetailProducts['title'] ?>'/></li>
                                        <?php if (isset($gallerys) && is_array($gallerys) && count($gallerys)): ?>
                                            <?php foreach ($gallerys as $key => $val): ?>
                                                <li><img src="<?php echo getthumb($val['images'], TRUE) ?>"
                                                         alt="<?php echo $DetailProducts['title'] ?>">
                                                </li>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12 col-edit-0">
                                <div class="">
                                    <div class="row_pro">
                                        <h3><span style="font-size:18px;font-weight: bold;line-height: 23px;color: #000 !important;"><?php echo $DetailProducts['content'] ?></span>
                                        </h3>
                                    </div>
                                    <?php if(!empty($DetailProductsgiaold)){?>
                                    <div class="row_pro">
                                        <div class="label_pro">Giá Gốc</div>
                                        <span style="font-size:16px; text-decoration:line-through"><?php echo $DetailProductsgiaold?></span>
                                    </div>
                                    <?php }?>
                                    <div class="row_pro">
                                        <div class="label_pro">Giá bán</div>
                                        <div><span
                                                style="color:#ff0000 !important;font-size: 20px; font-weight:bold"> <?php echo $DetailProductsgia?></span>
                                        </div>
                                    </div>

                                    <div class="row_pro">
                                        <div class="label_pro" style="display:block;width: 100%">Thời gian chỉ còn</div>
                                        <div style="clear: both;height: 10px"></div>
                                        <div class="date-time">
                                            <ul class="section_flash_sale_wm">
                                                <div class="times"
                                                     data-time="<?php echo $DetailProducts['content1'] ?>"></div>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="row_pro">

                                        <?php echo $DetailProducts['content2'] ?>
                                    </div>
                                    <div class="row_pro">
                                        <?php echo $DetailProducts['description'] ?>
                                    </div>
                                    <?php if($DetailProducts['ishome']==1){?>
                                    <div class="row_pro" style="border: 0px">
                                        <div class="item" style="position: relative;width: 100px;float: left;margin-right: 10px">

                                                        <span class="btn_num num_1 button button_qty  btn-up"><i
                                                                class="fa fa-caret-down" style="position: absolute;right: 0px;top: 50%;transform: translate(-50%)"></i>
                                                        </span>
                                            <input type="text" name="quantity" value="1" class="form-control prd_quantity quantity" style="height: 34px;">
                                                        <span class="btn_num num_2 button button_qty  btn-down" ><i
                                                                class="fa fa-caret-up" style="position: absolute;right: 0px;bottom: 50%;transform: translate(-50%)"></i>
                                                        </span>
                                        </div>
                                       <a href="" class="btn btn-danger btn-addtocart action-button ajax-addtocart"   data-href="dat-mua.html" data-quantity="1" title="Thêm giỏ hàng"
                                          data-id="<?php echo $DetailProducts['id'] ?>"
                                          data-price="<?php echo $prdsaleoff ?>">Đặt ngay</a>
<!--                                        <a class="btn btn-danger" data-toggle="modal" href="#myModal_VOUCHER">Đặt mua</a>-->
                                    </div>
                                    <?php }else{?>
                                        <div class="row_pro">
                                            <a href="javascript:void();" class="btn btn-danger">Hết thời hạn</a>
                                        </div>
                                    <?php }?>


                                </div>
                            </div>
                            <style>
                                .row_pro img,.row_pro iframe{
                                    max-width: 100% !important;
                                    height: auto !important;
                                }
                                #myModal_VOUCHER .form-control{
                                    margin-bottom: 10px;
                                }
                                #myModal_VOUCHER .btn-submit {
                                    background: #e32930;
                                    color: #fff;
                                    border-radius: 22px;
                                    border: none;
                                    text-transform: uppercase;
                                    font-weight: 400;
                                    font-size: 15px;
                                    width: 100%;
                                }
                            </style>
                            <div class="modal fade" id="myModal_VOUCHER" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header" style="border-bottom: 0px">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 hidden-xs col-sm-6">
                                                    <img src="<?php echo $this->fcSystem['banner_banner3']?>" alt="banner" style="width: 100%">
                                                </div>
                                                <div class="col-md-6 col-xs-12 col-sm-6">

                                                    <form action="mailsubricreguiyeucau.html" method="post" id="sform_VOUCHER">
                                                        <div class="error uk-alert"></div>

                                                        <input class="form-control" name="product" type="text" value="<?php echo $DetailProducts['title'] ?> - Giá: <?php echo $DetailProductsgia?>" >
                                                        <input class="form-control" name="type" type="hidden" value="0" >
                                                        <div class="form-group">
                                                            <lable style="margin-bottom: 5px;font-weight: bold;float: left">Số lượng</lable>
                                                            <input class="form-control quantiny" name="quantiny" placeholder="Số lượng *" >

                                                        </div>
                                                        <input class="form-control fullname" name="fullname" placeholder="Họ và tên *" >
                                                        <input class="form-control phone" name="phone" placeholder="Điện thoại *" >
                                                        <input class="form-control email" name="email" placeholder="Email" >
                                                        <input class="form-control address" name="address" placeholder="Địa chỉ" >
                                                        <select name="title" class="form-control title">
                                                            <option value="">--- Nhà hàng trong hệ thống ---</option>
                                                            <?php
                                                            $address = $this->Frontendaddress_Model->ReadByCondition(array(
                                                                'select' => 'id, title, address,type,phone,size,email',
                                                                'table' => 'address',
                                                                'where' => array('publish' => 1, 'trash' => 0),
                                                                'limit' => 100,
                                                                'order_by' => 'id asc',
                                                            ));
                                                            ?> <?php if (is_array($address) && isset($address) && count($address)) { ?>
                                                                <?php foreach ($address as $key => $val) { ?>
                                                                    <option  value="<?php echo $val['email']; ?>"><?php echo $val['title']; ?></option>
                                                                <?php }
                                                            } ?>
                                                        </select>
                                                        <textarea placeholder="Ghi chú" rows="5" name="message" class="form-control"></textarea>
                                                        <input type="submit" value="Đặt bàn" class="form-control btn-submit">
                                                    </form>
                                                    <script type="text/javascript" charset="utf-8">
                                                        $(document).ready(function () {
                                                            $('#sform_VOUCHER .error').hide();
                                                            var uri = $('#sform_VOUCHER').attr('action');
                                                            $('#sform_VOUCHER').on('submit', function () {
                                                                var postData = $(this).serializeArray();
                                                                $.post(uri, {
                                                                        post: postData,
                                                                        quantiny: $('#sform_VOUCHER .quantiny').val(),  fullname: $('#sform_VOUCHER .fullname').val(),
                                                                        phone: $('#sform_VOUCHER .phone').val(),
                                                                    },
                                                                    function (data) {
                                                                        var json = JSON.parse(data);
                                                                        $('#sform_VOUCHER .error').show();
                                                                        if (json.error.length) {
                                                                            $('#sform_VOUCHER .error').removeClass('alert alert-success').addClass('alert alert-danger');
                                                                            $('#sform_VOUCHER .error').html('').html(json.error);
                                                                        } else {
                                                                            $('#sform_VOUCHER .error').removeClass('alert alert-danger').addClass('alert alert-success');
                                                                            $('#sform_VOUCHER .error').html('').html('Đặt Voucher thành công! Chúng tôi sẽ liên hệ sớm với quý khách.');
                                                                            $('#sform_VOUCHER').trigger("reset");
                                                                            setTimeout(function () {
                                                                                location.reload();
                                                                            }, 5000);
                                                                        }
                                                                    });
                                                                return false;
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div style="clear: both;height: 20px;"></div>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <div class="wp-tab-ctsp">
                                    <div class="box-tab-ctsp">
                                        <div class="btn-tab-ctsp">
                                            <ul class="nav nav-pills">
                                                <li class="open active"><a data-toggle="pill" href="#tab1" style="background: #f7941e">Điều kiện và thông tin sản phẩm</a></li>
                                            </ul>
                                        </div>
                                        <div style="clear: both;height: 20px;"></div>
                                        <div class="wp-tab-content">
                                            <div class="tab-content">
                                                <div id="tab1" class="tab-pane fade active in">
                                                    <div class="sau-tab">
                                                        <?php echo $DetailProducts['content3'] ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end img ctsp -->

                    </div>
                </div>
                <?php echo $this->load->view('homepage/frontend/common/aside') ?>

            </div>

        </div>
    </div>
    <link rel="stylesheet" type="text/css" href="templates/frontend/resources/css/glasscase.minf195.css">

    <script type="text/javascript" src="templates/frontend/resources/css/modernizr.custom.js"></script>
    <script type="text/javascript" src="templates/frontend/resources/css/jquery.glasscase.minf195.js"></script>

    <script>
        $(function () {
            $("#zoom1").glassCase({
                'widthDisplay': 480,
                'heightDisplay': 480,
                'nrThumbsPerRow': 4,
                'isSlowZoom': true,
                'colorIcons': '#F15129',
                'colorActiveThumb': '#F15129',
                /*'thumbsPosition': 'left'*/
            });
        });
    </script>
    <style>
        .gc-overlay-top-icons .gc-icon.gc-icon-close:before {
            content: "\f00d" !important;
            font-family: 'FontAwesome';
            color: #fff;
            width: 24px;
            text-align: center;
            top: 0px;
            right: 0px;
        }

        .gc-overlay-right-icons .gc-icon.gc-icon-next:before {
            content: "\f105" !important;
            font-family: 'FontAwesome';
            width: 36px !important;
            height: 50px !important;
            color: #fff;
        }

        .gc-overlay-left-icons .gc-icon.gc-icon-prev:before {
            content: "\f104" !important;
            font-family: 'FontAwesome';
            width: 36px !important;
            height: 50px !important;
            color: #fff;
        }

        .gc-display-area .gc-icon.gc-icon-next:before {
            content: "\f105" !important;
            font-family: 'FontAwesome';
            width: 36px;
            color: #fff;
            height: 50px;
            text-align: center;
        }

        .gc-display-area .gc-icon.gc-icon-prev:before {
            content: "\f104" !important;
            font-family: 'FontAwesome';
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

        .gc-display-area .gc-icon.gc-icon-next {
            width: 36px !important;
            height: 50px !important;
            right: 10px;
        }

        .gc-icon.gc-icon-download {
            display: none !important;
        }

        .gc-display-area {
            background-color: transparent !important;
        }

        .gc-thumbs-area-next .gc-icon.gc-icon-next:before {
            content: "\f105" !important;
            font-family: 'FontAwesome';
            width: 24px;
            height: 24px;
            text-align: center;
        }

        .gc-thumbs-area-prev .gc-icon.gc-icon-prev:before {
            content: "\f104" !important;
            font-family: 'FontAwesome';
            width: 24px;
            height: 24px;
            text-align: center;
        }

        .gc-icon-next:before {
            position: absolute;
            top: 1px !important;
            right: 0px !important;
            content: "\e04b";
        }

        .gc-icon-prev:before {
            top: 1px !important;
            left: 0px !important;
        }

        .gc-icon-enlarge:before {
            position: absolute;
            content: '\f00e';
            top: 2px;
            right: 2px;
            color: #fff;
            font-size: 20px;
            font-family: "FontAwesome";
        }
    </style>
</main>
<!--<div id="modal-cart" class="uk-modal" style="display: none">-->
<!--    <div class="uk-modal-dialog" style="width:768px;">-->
<!--        <a class="uk-modal-close uk-close"></a>-->
<!---->
<!--        <div class="cart-content">-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--<div id="modal-buynow" class="uk-modal" style="display: none">-->
<!--    <div class="uk-modal-dialog uk-modal-dialog-large">-->
<!--        <a class="uk-modal-close uk-close"></a>-->
<!---->
<!--        <div class="cart-content"></div>-->
<!--    </div>-->
<!--</div>-->
<script>
    //giỏ hàng
    $(document).ready(function () {
        $(document).on('click', '.ajax-addtocart', function () {
            var product = $(this);
            var color = $('input:checked').val();
            // alert(color);
            // var quantity = $('#ajax-cart-quantity').val();
            var modal = UIkit.modal('#modal-cart', {
                bgclose: false,
            });
            modal.show();
            $('#modal-cart .cart-content').html('Loading...');
            $.post('<?php echo site_url("products/ajax/cart/addtocart");?>', {
                id: product.attr('data-id'),
                quantity: product.attr('data-quantity'),
                color: color,
            }, function (data) {
                window.location.href = '<?php echo base_url()?>' + 'dat-mua' + '.html';
            });
            return false;
        });
        $('.quantity').change(function () {
            var $_input = $(this).parent().find('.quantity');
            var quantity = parseInt($_input.val());
            $('.action-button.ajax-addtocart').attr('data-quantity', quantity);

        });
        if ($('.btn-up')) {
            $('.btn-up').click(function () {
                var $_input = $(this).parent().find('.quantity');
                var quantity = parseInt($_input.val());
                if (quantity <= 1) {
                    quantity = 1;
                } else {
                    quantity -= 1;
                }
                $_input.val(quantity);
                $('.action-button.ajax-addtocart').attr('data-quantity', quantity);
            });
        }
        if ($('.btn-down')) {
            $('.btn-down').click(function () {
                var $_input = $(this).parent().find('.quantity');
                var quantity = parseInt($_input.val());
                quantity += 1;
                $_input.val(quantity);
                $('.action-button.ajax-addtocart').attr('data-quantity', quantity);
            });
        }
        $(document).on('click', '#ec-module-cart .augment', function () {
            var item = $(this);
            var quantity = parseInt($(this).parent().find('.quantity').val());
            quantity = quantity + 1;
            item.parent().find('.quantity').val(quantity);
            ajax_cart_update();
            return false;
        });
        $(document).on('click', '#ec-module-cart .abate', function () {
            $(".panel-foot1").hide();
            $(".panel-foot2").show();
        })
        $(document).on('click', '#hidedd', function () {
            $(".uk-open").hide();
        })
        $(document).on('click', '#hide', function () {
            $("#mylogin").hide();
            $("#myloginmuahang").hide();
        })
        $(document).on('click', '#ec-module-cart .augment', function () {
            $(".panel-foot1").hide();
            $(".panel-foot2").show();
        })
        $(document).on('click', '#ec-module-cart .abate', function () {
            var item = $(this);
            var quantity = parseInt($(this).parent().find('.quantity').val());
            if (quantity <= 1) {
                quantity = 1
            } else {
                quantity = quantity - 1;
            }
            item.parent().find('.quantity').val(quantity);
            ajax_cart_update();
            return false;
        });

        $(document).on('click', '#ec-module-cart .delete', function () {
            var item = $(this);
            item.parent().parent().parent().parent().parent().find('.quantity').val(0);
            item.parent().parent().parent().parent().parent().addClass('uk-hidden').removeClass('item');
            ajax_cart_update();
            return false;
        });
        $(document).on('click', '#ec-module-cart .delete', function () {
            $(".panel-foot1").hide();
            $(".panel-foot2").show();
        })
        $(document).on('click', '.ec-cart-continue', function () {
            UIkit.modal('#modal-cart').hide();
            return false;
        });

        $('.augment').click(function () {
            var num_order = parseInt($(this).parent().find('.quantity').val());
            num_order += 1;
            $(this).parent().find('.quantity').val(num_order);
        });
        $('.abate').click(function () {
            var cart_class = $(this).attr('data-cart');
            var num_order = parseInt($(this).parent().find('.quantity').val());
            if (num_order <= 1) {
                num_order = 1
            } else {
                num_order -= 1;
            }
            $(this).parent().find('.quantity').val(num_order);
        });

        $(document).on('click', '.delete_item', function () {
            var item = $(this);
            var idprd = item.parent().parent().parent().parent().find('.quantity').val();
            ajax_cart_update1(idprd);
            return false;
        });

    });
    function ajax_cart_update1(idprd) {
        $.post('<?php echo site_url("products/ajax/cart/deletecart");?>', {idprd: idprd}, function (data) {
            window.location.href = 'dat-mua.html';
        });
    }

    function ajax_cart_update() {
//		alert($('#ajax-cart-form').serialize());
        $.post('<?php echo site_url("products/ajax/cart/updatetocart");?>', $('#ajax-cart-form').serialize(), function (data) {
            var price = JSON.parse(data);
            $('#ajax-cart-form').html(price.html);
        });
        return false;
    }
    $(function () {
        $('.label-star').on('click', function () {
            var value = $(this).attr('data-value');
            $('#hidden_star').attr('data-star', value);
        });

        $('#commentForm').on('submit', function () {
            var postData = $(this).serializeArray();
            var formURL = $(this).attr('action');
            var fullname = $('#fullname').val();
            var phone = $('#phone').val();
            var message = $('#message').val();
            var star = $('#hidden_star').attr('data-star');
            var module = $('#hidden_star').attr('data-module');
            var moduleid = $('#hidden_star').attr('data-module-id');
            var html = '';
            $.post(formURL, {
                    post: postData,
                    fullname: fullname,
                    phone: phone,
                    message: message,
                    star: star,
                    module: module,
                    moduleid: moduleid
                },
                function (data) {
                    var json = JSON.parse(data);
                    if (json.error.length > 0) {
                        $('.validate_error').html(json.error);
                    } else {
                        $('#commentlist').html(json.result);
                    }
                    return false;
                });
            return false;
        });
    });

</script>
<script>
    $(document).ready(function ($) {
        $('.section_flash_sale_wm .times').each(function (e) {
            awe_countDown($(this));
        });
    });
    function awe_countDown(selector2) {
        var dataTime = selector2.attr('data-time');
        var countDownDate = new Date(dataTime).getTime();
        var x = setInterval(function () {
            var now = new Date().getTime();
            var distance = countDownDate - now;
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            selector2.html("<li><span class='span1'>" + days + "</span><br><span class='span2'>Ngày</span></li>" + "<li><span class='span1'>" + hours + "</span><br><span class='span2'>Giờ</span></li>" + "<li><span class='span1'>" + minutes + "</span><br><span class='span2'>Phút</span></li>" + "<li><span class='span1'>" + seconds + "</span><br><span class='span2'>Giây</span></li>");
            if (distance < 0) {
                clearInterval(x);
                selector2.html("<span>VOUCHER kết thúc</span>");
            }
        }, 1000);
    }
    setTimeout(function () {
        jQuery('#show_success_mss').fadeOut().empty();
    }, 5000);
</script>
<style>
    .sale{font-size:14px;color:#666666;margin-top:19px;}
    .sale span{color:#EE2D36;font-family:'Roboto-Bold';}
    .date-time ul li{display:inline-block;margin-right:17px}
    .date-time ul li .span1{font-weight:bold;font-size:18px;color:#F05A61;background:url('templates/frontend/resources/images/icon-date.jpg');display:inline-block;padding:10px 2px;width:43px;height:45px;text-align:center;background-size:cover;background-repeat:no-repeat;}
    .date-time ul li .span2{font-size:18px;color:#999999;display:inline-block;clear:both;font-weight:400;}
    .date-time ul{padding-left:0;}
    .date-time{padding-top:8px;}
</style>