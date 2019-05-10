<section class="content-header">
	<h1>Cập nhật đơn hàng mới</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
		<li><a href="<?php echo site_url('payments/backend/payments/view');?>">đơn hàng</a></li>
		<li class="active"><a href="<?php echo site_url('payments/backend/payments/create');?>">Thêm đơn hàng mới</a></li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<form class="form-horizontal" method="post" action="">
			<div class="col-md-9">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab-info" data-toggle="tab">Thông tin cơ bản</a></li>
					</ul>
						<div class="tab-content">
							<div class="box-body">
								<?php $error = validation_errors(); echo !empty($error)?'<div class="callout callout-danger">'.$error.'</div>':'';?>
							</div><!-- /.box-body -->
							<div class="tab-pane active" id="tab-info">
								<div class="box-body">
									<div class="form-group">
										<label class="col-sm-2 control-label tp-text-left">Tên Khách hàng</label>
										<div class="col-sm-10">
											<?php echo form_input('fullname', set_value('fullname', $DetailPayments['fullname']), 'class="form-control form-static-link" placeholder="Họ tên khách hàng"');?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label tp-text-left">Tên gọi tại gia đình</label>
										<div class="col-sm-10">
											<?php echo form_input('namefamily', set_value('namefamily', $DetailPayments['namefamily']), 'class="form-control form-static-link" placeholder="Tên gọi tại gia đình"');?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label tp-text-left">Số điện thoại</label>
										<div class="col-sm-10">
											<?php echo form_input('phone', set_value('phone', $DetailPayments['phone']), 'class="form-control form-static-link" placeholder="Số điện thoại"');?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label tp-text-left">Số Fax</label>
										<div class="col-sm-10">
											<?php echo form_input('fax', set_value('fax', $DetailPayments['fax']), 'class="form-control form-static-link" placeholder="Số fax"');?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label tp-text-left">Email</label>
										<div class="col-sm-10">
											<?php echo form_input('email', set_value('email', $DetailPayments['email']), 'class="form-control form-static-link" placeholder="Email"');?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label tp-text-left">Địa chỉ</label>
										<div class="col-sm-10">
											<?php echo form_input('address', set_value('address', $DetailPayments['address']), 'class="form-control form-static-link" placeholder="Địa chỉ"');?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label tp-text-left">Tên công ty</label>
										<div class="col-sm-10">
											<?php echo form_input('companyname', set_value('companyname', $DetailPayments['companyname']), 'class="form-control form-static-link" placeholder="Tên công ty"');?>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label tp-text-left">Ghi chú</label>
										<div class="col-sm-10">
											<?php echo form_textarea('content', htmlspecialchars_decode(set_value('message', $DetailPayments['message'])), 'id="txtContent" class="ckeditor-description" placeholder="Nội dung" style="width: 100%; height: 350px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"');?>
										</div>
									</div>
								</div><!-- /.box-body -->
							</div><!-- /.tab-pane -->
						</div><!-- /.tab-content -->
						<div class="box-footer">
							<button type="reset" class="btn btn-default">Làm lại</button>
							<button type="submit" name="update" value="action" class="btn btn-info pull-right">Cập nhật</button>
						</div><!-- /.box-footer -->
					
				</div><!-- nav-tabs-custom -->
			</div><!-- /.col -->
			<div class="col-md-3">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab-info" data-toggle="tab">Nâng cao</a></li>
					</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab-seo">
								<div class="form-group">
									<label class="col-sm-12 control-label tp-text-left">Nhà phân phối</label>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<select name="distributors" id="distributors" class="form-control">
											<option value="0">Nhà phân phối</option>
											<?php  
												$distributors = $this->Frontendaddress_Model->ReadByCondition(array('select' => 'id, title, email, phone','where' => array('trash' => 0,'publish' => 1),'limit' => 10,'order_by' => 'id asc'));
												if (isset($distributors) && is_array($distributors) && count($distributors)) {
													foreach ($distributors as $key => $val) {
														?><option <?php echo (($val['id'] == $DetailPayments['distributors']) ? 'selected' : '') ?> value="<?php echo $val['id'] ?>"><?php echo $val['title'] ?></option><?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-12 control-label tp-text-left">Trạng thái giao hàng</label>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<?php echo form_dropdown('send', $this->configbie->data('send'), set_value('publish', $DetailPayments['send']), 'class="form-control" style="width: 100%;"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-12 control-label tp-text-left">Tình trạng</label>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<?php echo form_dropdown('status', $this->configbie->data('status'), set_value('status', $DetailPayments['status']), 'class="form-control" style="width: 100%;"');?>
									</div>
								</div>
							</div>
						</div><!-- /.tab-pane -->
					</div><!-- /.tab-content -->
				</div><!-- nav-tabs-custom -->
			</div><!-- /.col -->
		</form>
	</div> <!-- /.row -->
</section><!-- /.content -->