<div id="main" class="wrapper">
    <div class="bres">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url() ?>">Trang chủ</a></li>
                <?php foreach ($Breadcrumb as $key => $val) { ?>
                    <?php
                    $title = $val['title'];
                    $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles_catalogues');
                    ?>
                    <li><?php echo $title; ?></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="banner wow fadeInUp">
        <div class="container">
            <div class="banner-img">
                <img src="<?php echo $this->fcSystem['banner_banner1'] ?>"
                     alt="<?php echo $DetailCatalogues['title'] ?>">

            </div>

        </div>

    </div>
    <div id="main" class="main-new main-baihoc">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-12 wow fadeInUp">
                    <div class="contet-child">
                        <h1 class="titleprimary"><?php echo $DetailArticles['title']; ?></h1>

                        <p class="mean"><?php echo strip_tags($DetailArticles['description']); ?></p>

                        <div class="line"><img src="templates/frontend/resources/images/line3.png" alt=""></div>
                        <div class="nav-baihoc">
                            <div class="item-baihoc">
                                <h3 class="title">Đối tượng học</h3>

                                <?php echo $DetailArticles['doituonghoc']; ?>
                            </div>
                            <div class="item-baihoc">
                                <h3 class="title">Trình độ</h3>

                                <?php echo $DetailArticles['trinhdo']; ?>

                            </div>
                            <div class="item-baihoc">
                                <h3 class="title">Mục tiêu học</h3>

                                <?php echo $DetailArticles['muctieuhoc']; ?>

                            </div>
                            <div class="item-baihoc">
                                <h3 class="title">Đầu ra</h3>

                                <?php echo $DetailArticles['daura']; ?>

                            </div>

                            <div style="clear: both;height: 20px"></div>
                            <div class="social-share" style="float: right;text-align: right;">
                                <script type="text/javascript"
                                        src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59e812e6b22460be"></script>
                                <div class="addthis_inline_share_toolbox_i92u"></div>
                            </div>
                            <div style="clear: both;height: 20px"></div>
                            <div id="about">
                                <?php coment_fb() ?>

                            </div>

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

                    </div>


                </div>
                <?php echo $this->load->view('homepage/frontend/common/aside'); ?>

            </div>
            <?php echo $this->load->view('homepage/frontend/common/block'); ?>


            <?php if (is_array($articles_same) && isset($articles_same) && count($articles_same)) { ?>

                <section class="course-home traditional-image wow fadeInUp ">
                    <div class="container">
                        <div class="title-title11 title-title">
                            <h2 class="title-primary"><img src="templates/frontend/resources/images/icon3.png" alt="">Có
                                thể ban quan tâm</h2>

                        </div>
                        <div class="nav-course-home">
                            <div class="row">
                                <?php foreach ($articles_same as $key => $val) { ?>
                                    <?php
                                    $title = $val['title'];
                                    $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');
                                    $image = getthumb($val['images'], TRUE);
                                    $description = cutnchar(strip_tags($val['description']), 300);
                                    $created = show_time($val['created'], 'd/m/Y');
                                    $view = $val['viewed'];
                                    ?>
                                    <?php if ($key <= 3) { ?>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="item">
                                                <div class="image">
                                                    <div class="relative-overlay">
                                                        <a href="<?php echo $href ?>"><img src="<?php echo $image ?>"
                                                                                           alt="<?php echo $title ?>"></a>

                                                        <div class="overlay"><a href="<?php echo $href ?>">Xem chi
                                                                tiết<i class="fas fa-angle-right"></i></a></div>
                                                    </div>
                                                </div>
                                                <div class="box-item">
                                                    <h3 class="title">khóa học<br><?php echo $title ?></h3>

                                                    <p class="desc"
                                                       style="height: 132px;overflow: hidden"><?php echo $description ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </section>

            <?php } ?>

        </div>


        <?php
        $phuhuynh = $this->FrontendArticles_Model->ReadByCondition(array(
            'select' => 'id, title, slug, canonical,description,images,album	',
            'table' => 'articles',
            'where' => array('highlight' => 1, 'publish' => 1, 'trash' => 0, 'alanguage' => $this->fc_lang),
            'limit' => 1,
            'order_by' => 'order asc, id desc',
        ));

        ?>
        <?php if (is_array($phuhuynh) && isset($phuhuynh) && count($phuhuynh)) { ?>
            <?php foreach ($phuhuynh as $key => $val) { ?>
                <?php
                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');
                $image = $val['images'];
                $list_items = json_decode($val['album'], TRUE);
                ?>
                <?php if (is_array($list_items) && isset($list_items) && count($list_items)) { ?>
                    <section class="before-after wow fadeInUp ">
                        <div class="container">
                            <div class="title-title">
                                <h2 class="title-primary">Phụ huynh nói về ales</h2>
                            </div>
                            <div class="carousel uk-visible-large" id="ba-desktop">
                                <div class="slides">
                                    <?php foreach ($list_items as $keys => $vals) { ?>
                                        <div class="item slideItem">
                                            <img src="<?php echo $vals['images'] ?>" alt="<?php echo $vals['title'] ?>">

                                            <div class="nav-img">
                                                <h3 class="title"><?php echo $vals['title'] ?></h3>

                                                <p class="adress"><?php echo $vals['description'] ?></p>

                                                <p class="desc"><?php echo $vals['content'] ?></p>
                                            </div>
                                        </div>
                                        <?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php }
            }
        } ?>


    </div>

</div>