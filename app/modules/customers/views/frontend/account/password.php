<div id="body" class="body-container">
	<div class="breadcrumb">
		<div class="uk-container uk-container-center"> 
			<ul class="uk-breadcrumb">
				<li>
					<a href="<?php echo base_url(); ?>" title="<?php echo $this->lang->line('home_page') ?>">
					<i class="fa fa-home"></i> <?php echo $this->lang->line('home_page') ?></a>
				</li>
				<li class="uk-active">
					<a href="javascript:void(0)" title="Quản lý thành viên">Quản lý thành viên</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="uk-container uk-container-center">
		<?php $error = validation_errors(); echo !empty($error)?'<div class="uk-alert uk-alert-danger" data-uk-alert> <a href="" class="uk-alert-close uk-close"></a> <p>'.$error.'</p></div>' : ''; ?>
		<div class="uk-grid uk-grid-medium mb20">
			<div class="uk-width-large-2-3">
				<section class="profile_box">
					<header class="panel-head">
						<div class="heading-2"><span>Thông tin thành viên</span></div>
					</header>
					<section class="panel-body height100">
						<div class="uk-panel-body profile project-create">
							<?php $error = validation_errors(); echo !empty($error)?'<div class="callout callout-danger">'.$error.'</div>':'';?>
							<form  method="post" action="">
								<div class="line-form mb20 bor_bor">
									<div class="box_title_2">
										<span>Đổi mật khẩu</span>
									</div>
									<div class="content_content">
										<div class="uk-grid uk-flex-middle lib-grid-0">
											<div class="uk-width-1-2">
												<div class="uk-flex item-form uk-flex-middle">
													<div class="label-left bg_bg">
														<label class="label-label">Mật khẩu mới</label>
													</div>
													<div class="label-right uk-width-1-1 bdl0">
														<label class="label-label">
															<input type="password" class="uk-width-1-1" name="newpassword">
														</label>
													</div>
												</div>
											</div>
											<div class="uk-width-1-2">
												<div class="uk-flex item-form uk-flex-middle">
													<div class="label-left bg_bg">
														<label class="label-label">Nhập lại</label>
													</div>
													<div class="label-right uk-width-1-1 bdl0">
														<label class="label-label">
															<input type="password" class="uk-width-1-1" name="renewpassword">
														</label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="uk-form-row-center uk-text-center">
									<input class="uk-button login_button" type="submit" name="update" value="Cập nhật" />
								</div>
							</form>
						</div>
					</section>
				</section>
			</div>
			<div class="uk-width-large-1-3">
				<?php $this->load->view('homepage/frontend/common/customers_aside'); ?>
			</div>
		</div><!-- .uk-grid  -->
	</div>
</div>
