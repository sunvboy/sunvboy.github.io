<section class="sec-content-page page-ds-phong">
    <div class="wp-title-page">
        <div class="container">
            <div class="title-page">
                <h1><?php echo $DetailCatalogues['title']; ?></h1>
                <li><a href="<?php echo base_url() ?>">Trang chủ</a></li>
                <?php foreach ($Breadcrumb as $key => $val) { ?>
                    <?php
                    $title = $val['title'];
                    $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles_catalogues');
                    ?>
                    <li><?php echo $title; ?></li>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="wp-content-page page-ds-dichvu">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-12 col-xs-12 fl-right">
                    <div class="wp-content-ctdv">
                        <h2 class="ten-cttin"><?php echo $DetailArticles['title']; ?></h2>
                        <div class="wp-date-view-ct">
                            <div class="date-view-ct">
                                <div class="date-ct">
                                    <p><?php echo $this->lang->line('updated')?>: <?php echo $DetailArticles['created']; ?></p>
                                </div>
                                <div class="view-ct">
                                    <p><?php echo $this->lang->line('viewed')?>: <?php echo $DetailArticles['viewed']; ?></p>
                                </div>
                            </div>
                            <?php links_share(); ?>
                        </div>
                        <p><b><?php echo strip_tags($DetailArticles['description']); ?></b></p> <br>

                        <?php echo $DetailArticles['content']; ?>
                        <div class="div-sautab">
                            <div class="fb-comments" data-href="<?php echo $canonical ?>"
                                 data-numposts="5" data-width="100%"></div>

                        </div>
                        <?php if (is_array($articles_same) && isset($articles_same) && count($articles_same)) { ?>
                            <div class="cac-baiviet-khac">
                                <div class="wp-tinkhac">
                                    <h3><?php echo $this->lang->line('cac-bai-viet-khac');?></h3>
                                    <ul>
                                        <?php foreach ($articles_same as $key => $val) { ?>
                                            <?php
                                            $title = $val['title'];
                                            $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');
                                            $image = getthumb($val['images'], TRUE);
                                            $description = cutnchar(strip_tags($val['description']), 450);
                                            $created = show_time($val['created'], 'd/m/Y');
                                            $view = $val['viewed'];
                                            ?>
                                            <li class="tich-1"><a
                                                    href="<?php echo $href ?>"><?php echo $val['title'] ?></a><span
                                                    class="color-9">(<?php echo $view ?> <?php echo $this->lang->line('viewed')?>)</span></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php $this->load->view('homepage/frontend/common/aside') ?>
            </div>
        </div>
    </div>
</section>
<!-- end sec danh mục sản phẩm -->
