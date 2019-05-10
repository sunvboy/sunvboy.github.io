<main>
    <div class="link-home-dm">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <li><a href="<?php echo base_url() ?>">Trang Chủ</a></li>

                            <li><a href="javascript:void();"><i class="fas fa-long-arrow-alt-right"></i></a></li>
                            <li><a href="javascript:void();">Kết quả tìm kiếm</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="main-site_bar-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="title-left-dm-content">
                        <h1>Kết quả tìm kiếm</h1>
                        <p><?php echo strip_tags($this->fcSystem['homepage_links_map']) ?></p>


                    </div>

                    <?php if (isset($result) && is_array($result) && count($result)) { ?>

                        <div class="list-products-bottom-dm active-tab2" id="tab1">
                            <div class="row">
                                <?php $i = 0;
                                foreach ($result as $key => $val) {
                                    $i++; ?>
                                    <?php
                                    $title = $val['title'];
                                    $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');
                                    $image = getthumb($val['images'], TRUE);
                                    $description = cutnchar(strip_tags($val['description']), 150);
                                    $created = show_time($val['created'], 'd/m/Y');
                                    $view = $val['viewed'];
                                    ?>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="box1-list-products">
                                            <div class="img-products-left">
                                                <a href="<?php echo $href ?>"><img src="<?php echo $image ?>"
                                                                                   alt="<?php echo $title ?>"></a>
                                            </div>
                                            <div class="text-products-right">
                                                <h4><a href="<?php echo $href ?>"><?php echo $title ?></a></h4>

                                                <p><?php echo $description ?></p>
                                            </div>
                                        </div>
                                    </div>


                                <?php } ?>
                            </div>
                        </div>


                    <?php } ?>
                    <div class="list-text-tab-bottom">
                        <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
                    </div>


                </div>
                <?php echo $this->load->view('homepage/frontend/common/aside'); ?>

            </div>
        </div>
    </div>
</main>



