<div id="body" class="body-container">
	<div class="breadcrumb">
		<div class="uk-container uk-container-center"> 
			<ul class="uk-breadcrumb">
				<li>
					<a href="<?php echo base_url(); ?>" title="<?php echo $this->lang->line('home_page') ?>">
					<i class="fa fa-home"></i> <?php echo $this->lang->line('home_page') ?></a>
				</li>
				<li class="uk-active">
					<a href="javascript:void(0)" title="Đăng nhập">Đăng nhập</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="uk-container uk-container-center">
		<?php $error = validation_errors(); echo !empty($error)?'<div class="callout callout-danger uk-margin-bottom" style="background:#AB5858;padding:8px;color:#fff;">'.$error.'</div>':'';?>
		<div class="uk-grid uk-grid-medium mb20">
			<div class="uk-width-large-2-3">
				<section class="register_box">
					<header class="panel-head">
						<div class="heading-2"><span>Đăng ký</span></div>
					</header>
					<section class="panel-body">
						<div class="uk-alert uk-alert-danger uk-margin-remove mb15" data-uk-alert>
							<a href="#" class="uk-alert-close uk-close"></a>
							<p>Nếu bạn đã là thanh viên xin mời bạn Đăng Nhập, Nều chưa là thành viên xin mời bạn đăng ký tài khoản.</p>
						</div>
						<?php 
							$location_dropdown = $this->BackendProjects_Model->location_dropdown(array(
								'where' => array('parentid' => 0)
							));
						?>
						<form class="uk-form uk-form-horizontal" method="post" action="">
							<div class="log login">
								<div class="uk-grid lib-grid-20 uk-grid-widt-1-1 uk-grid-width-small-1-2 uk-grid-width-large-1-2">
									<div class="mb15 form-row">
										<?php echo form_input('fullname', set_value('fullname'), 'placeholder="Tên đầy đủ (*)" class="form-control"');?>
									</div>
									<div class="mb15 form-row">
										<?php echo form_dropdown('subjects', $this->configbie->data('subjects'), set_value('subjects'), 'class="form-control"');?>
									</div>
									<div class="mb15 form-row">
										<?php echo form_input('email', set_value('email'), 'placeholder="Email  (*)" class="form-control"');?>
									</div>
									<div class="mb15 form-row">
										<?php echo form_dropdown('sex', $this->configbie->data('sex'), set_value('sex'), 'class="form-control"');?>
									</div>
									<div class="mb15 form-row">
										<?php echo form_input('phone', set_value('phone'), 'placeholder="Số điện thoại  (*)" class="form-control"');?>
									</div>
									<div class="mb15 form-row">
										<?php echo form_dropdown('cityid', $location_dropdown, set_value('cityid', 0), 'class="form-control"');?>
									</div>
									<div class="mb15 form-row">
										<input name="password" class="form-control" placeholder="Mật khẩu (*)" type="password">
									</div>
									<div class="mb15 form-row">
										<?php echo form_input('skype', set_value('skype'), 'placeholder="Nick skype" class="form-control"');?>
									</div>
									<div class="mb15 form-row">
										<input name="re_password" class="form-control" placeholder="Nhập lại mật khẩu (*)" type="password">
									</div>
									<div class="mb15 form-row">
										<?php echo form_input('address', set_value('address'), 'placeholder="Địa chỉ liên hệ" class="form-control"');?>
									</div>
								</div>
								<div class="mb15 form-row uk-text-center">
									<button type="submit" name="register" value="register" class="uk-button login_button">Đăng ký</button>
								</div>
							</div>
						</form>
					</section>
				</section>
			</div><!-- .uk-width -->
			<div class="uk-width-1-3">
				<section class="login_box">
					<header class="panel-head">
						<div class="heading-2"><span>Đăng nhập</span></div>
					</header>
					<section class="panel-body height100">
						<?php echo $social; ?>
						<div class="button-social button-facebook" data-href="<?php echo BASE_URL ?>" data-type="facebook">
				            <span class="icon-facebook fa fa-facebook"></span>
				            Đăng nhập bằng Facebook
				        </div>
				        <div class="button-social button-google" data-href="<?php echo BASE_URL ?>" data-type="google">
				            <span class="icon-google-plus fa fa-google-plus"></span>
				            Đăng nhập bằng Google
				        </div>
						<div class="divider">
				            <span> Hoặc đăng nhập bằng Email </span>
				        </div>
						<form action="" method="post" class="uk-form">
							<div class="uk-grid uk-grid-collapse uk-grid-width-1-1 uk-position-relative">
								<div class="log login">
									<div class="body">
										<div class="mb15 form-row">
											<input type="text" name="email_log" id="" class="form-control" value="<?php echo set_value('email'); ?>" placeholder="Email" />
										</div>
										<div class="mb15 form-row">
											<input type="password" name="password_log" id="" class="form-control" placeholder="Mật khẩu" />
										</div>
										<div class="form-row uk-text-center">
											<input type="submit" name="login" class="uk-button login_button" value="Đăng nhập" />
										</div>
									</div>
								</div>
							</div>
						</form>
					</section> <!-- .fc-panel-body -->
				</section> <!-- .uk-panel -->
			</div>
		</div><!-- .uk-grid -->
	</div><!-- .uk-container -->
</section><!-- .index-navigation -->

<script>
	$(document).ready(function() {
		$('.button-social').click(function(){
			var url = $(this).attr('data-href');
			var social = $(this).attr('data-type');
        	var link = url + 'login.html?log=' + social;
        	location.href = link;
    	});
    });
</script>