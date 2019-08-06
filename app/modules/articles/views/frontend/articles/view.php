<div class="page-banner"  style="background:url(<?php echo $this->fcSystem['banner_banner2']?>) no-repeat center center;background-size: cover;  ">
    <div class="container">

        <div class="row gutter-0">
            <div class="col-sm-6 col-sm-offset-3">
                <h1 class="banner-title"><?php echo $DetailCatalogues['title'] ?></h1>

                <div class="banner-description">
                    <p>
                        <span style="\&quot;color:" rgb(255,="" 255,="" 255);="" font-family:="" myriadpro,=""
                              sans-serif;="" font-size:="" 22px;="" text-align:="" center;="" background-color:=""
                              rgb(204,="" 204,="" 204);\"=""><?php echo strip_tags($DetailCatalogues['description']) ?></span></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-content-wrapper page-news page-news-detail">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <h1 id="lblTitle" class="main-title page-title"><?php echo $DetailArticles['title']; ?></h1>

                <div id="lblDate" class="new-date"></div>
                <div class="page-content">
                    <div id="divPostContent" class="post-content content-wrapper editor-content">
                        <div class="boxstyle_center text_color">
                            <div class="clus">


                                <div class="clear" style="height:8px;"></div>
                                <div id="user_post_view">
                                    <?php echo $DetailArticles['content']; ?>

                                </div>
                                <div style="clear: both;height: 20px"></div>
                                <div class="social-share" style="float: right;text-align: right;">
                                    <script type="text/javascript"
                                            src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59e812e6b22460be"></script>
                                    <div class="addthis_inline_share_toolbox_i92u"></div>
                                </div>
                                <div class="clear" style="height:8px;"></div>

                                <div class="div-sautab">
                                    <div class="fb-comments" data-href="<?php echo $canonical ?>"
                                         data-numposts="5" data-width="750"></div>

                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
            <style>
                #user_post_view img{
                    max-width: 100% !important;
                    height: auto !important;
                }
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
            <?php if (is_array($articles_same) && isset($articles_same) && count($articles_same)) { ?>

                <div class="col-xs-12 col-md-4 col-lg-offset-1 col-lg-3">
                    <div id="section_news" class="page-bottom">
                        <div class="title">TIN TỨC KHÁC</div>
                        <div class="news-content row">
                            <div class="col-xs-12 col-sm-6 col-md-12 item">
                                <?php foreach ($articles_same as $key => $val) { ?>
                                <?php
                                $title = $val['title'];
                                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');
                                $image = getthumb($val['images'], TRUE);
                                $description = cutnchar(strip_tags($val['description']), 450);
                                $created = show_time($val['created'], 'd/m/Y');
                                $view = $val['viewed'];
                                ?>
                                <div class="row"><a class="col-xs-12 news-thumbnail"
                                                    href="<?php echo $href ?>"
                                                    style="background-image:url(<?php echo $image ?>);"></a>

                                    <div class="col-xs-12 news-info">
                                        <div class="date-time"><?php echo $created ?></div>
                                        <div class="title"><a
                                                href="<?php echo $href ?>"><?php echo $val['title'] ?></a>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</div>