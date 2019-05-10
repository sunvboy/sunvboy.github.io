<div id="body" class="body-container">
	<div class="breadcrumb">
		<div class="uk-container uk-container-center"> 
			<ul class="uk-breadcrumb">
				<li>
					<a href="<?php echo base_url(); ?>" title="<?php echo $this->lang->line('home_page') ?>">
					<i class="fa fa-home"></i> <?php echo $this->lang->line('home_page') ?></a>
				</li>
				<li class="uk-active">
					<a href="javascript:void(0)" title="Quản lý biểu mẫu">Quản lý biểu mẫu</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="uk-container uk-container-center">
		<div class="uk-grid uk-grid-medium mt20 mb20">
			<div class="uk-width-large-1-4">
				<?php $this->load->view('homepage/frontend/common/modal_login') ?>
			</div>
			<div class="uk-width-large-3-4">
				<div class="box_tracuu">
		            <div class="box_tracuu_header uk-flex uk-flex-middle uk-flex-space-between">
		                <div class=" logo_web">
		                    <a href="<?php echo BASE_URL ?>" title="<?php echo $this->fcSystem['homepage_company'] ?>">
								<img src="<?php echo $this->fcSystem['homepage_logo'] ?>" alt="<?php echo $this->fcSystem['homepage_company'] ?>" />
							</a>                
		                </div>
		                <div class="address_web">
							<?php echo $this->fcSystem['address_address_1'] ?>
		                </div>
		            </div>
		            <?php $sex = $this->configbie->data('sex'); ?>
		            <div class="box_tracuu_content">
		                <h2 class="title_phieu">Phiếu kết quả</h2>
		                <div class="content_traccuu">
		                    <div class="line_box mb20">
		                        <h3>Thông tin khách hàng</h3>
		                        <ul class="ds_profile uk-grid uk-grid-width-large-1-2">
		                            <li>Họ và tên:<font><?php echo $DetailUsers['fullname'] ?></font></li>
		                            <li>Mã khách hàng: <?php echo $DetailUsers['code'] ?></li>
		                            <li>Năm sinh:  <?php echo $DetailUsers['skype'] ?></li>
		                            <li>Giới tính:  <?php echo $sex[$DetailUsers['sex']] ?></li>
		                            <li>Địa chỉ:  <?php echo $DetailUsers['address'] ?></li>
		                            <li>Điện thoại:  <?php echo $DetailUsers['phone'] ?></li>
		                            <li>Ngày xét nghiệm:  <?php echo $DetailTracuu['date'] ?></li>
		                            <li>BV/Phòng khám:  <?php echo $DetailTracuu['room'] ?></li>
		                        </ul>
		                    </div>

		                    <div class="line_box">
		                        <h3>Yêu cầu xét ngiệm</h3>
		                        <div class="ds_xetnghiem">
									<?php echo $DetailTracuu['note'] ?>
                     			</div>
		                    </div>
		                    <div class="line_boxsub uk-text-center mt30">
		                        <?php echo $this->fcSystem['address_address_2'] ?>
		                        <p class="uk-text-right">Hà nội, ngày <?php echo date('d', time() + 7* 3600) ?> tháng <?php echo date('m', time() + 7* 3600) ?> năm <?php echo date('Y', time() + 7* 3600) ?></p>
		                    </div>
	                        <div class="line_sub uk-flex uk-flex-right lib-grid-30 mt20">
	                            <div class="coldiv1 uk-text-center">
	                                <p>Phụ trách phòng xét nghiệm</p>
	                                <p style="margin-top:20px;"><b><?php echo $this->fcSystem['common_skype_1'] ?></b></p>
	                            </div>
	                            <div class="coldiv1 uk-text-center">
	                                <p>Phụ trách chuyên môn</p>
	                                <p style="margin-top: 20px;"><b><?php echo $this->fcSystem['common_skype_2'] ?></b></p>
	                            </div>
	                        </div>
							<div class="line_boxsub mt20 uk-text-center">
								<?php $arr = json_decode($DetailTracuu['result'], TRUE); ?>
								<?php if (isset($arr) && is_array($arr) && count($arr)) { ?>
									<?php foreach ($arr as $key => $vals) { ?>
										<a href="<?php echo BASE_URL.$vals['file'] ?>" title="Địa chỉ files kết quả" target="_blank" >
											<?php echo (($key == 0) ? '' : ', ') ?>
											<img src="templates/backend/images/link.png" alt="links"> (Tải kết quả xét nghiệm)
										</a>
									<?php } ?>
								<?php } ?>
							</div>

		                    <div class="line_boxsub mt20">              
		                        <p class="loicamon" style="font-size:20px;">CHEMEDIC luôn nỗ lực hết hình để nâng cao chất lượng dịch vụ xét nghiệm với phương châm<br>“Mỗi khách hàng của CHEMEDIC sẽ là cầu nối giữa chúng tôi với cộng đồng”</p>
		                    </div>
		                </div>
		            </div>
		            <div class="footer_tracuu">
		                <?php echo $this->fcSystem['homepage_company'] ?> – Vì sức khỏe cộng đồng
		            </div>
		        </div>
			</div>
		</div>
	</div>
</div>