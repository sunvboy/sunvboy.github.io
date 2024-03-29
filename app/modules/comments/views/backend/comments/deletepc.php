<section class="content-header">
	<h1>Xóa</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
		<li><a href="<?php echo site_url('comments/backend/comments/view');?>">Danh sách bình luận</a></li>
		<li class="active"><a href="<?php echo site_url('comments/backend/comments/delete/'.$Detailcomments['id']);?>">Xóa</a></li>
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
								<i class="fa fa-envelope"></i> #
								<small class="pull-right">Ngày gửi: <?php echo show_time($Detailcomments['created']);?></small>
							</h2>
						</div><!-- /.col -->
					</div>
					<div class="row invoice-info">
						<div class="col-sm-4 invoice-col">
							<b>Người gửi</b><br>
							<br>
							<address>
							<strong><?php echo $Detailcomments['fullname'];?></strong><br>
							</address>
						</div><!-- /.col -->
						<div class="col-sm-4 invoice-col">
							<b>Thông tin</b><br>
							
							<b>Xuất bản:</b> <?php echo $this->configbie->data('publish', $Detailcomments['publish']);?><br>
						</div><!-- /.col -->
						
					</div><!-- /.row -->
					
					<div class="row">
						<div class="box-footer">
							<button type="reset" class="btn btn-default">Làm lại</button>
							<button type="submit" name="delete" value="action" class="btn btn-info pull-right">Xóa bỏ</button>
						</div><!-- /.box-footer -->
					</div>
				</section><!-- /.content -->
			</form>
		</div><!-- /.col -->
	</div><!-- /.row -->
</section><!-- /.content -->