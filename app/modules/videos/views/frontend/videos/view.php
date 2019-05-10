<div id="main" class="wrapper">
	<div class="bres">
		<div class="container">
			<ul>
				<li><a href="<?php echo base_url() ?>"><i class="fas fa-home"></i>Trang chủ</a>/</li>
				<?php foreach ($Breadcrumb as $key => $val) { ?>
					<?php
					$title = $val['title'];
					$href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'videos_catalogues');
					?>
					<li class="">
						<a href="<?php echo $href; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<div id="main" class="main-new main-detail-video main-video wow fadeInUp">
		<div class="container">
			<div class="primary-video">
				<?php $video_code = explode('?v=', $DetailVideos['videos_code'])[1]; ?>
				<iframe width="932" height="524" src="https://www.youtube.com/embed/<?php echo $video_code?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				<div class="nav-detail-vide">
					<div class="row">
						<div class="col-md-8 col-md-8 col-xs-12" id="mota">
							<h1 class="title"><?php echo $DetailVideos['title'] ?></h1>
							<div class="date-share">
								<div class="row">
									<div class="col-md-6 col-sm-6 cl-xs-12">
										<p class="date"><i class="fas fa-calendar-week"></i><?php echo $DetailVideos['created'] ?> </p>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="share-video">
											<ul>
												<li><a href="javascript:void();"><i class="fas fa-comments"></i>Bình luận</a></li>
												<li><a href="javascript:void();"><i class="fab fa-facebook-f"></i>Chia sẻ</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<p class="desc" style="color: #fff !important;"><?php echo $DetailVideos['description'] ?></p>
							<div style="clear: both;height: 20px"></div>
							<div class="social-share" style="float: right;text-align: right;">
								<script type="text/javascript"
										src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59e812e6b22460be"></script>
								<div class="addthis_inline_share_toolbox_i92u"></div>
							</div>
							<div style="clear: both;height: 20px"></div>
							<?php coment_fb()?>
						</div>
						<style>
							#mota p{
								color: #fff !important;

							}
							#mota img{
								max-width: 100% !important;
								height: auto !important;
							}
						</style>
						<style>
							#at4-share, #at4-soc, #at-cv-toaster.at-cv-mask, #at-share-dock {
								display: none !important;
							}

							#fld_8111642_2 {
								width: auto;
								float: right;
								background: #0057af;
								color: #fff;
								height: 40px;
								line-height: 36px;
								padding: 0 10px 15px;
							}
						</style>


						<?php if(isset($videos_same) && is_array($videos_same) && count($videos_same)){ ?>

						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="list-vide0 scrollbar" id="style-2">
								<div class="force-overflow">
									<?php foreach($videos_same as $key => $val) { ?>
										<?php
										$title = $val['title'];
										$href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'videos');
										$image = getthumb($val['images'], FALSE);
										?>
									<div class="item-video-dt">
										<div class="image">
											<a href="<?php echo $href ?>"><img src="<?php echo $image ?>" alt="<?php echo $title ?>"></a>
											<div class="icon-video1">
												<img src="templates/frontend/resources/images/icon-video.png" alt="<?php echo $title ?>">
											</div>
										</div>
										<div class="nav-image">
											<h3 class="title"><a href="<?php echo $href ?>"><?php echo $title ?></a></h3>
											<div class="view-fb">
												<ul>
													<li><i class="fas fa-eye"></i><?php echo $val['created']?></li>
<!--													<li><i class="fab fa-facebook-f"></i>1098</li>-->
												</ul>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>

									<?php } ?>
								</div>

							</div>

						</div>


						<?php } ?>




					</div>

				</div>
			</div>
		</div>
	</div>
</div>