<section class="content-header">
	<h1>Thêm Nhóm hỗ trợ trực tuyến mới</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
		<li><a href="<?php echo site_url('supports/backend/catalogues/view');?>">Nhóm hỗ trợ trực tuyến</a></li>
		<li class="active"><a href="<?php echo site_url('supports/backend/catalogues/create');?>">Thêm Nhóm hỗ trợ trực tuyến mới</a></li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab-info" data-toggle="tab">Thông tin cơ bản</a></li>
					<li><a href="#tab-advanced" data-toggle="tab">Nâng cao</a></li>
				</ul>
				<form class="form-horizontal" method="post" action="">

					<div class="tab-content">
						<div class="box-body">
							<?php $error = validation_errors(); echo !empty($error)?'<div class="callout callout-danger">'.$error.'</div>':'';?>
						</div><!-- /.box-body -->
						<div class="tab-pane active" id="tab-info">
							<div class="box-body">
								<div class="form-group">
									<label class="col-sm-2 control-label">Nhóm hỗ trợ trực tuyến</label>
									<div class="col-sm-10">
										<?php echo form_input('title', set_value('title'), 'class="form-control" placeholder="Nhóm hỗ trợ trực tuyến"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Số điện thoại</label>
									<div class="col-sm-10">
										<?php echo form_input('description', set_value('description'), 'class="form-control" placeholder="Số điện thoại"');?>

									</div>
								</div>
							</div><!-- /.box-body -->
						</div><!-- /.tab-pane -->
						<div class="tab-pane" id="tab-advanced">
							<div class="box-body">
								<div class="form-group">
									<label class="col-sm-2 control-label">Xuất bản</label>
									<div class="col-sm-10">
										<?php echo form_dropdown('publish', $this->configbie->data('publish'), set_value('publish', 1), 'class="form-control select2" style="width: 100%;"');?>
									</div>
								</div>
								<div class="form-group hide">
									<label class="col-sm-2 control-label">Văn phòng hỗ trợ diệt mối</label>
									<div class="col-sm-2">
										<?php echo form_dropdown('ishome', $this->configbie->data('ishome'), set_value('ishome', 1), 'class="form-control select2" style="width: 100%;"');?>
									</div>
								</div>
								<div class="form-group hide">
									<label class="col-sm-2 control-label">Hỗ trợ tư vấn</label>
									<div class="col-sm-2">
										<?php echo form_dropdown('isfooter', $this->configbie->data('isfooter'), set_value('isfooter', 1), 'class="form-control select2" style="width: 100%;"');?>
									</div>
								</div>
							</div><!-- /.box-body -->
						</div><!-- /.tab-pane -->
					</div><!-- /.tab-content -->
					<div class="box-footer">
						<button type="reset" class="btn btn-default">Làm lại</button>
						<button type="submit" name="create" value="action" class="btn btn-info pull-right">Thêm mới</button>
					</div><!-- /.box-footer -->
				</form>
			</div><!-- nav-tabs-custom -->
		</div><!-- /.col -->
	</div> <!-- /.row -->
</section><!-- /.content -->