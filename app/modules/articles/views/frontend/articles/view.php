<div id="main" class="wrapper main-detail-new">
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

    <div id="main" class="main-new new0detail wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="contet-child">
                        <h1 class="titleprimary"><?php echo $DetailArticles['title']; ?></h1>
                        <?php
                        $hrefDetailArticles = rewrite_url($DetailArticles['canonical'], $DetailArticles['slug'], $DetailArticles['id'], 'articles_catalogues');

                        ?>
                        <p class="date"><i class="fas fa-calendar-week"></i><?php echo $DetailArticles['created']; ?>
                        </p>

                        <div class="content-detail-new">
                            <div class="left">
                                <div class="binhluan">
                                    <div id="sidebar"><a id="aboutlink" href="<?php echo $hrefDetailArticles ?>#"><span>Bình Luận</span></a></div>
                                        <img src="templates/frontend/resources/images/icon4.png" alt="Bình Luận">
                                </div>
                                <div class="home-con">
                                    <a href="<?php echo base_url() ?>"> <i class="fas fa-home"></i></a>
                                </div>
                                <div class="fb-con"><a href="<?php echo $this->fcSystem['social_facebook'] ?>"
                                                       target="_blank"> <i class="fab fa-facebook-f"></i></a></div>
                            </div>
                            <div class="content1">
                                <?php echo $DetailArticles['content']; ?>
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
                                .content1 img {
                                    max-width: 100% !important;
                                    height: auto !important;
                                }
                            </style>
                            <div class="clearfix"></div>
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
                    </style>
                    <?php echo $this->load->view('homepage/frontend/common/block'); ?>

                    <!--                    <p class="note-view">Bạn đang xem chuyên đề <span class="red">"Blog chia sẻ" </span>và cơ hội thẩm-->
                    <!--                        mỹ miễn phí 100% trong kiến thức làm đẹp</p>-->

                    <div class="line-detal-new">
                        <img src="templates/frontend/resources/images/line2.png"
                             alt="<?php echo $DetailArticles['title']; ?>">
                    </div>
                </div>
                <?php echo $this->load->view('homepage/frontend/common/aside'); ?>

            </div>

            <?php if (is_array($articles_same) && isset($articles_same) && count($articles_same)) { ?>

                <div class="other-new traditional-image">
                    <h2 class="title1"><img src="templates/frontend/resources/images/icon3.png" alt="">Tin tức liên quan
                    </h2>

                    <div class="row">
                        <?php foreach ($articles_same as $key => $val) { ?>
                            <?php
                            $title = $val['title'];
                            $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');
                            $image = getthumb($val['images'], TRUE);
                            $description = cutnchar(strip_tags($val['description']), 450);
                            $created = show_time($val['created'], 'd/m/Y');
                            $view = $val['viewed'];
                            ?>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="traditional-home">

                                    <div class="nav-traditional">
                                        <div class="item">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <div class="image">
                                                        <a href="<?php echo $href ?>"><img src="<?php echo $image ?>"
                                                                                           alt="<?php echo $title ?>"></a>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <div class="nav-img">
                                                        <h3 class="title"><a
                                                                href="<?php echo $href ?>"><?php echo $title ?></a></h3>

                                                        <p class="date"><i
                                                                class="fas fa-calendar-week"></i><?php echo $created ?>
                                                        </p>

                                                        <p class="desc"><?php echo $description ?></p>
                                                    </div>
                                                </div>
                                            </div>
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
</div>
<script>
    function goToByScroll(id){
        // Reove "link" from the ID
        id = id.replace("link", "");
        // Scroll
        $('html,body').animate({
                scrollTop: $("#"+id).offset().top},
            'slow');
    }

    $("#sidebar > a").click(function(e) {
        // Prevent a page reload when a link is pressed
        e.preventDefault();
        // Call the scroll function
        goToByScroll($(this).attr("id"));
    });
</script>