<div id="documents-page" class="page-body">
	<div class="banner-page  uk-text-center" style="background: url('<?php echo $this->fcSystem['banner_banner1'] ?>');">
		<img src="<?php echo $this->fcSystem['banner_banner1'] ?>" alt="Banner page">
		<div class="absulute-page">
			<header class="panelhead">
				<h2 class="heading"><span>Documents</span></h2>
			</header>
			<div class="breadcrumb">
				<ul class="uk-breadcrumb">
					<li>
						<a href="<?php echo BASE_URL ?>" title="<?php echo $this->lang->line('home_page') ?>">
							<?php echo $this->lang->line('home_page'); ?>
						</a>
					</li>
					<li class="uk-active">
						<a href="documents.html" title="Documents">Documents</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<section class="documents-page mt30">
		<div class="uk-container uk-container-center">
			<section class="panel-body">
				<?php if (is_array($AddressList) && isset($AddressList) && count($AddressList)) { ?>
					<ul class="uk-grid lib-grid-30 uk-grid-width-1-1 uk-grid-width-small-1-2 list-document">
						<?php foreach ($AddressList as $key => $val) { ?>
							<?php $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'address'); ?>
							<li class="mb30">
	                            <article class="uk-clearfix document">
	                                <div class="thumb">
	                                    <a class="image img-cover" href="<?php echo $href ?>" title="<?php echo $val['title'] ?>">
	                                        <img src="templates/frontend/resources/img/img_files.png" alt="<?php echo $val['title'] ?>">
	                                    </a>
	                                </div>
	                                <div class="infor">
	                                    <h3 class="title">
	                                        <a href="<?php echo $href ?>" title="<?php echo $val['title'] ?>">
	                                            <?php echo $val['title'] ?>
	                                        </a>
	                                    </h3>
	                                    <div class="more_document uk-flex uk-flex-middle uk-flex-space-between">
	                                    	<div class="des_document">
	                                    		<span>Type: <?php echo $val['type'] ?></span>
	                                    		<span>Size: <?php echo $val['size'] ?></span>
	                                    	</div>
	                                    	<a class="download-file" href="<?php echo $val['attachs'] ?>" title="<?php echo $val['title'] ?>">
	                                    		Download
	                                    	</a>
	                                    </div>
	                                </div>
	                            </article>
	                        </li>
						<?php } ?>
					</ul>
				<?php } ?>
			</section>
		</div>
	</section>
</div>