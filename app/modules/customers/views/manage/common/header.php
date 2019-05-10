<header id="header" class="header">
	<div class="uk-grid uk-grid-collapse uk-flex-middle wrapper">
		<div class="uk-width-medium-1-5 uk-width-large-1-6">
			<div class="header-left">
				<div class="logo uk-text-center"><a class="link ec-fit" style="height:35px;" href="" title=""><img src="<?php echo $this->fcSystem['homepage_logo']; ?>" alt="" /></a></div>
			</div><!-- .header-left -->
		</div><!-- .uk-width -->
		<?php 
			$this->fcCustomer = $this->config->item('fcCustomer');
		?>
		<div class="uk-width-medium-4-5 uk-width-large-5-6">
			<form action="" class="uk-form form">
				<div class="header-right">
					<div class="uk-grid uk-grid-medium">
						<div class="uk-width-large-1-1 uk-width-xlarge-1-1">
							<div class="uk-grid uk-grid-collapse uk-flex-middle header-action">
								<div class="uk-width-large-2-3">
									<div class="uk-flex uk-flex-middle check-create">
										<div class="col create-lading">
											<a href="<?php echo base_url(); ?>" title="" class="link"><i class="fa fa-step-backward"></i> Quay về trang chủ</a>
										</div>
										<!--<div class="col create-lading"><a href="" title="" class="link"><i class="fa fa-plus"></i> Tạo nhiều vận đơn</a></div> -->
									</div><!-- .check-create -->
								</div>
								<div class="uk-width-large-1-3">
									<div class="user-info">
										<div class="uk-button-dropdown user-name" data-uk-dropdown="{mode:'click', pos:'bottom-right'}">
											<a class="user-info-link" href="" onclick="return false;" title=""><?php echo $this->fcCustomer['fullname']; ?>  <i class="fa fa-caret-down"></i></a>
											<div class="uk-dropdown dropdown">
												<ul class="uk-list list-lading">
													<li class="item"><a href="thong-tin-tai-khoan.html" title="" class="link"><i class="fa fa-user"></i> Thông tin tài khoản</a></li>
													<li class="item"><a href="logout.html" title="" class="link"><i class="fa fa-power-off"></i> Thoát</a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div><!-- . header-action -->
						</div>
					</div><!-- .uk-grid -->
				</div><!-- .header-right -->
			</form>
		</div><!-- .uk-width -->
	</div><!-- .wrapper -->
</header><!-- .header -->
