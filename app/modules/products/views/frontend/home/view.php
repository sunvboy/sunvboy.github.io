<div id="products-page" class="page-body">
	<div class="banner-page  uk-text-center" style="background: url('<?php echo $this->fcSystem['banner_banner1'] ?>');">
		<img src="<?php echo $this->fcSystem['banner_banner1'] ?>" alt="Banner page">
		<div class="absulute-page">
			<header class="panelhead">
				<h1 class="heading"><span>Products</span></h1>
			</header>
			<div class="breadcrumb">
				<ul class="uk-breadcrumb">
					<li>
						<a href="<?php echo BASE_URL ?>" title="<?php echo $this->lang->line('home_page') ?>">
							<?php echo $this->lang->line('home_page'); ?>
						</a>
					</li>
					<li class="uk-active">
						<a href="products.html" title="Products">Products</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	
	<section class="design-catalogue mt30">
		<div class="uk-container uk-container-center">
			<?php if (isset($productsList) && is_array($productsList) && count($productsList)): ?>
				<section class="catalogues-products">
                    <section class="panel-body">
                        <ul class="uk-list list-category">
                            <?php foreach ($productsList as $key => $val) { ?>
                                <?php 
                                    $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products_catalogues');
                                    $image = $val['images']; 
                                    $description = cutnchar(strip_tags($val['description']), 300);
                                ?>
                                <li>
                                    <div class="category">
                                        <div class="thumb">
                                            <a class="image img-cover" href="<?php echo $href ?>" title="<?php echo $val['title'] ?>">
                                                <img src="<?php echo $image; ?>" alt="<?php echo $val['title'] ?>" />
                                            </a>
                                        </div>
                                        <div class="infor uk-flex-middle uk-flex uk-flex-center">
                                        	<div class="box_center">
	                                            <h3 class="title mb20">
	                                                <a href="<?php echo $href ?>" title="<?php echo $val['title'] ?>">
	                                                    <?php echo $val['title'] ?>
	                                                </a>
	                                            </h3>
	                                            <div class="description"><?php echo $description ?></div>
	                                            <div class="more_detail">
	                                                <a href="<?php echo $href ?>" title="Xem chi tiết">
	                                                    Xem chi tiết
	                                                </a>
	                                            </div>
	                                       	</div>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </section>
                </section>
			<?php endif ?>
		</div>
	</section>
</div>