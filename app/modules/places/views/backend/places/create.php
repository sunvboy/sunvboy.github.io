<section class="content-header">
	<h1>Thêm dự án</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
		<li><a href="<?php echo site_url('places/backend/places/view');?>">hỗ trợ trực tuyến</a></li>
		<li class="active"><a href="<?php echo site_url('places/backend/places/create');?>">Thêm dự án</a></li>
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
									<label class="col-sm-2 control-label tp-text-left">Tên hiệu thuốc</label>
									<div class="col-sm-4">
										<?php echo form_input('title', set_value('title'), 'class="form-control" placeholder="Tên hiệu thuốc"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label tp-text-left">Địa chỉ</label>
									<div class="col-sm-4">
										<?php echo form_input('address', set_value('address'), 'class="form-control" placeholder="Địa chỉ"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label tp-text-left">Số điện thoại</label>
									<div class="col-sm-4">
										<?php echo form_input('phone', set_value('phone'), 'class="form-control" placeholder="Số điện thoại"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label tp-text-left">Tỉnh / Thành Phố</label>
									<?php
										$location_dropdown = $this->BackendProjects_Model->location_dropdown(array(
											'where' => array('parentid' => 0)
										));
									?>
									<div class="col-sm-4">
										<?php echo form_dropdown('cityid', $location_dropdown, set_value('cityid', 0), 'class="form-control location" style="width: 100%;" data-return="district"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label tp-text-left">Quận / Huyện</label>
									<div class="col-sm-4">
										<select id="district" class="form-control location" name="districtid" data-return="ward"><option value="0">[Chọn]</option></select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label tp-text-left">Phường / Xã</label>
									<div class="col-sm-4">
										<select id="ward" class="form-control location" name="wardid"><option value="0">[Chọn]</option></select>
									</div>
								</div>


							</div><!-- /.box-body -->
						</div><!-- /.tab-pane -->
						<div class="tab-pane" id="tab-advanced">
							<div class="box-body">
								<div class="form-group">
									<label class="col-sm-2 control-label">Xuất bản</label>
									<div class="col-sm-2">
										<?php echo form_dropdown('publish', $this->configbie->data('publish'), set_value('publish', 1), 'class="form-control select2" style="width: 100%;"');?>
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
<script>
	$(document).ready(function(){


		$('.location').on('change',function(){
			var id = $(this).val();
			var returnSection = $(this).attr('data-return');
			var flag = $(this).attr('data-flag');
			var formURL = 'projects/ajax/projects/ajax_change_location';
			var _this = $(this);
			if(returnSection == 'district'){
				$('#ward').html('');
				$('#district').html('');
			}else if(returnSection == 'ward'){
				$('#ward').html('');
			}

			$.post(formURL, {id: id},
				function(data){
					var json = JSON.parse(data);
					if(flag == 0){
						if(returnSection == 'district'){
							$('#'+returnSection).html(json.html).val(districtid).trigger('change');
						}else if(returnSection == 'ward'){
							$('#'+returnSection).html(json.html).val(wardid).trigger('change');
						}
						_this.attr('data-flag',1);
					}else{
						$('#'+returnSection).html(json.html);
					}
				});

			var city_id = $('#cityid option:selected').val();
			var district_id = $('#district option:selected').val();
			var ward_id = $('#ward option:selected').val();


			var city_text = $('#cityid option:selected').text();
			var district_text = $('#district option:selected').text();
			var ward_text = $('#ward option:selected').text();
			/* Ghi nhanh Ä‘á»‹a chá»‰ */
			var address = '';
			address = ((ward_text != '') ? '' + ward_text : '') + ((district_text != '') ? ' - ' + district_text : '') + ((city_text != '') ? ' - ' + city_text : '');
			$('#address').val('').val(address);
			/* ---------------- */
			if(typeof(district_id) == 'undefined'){
				district_id = 0;
			}
			if(typeof(ward_id) == 'undefined'){
				ward_id = 0;
			}
			if(typeof(projectid) == 'undefined'){
				projectid = 0;
			}
			if(typeof(streetid) == 'undefined'){
				streetid = 0;
			}
			listProject(city_id, district_id, ward_id, projectid);
			//listStreet(city_id, district_id, ward_id, streetid);
		});
		if(cityid > 0){
			$('#cityid').val(cityid).trigger('change');
		}
	});

	/* Láº¥y dá»± Ă¡n theo thĂ nh phá»‘, quáº­n, huyá»‡n */
	function listProject (cityid, districtid, wardid, projectid){
		var formURL = 'projects/ajax/projects/ajax_get_project_list'
		$.post(formURL, {cityid: cityid, districtid:districtid, wardid:wardid},
			function(data){
				var json = JSON.parse(data);
				$('#project').html('').html(json.html).val(projectid);
			});
	}
	//function listStreet(cityid, districtid, wardid, streetid) {
	//	var formURL = 'projects/ajax/projects/ajax_get_street_list'
	//	$.post(formURL, {cityid: cityid, districtid: districtid, wardid: wardid},
	//		function (data) {
	//			var json = JSON.parse(data);
	//			$('#street').html('').html(json.html).val(streetid);
	//
	//		});
	//}
</script>