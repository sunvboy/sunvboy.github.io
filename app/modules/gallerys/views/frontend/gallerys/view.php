<main>
    <div class="project-main-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <li><a href="<?php echo base_url() ?>"><?php echo $this->lang->line('home_page'); ?></a></li>


                        <?php foreach ($Breadcrumb as $key => $val) { ?>
                            <?php
                            $title = $val['title'];
                            $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'gallerys_catalogues');
                            ?>
                            <li><a href="javascript:void();">/</a></li>
                            <li><a href="<?php echo $href; ?>"
                                   title="<?php echo $title; ?>"><?php echo $title; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="templates/frontend/resources/plu/uikit.min.js"></script>
    <link href="templates/frontend/resources/plu/lightgallery.css" rel="stylesheet"/>
    <link href="templates/frontend/resources/plu/uikit.modify.css" rel="stylesheet"/>
    <div class="news-top-slide">
        <div class="container">
            <div class="row news-main-siter_bar-2">
                <div class="col-md-12">
                    <div class="title-news title-news-2">
                        <h1><?php echo $DetailCatalogues['title'] ?></h1>
                    </div>
                </div>
                <?php if (isset($gallerysList) && is_array($gallerysList) && count($gallerysList)) { ?>
                    <?php $i = 0;
                    foreach ($gallerysList as $keyp => $val) {
                        $i++; ?>
                        <?php
                        $title = $val['title'];
                        $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'gallerys');
                        $image = $val['images'];

                        ?>
                        <div class="col-md-4 col-12 col-xl-4">

                            <article class="album-item thumb">
                                <a href="<?php echo $image ?>" class="img-cover img-zoomin h_732075472"
                                   title="<?php echo $val['title'] ?>"
                                   data-uk-lightbox="{group:'gallerys-<?php echo $i ?>'}">
                                    <div class="center-block hvr-trim img-album mrb15">
                                        <img src="<?php echo $image ?>" alt="<?php echo $title ?>"
                                             style="width: 100%;height: 221px;object-fit: cover"></div>

                                    <h2 class="transition"><?php echo $title ?></h2></a>
                            </article>
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
                    <?php } ?>
                <?php } ?>


            </div>
        </div>
    </div>

</main>
<script src="templates/frontend/resources/plu/uikit.components.js"></script>

<script  src="templates/frontend/resources/plu/lightgallery-all.min.js"></script>
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
