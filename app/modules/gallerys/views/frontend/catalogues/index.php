<link href="templates/frontend/resources/css/lightgallery.css" rel="stylesheet"/>
<main>
    <h1 class="hidden"><?php echo $DetailCatalogues['title']; ?></h1>
    <section>
        <div class="site-bar-content">
            <div class="container">
                <div class="row">
                    <?php echo $this->load->view('homepage/frontend/common/aside') ?>
                    <div class="col-xl-9 col-lg-8 col-md-12">
                        <div class="content_rigt-col9 content_rigt-col9-2">
                            <div class="slider-main-content slider-main-content-2">
                                <div class="slider-border">
                                    <img src="templates/frontend/resources/images/gack-slider.png"
                                         alt="<?php echo $DetailCatalogues['title']; ?>">
                                </div>
                                <div class="title-top-right wow bounceInUp">

                                    <h2><?php echo $DetailCatalogues['title']; ?></h2>
                                </div>
                                <div class="img-products-left">
                                    <div class="row">

                                        <?php if (isset($gallerysList) && is_array($gallerysList) && count($gallerysList)) { ?>
                                            <?php $i = 0; foreach ($gallerysList as $keyp => $val) { $i++;?>
                                                <?php
                                                $title = $val['title'];
                                                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'gallerys');
                                                $image = getthumb($val['images'], FALSE);

                                                ?>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="box1-left-products box1-left-products-2 wow bounceInUp">
                                                        <div class="img-box1-left">
                                                            <a href="<?php echo $image ?>" data-uk-lightbox="{group:'gallerys-<?php echo $i ?>'}"><img
                                                                    src="<?php echo $image ?>"
                                                                    alt="<?php echo $title ?>" style="height: 138px;object-fit: cover"></a>
                                                        </div>
                                                        <p class="p1-products"><a
                                                                href="<?php echo $href ?>"><?php echo $title ?></a></p>
                                                        <div class="uk-hidden">
                                                            <?php $albums = json_decode($val['albums'], TRUE); ?>
                                                            <?php if (isset($albums) && is_array($albums) && count($albums)) { ?>
                                                                <?php foreach ($albums as $keyp => $valu) { ?>
                                                                    <a href="<?php echo $valu['images']; ?>"
                                                                       data-uk-lightbox="{group:'gallerys-<?php echo $i ?>'}"></a>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="list-next-products wow bounceInUp">
                                    <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
                                </div>
                                <div class="slider-border-2">
                                    <img src="templates/frontend/resources/images/back-slider-2.png" alt="<?php echo $DetailCatalogues['title']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="templates/frontend/resources/js/uikit.components.js"></script>

<script src="templates/frontend/resources/js/lightgallery-all.min.js"></script>