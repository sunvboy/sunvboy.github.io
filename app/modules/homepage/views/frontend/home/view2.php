
<script type="text/javascript" src="templates/frontend/resources/js/jquery.min.js"></script>
<ul class="nav navbar-nav">
    <?php $main_main = navigations_array('main', $this->fc_lang); ?>
    <?php if (isset($main_main) && is_array($main_main) && count($main_main)) { ?>
        <?php foreach ($main_main as $key => $val) { ?>
            <li class="dropdown">
                <a href="<?php echo $val['href']; ?>"><?php echo $val['title'] ?></a>
                <?php if (isset($val['child']) && is_array($val['child']) && count($val['child'])) { ?>
                    <ul class="dropdown-menu">
                        <?php foreach ($val['child'] as $key => $vals) { ?>
                            <li><a href="<?php echo $vals['href']; ?>"
                                   title="<?php echo $vals['title']; ?>">
                                    <?php echo $vals['title']; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </li>
        <?php }
    } ?>
</ul>
<?php if (is_array($videos) && isset($videos) && count($videos)) { ?>
    <?php foreach ($videos as $key => $value) { ?>
        <?php
        $href = rewrite_url($value['canonical'], $value['slug'], $value['id'], 'videos_catalogues');
        ?>
        <?php if (is_array($value['post']) && isset($value['post']) && count($value['post'])) { ?>
            <div class="main-video_number2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="title-video">
                                <h3><?php echo $value['title'] ?></h3>
                            </div>
                        </div>
                        <?php $i = 0;
                        foreach ($value['post'] as $keyp => $val) {
                            $i++; ?>
                            <?php $video_code = explode('?v=', $val['videos_code'])[1]; ?>
                            <div class="col-md-4">
                                <div class="video-top">
                                    <iframe width="100%" height="205"
                                            src="https://www.youtube.com/embed/<?php echo $video_code; ?>"
                                            frameborder="0" allow="autoplay; encrypted-media"
                                            allowfullscreen></iframe>
                                </div>
                                <div class="text-video">
                                    <p><?php echo $val['title'] ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
<?php } ?>
<?php if (is_array($hinhanh) && isset($hinhanh) && count($hinhanh)) { ?>
    <?php foreach ($hinhanh as $key => $value) { ?>
        <?php
        $href = rewrite_url($value['canonical'], $value['slug'], $value['id'], 'gallerys_catalogues');
        ?>
        <?php if (is_array($value['post']) && isset($value['post']) && count($value['post'])) { ?>
            <div class="main-images_number3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="title-number3-images">
                                <h4><?PHP ECHO $value['title'] ?></h4>
                            </div>
                        </div>

                        <div style="clear: both"></div>
                        <?php foreach ($value['post'] as $keyp => $val) { ?>
                            <?php $href = rewrite_url($value['canonical'], $value['slug'], $value['id'], 'gallerys');
                            ?>
                            <div class="col-md-3"><div class=""><a href="<?php echo $href?>"> <img src="<?php ECHO $val['images'] ?>"
                                                                                                   alt="<?PHP ECHO $val['title'] ?>" style="max-width: 100%"></a></div>
                            </div>

                        <?php } ?>
                    </div>
                </div>
            </div>

        <?php } ?>
    <?php } ?>
<?php } ?>
<?php if (is_array($tintuc) && isset($tintuc) && count($tintuc)) { ?>
    <?php foreach ($tintuc as $key => $value) { ?>
        <?php
        $href = rewrite_url($value['canonical'], $value['slug'], $value['id'], 'articles_catalogues');
        ?>
        <?php if (is_array($value['post']) && isset($value['post']) && count($value['post'])) { ?>
            <div class="main-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="title-main-top">
                                <h2><?php echo $value['title'] ?></h2>
                            </div>
                        </div>
                        <?php $i = 0;
                        foreach ($value['post'] as $keyp => $val) {
                            $i++; ?>
                            <?php
                            $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');
                            $image = getthumb($val['images'], TRUE);
                            $description = cutnchar($val['description'], 300);
                            ?>
                            <div class="col-md-4">
                                <div class="images-text-box1">
                                    <div class="img-hover">
                                        <a href="<?php echo $href ?>"><img
                                                src="<?php echo $image ?>"
                                                alt="<?php echo $val['title'] ?>"></a>

                                        <div class="hover-icon">
                                            <a href="<?php echo $href ?>">Chi Tiết</a>
                                        </div>
                                    </div>
                                    <div class="text-date-top">
                                        <div class="date-left">
                                            <p><?php echo show_time($val['created'], 'd'); ?></p>

                                            <p class="mar"><?php echo show_time($val['created'], 'M'); ?></p>
                                        </div>
                                        <div class="text-right-2">
                                            <p> <?php echo $val['title'] ?> </p>

                                            <p><span><i class="fas fa-user"></i> <?php echo $val['viewed'] ?>
                                                    views</span></p>
                                        </div>
                                    </div>
                                    <div class="text-bottom-3"><?php echo strip_tags($description) ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                    </div>
                </div>
            </div>

        <?php } ?>
    <?php } ?>
<?php } ?>
<img src="templates/frontend/resources/images/bg-header.png"
     alt="<?php echo $this->fcSystem['homepage_company'] ?>">

<?php if (is_array($gioithieu) && isset($gioithieu) && count($gioithieu)) { ?>
    <?php foreach ($gioithieu as $key => $val) { ?>
        <?php
        $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');
        $image = $val['images'];
        $description = cutnchar(strip_tags($val['description']), 1000);
        ?>
        <div class="wp-box-gt">
            <div class="title-danhmuc">
                <h3><?php echo $val['title'] ?><?php echo $val['title'] ?></h3>
            </div>
            <div class="wp-content-box-gt">
                <div class="row row-edit-10">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-edit-10">
                        <div class="wp-img-box-gt">
                            <a href="<?php echo $href ?>"><img src="<?php echo $image ?>"
                                                               alt="<?php echo $val['title'] ?>"></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 col-edit-10">
                        <div class="wp-text-box-gt">
                            <?php echo $description ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
} ?>


<?php if (is_array($danhmuchome) && isset($danhmuchome) && count($danhmuchome)) { ?>
    <?php foreach ($danhmuchome as $key => $val) { ?>
        <?php
        $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products_catalogues');
        ?>
        <?php if (is_array($val['post']) && isset($val['post']) && count($val['post'])) { ?>
            <div class="wp-box-sp box-sp">
                <div class="title-danhmuc">
                    <h3><?php echo $val['title'] ?></h3>
                    <a href="<?php echo $href ?>" class="view-all">Xem t?t c?</a>
                </div>
                <?php if (is_array($val['post']) && isset($val['post']) && count($val['post'])) { ?>
                    <div class="wp-list-boxsp">
                        <div id="box-sp" class="owl-carousel owl-theme box-sp1">
                            <?php foreach ($val['post'] as $key => $value) { ?>
                                <?php
                                $hrefP = rewrite_url($value['canonical'], $value['slug'], $value['id'], 'products');
                                ?>
                                <div class="item">
                                    <div class="wp-item-sp">
                                        <div class="img-sp">
                                            <a href="<?php echo $hrefP ?>" class="h_7065"><img
                                                    src="<?php echo $value['images'] ?>"
                                                    alt="<?php echo $value['title'] ?>"></a>
                                        </div>
                                        <div class="text-sp">
                                            <h4>
                                                <a href="<?php echo $hrefP ?>"><?php echo $value['title'] ?></a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    <?php }
} ?>
<?php if (isset($psale) && is_array($psale) && count($psale)) { ?>

    <section class="product-home">
        <div class="title-title">
            <h2 class="title-primary wow fadeInUp">Sản phẩm</h2>
        </div>
        <div class="container">
            <div class="row">
                <?php foreach ($psale as $keyp => $val) { ?>
                    <?php
                    $title = $val['title'];
                    $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products');
                    $image = getthumb($val['images'], FALSE);
                    $price = $val['price'];
                    $saleoff = $val['saleoff'];
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
                        $price_sale = str_replace(',', '.', number_format($price - $saleoff)) . 'đ';
                    } else {
                        $sale = $price_sale = '';
                    }
                    ?>
                    <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp">
                        <div class="item">
                            <div class="images">
                                <a href="<?php echo $href?>"><img src="<?php echo $image?>" alt="<?php echo $title?>"></a>
                            </div>
                            <div class="nav-content-img">
                                <h3 class="title"><a href="<?php echo $href?>"><?php echo $title?></a></h3>

                                <p class="price">Giá bán: <span><?php echo $gia?></span></p>
                            </div>
                            <div class="shop"><i class="fas fa-shopping-cart"></i></div>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
    </section>
<?php }?>
<div class="wp-fr-nhantin">
    <form action="mailsubricre.html" method="post" id="sform_footer">
        <div class="error uk-alert"></div>
        <div class="fr-nhantin">
            <input type="text" name="email" class="email" placeholder="Email c?a b?n">
            <input type="hidden" name="title" value="Đăng ký email">
            <input type="hidden" name="type" value="1">
            <button type="submit"><i class="fa fa-envelope"></i></button>
        </div>
    </form>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function () {
            $('#sform_footer .error').hide();
            var uri = $('#sform_footer').attr('action');
            $('#sform_footer').on('submit', function () {
                var postData = $(this).serializeArray();
                $.post(uri, {post: postData, email: $('#sform_footer .email').val()},
                    function (data) {
                        var json = JSON.parse(data);
                        $('#sform_footer .error').show();
                        if (json.error.length) {
                            $('#sform_footer .error').removeClass('alert alert-success').addClass('alert alert-danger');
                            $('#sform_footer .error').html('').html(json.error);
                        } else {
                            $('#sform_footer .error').removeClass('alert alert-danger').addClass('alert alert-success');
                            $('#sform_footer .error').html('').html('Đăng ký nhận bản tin thành công!.');
                            $('#sform_footer').trigger("reset");
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





<nav id="nav-mobile" class="hidden-md hidden-lg">
    <div>
        <ul class="ul-1">
            <?php $main_main = navigations_array('main', $this->fc_lang); ?>
            <?php if (isset($main_main) && is_array($main_main) && count($main_main)) { ?>
                <?php foreach ($main_main as $key => $val) { ?>
                    <li>
                        <a href="<?php echo $val['href']; ?>"><?php echo $val['title'] ?></a>

                        <?php if (isset($val['child']) && is_array($val['child']) && count($val['child'])) { ?>
                            <ul class="ul-2">
                                <?php foreach ($val['child'] as $key => $vals) { ?>
                                    <li>
                                        <a href="<?php echo $vals['href']; ?>"
                                           title="<?php echo $vals['title']; ?>">
                                            <?php echo $vals['title']; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php }
            } ?>

        </ul>
    </div>
</nav>
<!--cart-->
<section class="topbar">
    <nav class="mobile-nav">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <div class="box_cart">
                <a href="dat-mua.html">
                    <div class="cart_item">
                        <span class="quanlity"><?php echo $this->cart->total_items(); ?></span>
                    </div>
                </a>
            </div>
        </div>
    </nav>
</section>

<div class="wp-fr-nhantin">
    <form action="mailsubricre.html" method="post" id="sform_footer">
        <div class="error uk-alert"></div>
        <div class="fr-nhantin">
            <input type="text" name="email" class="email" placeholder="Email c?a b?n">
            <input type="hidden" name="title" value="Đăng ký email">
            <input type="hidden" name="type" value="1">
            <button type="submit"><i class="fa fa-envelope"></i></button>
        </div>
    </form>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function () {
            $('#sform_footer .error').hide();
            var uri = $('#sform_footer').attr('action');
            $('#sform_footer').on('submit', function () {
                var postData = $(this).serializeArray();
                $.post(uri, {post: postData, email: $('#sform_footer .email').val()},
                    function (data) {
                        var json = JSON.parse(data);
                        $('#sform_footer .error').show();
                        if (json.error.length) {
                            $('#sform_footer .error').removeClass('alert alert-success').addClass('alert alert-danger');
                            $('#sform_footer .error').html('').html(json.error);
                        } else {
                            $('#sform_footer .error').removeClass('alert alert-danger').addClass('alert alert-success');
                            $('#sform_footer .error').html('').html('Đăng ký nhận bản tin thành công!.');
                            $('#sform_footer').trigger("reset");
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
            <div><span>Online</span><?php echo $online;?>
            </div>
            <div><span>Hôm nay</span><?php echo $row['day_id'];?>
            </div>
            <div><span>Hôm qua</span><?php echo $row['yesterday_id'];?>
            </div>
            <div><span>T?ng truy cập</span><?php echo $row['all_value'];?>
            </div>

        </div>
    </div>
</div>