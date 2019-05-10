
<article id="body_home">
    <!--main-->
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-1200-20 hidden-xs hidden-sm">
                <div class="box_product">
                    <div class="menu_left_prod">
                        <h2 class="tit_left"><span><i class="fa fa-bars"
                                                      aria-hidden="true"></i>DANH M?C S?N PH?M</span>
                        </h2>
                        <ul class="menu_cate_prod_l">


                            <?php if (isset($danhmuchome) && is_array($danhmuchome) && count($danhmuchome)): ?>
                                <?php foreach ($danhmuchome as $key => $val) { ?>
                                    <?php
                                    $title = $val['title'];
                                    $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products_catalogues');
                                    ?>
                                    <li>
                                        <a href="<?php echo $href; ?>" title="<?php echo $val['title']; ?>">

                                            <span><?php echo $val['title']; ?></span>
                                        </a>
                                        <ul class="sub_menu_cate_prod">
                                            <?php foreach ($val['child'] as $key1 => $val) { ?>
                                                <?php
                                                $title = $val['title'];
                                                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products_catalogues');
                                                ?>
                                                <li><a href="<?php echo $href ?>"><?php echo $title; ?></a></li>

                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php } ?>
                            <?php endif; ?>

                        </ul>

                    </div>
                </div>
                <div class="clearix clearfix-10"></div>
                <?php $this->load->view('homepage/frontend/common/advertise') ?>

            </div>
            <div class="col-lg-6 col-md-6 col-sm-8 col-1200-60">
                <div class="back_link">
                    <ul>
                        <li><a href="<?php echo BASE_URL ?>">Trang ch?</a></li>
                        <li>
                            <a href="javascript:void(0)" title="<?php echo $this->lang->line('search') ?>">
                                <?php echo $this->lang->line('search') ?>
                            </a>
                        </li>
                        <li class="uk-active">
                            <a href="javascript:void(0)" title="<?php echo $this->lang->line('search') ?>">
                                <?php echo ((isset($keys)) ? $keys : '') ?>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="clearfix-10"></div>
                <h1 class="tit_cat"><a href="javascript:void()">K?t qu? tìm ki?m: <?php echo ((isset($keys)) ? $keys : '') ?></a></h1>
                <?php if (isset($result) && is_array($result) && count($result)){ ?>
                <div class="clearfix-20"></div>
                <div class="row_12">

                    <?php foreach($result as $key => $val) { ?>
                        <?php
                        $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products');
                        $image = getthumb($val['images'], TRUE);
                        $price = (($val['saleoff'] > 0) ? str_replace(',', '.', number_format($val['saleoff'])).' <span>?</span>' : 'Liên h?');
                        ?>
                        <div class="col-sm-4 col-xs-4 col-480-12 wow fadeInLeft" data-wow-duration="0.6s"
                             data-wow-delay="1s">
                            <div class="row_3">
                                <div class="box_prod_hot">
                                    <a href="<?php echo $href; ?>"
                                       class="img_prod_hot"><img class="w_100"
                                                                 src="<?php echo $image; ?>"
                                                                 alt="<?php echo $title; ?>" style="height: 153px;"></a>

                                    <h3 class="name_prod_hot"><a href="<?php echo $href; ?>"><?php echo $title; ?></a>
                                    </h3>

                                    <div class="price">

                                        <span class="price_new">Giá: Liên h?</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php } ?>


                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
            <?php } ?>
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