<div id="main" class="wrapper">
    <div class="bres">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url() ?>"><i class="fas fa-home"></i>Trang chủ</a>/</li>
                <?php foreach ($Breadcrumb as $key => $val) { ?>
                    <?php
                    $title = $val['title'];
                    $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles_catalogues');
                    ?>
                    <li><a href="<?php echo $href ?>"><?php echo $title ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="banner wow fadeInUp">
        <div class="container">
            <div class="banner-img">

                <img src="<?php echo $this->fcSystem['banner_banner1'] ?>"
                     alt="<?php echo $DetailCatalogues['title'] ?>">

                <h1 class="title-bn"><?php echo $DetailCatalogues['title'] ?></h1>
            </div>

        </div>

    </div>
    <div id="main" class="main-new">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="contet-child">
                        <?php if (isset($ArticlesList) && is_array($ArticlesList) && count($ArticlesList)) { ?>
                            <?php $i = 0;
                            foreach ($ArticlesList as $key => $val) {
                                $i++; ?>
                                <?php
                                $title = $val['title'];
                                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');
                                $image = getthumb($val['images'], TRUE);
                                $description = cutnchar(strip_tags($val['description']), 320);
                                $created = show_time($val['created'], 'd/m/Y');
                                $view = $val['viewed'];
                                ?>
                                <div class="item-new wow fadeInUp">
                                    <div class="image">
                                        <a href="<?php echo $href ?>"><img src="<?php echo $image ?>" alt="<?php echo $title ?>"></a>
                                    </div>
                                    <div class="nav-image">
                                        <p class="date"><i class="fas fa-calendar-week"></i><?php echo $created?></p>

                                        <h3 class="title"><a href="<?php echo $href ?>"><?php echo $title ?></a></h3>

                                        <p class="desc"><?php echo $description?></p>
                                        <a href="<?php echo $href ?>" class="chitiet">Xem chi tiết<i class="fas fa-angle-double-right"></i></a>

                                        <div class="line"><img src="templates/frontend/resources/images/line.png" alt="<?php echo $title ?>"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            <?php } ?>
                        <?php } ?>

                    </div>
                    <nav class="nav-page wow fadeInUp" aria-label="Page navigation navigation-page wow fadeInUp">
                        <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>


                    </nav>
                    <div style="clear: both;height: 40px"></div>
                    <?php echo $this->load->view('homepage/frontend/common/block'); ?>

                </div>
                <?php echo $this->load->view('homepage/frontend/common/aside') ?>

            </div>
        </div>
    </div>
</div>