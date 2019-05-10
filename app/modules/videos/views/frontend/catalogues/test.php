<div class="pg-body mgt20">
    <div class="container body-content-mgt25">
        <div class="row"> <span id="To"></span>
            <?php echo $this->load->view('homepage/frontend/common/aside');?>
            <div class="col-md-9 col-xs-12 cat-content">
                <nav class="nav-ct hidden-xs">

                    <li><a href="<?php echo base_url() ?>">Trang ch?</a></li>
                    <?php foreach ($Breadcrumb as $key => $val) { ?>
                        <?php
                        $title = $val['title'];
                        $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'videos_catalogues');
                        ?>
                        <li class="">
                            <a href="<?php echo $href; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
                        </li>
                    <?php } ?>



                </nav>
                <div class="wp-prd">
                    <div class="">
                        <h1 class="tite-ct"><?php echo $DetailCatalogues['title']?></h1>
                    </div>
                    <div class="wpda">
                        <div class="row">
                            <?php if (isset($videosList) && is_array($videosList) && count($videosList)): ?>
                                <?php $i = 0;
                                foreach ($videosList as $key => $val) {
                                    $i++; ?>
                                    <div class="full480 col-xs-6 col-sm-4 col-md-4 product-item">
                                        <div class="wp-video-list">
                                            <div class="wp-item-video">
                                                <a data-fancybox href="<?php echo $val['videos_code'] ?>">
                                                    <img src="<?php echo $val['images'] ?>" alt="<?php echo $val['title'] ?>">
                                                    <span class="icon-play-video el__video__play-button"></span>
                                                </a>
                                            </div>
                                            <div class="title-video">
                                                <h4><a data-fancybox href="<?php echo $val['videos_code'] ?>"><?php echo $val['title'] ?></a></h4>
                                            </div>
                                        </div>
                                    </div>
                                <?php }?>
                            <?php endif ?>

                            <div class="row">
                                <div class="col-md-12">
                                    <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

                                    </br>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
