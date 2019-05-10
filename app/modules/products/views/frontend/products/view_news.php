<section class="sec-content-page content-page-dssp">
    <div class="bread-page">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url() ?>">Trang chủ</a></li>
                <li>Sản phẩm mới</li>
            </ul>
        </div>
    </div>
    <div class="wp-content-page page-dssp">
        <div class="container">
            <div class="title-page">
                <h1>Sản phẩm mới</h1>
            </div>
            <div class="content-page">
                <div class="wp-list-sanpham">
                    <div class="row">
                        <?php if (isset($result) && is_array($result) && count($result)) { ?>

                            <?php foreach ($result as $key => $val) { ?>
                                <?php
                                $title = $val['title'];
                                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products');
                                $image = getthumb($val['images'], FALSE);
                                $price = $val['price'];
                                $saleoff = $val['saleoff'];
                                if ($price > 0) {
                                    $giaold = str_replace(',', '.', number_format($price)) . '&nbspđ';
                                } else {
                                    $giaold = '';
                                }
                                if ($saleoff > 0) {
                                    $gia = str_replace(',', '.', number_format($saleoff)) . '&nbspđ';
                                } else {
                                    $gia = 'Liên hệ';
                                }
                                if ($saleoff > 0 && $price > 0 && $saleoff < $price) {
                                    $sale = ceil(($price - $saleoff) / $price * 100);
                                    $price_sale = str_replace(',', '.', number_format($price - $saleoff)) . '?';
                                } else {
                                    $sale = $price_sale = '';
                                }
                                ?>
                                <div class="col-md-20 col-md-3 col-sm-4 col-xs-6">
                                    <div class="wp-item-sp">
                                        <div class="img-item-sp">
                                            <a href="<?php echo $href ?>"><img src="<?php echo $image ?>" alt="<?php echo $title ?>"></a>
                                        </div>
                                        <div class="text-item-sp">
                                            <h4 class="ten-item-sp"><a href="<?php echo $href ?>"><?php echo $title ?></a></h4>

                                            <p class="gia-sp"><?php echo $gia?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } ?>

                    </div>
                    <div class="phantrang">
                        <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>