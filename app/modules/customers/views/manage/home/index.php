<style>
	.success{background:#034403;padding:3px 5px;display:inline-block;color:#fff;}
	.unsuccess{background:red;padding:3px 5px;display:inline-block;color:#fff;}
	.cancle{background:#333;padding:3px 5px;display:inline-block;color:#fff;}
</style>
<div class="uk-grid uk-grid-collapse">
	<div class="uk-width-medium-1-5 uk-width-large-1-6">
		<?php $this->load->view('customers/manage/common/aside');?>
	</div>
	<div class="uk-width-medium-4-5 uk-width-large-5-6">
		<div class="wrap-content">
			<div class="main-content management-lading">
				<div class="navbar-status mb15">
					<ul class="uk-list uk-clearfix">
						<li class="item active"><a href=""><a href="<?php echo site_url('quan-ly-van-don'); ?>" class="link" title="">Tất cả </a></li>
					</ul>
				</div>
				<form action="" method="" class="form">
					<div class="search-order uk-flex uk-flex-middle mb15">
						<div class="row search-box uk-position-relative">
							<label class="label-search">
								<input type="text" name="keyword" value="<?php echo $keyword; ?>"  class="input-text uk-width-1-1" placeholder="Tìm kiếm theo mã vận đơn hoặc số điện thoại" />
							</label>
						</div>
						<div class="row ">
							<label class="status-box">
								<?php echo form_dropdown('status', $this->configbie->data('status'), set_value('status', $this->input->get('status')), 'class="form-control" style="width: 100%;" id="status"');?>
							</label>
						</div>
						<div class="row">
							<label class="datetime">
								<input type="text" class="input-text uk-width-1-1" value="<?php echo set_value('start_date', $start_date) ?>" name="start_date" placeholder="Từ ngày" data-uk-datepicker="{format:'DD/MM/YYYY'}" />
							</label>
						</div>
						<div class="row">
							<label class="datetime">
								<input type="text" class="input-text uk-width-1-1" value="<?php echo set_value('end_date', $end_date); ?>"  name="end_date" placeholder="Từ ngày" data-uk-datepicker="{format:'DD/MM/YYYY'}" />
							</label>
						</div>
						<div class="row">
							<input type="submit" name="" value="Tìm kiếm" class="input-text btn-search" />
						</div>
					</div><!-- .search-order -->
					<div class="table-detail mb15">
						<div class="uk-overflow-container">
							<table class="table uk-table">
								<thead>
									<tr>
										<th class="col-250">Số ĐT Shop</th>
										<th class="col-250">Điểm lấy</th>
										<th class="col-250">Điểm đi</th>
										<th class="col-250">Khách nợ</th>
										<th class="col-250">Tiền hàng</th>
										<th class="col-250">Freeship</th>
										<th class="col-250">Ngày lấy</th>
										<th class="col-150">Ngày đi</th>
									</tr>
								</thead>
								<tbody>
								<?php $status_array  = $this->configbie->data('status');  ?>
								<?php $total_khachno = 0; $total_tien_h = 0; $total_tien_s = 0; $total_tien_fs = 0; $tong = 0; ?>
								<?php if(isset($customersList) && is_array($customersList) && count($customersList)){ ?>
								<?php foreach($customersList as $key => $val){ ?>
								<?php  
									$class = '';
									if($val['status'] == 0){$class = 'unsuccess';}
									else if($val['status'] == 1){$class = 'success';}
								?>
									<tr <?php echo ($val['status'] == 1) ? 'style="background:green;color:#fff !important;"' : '' ?>">
										<td class="uk-tex-center"><?php echo $val['phone'] ?></td>
										<td><?php echo $val['address'] ?></td>
										<td><?php echo $val['diemden'] ?></td>
										<td style="text-align:center !important;"><?php echo $val['khachno']; ?></td>
										<td style="text-align:center !important;"><?php echo $val['tien_h']; ?></td>
										<td style="text-align:center !important;"><?php echo $val['tien_fs']; ?></td>
										<td style="text-align:center !important;" ><?php echo $val['ngaylay']; ?></td>
										<td style="text-align:center !important;" ><?php echo $val['ngaydi']; ?></td>
									</tr>
									<?php 
									if($val['status'] == 1){
										$total_khachno = $val['khachno'] + $total_khachno;
										$total_tien_h = $val['tien_h'] + $total_tien_h;
										$total_tien_s = $val['tien_s'] + $total_tien_s;
										$total_tien_fs = $val['tien_fs'] + $total_tien_fs;
										
										
										$tong = $total_tien_h - $total_khachno - $total_tien_fs;
									}
									
									
									?>
								<?php } ?> 
									<tr >
										<td style="border-top:1px solid #CCC;" colspan="3" class="uk-text-right">Chốt</td>
										<td style="border-top:1px solid #CCC;" class="uk-text-center"><strong><?php echo $total_khachno; ?></strong></td>
										<td style="border-top:1px solid #CCC;" class="uk-text-center"><strong><?php echo $total_tien_h; ?></strong></td>
										<td style="border-top:1px solid #CCC;" class="uk-text-center"><strong><?php echo $total_tien_fs; ?></strong></td>
										<td style="border-top:1px solid #CCC;" class="uk-text-center"></td>
										<td style="border-top:1px solid #CCC;" class="uk-text-center"></td>
									</tr>
									<tr >
										<td style="border-top:1px solid #CCC;" colspan="3" class="uk-text-right">Tổng</td>
										<td style="border-top:1px solid #CCC;" class="uk-text-center"><?php echo $tong; ?><strong>
									</tr>
								<?php } else{ ?>
									<tr>
										<td colspan="5" class="uk-text-center uk-hidden">Không có dữ liệu</td>
									</tr>
								<?php } ?>
								</tbody>
							</table><!-- .table -->
						</div>
					</div>
				</form><!-- .form -->
				<?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
			</div><!-- .management-lading -->
		</div><!-- .main-content -->
	</div>
</div><!-- .uk-grid  -->
<div id="send-contact" class="uk-modal modal">
	<div class="uk-modal-dialog">
		<form action="" method="post" class="uk-form form">
			<div class="modal-head">
				<div class="title uk-text-center">Gửi yêu cầu khiếu nại</div>
				<a class="uk-modal-close uk-close close-modal"></a>
			</div>
			<div class="modal-content">
				<div class="row mb15">
				<?php 
					$select = $this->configbie->data('title');
				?>
					<select name="process" class="uk-width-1-1 select">
					<?php if(isset($select) && is_array($select) && count($select)){ ?>
					<?php foreach($select as $key => $val){ ?>
						<option value="<?php echo $key; ?>"><?php echo $val; ?></option>
					<?php } ?>
					<?php } ?>
					</select>
				</div>
				<div class="row mb30">
					<label class="label mb5">Nội dung khách hàng yêu cầu hoặc góp ý</label>
					<textarea name="message" name="message" id="message" class="uk-width-1-1 textarea"></textarea>
					<input type="hidden"  value="" name="orderid" id="hidden_orderid"/>
				</div>
				<div class="row action uk-text-right">
					<div class="uk-flex-inline uk-flex-middle">
						<input type="submit" value="Gửi yêu cầu" class="uk-button btn confirm">
					</div>
				</div>
			</div>
		</form>
	</div>
</div><!-- .modal -->

<script type="text/javascript">
	$(document).ready(function(){
		$('.send-contact').click(function(){
			var id = $(this).attr('data-order-id');
			$('#hidden_orderid').val(id);
		});
		$('#send-contact .form').on('submit',function(){
			var postData = $(this).serializeArray();
			var formURL = 'customers/frontend/customers/messages';
			$.post(formURL, {
				post: postData,}, 
				function(data){
					alert(data);
					window.location.href = 'quan-ly-van-don.html';
				});
			return false;
		});
	});
</script>


<script type="text/javascript">
	$(document).ready(function(){
		$('#orderForm').on('submit',function(){
			
			
			
		});
	});
</script>