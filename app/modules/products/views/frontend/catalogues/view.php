<main id="main" class="site-cat-menu" style="margin-top: 30px;">
    <div class="container">
        <div class="row">

            <?php if (is_array($cat_child) && isset($cat_child) && count($cat_child)) { ?>
                <?php foreach ($cat_child as $key => $val) { ?>
                    <?php
                    $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products_catalogues');
                    ?>

                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="list-menu-cat h_43648"><img src="<?php echo $val['images'] ?>" style="object-fit: cover"><a class="title-cat-menu"
                                                                                              href="<?php echo $href ?>"><?php echo $val['title'] ?></a>
                        </div>
                    </div>
                <?php }
            } ?>


        </div>
        <!-- .End row -->
    </div>


</main>