<section class="content-header">
	<h1>Cập nhật</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
		<li><a href="<?php echo site_url('address/backend/address/view');?>">Danh sách</a></li>
		<li class="active"><a href="<?php echo site_url('address/backend/address/update/'.$Detailaddress['id']);?>">Cập nhật</a></li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab-info" data-toggle="tab">Thông tin cơ bản</a></li>
					<li class=""><a href="#tab-album" data-toggle="tab">Albums ảnh</a></li>
				</ul>
				<form class="form-horizontal" method="post" action="">
					<div class="tab-content">
						<div class="box-body">
							<?php $error = validation_errors(); echo !empty($error)?'<div class="callout callout-danger">'.$error.'</div>':'';?>
						</div><!-- /.box-body -->
						<div class="tab-pane active" id="tab-info">
							<div class="box-body">
								<div class="form-group">
									<label class="col-sm-2 control-label">Tên</label>
									<div class="col-sm-4">
										<?php /* echo form_input('title', set_value('title', $Detailaddress['title']), 'class="form-control img-files" placeholder="File" onclick="openKCFinder(this, files)"')*/;?>
										<?php echo form_input('title', set_value('title', $Detailaddress['title']), 'class="form-control" placeholder="Tên"');?>

									</div>
									<label class="col-sm-2 control-label">Xuất bản</label>
									<div class="col-sm-4">
										<?php echo form_dropdown('publish', $this->configbie->data('publish'), set_value('publish',$Detailaddress['publish']), 'class="form-control select2" style="width: 100%;"');?>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">Địa chỉ</label>
									<div class="col-sm-4">

										<?php echo form_input('address', set_value('address', $Detailaddress['address']), 'class="form-control" placeholder="Địa chỉ"');?>
									</div>
									<label class="col-sm-2 control-label">Email</label>
									<div class="col-sm-4">
										<?php echo form_input('email', set_value('email', $Detailaddress['email']), 'class="form-control" placeholder="Email"');?>
									</div>

								</div>
								<div class="form-group">

									<label class="col-sm-2 control-label">Hotline</label>
									<div class="col-sm-4">
										<?php echo form_input('phone', set_value('phone', $Detailaddress['phone']), 'class="form-control" placeholder="Hotline"');?>
									</div>

								</div>


								<div class="form-group hide">
									<label class="col-sm-2 control-label">Phòng Vip</label>
									<div class="col-sm-4">
										<?php echo form_input('size', set_value('size', $Detailaddress['size']), 'class="form-control" placeholder="Phòng Vip"');?>
									</div>
									<label class="col-sm-2 control-label">Fanpage</label>
									<div class="col-sm-4">
										<?php echo form_input('type', set_value('type', $Detailaddress['type']), 'class="form-control" placeholder="Fanpage"');?>
									</div>
									<label class="col-sm-2 control-label">Giờ mở cửa</label>
									<div class="col-sm-4">
										<?php echo form_input('timelv', set_value('timelv', $Detailaddress['timelv']), 'class="form-control" placeholder="Giờ mở cửa"');?>
									</div>
								</div>
								<div class="form-group hide">

									<label class="col-sm-2 control-label">Bản đồ</label>
									<div class="col-sm-10">
										<textarea name="maps" cols="40" rows="10" class="form-control" placeholder="Bản đồ">
											<?php echo $Detailaddress['maps']?>
										</textarea>
									</div>

								</div>
								<div class="form-group hide">
									<label class="col-sm-2 control-label">Hình minh họa</label>
									<div class="col-sm-9">
										<?php echo form_input('attachs', set_value('attachs', $Detailaddress['attachs']), 'class="form-control" placeholder="Hình minh họa" onclick="openKCFinder(this)"');?>
									</div>
								</div>
							</div><!-- /.box-body -->
						</div><!-- /.tab-pane -->
						<div class="tab-pane" id="tab-album">
							<div class="box-body">
								<div class="form-group" id="fromSlide">
									<?php
									$slide = $this->input->post('album');
									$album = '';
									if(isset($slide) && is_array($slide) && count($slide)){
										foreach($slide['title'] as $key => $val){
											$album[$key]['images'] = $val;
											$album[$key]['title'] = $slide['title'][$key];
											$album[$key]['description'] = $slide['description'][$key];
											$album[$key]['content'] = $slide['content'][$key];
										}
									}else{
										$album = json_decode($Detailaddress['albums'], TRUE);
										//echo "<pre>";var_dump($album);
									}
									?>
									<?php if(isset($album) && is_array($album) && count($album)){ ?>
										<?php foreach($album as $key => $val){?>
											<div class="col-sm-3 slideItem">
												<div class="thumb "><img src="<?php echo $album[$key]['images'];?>" class="img-thumbnail img-responsive"/></div>
												<input type="hidden" name="album[images][]" value="<?php echo $album[$key]['images'];?>" />
												<input type="text" name="album[title][]" value="<?php echo $album[$key]['title'];?>" class="form-control title hide" placeholder="Tên hiệu thuốc" />
												<textarea name="album[description][]" cols="40" rows="10" class="form-control description hide" placeholder="Địa chỉ "><?php echo $album[$key]['description'];?></textarea>
												<textarea name="album[content][]" cols="40" rows="10" class="form-control content hide" placeholder="Số điện thoại"><?php echo $album[$key]['content'];?></textarea>
												<button type="button" class="btn btnRemove btn-danger pull-right">Xóa bỏ</button>
											</div>
										<?php } ?>
										<div class="col-sm-3 slideItem"><button type="button" class="btn btnAddItem pull-left">+</button></div>
									<?php } ?>
								</div>
							</div><!-- /.box-body -->
						</div><!-- /.tab-pane -->

					</div><!-- /.tab-content -->
					<div class="box-footer">
						<button type="reset" class="btn btn-default">Làm lại</button>
						<button type="submit" name="update" value="action" class="btn btn-info pull-right">Cập nhật</button>
					</div><!-- /.box-footer -->
				</form>
			</div><!-- nav-tabs-custom -->
		</div><!-- /.col -->
	</div> <!-- /.row -->
</section><!-- /.content -->
<script type="text/javascript">
	$(window).load(function(){
		var item;
		item = '<div class="col-sm-3 slideItem">';
		item = item + '<div class="thumb "><img src="templates/backend/images/not-found.png" class="img-thumbnail img-responsive"/></div>';
		item = item + '<input type="hidden" name="album[images][]" value="" />';
		item = item + '<input type="text" name="album[title][]" value="" class="form-control title hide" placeholder="Tên hiệu thuốc"/>';
		item = item + '<textarea name="album[description][]" cols="40" rows="10" class="form-control description hide" placeholder="Địa chỉ"></textarea>';
		item = item + '<textarea name="album[content][]" cols="40" rows="10" class="form-control content hide" placeholder="Số điện thoại"></textarea>';
		item = item + '<button type="button" class="btn btnRemove btn-danger pull-right">Xóa bỏ</button>';
		item = item + '</div>';
		item = item + '<div class="col-sm-3 slideItem"><button type="button" class="btn btnAddItem pull-left">+</button></div>';
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
			openKCFinderAlbum($(this));
		});
	});
</script>
<style>
	.slideItem{
		height: auto;
	}
	.slideItem .title{
		border-top: 1px solid #d2d6de;
	}
</style>