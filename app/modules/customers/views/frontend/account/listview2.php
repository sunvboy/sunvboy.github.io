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
<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		$('.error').hide();
		if($('#checkbox-all').length){
			$('#checkbox-all').click(function(){
				if($(this).prop('checked')){
					$('.checkbox-item').prop('checked', true);
				}
				else{
					$('.checkbox-item').prop('checked', false);
				}
			});
		}
		if($('.checkbox-item').length) {
			$('.checkbox-item').click(function(){
				if($('.checkbox-item:checked').length == $('.checkbox-item').length) {
					$('#checkbox-all').prop('checked', true);
				}
				else{
					$('#checkbox-all').prop('checked', false);
				}
			});
		}
		function showActionButton() {
			if($('.checkbox-item:checked').length) {
				$('.gcheckAction').show();
			}else {
				$('.gcheckAction').hide();
			}
		}
		$('form').change(function() {
			showActionButton();
		});
		$('.gcheckAction').click(function(){
			var id_checked = []; // Lấy id bản ghi
			$('.checkbox-item:checked').each(function() {
			   id_checked.push($(this).val());
			});
			var formURL = '<?php echo site_url('customers/ajax/auth/delete'); ?>';
			$.post(formURL, {
				post: id_checked,},
				function(data){
					var json = JSON.parse(data);
					$('.error').show();
					$('.gcheckAction').hide();
					if(json.error == false){
						$('.error').removeClass('uk-alert-danger').addClass('uk-alert-success');
						$('.error').html('').html(json.message);
					}else{
						$('.error').removeClass('uk-alert-success').addClass('uk-alert-danger');
						$('.error').html('').html(json.message);
					}
					window.setTimeout('location.reload()', 2000); //Reloads after three seconds
				});
			return false;
		});
	});
</script>
	<div class="uk-container uk-container-center">
		<div class="uk-grid uk-grid-medium mt20 mb20">
			<div class="uk-width-large-1-4">
				<?php $this->load->view('homepage/frontend/common/modal_login') ?>
			</div>
			<div class="uk-width-large-3-4">
				<section class="customers-formvalue">
					<header class="heading-page">
						<span>Danh sách biểu mẫu</span>
					</header>
					<section class="panel-body">
						<span class="gcheckAction pull-left btn btn-default"><i class="fa fa-trash"></i></span>
						<div class="error uk-alert"></div>
						<?php if (isset($List) && is_array($List) && count($List)): ?>
							<form action="" id="fcFrom" method="post" name="frm">
								<table class="uk-table uk-table-middle uk-table-condensed uk-table-striped table-form-customers">
									<thead>
										<th><input id="checkbox-all" type="checkbox"></th>
										<th>Mã bệnh nhân</th>
										<th>Tên bệnh nhân</th>
										<th>Loại xét nghiệm</th>
										<th>Kết quả</th>
										<th>File kết quả</th>
										<th>Ngày xét nghiệm</th>
										<th>Ghi chú</th>
									</thead>
									<tbody>
										<?php foreach ($List as $key => $val) { ?>
											<?php $arr = json_decode($val['result'], TRUE); ?>
											<tr>
												<td>
													<input name="checkbox[]" value="<?php echo $val['id']?>" class="checkbox-item" type="checkbox">
												</td>
												<td><?php echo $val['code'] ?></td>
												<td><?php echo $val['fullname'] ?></td>
												<td><?php echo $val['type'] ?></td>
												<td><?php echo $val['result_note'] ?></td>
												<td>
													<?php if (isset($arr) && is_array($arr) && count($arr)) { ?>
														<?php foreach ($arr as $key => $vals) { ?>
															<a href="<?php echo BASE_URL.$vals['file'] ?>" title="Địa chỉ files kết quả">
																<?php echo (($key == 0) ? '' : ', ') ?>
																<img src="templates/backend/images/link.png" alt="links">
															</a>
														<?php } ?>
													<?php } ?>
												</td>
												<td><?php echo $val['date'] ?></td>
												<td><?php echo $val['note_note'] ?></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</form>
						<?php endif ?>
					</section>
				</section>
			</div>
		</div>
	</div>
</div>
