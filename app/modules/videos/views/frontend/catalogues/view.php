<div id="main" class="wrapper">
    <div class="bres">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url() ?>"><i class="fas fa-home"></i>Trang chủ</a>/</li>
                <?php foreach ($Breadcrumb as $key => $val) { ?>
                    <?php
                    $title = $val['title'];
                    $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'videos_catalogues');
                    ?>
                    <li class="">
                        <a href="<?php echo $href; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <div id="main" class="main-new main-video ">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="contet-child">
                        <?php if (isset($videosList) && is_array($videosList) && count($videosList)) { ?>
                            <?php $i = 0;
                            foreach ($videosList as $key => $val) {
                                $i++; ?>
                                <?php
                                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'videos');
                                $description = cutnchar($val['description'], 300);

                                ?>
                                <div class="item-new">
                                    <div class="image">
                                        <a href="<?php echo $href ?>"><img src="<?php echo $val['images'] ?>"
                                                                           alt="<?php echo $val['title'] ?>"></a>

                                        <div class="icon-video1">
                                            <img src="templates/frontend/resources/images/icon-video.png"
                                                 alt="<?php echo $val['title'] ?>">
                                        </div>
                                    </div>
                                    <div class="nav-image">

                                        <h3 class="title"><a href="<?php echo $href ?>"><?php echo $val['title'] ?></a>
                                        </h3>

                                        <div class="view-fb">
                                            <ul>
                                                <li><i class="fas fa-eye"></i><?php echo $val['viewed'] ?></li>
                                                <!--                                        <li><i class="fab fa-facebook-f"></i>1098</li>-->
                                            </ul>
                                        </div>
                                        <p class="desc"><?php echo strip_tags($description) ?></p>
                                        <a href="<?php echo $href ?>" class="chitiet">Xem chi tiết<i
                                                class="fas fa-play-circle"></i></a>

                                        <div class="line"><img src="templates/frontend/resources/images/line.png"
                                                               alt="<?php echo $val['title'] ?>"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            <?php }
                        } ?>
                    </div>
                    <nav class="nav-page wow fadeInUp" aria-label="Page navigation navigation-page wow fadeInUp">
                        <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>


                    </nav>

                    <?php echo $this->load->view('homepage/frontend/common/block'); ?>




                </div>

                <?php echo $this->load->view('homepage/frontend/common/aside'); ?>
            </div>
        </div>
    </div>
</div>
