<section class="content-header">
	<h1>Trả lời câu hỏi: <?php echo $Detailmailsubricre['title']?></h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
		<li><a href="<?php echo site_url('mailsubricre/backend/mailsubricre/view');?>">Danh sách đặt bàn</a></li>
		<li class="active"><a href="<?php echo site_url('mailsubricre/backend/mailsubricre/update/'.$Detailmailsubricre['id']);?>">Cập nhật</a></li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab-info" data-toggle="tab">Thông tin cơ bản</a></li>
				</ul>
				<form class="form-horizontal" method="post" action="">
					<div class="tab-content">
						<div class="box-body">
							<?php $error = validation_errors(); echo !empty($error)?'<div class="callout callout-danger">'.$error.'</div>':'';?>
						</div><!-- /.box-body -->
						<div class="tab-pane active" id="tab-info">
							<div class="box-body">
								<div class="form-group">
									<label class="col-sm-2 control-label">Họ và tên</label>
									<div class="col-sm-4">
										<?php echo form_input('fullname', set_value('fullname', $Detailmailsubricre['fullname']), 'class="form-control" placeholder="Tên đầy đủ"');?>
									</div>

									<label class="col-sm-2 control-label">Xuất bản</label>
									<div class="col-sm-4">
										<?php echo form_dropdown('publish', $this->configbie->data('publish'), set_value('publish', $Detailmailsubricre['publish']), 'class="form-control select2" style="width: 100%;"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Email</label>
									<div class="col-sm-4">
										<?php echo form_input('email', set_value('email', $Detailmailsubricre['email']), 'class="form-control" placeholder="Email"');?>
									</div>
					
									<label class="col-sm-2 control-label">Số điện thoại</label>
									<div class="col-sm-4">
										<?php echo form_input('phone', set_value('phone', $Detailmailsubricre['phone']), 'class="form-control" placeholder="Điện thoại"');?>
									</div>
									
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Chi tiết câu hỏi</label>
									<div class="col-sm-4">
										<?php echo form_textarea('message', set_value('message', $Detailmailsubricre['message']), 'class="form-control" placeholder="Chi tiết câu hỏi"');?>
									</div>
									<label class="col-sm-2 control-label">Ngày đăng ký</label>
									<div class="col-sm-4">
										<?php echo form_input('created', set_value('created', $Detailmailsubricre['created']), 'class="form-control"  disabled=""');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Trả lời câu hỏi</label>
									<div class="col-sm-10">
										<?php echo form_textarea('description', htmlspecialchars_decode(set_value('description', $Detailmailsubricre['description'])), 'id="txtDescription" class="ckeditor-description" placeholder="Trả lời câu hỏi" style="width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"'); ?>
									</div>

								</div>

							</div><!-- /.box-body -->
						</div><!-- /.tab-pane -->

					</div><!-- /.tab-content -->
					<div class="box-footer">
						<button type="submit" name="update" value="action" class="btn btn-info pull-right">Cập nhật</button>
					</div><!-- /.box-footer -->
				</form>
			</div><!-- nav-tabs-custom -->
		</div><!-- /.col -->
	</div> <!-- /.row -->
</section><!-- /.content -->