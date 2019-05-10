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
                        $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'gallerys_catalogues');
                        ?>
                        » <span class="breadcrumb_last"><?php echo $title; ?></span>

                    <?php } ?>
                </span>
            </span>
        </p>
    </div>
    <script src="templates/frontend/resources/js/uikit.min.js"></script>
    <link href="templates/frontend/resources/css/lightgallery.css" rel="stylesheet"/>
    <link href="templates/frontend/resources/css/uikit.modify.css" rel="stylesheet"/>
    <div id="primary" class="content-area">

        <div class="container">

            <main id="main" class="site-main-showdien">

                <div class="row">


                    <?php if (isset($gallerysList) && is_array($gallerysList) && count($gallerysList)) { ?>
                        <?php $i = 0;
                        foreach ($gallerysList as $keyp => $val) {
                            $i++; ?>
                            <?php
                            $title = $val['title'];
                            $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'gallerys');
                            $image = getthumb($val['images'], FALSE);

                            ?>

                            <article class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="show-109">
                                <div class="show-list">
                                    <div class="thumbnail-show">
                                        <a href="<?php echo $image ?>"
                                           title="<?php echo $title ?>" class="h_7065 img-cover img-zoomin" data-uk-lightbox="{group:'gallerys-<?php echo $i ?>'}">
                                            <img class="img-responsive"
                                                 src="<?php echo $image ?>"
                                                 alt="<?php echo $title ?>" style="object-fit: cover">
                                        </a>
                                    </div>
                                    <!-- .thumbnail-archive -->

                                    <div class="entry-show-title">
                                        <h2 class="show-title"><a
                                                href="<?php echo $image ?>" class=" img-cover img-zoomin" data-uk-lightbox="{group:'gallerys-<?php echo $i ?>'}"
                                                rel="bookmark"><?php echo $title ?></a></h2>
                                    </div>
                                    <!-- .entry-show-title -->
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
                            </article>
                            <!-- #post-109 -->
                        <?php } ?>
                        <div style="clear: both;height: 20px"></div>
                        <div class="list-next-tab-products">
                            <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

                        </div>
                    <?php } ?>

                </div>
            </main>
            <!-- #main -->


        </div>
        <!-- .container -->
    </div>
</main>
<script src="templates/frontend/resources/js/uikit.components.js"></script>

<script  src="templates/frontend/resources/js/lightgallery-all.min.js"></script>
<style>
    .uk-close:after {
        display: block;
        content: "";
        background: #fff url(templates/frontend/resources/images/icon-close.png) center no-repeat;
        width: 32px;
        border-radius: 100%;
        height: 32px;
    }
    .uk-slidenav-position .uk-slidenav-next {
        right: 5px;
        width: 32px;
        height: 32px;
    }
    .uk-slidenav-position .uk-slidenav-previous{
        left: 5px;
        width: 32px;
        height: 32px;
    }
    .uk-slidenav-previous:before{
        display: block;
        content: "";
        background: url(templates/frontend/resources/images/prev.png) center no-repeat;
        width: 32px;
        border-radius: 100%;
        height: 32px;
        padding: 0px;
        margin: 0px;
        right: 0px;
    }
    .uk-slidenav-next:before {
        display: block;
        content: "";
        background: url(templates/frontend/resources/images/next.png) center no-repeat;
        width: 32px;
        border-radius: 100%;
        height: 32px;
        padding: 0px;
        margin: 0px;
        right: 0px;
    }
    .uk-modal-dialog-lightbox>.uk-close:first-child{
        width: 32px;
        height: 32px;
    }
    .album-item {
        margin-bottom: 30px;
    }

    .album-item h2 {
        margin: 5px 0;
        font-weight: 700;
        line-height: 1.4em;
        -webkit-transition: all .3s;
        -moz-transition: all .3s;
        transition: all .3s;
        color: #333;
    }
</style>
