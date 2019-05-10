<section class="index-navigation margin-bottom-25px">
	<div class="uk-container uk-container-center">
		<div class="uk-grid">
			<div class="uk-width-2-6"></div>
			<div class="uk-width-2-6">
				<div class="uk-panel log-panel margin-bottom-25px">
					<div class="fc-panel-body uk-panel-box">
						<?php $error = validation_errors(); echo !empty($error)?'<div class="callout callout-danger">'.$error.'</div>':'';?>
						<div class="button-social button-facebook" onclick="javascript: goSocial('facebook')">
				            <span class="icon-facebook fa fa-facebook"></span>
				            Đăng nhập bằng Facebook
				        </div>

				        <div class="button-social button-google" onclick="javascript:goSocial('google')">
				            <span class="icon-google-plus fa fa-google"></span>
				            Đăng nhập bằng Google
				        </div>
						
						<div class="divider">
				            <span> Hoặc đăng nhập bằng Email </span>
				        </div>
						<form class="uk-form uk-form-horizontal" method="post" action="">
							<div class="log login">
								<div class="body">
									<div class="uk-form-row">
										<?php echo form_input('fullname', set_value('fullname'), 'placeholder="Tên đầy đủ" class="form-control"');?>
									</div>

									<div class="uk-form-row">
										<?php echo form_input('email', set_value('email'), 'placeholder="Email" class="form-control"');?>
									</div>

									<div class="uk-form-row">
										<?php echo form_input('phone', set_value('phone'), 'placeholder="Số điện thoại" class="form-control"');?>
									</div>

									<div class="uk-form-row">
										<?php echo form_password('password', set_value('password'), 'placeholder="Mật khẩu" class="form-control"');?>
									</div>

									<div class="uk-form-row">
										<input name="re_password" class="form-control" placeholder="Nhập lại mật khẩu" type="password">
									</div>
									
									<div class="uk-form-row">
										<button type="submit" name="register" value="register" class="uk-button login_button">Đăng ký</button>
									</div>
								</div>
							</div>
						</form>
					</div><!-- .fc-panel-body -->
				</div><!-- .uk-panel -->
			</div><!-- .uk-width -->
			<div class="uk-width-2-6"></div>
		</div><!-- .uk-grid -->
	</div><!-- .uk-container -->
</section><!-- .index-navig-->