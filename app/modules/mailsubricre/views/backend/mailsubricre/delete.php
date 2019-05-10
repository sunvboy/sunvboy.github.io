<section class="content-header">
	<h1>Xóa</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
		<li><a href="<?php echo site_url('mailsubricre/backend/mailsubricre/view');?>">Đăng ký tư vấn</a></li>
		<li class="active"><a href="<?php echo site_url('mailsubricre/backend/mailsubricre/delete/'.$Detailmailsubricre['id']);?>">Xóa</a></li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form method="post" action="">
				<section class="invoice">
					<div class="row">
						<div class="col-xs-12">
							<h2 class="page-header">
								<i class="fa fa-envelope"></i> #<?php echo $Detailmailsubricre['id'];?>
								<small class="pull-right">Ngày gửi: <?php echo show_time($Detailmailsubricre['created']);?></small>
							</h2>
						</div><!-- /.col -->
					</div>
					<div class="row invoice-info">
						<div class="col-sm-4 invoice-col">
							<b>Người gửi</b><br>
							<br>
							<address>
							<strong>

							Họ và tên: <?php echo $Detailmailsubricre['fullname'];?><br>
							Số điện thoại: <?php echo $Detailmailsubricre['phone'];?><br>
							Câu hỏi: <?php echo $Detailmailsubricre['message'];?><br>


							</address>
						</div><!-- /.col -->
						<div class="col-sm-4 invoice-col hide">
							<b>Thông tin</b><br>
							
							<b>Xuất bản:</b> <?php echo $this->configbie->data('publish', $Detailmailsubricre['publish']);?><br>
						</div><!-- /.col -->
						
					</div><!-- /.row -->
					
					<div class="row">
						<div class="box-footer">
							<button type="submit" name="delete" value="action" class="btn btn-danger pull-right">Xóa bỏ</button>
						</div><!-- /.box-footer -->
					</div>
				</section><!-- /.content -->
			</form>
		</div><!-- /.col -->
	</div><!-- /.row -->
</section><!-- /.content -->