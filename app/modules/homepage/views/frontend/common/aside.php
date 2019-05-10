<div class="col-md-3 col-sm-3 col-xs-12 wow fadeInUp">
    <div class="sidebar">

        <?php
        $phuhuynh = $this->FrontendArticles_Model->ReadByCondition(array(
            'select' => 'id, title, slug, canonical,description,images,album	',
            'table' => 'articles',
            'where' => array('highlight' => 1, 'publish' => 1, 'trash' => 0, 'alanguage' => $this->fc_lang),
            'limit' => 1,
            'order_by' => 'order asc, id desc',
        ));
        ?>
        <?php if (is_array($phuhuynh) && isset($phuhuynh) && count($phuhuynh)) { ?>
            <?php foreach ($phuhuynh as $key => $val) { ?>
                <?php
                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');
                $image = $val['images'];
                $list_items = json_decode($val['album'], TRUE);
                ?>
                <?php if (is_array($list_items) && isset($list_items) && count($list_items)) { ?>
                    <div class="item-sidebar">
                        <h3 class="title-sb"><img src="templates/frontend/resources/images/i.png" alt="">Câu chuyện
                            khách hàng</h3>

                        <div class="nav-item-sb nav-item-kh">
                            <div class="slider-kh owl-carousel">
                                <?php foreach ($list_items as $keys => $vals) { ?>
                                    <div class="item">
                                        <div class="image">
                                            <img src="<?php echo $vals['images'] ?>" alt="<?php echo $vals['title'] ?>">
                                        </div>
                                        <div class="nav-img">
                                            <h3 class="title-name"><?php echo $vals['title'] ?></h3>

                                            <p class="adress"><?php echo $vals['description'] ?></p>

                                            <p class="desc"><?php echo $vals['content'] ?></p>
                                        </div>
                                    </div>
                                    <?php
                                } ?>
                            </div>
                        </div>
                    </div>
                <?php }
            }
        } ?>

        <?php $adversite = $this->FrontendSlides_Model->Read('adversite-1', $this->fc_lang); ?>
        <?php if (isset($adversite) && is_array($adversite) && count($adversite)) { ?>
            <div class="item-sidebar">
                <h3 class="title-sb"><img src="templates/frontend/resources/images/i.png" alt="ĐIỂM KHÁC BIỆT CỦA ALES">ĐIỂM
                    KHÁC BIỆT CỦA ALES
                </h3>

                <div class="nav-item-sb  nav-item-sb-lt">
                    <?php foreach ($adversite as $key => $val) { ?>
                        <div class="item">
                            <div class="icon">
                                <img src="<?php echo $val['image']; ?>" alt="<?php echo $val['title']; ?>">
                            </div>
                            <div class="nav-icon">
                                <p class="desc"><?php echo $val['title']; ?><br>
                                    <span><?php echo $val['description']; ?></span></p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        <?php
        $videos = $this->FrontendVideosCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, lft, rgt,description', 'where' => array('trash' => 0, 'publish' => 1, 'ishome' => 1, 'alanguage' => '' . $this->fc_lang . ''), 'limit' => 1, 'order_by' => 'order asc, id desc'));
        if (isset($videos) && is_array($videos) && count($videos)) {
            foreach ($videos as $key => $val) {
                $videos[$key]['post'] = $this->FrontendVideos_Model->_read_condition(array(
                    'modules' => 'videos',
                    'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`viewed`, `pr`.`videos_code`',
                    'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1  AND `pr`.`alanguage` = \'' . $this->fc_lang . '\'',
                    'limit' => 1000,
                    'order_by' => '`pr`.`order` asc, `pr`.`id` asc',
                    'cataloguesid' => $val['id'],
                ));
            }
        }
        ?>
        <?php if (is_array($videos) && isset($videos) && count($videos)) { ?>
            <?php foreach ($videos as $key => $value) { ?>

                <?php if (is_array($value['post']) && isset($value['post']) && count($value['post'])) { ?>
                    <div class="item-sidebar">
                        <h3 class="title-sb"><img src="templates/frontend/resources/images/i.png"
                                                  alt="<?php echo $value['title'] ?>"><?php echo $value['title'] ?></h3>

                        <div class="nav-item-sb nav-item-sb-vdeo">
                            <div class="slider-video-sb owl-carousel">
                                <?php $i = 0;
                                foreach ($value['post'] as $keyp => $val) {
                                    $i++; ?>
                                    <?php $video_code = explode('?v=', $val['videos_code'])[1]; ?>
                                    <?php
                                    $href = rewrite_url($value['canonical'], $value['slug'], $value['id'], 'videos');
                                    ?>
                                    <div class="item">
                                        <div class="img">
                                            <a href="<?php echo $href ?>"><img src="<?php echo $val['images'] ?>"
                                                                               alt="<?php echo $val['title'] ?>"
                                                                               style="height: 179px;object-fit: cover"></a>

                                            <div class="icon-video">
                                                <img src="templates/frontend/resources/images/icon-video.png"
                                                     alt="<?php echo $val['title'] ?>">
                                            </div>
                                        </div>
                                        <div class="nav-img">
                                            <h3 class="title" style="height: 40px;overflow: hidden"><a
                                                    href="<?php echo $href ?>"><?php echo $val['title'] ?></a></h3>

                                            <div class="view-fb">
                                                <ul>
                                                    <li><i class="fas fa-eye"></i><?php echo $val['viewed'] ?></li>
                                                    <!--                                                    <li><i class="fab fa-facebook-f"></i>1098</li>-->
                                                </ul>
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

        <?php
        $blogchiase = $this->FrontendArticlesCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, lft, rgt,description', 'where' => array('trash' => 0, 'publish' => 1, 'ishot' => 1, 'alanguage' => '' . $this->fc_lang . ''), 'limit' => 1, 'order_by' => 'order asc, id desc'));
        if (isset($blogchiase) && is_array($blogchiase) && count($blogchiase)) {
            foreach ($blogchiase as $key => $val) {
                $blogchiase[$key]['post'] = $this->FrontendArticles_Model->_read_condition(array(
                    'modules' => 'articles',
                    'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`description`, `pr`.`content`, `pr`.`cataloguesid`, `pr`.`viewed`, `pr`.`created`',
                    'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1 AND `pr`.`alanguage` = \'' . $this->fc_lang . '\'',
                    'limit' => 5,
                    'order_by' => '`pr`.`order` asc, `pr`.`id` desc',
                    'cataloguesid' => $val['id'],
                ));
            }
        }
        ?>
        <?php if (is_array($blogchiase) && isset($blogchiase) && count($blogchiase)) { ?>
            <?php foreach ($blogchiase as $key => $value) { ?>
                <?php
                $href = rewrite_url($value['canonical'], $value['slug'], $value['id'], 'articles_catalogues');
                ?>
                <?php if (is_array($value['post']) && isset($value['post']) && count($value['post'])) { ?>
                    <div class="item-sidebar">
                        <h3 class="title-sb"><img src="templates/frontend/resources/images/i.png"
                                                  alt="<?php echo $value['title'] ?>"><?php echo $value['title'] ?></h3>

                        <div class="nav-item-sb nav-item-sb-blog">
                            <?php $i = 0;
                            foreach ($value['post'] as $keyp => $val) {
                                $i++; ?>
                                <?php
                                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');
                                $image = getthumb($val['images'], TRUE);
                                $description = cutnchar($val['description'], 300);
                                ?>
                                <?php if ($i == 1) { ?>
                                    <div class="item1">
                                        <div class="image">
                                            <a href="<?php echo $href ?>"><img src="<?php echo $val['images'] ?>"
                                                                               alt="<?php echo $val['title'] ?>"></a>
                                        </div>
                                        <p class="date"><i
                                                class="fas fa-calendar-week"></i><?php echo $val['created'] ?> </p>

                                        <h3 class="title"><a href="<?php echo $href ?>"><?php echo $val['title'] ?></a>
                                        </h3>
                                    </div>
                                <?php } else { ?>

                                    <div class="item2">
                                        <div class="image">
                                            <a href="<?php echo $href ?>"><img src="<?php echo $val['images'] ?>"
                                                                               alt="<?php echo $val['title'] ?>"></a>
                                        </div>
                                        <div class="nav-image">

                                            <h3 class="title"><a
                                                    href="<?php echo $href ?>"><?php echo $val['title'] ?></a></h3>

                                            <p class="date"><i
                                                    class="fas fa-calendar-week"></i><?php echo $val['created'] ?></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>



        <?php
        $hinhanh = $this->FrontendGallerys_Model->ReadByCondition(array(
            'select' => 'id, title, slug, canonical,description,albums',
            'table' => 'gallerys',
            'where' => array('highlight' => 1, 'publish' => 1, 'trash' => 0, 'alanguage' => $this->fc_lang),
            'limit' => 1,
            'order_by' => 'order asc, id desc',
        ));
        ?>
        <?php if (is_array($hinhanh) && isset($hinhanh) && count($hinhanh)) { ?>
            <?php foreach ($hinhanh as $key => $value) { ?>
                <div class="item-sidebar">
                    <h3 class="title-sb" style="overflow: hidden"><img src="templates/frontend/resources/images/i.png"
                                              alt="<?php echo $value['title'] ?>">Thư viện ảnh</h3>

                    <div class="nav-item-sb nav-item-sb-vdeo nav-item-sb-library">
                        <div class="slider-video-sb owl-carousel">
                            <?php $list_items = json_decode($value['albums'], TRUE) ?>
                            <?php if (is_array($list_items) && isset($list_items) && count($list_items)) { ?>
                                <?php $i = 0;
                                foreach ($list_items as $keys => $vals) {
                                    $i++; ?>

                                    <div class="item">
                                        <div class="img">
                                            <img src="<?php echo $vals['images'] ?>" alt="<?php echo $vals['title'] ?>">
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>


    </div>
</div>