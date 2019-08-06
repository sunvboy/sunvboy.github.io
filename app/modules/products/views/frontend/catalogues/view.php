<div class="clear" style="height:20px;"></div>
<main id="main">
    <section id="content">
        <div id="sanpham">
            <div class="container">
                <div class="box">
                    <div class="thanh_index"><h2><?php echo $DetailCatalogues['title']; ?></h2></div>
                    <div class="clear" style="height:20px;"></div>
                    <div class="boxsp">

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
                                <div class="item">
                                    <div class="box_item">
                                        <div class="content_item">
                                            <div class="img_item"><a href="<?php echo $href; ?>"
                                                                     title="<?php echo $title; ?>"><img
                                                        src="<?php echo $image ?>" alt="<?php echo $title; ?>" style="height: 275px;object-fit: cover;width: 100%"></a>

                                                <div class="info_item">
                                                    <h3><a href="<?php echo $href; ?>"
                                                           title="<?php echo $title; ?>"><?php echo $title; ?></a></h3>

                                                    <div class="clear" style="height:10px;"></div>
                                                    <div class="g">
                                                        <div class="gb">Giá: <span><?php echo $gia ?></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>

                    </div>
                    <div class="clear"></div>
                    <div class="paging"></div>


                </div>
                <div class="clear" style="height:15px;"></div>
                <h1 class="visit_hidden fn org"><?php echo $DetailCatalogues['title']; ?></h1>
            </div>
        </div>
    </section>
    <div class="clear"></div>
</main>