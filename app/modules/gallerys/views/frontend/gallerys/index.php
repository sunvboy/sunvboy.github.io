
<div id="album-page" class="page-body">
    <div class="breadcrumb uk-hidden">
        <ul class="uk-breadcrumb">
            <li><a href="" title=""><i class="fa fa-home"></i> Trang ch?</a></li>
            <?php foreach($Breadcrumb as $key => $val){ ?>
                <?php
                $title = $val['title'];
                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'gallerys_catalogues');
                ?>
                <li class="uk-active"><a href="<?php echo $href; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></li>
            <?php } ?>
        </ul>
    </div>
    <section class="photos-detail">
        <header class="panel-head">
            <div class="gallerys-box">
                <div class="image img-cover">
                    <img style="max-height:550px" src="<?php echo $DetailGallerys['images'] ?>" alt="<?php echo $DetailGallerys['title']?>" />
                </div>
                <div class="uk-flex uk-flex-middle uk-flex-right sharebox">
                    <div class="g-plusone plus" data-size="medium" data-href=""></div>
                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="" data-via="">Tweet</a>
                    <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                </div>
                <div class="gallerys-content">
                    <h1 class="title"><span><?php echo $DetailGallerys['title'] ?></span></h1>
                    <div class="excerpt">
                        <div class="uk-clearfix item">
                            <span class="label">Categories</span>
                            <?php $catalogues = json_decode($DetailGallerys['catalogues'], TRUE); ?>
                            <?php $list = Load_catagoies($catalogues, 'gallerys'); ?>
                            <div class="value">
                                <?php if (isset($list) && is_array($list) && count($list)) { ?>
                                    <?php foreach ($list as $keyg => $valg) { ?>
                                        <?php $hrefg = rewrite_url($valg['canonical'], $valg['slug'], $valg['id'], 'gallerys_catalogues'); ?>
                                        <a href="<?php echo $hrefg ?>"><?php echo $valg['title'].(($keyg == (count($list) - 1)) ? '' : ', ') ?></a>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="uk-clearfix item">
                            <span class="label">Tags</span>
                            <div class="value">
                                <?php if (isset($TagsList) && is_array($TagsList) && count($TagsList)) { ?>
                                    <?php foreach ($TagsList as $keyt => $val) { ?>
                                        <?php $hreft = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'tags'); ?>
                                        <a href="<?php echo $hreft ?>" title="<?php echo $val['title'] ?>">
                                            <?php echo $val['title'].(($keyt == (count($TagsList) - 1)) ? '' : ', ') ?>
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="uk-clearfix item">
                            <span class="label">Time</span>
                            <div class="value">
                                <?php echo  $DetailGallerys['created'] ?>
                            </div>
                        </div>
                        <div class="uk-clearfix item">
                            <span class="label">Viewcount</span>
                            <div class="value"><?php echo $DetailGallerys['viewed'] ?></div>
                        </div>
                    </div>
                    <a class="btn-back" href="" title="Retrun">Retrun</a>
                </div>
            </div><!-- .gallerys-box -->
        </header>
        <?php $albums = json_decode($DetailGallerys['albums'], TRUE); ?>
        <section class="panel-body">
            <?php if(isset($albums) && is_array($albums) && count($albums)){ ?>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('a[rel^=\'prettyPhoto\']').prettyPhoto({theme: 'facebook',slideshow:5000, autoplay_slideshow:true});
                    })
                </script>
                <ul class="uk-grid lib-grid-20 uk-grid-width-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 gallerys-list" data-uk-grid>
                    <?php foreach($albums as $key => $val){ ?>
                        <li>
                            <div class="thumb">
                                <a class="image img-cover" rel="prettyPhoto[pp_gal]" href="<?php echo $val['images'] ?>" title="<?php echo $DetailGallerys['title'] ?>">
                                    <img src="<?php echo $val['images'] ?>" alt="<?php echo $DetailGallerys['title'] ?>" />
                                </a>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </section>
        <footer class="panel-foot">
            <div class="uk-container uk-container-center">
                <article class="article">
                    <?php echo $DetailGallerys['content'] ?>
                </article>
            </div>
        </footer>
        <div class="general-box">
            <div class="uk-container uk-container-center">
                <div class="uk-grid uk-grid-medium">
                    <div class="uk-width-large-3-4">
                        <?php if (isset($danhmuchome) && is_array($danhmuchome) && count($danhmuchome)): ?>
                            <div class="newslist">
                                <ul class="uk-list listarticle">
                                    <?php foreach ($danhmuchome as $key => $val) { ?>
                                        <?php $image = getthumb($val['images'], TRUE); ?>
                                        <?php $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'gallerys'); ?>
                                        <li>
                                            <article class="uk-clearfix article">
                                                <div class="thumb">
                                                    <a class="image img-cover" href="<?php echo $href ?>" title="<?php echo $val['title'] ?>">
                                                        <img src="<?php echo $image; ?>" alt="<?php echo $val['title'] ?>" />
                                                    </a>
                                                </div>
                                                <div class="infor">
                                                    <h3 class="title">
                                                        <a href="<?php echo $href ?>" title="<?php echo $val['title'] ?>">
                                                            <?php echo $val['title'] ?>
                                                        </a>
                                                    </h3>
                                                    <div class="meta"><?php echo $val['created'] ?></div>
                                                    <div class="description"><?php echo cutnchar(strip_tags($val['description']), 150) ?></div>
                                                    <div class="viewmore">
                                                        <a href="<?php echo $href ?>" title="<?php echo $val['title'] ?>">Read More</a>
                                                    </div>
                                                </div>
                                            </article>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php endif ?>
                        <?php if (isset($tagall) && is_array($tagall) && count($tagall)): ?>
                            <div class="uk-clearfix taglist">
                                <?php foreach ($tagall as $key => $val) { ?>
                                    <?php $hreft = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'tags'); ?>
                                    <a href="<?php echo $hreft ?>" title="<?php echo $val['title'] ?>"><?php echo $val['title'] ?></a>
                                <?php } ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="uk-width-large-1-4 uk-visible-large">
                        <aside class="aside">
                            <?php if (isset($parentid_cat) && is_array($parentid_cat) && count($parentid_cat)): ?>
                                <div class="listcategory">
                                    <ul class="uk-list">
                                        <?php foreach ($parentid_cat as $key => $val) { ?>
                                            <?php $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'gallerys'); ?>
                                            <?php $count_id = catalogues_relationship($val['id'], 'gallerys', array('Backendgallerys','BackendgallerysCatalogues'), 'gallerys_catalogues', $this->fclang); ?>
                                            <li>
                                                <a href="<?php echo $href ?>" title="<?php echo $val['title'] ?>">
                                                    <?php echo $val['title'] ?><span class="count">(<?php echo (isset($count_id) && is_array($count_id) && count($count_id) ) ? count($count_id) : 0; ?>)</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php endif ?>
                            <?php $this->load->view('homepage/frontend/common/advertise'); ?>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
</div>
</div><!-- .uk-container -->