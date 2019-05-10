<div id="main" class="wrapper">
	<div id="main-category">
		<div class="container">
			<div class="row">

				<div class="col-md-9 col-sm-9 col-xs-12 col-md-push-3">
					<div class="main-content-c">
						<ul class="ulink">
							<li class="c">
								<a href="" rel="nofollow"></a>
							</li>
							<?php if (isset($DetailCatalogues) && is_array($DetailCatalogues)) {
							?>
								<?php
								$href = rewrite_url($DetailCatalogues['canonical'], $DetailCatalogues['slug'], $DetailCatalogues['id'], 'products_catalogues');
								?>
								<li><a  style="    text-transform: uppercase;" href="<?php echo $href?>" title="<?php echo $DetailCatalogues['title']; ?>"><?php echo $DetailCatalogues['title']; ?></a>
								</li>
								<li><a style="    text-transform: uppercase;" href="javascript:void()" title="<?php echo $DetailCatalogues['title']; ?>"><?php echo $DetailCatalogues['title']; ?> <?php echo $DetailAttributes['title']?></a>
								</li>
								<?php
							} ?>

						</ul>


						<section class="item-category">
							<?php if (isset($DetailCatalogues) && is_array($DetailCatalogues)) {
							?>
							<h1 class="hidden"> <?php echo $DetailCatalogues['title']; ?> <?php echo $DetailAttributes['title']?></h1>
							<?php }else{?>
								<h1 class="hidden"> <?php echo $DetailAttributes['title']; ?></h1>

							<?php }?>
							<div class="nav-item-category">
								<div class="row">
									<?php if (isset($AttributesList) && is_array($AttributesList) && count($AttributesList)) { ?>
										<?php foreach ($AttributesList as $keyp => $val) { ?>
											<?php
											$title = $val['title'];
											$href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products');
											$image = getthumb($val['images'], FALSE);
											$price = $val['price'];
											$saleoff = $val['saleoff'];
											if ($price > 0) {
												$giaold = str_replace(',', '.', number_format($price)) . '<sup>đ</sup>';
											} else {
												$giaold = '';
											}
											if ($saleoff > 0) {
												$gia = str_replace(',', '.', number_format($saleoff)) . '<sup>đ</sup>';
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

											<div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp">
												<div class="item">
													<div class="image">
														<a href="<?php echo $href?>"><img src="<?php echo $image?>" alt="<?php echo $title?>"></a>
													</div>
													<h3 class="title"><a href="<?php echo $href?>"><?php echo $title?></a></h3>
													<p class="price">Giá: <span><?php echo $gia?></span></p>
												</div>
											</div>
										<?php }}?>


								</div>
							</div>
							<div class="pagenavi">
								<?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
							</div>

						</section>



					</div>
				</div>
				<?php echo $this->load->view('homepage/frontend/common/aside')?>

			</div>
		</div>
	</div>
</div>

