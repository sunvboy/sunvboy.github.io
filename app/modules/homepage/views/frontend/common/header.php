<header id="header-site">

    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="top-header-left">
                        <ul>
                            <li><i class="fas fa-star"></i></li>

                            <li>
                                <a href="<?php echo $this->fcSystem['MENU_link_menu_tintuc'] ?>"><?php echo $this->fcSystem['MENU_menu_tintuc'] ?></a>|
                            </li>
                            <li>
                                <a href="<?php echo $this->fcSystem['MENU_link_menu_blog'] ?>"><?php echo $this->fcSystem['MENU_menu_blog'] ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="top-header-right">
                        <p><img src="templates/frontend/resources/images/icon2.png" alt="HOTLINE"><span>HOTLINE:</span>
                            Hà Nội <span><?php echo $this->fcSystem['contact_hotline_hanoi'] ?></span> I TP. Hồ Chí Minh
                            <span><?php echo $this->fcSystem['contact_hotline_hcm'] ?></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div id="main-menu">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-12 col-xs-12">
                    <!-- begin mobile -->
                    <div class="wrapper cf">
                        <nav id="main-nav">
                            <ul class="second-nav">
                                <?php $main_main = navigations_array('main', $this->fc_lang); ?>
                                <?php if (isset($main_main) && is_array($main_main) && count($main_main)) { ?>
                                    <?php foreach ($main_main as $key => $val) { ?>
                                        <li class="devices">
                                            <a href="<?php echo $val['href']; ?>"><?php echo $val['title'] ?></a>
                                            <?php if (isset($val['child']) && is_array($val['child']) && count($val['child'])) { ?>

                                                <ul>
                                                    <?php foreach ($val['child'] as $keys => $vals) { ?>
                                                        <li class="camera">
                                                            <a href="<?php echo $vals['href']; ?>"
                                                               title="<?php echo $vals['title']; ?>">
                                                                <?php echo $vals['title']; ?>
                                                            </a>
                                                            <!--                                            <ul>-->
                                                            <!--                                                <li><a href="#">Smart Shot</a></li>-->
                                                            <!--                                                <li><a href="#">Power Shooter</a></li>-->
                                                            <!--                                                <li><a href="#">Easy Photo Maker</a></li>-->
                                                            <!--                                                <li><a href="#">Super Pixel</a></li>-->
                                                            <!--                                            </ul>-->
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                    <?php }
                                } ?>
                            </ul>
                        </nav>
                        <a class="toggle">
                            <span></span>
                        </a>
                    </div>
                    <!-- end mobile -->
                    <a href="<?php echo base_url() ?>" class="logo">
                        <img src="<?php echo $this->fcSystem['homepage_logo'] ?>"
                             alt="<?php echo $this->fcSystem['homepage_brandname'] ?>">
                    </a>
                </div>
                <div class="col-md-10 col-sm-12 col-xs-12">
                    <nav class="menu">
                        <ul>
                            <?php $main_main = navigations_array('main', $this->fc_lang); ?>
                            <?php if (isset($main_main) && is_array($main_main) && count($main_main)) { ?>
                                <?php foreach ($main_main as $key => $val) { ?>
                                    <li>
                                        <a href="<?php echo $val['href']; ?>">
                                    <span class="icon"><img src="<?php echo $val['images'] ?>"
                                                            alt="<?php echo $val['title'] ?>"></span>
                                            <span class="title-menu"><?php echo $val['title'] ?></span>
                                        </a>
                                        <?php if (isset($val['child']) && is_array($val['child']) && count($val['child'])) { ?>

                                            <div class="sub-menu">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="item-sub-menu">
                                                            <ul>
                                                                <?php foreach ($val['child'] as $keys => $vals) { ?>
                                                                    <?php if ($keys <= 4) { ?>
                                                                        <li><a href=" <?php echo $vals['href']; ?>"> <?php echo $vals['title']; ?></a>
                                                                        </li>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="item-sub-menu">
                                                            <ul>
                                                                <?php foreach ($val['child'] as $keys => $vals) { ?>
                                                                    <?php if ($keys > 4) { ?>
                                                                        <li><a href=" <?php echo $vals['href']; ?>"> <?php echo $vals['title']; ?></a>
                                                                        </li>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="item-sub-menu">
                                                            <img src="<?php echo $val['images_sub']?>"
                                                                 alt="<?php echo $val['title']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </li>
                                <?php }
                            } ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- end header -->