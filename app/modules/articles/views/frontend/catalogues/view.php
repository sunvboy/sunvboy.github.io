<div class="clear" style="height:20px;"></div>

<main id="main">
    <section id="content">
        <div id="sanpham">
            <div class="container">
                <div class="box">
                    <div class="thanh_index " data-wow-delay="0.3s"><h2><?php echo $DetailCatalogues['title'] ?></h2></div>
                    <div class="clear" style="height:20px;"></div>
                    <div class="newsss">

                        <?php if (isset($ArticlesList) && is_array($ArticlesList) && count($ArticlesList)) { ?>
                        <?php $i = 0;
                        foreach ($ArticlesList as $key => $val) {
                        $i++; ?>
                        <?php
                            $title = $val['title'];
                            $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');
                            $image = getthumb($val['images'], TRUE);
                            $description = cutnchar(strip_tags($val['description']), 200);
                            $created = show_time($val['created'], 'd/m/Y');
                            $view = $val['viewed'];
                        ?>
                        <div class="item_tintuc " >

                            <a href="<?php echo $href?>"
                               title="<?php echo $title?>"><img
                                    src="<?php echo $image?>"
                                    alt="<?php echo $image ?>" style="height: 146px;width: 214px;object-fit: cover"></a>

                            <h2><a href="<?php echo $href?>"
                                   title="<?php echo $title?>"><?php echo $title?></a></h2>

                            <div class="ngayup" style="color:#999"><?php echo $created?></div>
                            <p><?php echo $description?></p>

                        </div>

                        <?php } ?>
                        <?php } ?>
                        <div align="center">
                            <div class="paging"></div>
                        </div>
                    </div>
                </div>
                <h1 class="visit_hidden fn org "><?php echo $DetailCatalogues['title'] ?></h1>

                <div class="clear" style="height:20px;"></div>
            </div>
        </div>
    </section>
    <div class="clear"></div>
</main>