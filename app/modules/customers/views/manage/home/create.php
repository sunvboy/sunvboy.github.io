<div class="uk-grid uk-grid-collapse">
	<div class="uk-width-medium-1-5 uk-width-large-1-6">
		<?php $this->load->view('bills/manage/common/aside');?>
	</div>
	<div class="uk-width-medium-4-5 uk-width-large-5-6">
		<form action="" method="" class="form">
			<div class="wrap-content">
				<div class="notification mb10">
					<a href="" title="" class="link"><span class="label">Thông báo:</span> <span class="text">Hiện chức năng tạo vận đơn trên hệ thống website đang được chúng tôi nâng cấp, và sẽ sớm đi vào hoạt đông. Mọi chi tiết vui lòng liên hệ Hotline: <?php echo $this->fcSystem['contact_hotline']; ?></span></a>
				</div>
				<div class="main-content create-lading">
					<h2 class="mainheading"><span class="text">Tạo vận đơn (DEMO)</span></h2>
					<div class="create-lading-body">
						<div class="uk-grid uk-grid-collapse uk-grid-width-xlarge-1-2">
							<div class="column">
								<section class="uk-panel lading-info mb30">
									<div class="heading mb10"><span class="text ec-uppercase">Thông tin vận đơn</span></div>
									<div class="panel-body">
										<div class="row form-group mb10">
											<div class="label mb5">Hình thức vận chuyển <span class="required">*</span></div> 
											<div class="uk-clearfix">
												<label class="label"><input type="radio" name="hinhthuc" class="input-radio" /> Nội tỉnh</label>
												<label class="label"><input type="radio" name="hinhthuc" class="input-radio" /> Hỏa tốc</label>
												<label class="label"><input type="radio" name="hinhthuc" class="input-radio" /> Chuyển phát nhanh</label>
												<label class="label"><input type="radio" name="hinhthuc" class="input-radio" />  Chuyển phát thường</label>
												<label class="label"><input type="radio" name="hinhthuc" class="input-radio" />  Chuyển phát tiết kiệm</label>
											</div>
										</div>
										<div class="row mb10">
											<label class="label mb5">Địa chỉ lấy hàng <span class="required">*</span></label>
											<select name="" class="uk-width-1-1 select">
												<option value="">Tòa 21B6 Chung cư Greenstar, số 234 Phạm Văn Đồng, Bắc Từ Liêm, Hà Nội, Phường Cổ Nhuế 1 - Quận Bắc Từ Liêm - Hà Nội</option>
												<option value="">Tòa 21B6 Chung cư Greenstar, số 234 Phạm Văn Đồng, Bắc Từ Liêm, Hà Nội, Phường Cổ Nhuế 1 - Quận Bắc Từ Liêm - Hà Nội</option>
											</select>
										</div>
										<div class="uk-grid ec-grid-20 uk-grid-width-small-1-2">
											<div class="row mb10">
												<label class="label mb5">Tổng khối lượng <span class="required">*</span></label>
												<input type="text" name="" class="input-text uk-width-1-1" />
											</div>
											<div class="row mb10">
												<label class="label mb5">Số lượng <span class="required">*</span></label>
												<input type="text" name="" class="input-text uk-width-1-1" />
											</div>
											<div class="row mb10">
												<label class="label mb5">Tên hàng hóa <span class="required">*</span></label>
												<input type="text" name="" class="input-text uk-width-1-1" />
											</div>
											<div class="row mb10">
												<label class="label mb5">Tổng giá trị hàng hóa <span class="required">*</span></label>
												<input type="text" name="" class="input-text uk-width-1-1" />
											</div>
										</div><!-- .uk-grid -->
										<div class="row mb10">
											<label class="label ec-uppercase mb5">Thông tin thêm</label>
											<textarea name="" class="uk-width-1-1 textarea" placeholder="Hãy thêm thông tin để chúng tôi phục vụ bạn tốt hơn"></textarea>
										</div>
										<div class="receiver-info">
											<div class="title mb10"><span class="text ec-uppercase">Thông tin người nhận hàng</span></div>
											<div class="uk-grid ec-grid-20 uk-grid-width-small-1-2">
												<div class="row mb10">
													<label class="label mb5">Tên người nhận <span class="required">*</span></label>
													<input type="text" name="" class="input-text uk-width-1-1" />
												</div>
												<div class="row mb10">
													<label class="label mb5">Số điện thoại <span class="required">*</span> <span class="tooltip" data-uk-tooltip title="có thể nhập 2 số điện thoại, mỗi số cách nhau bằng dấu phẩy, Nhập số điện thoại và Enter để lấy thông tin khách hàng"><i class="fa fa-question-circle"></i></span></label>
													<input type="text" name="" class="input-text uk-width-1-1" />
												</div>
											</div><!-- .uk-grid -->
											<div class="row mb10">
												<label class="label mb5">Địa chỉ chi tiết (Số nhà, ngõ hẻm, tên đường phố) <span class="required">*</span></label>
												<input type="text" name="" class="input-text uk-width-1-1" />
											</div>
											<div class="uk-grid ec-grid-20 uk-grid-width-small-1-2">
												<div class="row mb10">
													<label class="label mb5">Tỉnh/thành phố <span class="required">*</span></label>
													<select name="" class="uk-width-1-1 select">
														<option value="">Chọn Tỉnh/thành phố</option>
														<option value="">Hà Nội</option>
														<option value="">Hải Dương</option>
													</select>
												</div>
												<div class="row mb10">
													<label class="label mb5">Quận/huyện <span class="required">*</span></label>
													<select name="" class="uk-width-1-1 select">
														<option value="">Chọn Quận/huyện</option>
														<option value="">Hà Nội</option>
														<option value="">Hải Dương</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</section>
							</div>
							<div class="column">
								<section class="uk-panel lading-costs mb30">
									<header class="panel-head mb10 uk-flex uk-flex-middle">
										<div class="heading"><span class="text ec-uppercase">Thông tin tính phí</span></div>
										<label class="cod" id="check_order_type"><input type="checkbox" id="input-checkbox" checked="checked" /> Giao hàng thu tiền (CoD)</label>
									</header>
									<div class="panel-body">
										<div class="price_result mb15">
											<div class="uk-overflow-container">
												<table class="table uk-table">
													<thead>
														<tr>
															<th>Gói cước</th>
															<th>Phí vận chuyển</th>
															<th>Phí COD</th>
															<th>Chọn</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td class="unit">
																<img src="templates/manage/resources/img/upload/VT.png" alt="" style="max-width: 50px" />
																Phát hôm sau Viettelpost
															</td>
															<td class="price">66,000đ</td>
															<td class="price">112,000đ</td>
															<td>
																<input type="radio" class="input-radion package_ship " name="package_ship" value="" />
															</td>
														</tr>
														<tr>
															<td class="unit">
																<img src="templates/manage/resources/img/upload/KR.png" alt="" style="max-width: 50px" />
																Kerry Express nội tỉnh
															</td>
															<td class="price">53,000đ</td>
															<td class="price">10,000đ</td>
															<td>
																<input type="radio" class="input-radion package_ship " name="package_ship" value="" />
															</td>
														</tr>
														<tr>
															<td colspan="4">Điền đủ thông tin cân nặng, giá trị hàng hóa và địa chỉ người nhận để được giá tốt nhất</td>
														</tr>
													</tbody>
												</table><!-- .table -->
											</div>
											<div class="dvct">
												<div class="row uk-flex uk-flex-middle">
													<div class="subtitle">Dịch vụ cộng thêm</div>
													<div class="form-group">
														<label class="label">
															<input type="checkbox" name="" value="" class="input-checkbox" /> 
															Cho người nhận xem hàng
														</label>
														<label class="label label-insurrance">
															<input type="checkbox" name="" value="" class="input-checkbox" id="input-insurrance" /> 
															Mua bảo hiểm
														</label>
													</div>
												</div>
												<div class="row uk-clearfix insurrance">
													<div class="subtitle uk-float-left">Phí bảo hiểm</div>
													<div class="price uk-float-left">112,000đ</div>
												</div>
											</div>
										</div>
										<div class="title mb10"><span class="text ec-uppercase">Thông tin tiền khuyến mại đặt cọc</span></div>
										<div class="deposit">
											<div class="uk-grid uk-grid-collapse uk-grid-width-small-1-2 uk-flex-middle">
												<label class="label mb5">Người bán khuyến mại cho người mua</label>
												<div class="form-group mb10"><input type="text" class="input-text uk-width-1-1 required" /></div>
												<label class="label mb5">Tiền đặt cọc yêu cầu <span class="tooltip" data-uk-tooltip title="Yêu cầu người mua đặt cọc vận đơn sẽ giúp người bán giảm thiểu rủi ro khi bị chuyển hoàn. Người mua đặt cọc bằng cách nạp thẻ điện thoại. Tiền đặt cọc sẽ được trừ vào tiền thu hộ."><i class="fa fa-question-circle"></i></span></label>
												<div class="form-group mb10">
													<select name="" class="uk-width-1-1 select required">
														<option value="">Không yêu cầu đặt cọc</option>
														<option value="">Hà Nội</option>
														<option value="">Hải Dương</option>
													</select>
												</div>
											</div>
										</div>
										<div class="total mb10">TỔNG TIỀN THU HỘ DỰ KIẾN: <span class="price">0 Đ</span> </div>
										<div class="row mb10"><input type="submit" value="Tạo vận đơn" name="" class="uk-button btn-create-order" /></div>
									</div><!-- .panel-body -->
								</section><!-- .lading-costs -->
							</div>
						</div>
					</div>
				</div><!-- .create-lading -->
			</div><!-- .main-content -->
		</form>
	</div>
</div><!-- .uk-grid  -->