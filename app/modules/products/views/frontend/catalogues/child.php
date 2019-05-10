<div id="content" class="site-content">


    <div id="primary" class="content-area">

        <div class="container">
            <section id="main-thucdon" class="site-main-menu">
                <div class="menu-image text-center"
                     style="background:url(<?php echo $DetailCatalogues['images']; ?>) no-repeat center center;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
                    <h1 style="    text-align: center;color: #fff"
                        class="menu-group"><?php echo $DetailCatalogues['title']; ?></h1>
                </div>


                <?php if (isset($productsList) && is_array($productsList) && count($productsList)) { ?>
                    <?php foreach ($productsList as $keyp => $val) { ?>
                        <?php
                        $title = $val['title'];
                        $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products');
                        $image = getthumb($val['images'], FALSE);
                        $price = $val['price'];
                        $saleoff = $val['saleoff'];
                        if ($price > 0) {
                            $giaold = str_replace(',', '.', number_format($price));
                        } else {
                            $giaold = '';
                        }
                        if ($saleoff > 0) {
                            $gia = str_replace(',', '.', number_format($saleoff)) . ' đ';
                        } else {
                            $gia = 'Contact';
                        }
                        if ($saleoff > 0 && $price > 0 && $saleoff < $price) {
                            $sale = ceil(($price - $saleoff) / $price * 100);
                            $price_sale = str_replace(',', '.', number_format($price - $saleoff)) . '?';
                        } else {
                            $sale = $price_sale = '';
                        }
                        ?>
                        <article class="menu-list" id="post-213">

                            <div class="menu-title">
                                <span class="thucdon-title"><?php echo $title; ?></span>
                                <span class="thucdon-price"><?php echo $gia ?></span>
                            </div>
                            <div class="menu-subtitle">
                                <span class="thucdon-unit"><?php echo strip_tags($val['description']) ?></span>
                                <span class="thucdon-plate"></span>
                            </div>


                        </article>
                        <!-- #post-213 -->
                    <?php } ?>
                <?php } ?>


                <div class="pagination" style="text-align: center;display: flex;    justify-content: center;    ">
                    <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
                </div>
            </section>
            <!-- #main -->
        </div>
        <!-- .container -->
    </div>
    <!-- #primary -->


</div>