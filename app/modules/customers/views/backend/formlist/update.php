<section class="content-header">
	<h1>Biểu mẫu</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
		<li><a href="<?php echo site_url('customers/backend/formlist/view');?>">Biểu mẫu</a></li>
		<li class="active"><a href="<?php echo site_url('customers/backend/formlist/create');?>">Thêm bản ghi mới</a></li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<form class="form-horizontal" method="post" action="">
			<div class="col-md-9">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab-info" data-toggle="tab">Thông tin cơ bản</a></li>
						<li><a href="#tab-files" data-toggle="tab">Files kết quả</a></li>
					</ul>
					<div class="tab-content">
						<div class="box-body">
							<?php $error = validation_errors(); echo !empty($error)?'<div class="callout callout-danger">'.$error.'</div>':'';?>
						</div><!-- /.box-body -->
						<div class="tab-pane active" id="tab-info">
							<div class="box-body">
								<div class="form-group">
									<label class="col-sm-2 control-label tp-text-left">Tên phòng khám</label>
									<div class="col-sm-10">
										<?php echo form_input('room', set_value('room', $Detailform['room']), 'class="form-control" placeholder="Tên phòng khám"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label tp-text-left">Kết luận</label>
									<div class="col-sm-10">
										<?php echo form_input('result_note', set_value('result_note', $Detailform['result_note']), 'class="form-control" placeholder="Kết luận"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label tp-text-left">Ghi chú</label>
									<div class="col-sm-10">
										<?php echo form_textarea('note', htmlspecialchars_decode(set_value('note', $Detailform['note'])), 'id="txtDescription" class="ckeditor-description" placeholder="Ghi chú"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label tp-text-left">Ghi chú thêm</label>
									<div class="col-sm-10">
										<?php echo form_input('note_note', set_value('note_note', $Detailform['note_note']), 'class="form-control" placeholder="Ghi chú thêm"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label tp-text-left">Loại xét nghiệm</label>
									<div class="col-sm-10">
										<?php echo form_input('type', set_value('type', $Detailform['type']), 'class="form-control" placeholder="Loại xét nghiệm"');?>
									</div>
								</div>
							</div><!-- /.box-body -->
						</div><!-- /.tab-pane -->
						<div class="tab-pane" id="tab-files">
							<div class="box-body">
								<div class="form-group" id="fromSlide">
									<?php 
										$slide = $this->input->post('result');
										$result = '';
										if(isset($slide) && is_array($slide) && count($slide)){
											foreach($slide['file'] as $key => $val){
												$result[$key]['file'] = $val;
											}
										}else{
											$result = json_decode($Detailform['result'], TRUE);
										}
									?>
									<?php if(isset($result) && is_array($result) && count($result)){ ?>
										<?php foreach($result as $key => $val){ ?>
											<?php if(empty($result[$key]['file'])) continue; ?>
											<div class="col-sm-3 slideItem" style="height: 152px;">
												<div class="thumb">
													<img src="<?php echo $result[$key]['file'];?>" class="img-thumbnail img-responsive"/>
												</div>
												<input type="hidden" name="result[file][]" value="<?php echo $result[$key]['file'];?>" />
												<button type="button" class="btn btnRemove btn-danger pull-right">Xóa bỏ</button>
											</div>
										<?php } ?>
										<div class="col-sm-3 slideItem">
											<button type="button" class="btn btnAddItem pull-left" style="height: 152px;">+</button>
										</div>
									<?php } ?>
								</div>
							</div><!-- /.box-body -->
						</div>
					</div><!-- /.tab-content -->
					<div class="box-footer">
						<button type="reset" class="btn btn-default">Làm lại</button>
						<button type="submit" name="update" value="action" class="btn btn-info pull-right">Câp nhật</button>
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
									<label class="col-sm-12 control-label tp-text-left">Ngày khám</label>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<?php echo form_input('date', set_value('date', $Detailform['date']), 'class="form-control datetimepicker"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-12 control-label tp-text-left">Bác sỹ</label>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<?php echo form_dropdown('doctorid', $this->BackendCustomers_Model->Dropdown(2), set_value('doctorid', $Detailform['doctorid']), 'class="form-control"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-12 control-label tp-text-left">Bệnh nhân</label>
								</div>
								<div class="form-group">
									<div class="col-sm-12" id="customers">
										<?php echo form_dropdown('customersid', $this->BackendCustomers_Model->Dropdown(1), set_value('customersid', $Detailform['customersid']), 'class="form-control"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-12 control-label tp-text-left">Xuất bản</label>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<?php echo form_dropdown('publish', $this->configbie->data('publish'), set_value('publish', $Detailform['publish']), 'class="form-control" style="width: 100%;"');?>
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

<script type="text/javascript">
$(window).load(function(){
	var item;
	item = '<div class="col-sm-3 slideItem" style="height: 152px;">';
	item = item + '<div class="thumb"><img src="templates/backend/images/not-found.png" class="img-thumbnail img-responsive"/></div>';
	item = item + '<input type="hidden" name="result[file][]" value="" />';
	item = item + '<button type="button" class="btn btnRemove btn-danger pull-right">Xóa bỏ</button>';
	item = item + '</div>';
	item = item + '<div class="col-sm-3 slideItem"><button type="button" class="btn btnAddItem pull-left" style="height: 152px;">+</button></div>';
	if($('#fromSlide').html().trim() == ''){
		$('#fromSlide').append(item);
	}
	/* Thêm phần tử đầu tiên */
	$(document).on('click', '.btnAddFrist', function(){
		$('#fromSlide').html(item);
	});

	/* Thêm phần tử tiếp theo */
	$(document).on('click', '.btnAddItem', function(){
		$('.btnAddItem').parent().remove();
		$('#fromSlide').append(item);
	});

	/* Xóa phần tử */
	$(document).on('click', '.btnRemove', function(){
		$(this).parent().remove();
	});

	/* Xóa phần tử */
	$(document).on('click', '.img-thumbnail', function(){
		openKCFinderAlbum($(this), 'files');
	});
});
</script>