<div id="main" class="wrapper">
    <?php $slide = $this->FrontendSlides_Model->Read('index-slide', $this->fc_lang); ?>
    <?php if (isset($slide) && is_array($slide) && count($slide)) { ?>
        <div id="slider-home" class="owl-carousel">
            <?php foreach ($slide as $key => $val) { ?>
                <div class="item">
                    <a href="<?php echo $val['url']; ?>" title="<?php echo $val['title']; ?>"><img
                            alt="<?php echo $val['title']; ?>" src="<?php echo $val['image']; ?>"/></a>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
    <?php $adversite = $this->FrontendSlides_Model->Read('adversite-1', $this->fc_lang); ?>
    <?php if (isset($adversite) && is_array($adversite) && count($adversite)) { ?>
        <section class="top-content">
            <div class="container">
                <div class="title-title">
                    <h2 class="title-primary wow fadeInUp">Điểm khác biệt của ales</h2>
                </div>
                <div class="nav-top-content">
                    <div class="row">
                        <?php foreach ($adversite as $key => $val) { ?>
                            <div class="col-md-3 col-sm-6 col-xs-6 wow fadeInUp">
                                <div class="item">
                                    <div class="icon"><img src="<?php echo $val['image']; ?>"
                                                           alt="<?php echo $val['title']; ?>"></div>
                                    <p class="desc"><?php echo $val['title']; ?><br>
                                        <span><?php echo $val['description']; ?></span></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
    <?php if (is_array($doingugiangvien) && isset($doingugiangvien) && count($doingugiangvien)) { ?>
        <?php foreach ($doingugiangvien as $key => $value) { ?>
            <?php
            $href = rewrite_url($value['canonical'], $value['slug'], $value['id'], 'articles_catalogues');
            ?>
            <?php if (is_array($value['post']) && isset($value['post']) && count($value['post'])) { ?>
                <section class="team-teacher ">
                    <div class="container">
                        <div class="title-title">
                            <h2 class="title-primary wow fadeInUp"><?php echo $value['title'] ?></h2>
                        </div>
                        <div class="nav-team-teacher wow fadeInUp">
                            <div class="slider-team owl-carousel">
                                <?php $i = 0;
                                foreach ($value['post'] as $keyp => $val) {
                                    $i++; ?>
                                    <?php
                                    $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');
                                    $image = getthumb($val['images'], TRUE);
                                    $description = $val['description'];
                                    ?>
                                    <div class="item">
                                        <div class="image">
                                            <a href="<?php echo $href ?>"><img
                                                    src="<?php echo $image ?>"
                                                    alt="<?php echo $val['title'] ?>"></a>
                                        </div>
                                        <div class="nav-img">
                                            <h3 class="name"> <?php echo $val['title'] ?> </h3>

                                            <div class="description">
                                                <p><?php echo strip_tags($description) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </section>

            <?php } ?>
        <?php } ?>
    <?php } ?>
    <?php if (is_array($cackhoahoc) && isset($cackhoahoc) && count($cackhoahoc)) { ?>
        <?php foreach ($cackhoahoc as $key => $value) { ?>
            <?php
            $href = rewrite_url($value['canonical'], $value['slug'], $value['id'], 'articles_catalogues');
            ?>
            <?php if (is_array($value['post']) && isset($value['post']) && count($value['post'])) { ?>

                <section class="course-home">
                    <div class="container">
                        <div class="title-title">
                            <h2 class="title-primary wow fadeInUp"><?php echo $value['title'] ?></h2>

                            <p class="desc-primary wow fadeInUp">
                                <?php echo $value['description'] ?>
                            </p>
                        </div>
                        <div class="nav-course-home">
                            <div class="row">
                                <?php $i = 0;
                                foreach ($value['post'] as $keyp => $val) {
                                    $i++; ?>
                                    <?php
                                    $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');
                                    $image = getthumb($val['images'], TRUE);
                                    $description = cutnchar($val['description'], 200);
                                    ?>
                                    <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp">
                                        <div class="item">
                                            <div class="image">
                                                <div class="relative-overlay">
                                                    <a href="<?php echo $href ?>"><img
                                                            src="<?php echo $image ?>"
                                                            alt="<?php echo $val['title'] ?>"></a>

                                                    <div class="overlay"><a href="<?php echo $href ?>">Xem chi tiết<i
                                                                class="fas fa-angle-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-item">
                                                <h3 class="title">Khóa học<br><?php echo $val['title'] ?></h3>

                                                <p class="desc"
                                                   style="height: 66px;overflow: hidden"><?php echo strip_tags($description) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </section>

            <?php } ?>
        <?php } ?>
    <?php } ?>


    <?php if (is_array($thanhtichcao) && isset($thanhtichcao) && count($thanhtichcao)) { ?>
        <?php foreach ($thanhtichcao as $key => $val) { ?>
            <?php
            $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');
            $image = $val['images'];
            $list_items = json_decode($val['albums'], TRUE);
            // echo "<pre>";var_dump($list_items);die;
            ?>
            <?php if (is_array($list_items) && isset($list_items) && count($list_items)) { ?>

                <section class="top-student">
                    <div class="container">
                        <div class="title-title wow fadeInUp">
                            <h2 class="title-primary "><?php echo $val['title'] ?></h2>
                        </div>
                        <div class="nav-top-student wow fadeInUp">
                            <div class="list-img">
                                <div class="slider-large owl-carousel">
                                    <?php foreach ($list_items as $keys => $vals) { ?>
                                        <div class="item" data-hash="one<?php echo $keys ?>">
                                            <div class="item1">
                                                <div class="left">
                                                    <img src="<?php echo $vals['content'] ?>"
                                                         alt="<?php echo $vals['title'] ?>">
                                                </div>
                                                <div class="right">
                                                    <img src="<?php echo $vals['images'] ?>"
                                                         alt="<?php echo $vals['title'] ?>">
                                                </div>
                                            </div>
                                            <div class="content-desc">
                                                <h3 class="title"><?php echo $vals['title'] ?></h3>

                                                <p class="desc"><?php echo $vals['description'] ?>
                                                </p>
                                            </div>
                                        </div>
                                        <?php
                                    } ?>
                                </div>
                                <div class="slider-small owl-carousel">
                                    <?php foreach ($list_items as $keys => $vals) { ?>
                                        <a href="#one<?php echo $keys ?>">
                                            <img src="<?php echo $vals['images'] ?>" alt="<?php echo $vals['title'] ?>">
                                        </a>
                                        <?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php }
        }
    } ?>
    <?php if (is_array($phuhuynh) && isset($phuhuynh) && count($phuhuynh)) { ?>
        <?php foreach ($phuhuynh as $key => $val) { ?>
            <?php
            $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');
            $image = $val['images'];
            $list_items = json_decode($val['album'], TRUE);
            ?>
            <?php if (is_array($list_items) && isset($list_items) && count($list_items)) { ?>
                <section class="before-after wow fadeInUp">
                    <div class="container">
                        <div class="title-title">
                            <h2 class="title-primary"><?php echo $val['title'] ?></h2>
                        </div>
                        <div class="carousel uk-visible-large" id="ba-desktop">
                            <div class="slides">
                                <?php foreach ($list_items as $keys => $vals) { ?>
                                    <div class="item slideItem">
                                        <img src="<?php echo $vals['images'] ?>" alt="<?php echo $vals['title'] ?>">

                                        <div class="nav-img">
                                            <h3 class="title"><?php echo $vals['title'] ?></h3>

                                            <p class="adress"><?php echo $vals['description'] ?></p>

                                            <p class="desc"><?php echo $vals['content'] ?></p>
                                        </div>
                                    </div>

                                    <?php
                                } ?>
                            </div>
                        </div>
                        <div class="slider-mobile owl-carousel">
                            <?php foreach ($list_items as $keys => $vals) { ?>

                                <div class="item ">
                                    <img src="<?php echo $vals['images'] ?>" alt="<?php echo $vals['title'] ?>">

                                    <div class="nav-img">
                                        <h3 class="title"><?php echo $vals['title'] ?></h3>

                                        <p class="adress"><?php echo $vals['description'] ?></p>

                                        <p class="desc"><?php echo $vals['content'] ?></p>
                                    </div>
                                </div>
                                <?php
                            } ?>
                        </div>
                    </div>
                </section>
            <?php }
        }
    } ?>

    <section class="traditional-image wow fadeInUp">
        <div class="container">
            <div class="row">

                <?php if (is_array($truyenthong) && isset($truyenthong) && count($truyenthong)) { ?>
                    <?php foreach ($truyenthong as $key => $value) { ?>
                        <?php
                        $href = rewrite_url($value['canonical'], $value['slug'], $value['id'], 'articles_catalogues');
                        ?>
                        <?php if (is_array($value['post']) && isset($value['post']) && count($value['post'])) { ?>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="traditional-home">
                                    <h2 class="title1"><img src="templates/frontend/resources/images/icon3.png"
                                                            alt="<?php echo $value['title'] ?>"><?php echo $value['title'] ?>
                                    </h2>

                                    <div class="nav-traditional">
                                        <?php $i = 0;
                                        foreach ($value['post'] as $keyp => $val) {
                                            $i++; ?>
                                            <?php
                                            $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');
                                            $image = getthumb($val['images'], TRUE);
                                            $description = cutnchar($val['description'], 300);
                                            ?>
                                            <div class="item">
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                                        <div class="image">
                                                            <a href="<?php echo $href ?>"><img
                                                                    src="<?php echo $image ?>"
                                                                    alt="<?php echo $val['title'] ?>"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                        <div class="nav-img">
                                                            <h3 class="title"><a
                                                                    href="<?php echo $href ?>"><?php echo $val['title'] ?></a>
                                                            </h3>

                                                            <p class="date"><i
                                                                    class="fas fa-calendar-week"></i><?php echo $val['created'] ?>
                                                            </p>

                                                            <p class="desc"><?php echo strip_tags($description) ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>

                <?php if (is_array($hinhanh) && isset($hinhanh) && count($hinhanh)) { ?>
                <?php foreach ($hinhanh as $key => $value) { ?>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="image-home">
                        <h2 class="title1"><img src="templates/frontend/resources/images/icon3.png" alt="<?php echo $value['title']?>"><?php echo $value['title']?></h2>

                        <div class="nav-image-home">
                            <div class="slider-img owl-carousel">
                                <?php $list_items = json_decode($value['albums'],TRUE)?>
                                <?php if (is_array($list_items) && isset($list_items) && count($list_items)) { ?>

                                    <div class="item">
                                    <?php $i=0; foreach ($list_items as $keys => $vals) { $i++;?>
                                        <?php if ($keys == 4) {?>
                                        </div><div class="item">
                                        <?php }?>
                                        <div class="item1">
                                            <img src="<?php echo $vals['images']?>" alt="<?php echo $vals['title']?>">
                                        </div>
                                    <?php }?>
                                    </div>


                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </section>

    <?php if (is_array($videos) && isset($videos) && count($videos)) { ?>
        <?php foreach ($videos as $key => $value) { ?>

            <?php if (is_array($value['post']) && isset($value['post']) && count($value['post'])) { ?>
                <section class="video-home wow fadeInUp">
                    <div class="container">
                        <div class="title-title">
                            <h2 class="title-primary"><?php echo $value['title'] ?></h2>
                        </div>
                        <div class="nav-video-home">
                            <div class="row">
                                <div class="col-md-8 col-sm-12 col-xs-12">
                                    <?php $i = 0;
                                    foreach ($value['post'] as $keyp => $val) {
                                        $i++; ?>
                                        <?php if ($i == 1) { ?>
                                            <?php $video_code = explode('?v=', $val['videos_code'])[1]; ?>
                                            <?php
                                            $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'videos');
                                            ?>
                                            <div class="video-primary">

                                                <div class="image">
                                                    <a href="<?php echo $href?>"><img src="<?php echo $val['images'] ?>"
                                                                    alt="<?php echo $val['title'] ?>"></a>

                                                    <div class="icon-video1">
                                                        <a href="<?php echo $href?>"><img
                                                                src="templates/frontend/resources/images/icon-video.png"
                                                                alt="<?php echo $val['title'] ?>"></a>
                                                    </div>
                                                </div>
                                                <div class="nav-title">
                                                    <h3 class="title"><a href="<?php echo $href?>"><?php echo $val['title'] ?></a>
                                                    </h3>

                                                    <div class="view-fb">
                                                        <ul>
                                                            <li><i class="fas fa-eye"></i><?php echo $val['viewed'] ?></li>
                                                            <!--                                        <li><i class="fab fa-facebook-f"></i>1098</li>-->
                                                        </ul>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>

                                            </div>
                                        <?php } ?>
                                    <?php } ?>


                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <div class="video-second">

                                        <?php $i = 0;
                                        foreach ($value['post'] as $keyp => $val) {
                                            $i++; ?>
                                            <?php if ($i > 1) { ?>
                                                <?php $video_code = explode('?v=', $val['videos_code'])[1]; ?>
                                                <?php
                                                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'videos');
                                                ?>
                                                <div class="item-vd">
                                                    <div class="video-l">
                                                        <div class="image">
                                                            <a href="<?php echo $href?>"><img
                                                                    src="<?php echo $val['images'] ?>"
                                                                    alt="<?php echo $val['title'] ?>"></a>

                                                            <div class="icon-video1">
                                                                <a href="<?php echo $href?>"><img
                                                                        src="templates/frontend/resources/images/icon-video.png"
                                                                        alt="<?php echo $val['title'] ?>"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="video-r">
                                                        <h3 class="title"><a href="<?php echo $href?>"><?php echo $val['title'] ?></a></h3>

                                                        <div class="view-fb">
                                                            <ul>
                                                                <li><i class="fas fa-eye"></i><?php echo $val['viewed'] ?></li>
                                                                <!--                                            <li><i class="fab fa-facebook-f"></i>1098</li>-->
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php } ?>
        <?php } ?>
    <?php } ?>

    <section class="traditional-image ketnoi wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="traditional-home">
                        <h2 class="title1"><img src="templates/frontend/resources/images/icon3.png" alt="Kết nối ngoại
                            ngữ ales">Kết nối ngoại
                            ngữ ales</h2>

                        <div class="nav-ketnoi-l">
                            <iframe
                                src="https://www.facebook.com/plugins/page.php?href=<?php echo $this->fcSystem['social_facebook'] ?>%2F&tabs=timeline&width=568&height=380&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=343876996017079"
                                width="568" height="380" style="border:none;overflow:hidden" scrolling="no"
                                frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                        </div>

                    </div>
                </div>
                <?php if (is_array($sukienuudai) && isset($sukienuudai) && count($sukienuudai)) { ?>
                    <?php foreach ($sukienuudai as $key => $value) { ?>
                        <?php
                        $href = rewrite_url($value['canonical'], $value['slug'], $value['id'], 'articles_catalogues');
                        ?>
                        <?php if (is_array($value['post']) && isset($value['post']) && count($value['post'])) { ?>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="image-home">
                                    <h2 class="title1"><img src="templates/frontend/resources/images/icon3.png"
                                                            alt="<?php echo $value['title'] ?>"><?php echo $value['title'] ?>
                                    </h2>

                                    <div class="nav-ketnoi-right traditional-home">
                                        <div class="nav-traditional">
                                            <?php $i = 0;
                                            foreach ($value['post'] as $keyp => $val) {
                                                $i++; ?>
                                                <?php
                                                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');
                                                $image = getthumb($val['images'], TRUE);
                                                $description = cutnchar($val['description'], 300);
                                                ?>
                                                <div class="item">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <div class="image">
                                                                <a href="<?php echo $href ?>"><img
                                                                        src="<?php echo $image ?>"
                                                                        alt="<?php echo $val['title'] ?>"></a>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                            <div class="nav-img">
                                                                <h3 class="title"><a
                                                                        href="<?php echo $href ?>"><?php echo $val['title'] ?></a>
                                                                </h3>

                                                                <p class="date"><i class="fas fa-calendar-week"></i><?php echo $val['created']?>
                                                                </p>

                                                                <p class="desc"><?php echo strip_tags($description) ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    }
                } ?>
            </div>
        </div>
    </section>
</div>
