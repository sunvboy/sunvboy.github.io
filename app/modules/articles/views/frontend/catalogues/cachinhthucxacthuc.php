<main>
    <div class="breadcrumb_pc">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo base_url() ?>">Trang chủ</a></li>
                        <?php foreach ($Breadcrumb as $key => $val) { ?>
                            <?php
                            $title = $val['title'];
                            $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles_catalogues');
                            ?>
                            <li><a href="<?php echo $href; ?>"><?php echo $title; ?></a></li><?php } ?>
                    </ul>
                </div>

            </div>

        </div>

    </div>
    <div class="clearfix-20"></div>
    <section id="baovekhachhang">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <h1 class="text-center"><?php echo $DetailCatalogues['title'] ?></h1>

                    <div class="clearfix"></div>

                    <?php echo $DetailCatalogues['description'] ?>

                </div>

                <div class="clearfix"></div>

                <?php if (isset($ArticlesList) && is_array($ArticlesList) && count($ArticlesList)) { ?>
                    <?php $i = 0;
                    foreach ($ArticlesList as $key => $val) {
                        $i++; ?>
                        <?php
                        $title = $val['title'];
                        $image = getthumb($val['images'], TRUE);
                        $description = $val['description'];
                        ?>
                        <div class="col-md-4 col-xs-12 col-sm-4 col0057af">
                            <div class="baovekhachhang_box">
                                <img src="<?php echo $image ?>" alt="<?php echo $title ?>">

                                <div class="clearfix-10"></div>
                                <h3 class="et_pb_module_header"><?php echo $title ?></h3>

                                <div class="et_pb_blurb_description">
                                    <?php echo $description ?>
                                </div>
                            </div>

                        </div>

                    <?php } ?>
                <?php } ?>


                <div class="clearfix-20"></div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <div class="baovekhachhang_box1">
                        <?php echo $this->fcSystem['homepage_note'] ?>

                        <div class="clearfix-20"></div>
                        <div class="text-center">
                            <a href="tel:<?php echo $this->fcSystem['contact_phone'] ?>">Hotline: <?php echo $this->fcSystem['contact_phone'] ?></a>
                        </div>

                    </div>

                </div>


            </div>
        </div>

    </section>

</main>