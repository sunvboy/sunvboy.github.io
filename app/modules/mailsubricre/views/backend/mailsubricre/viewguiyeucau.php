<section class="content-header">
	<h1>Danh sách đăng ký dịch vụ</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
		<li class="active"><a href="<?php echo site_url('mailsubricre/backend/mailsubricre/viewguiyeucau');?>">Danh sách đăng ký</a></li>
	</ol>
</section>

<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header">
			<div class="box-tools pull-left">
				<form method="get" action="<?php echo site_url('mailsubricre/backend/mailsubricre/viewguiyeucau');?>">
					<div class="input-group pull-left" style="width: 250px;">
						<input type="text" name="keyword" value="<?php echo htmlspecialchars($this->input->get('keyword'));?>" class="form-control" placeholder="Search">
						<div class="input-group-btn">
							<button type="submit" value="action" class="btn btn-default"><i class="fa fa-search"></i></button>
						</div>
					</div>
				</form>
			</div>
		</div><!-- /.box-header -->
		<?php echo show_flashdata();?>
		<?php if(isset($listemail) && is_array($listemail) && count($listemail)){ ?>
		<div class="box-body table-responsive no-padding">
			<table class="table table-hover table-bordered table-striped">
				<tr>
					<th>ID</th>
					<th>Voucher</th>
					<th>Số lượng</th>
					<th>Họ tên</th>
					<th>Số điện thoại</th>
					<th>Email</th>
					<th>Địa chỉ</th>
					<th>Ghi chú</th>
					<th>Ngày đăng ký</th>

<!--					<th>Hiển thị</th>-->
					<th class="text-center">Thao tác</th>





				</tr>
				<?php foreach($listemail as $key => $email){ ?>
				<tr>
					<td><?php echo $email['id'];?></td>
					<td><?php echo $email['product'];?></td>
					<td><?php echo $email['quantiny'];?></td>

					<td><?php echo $email['fullname'];?></td>
					<td class=""><?php echo $email['phone'];?></td>
					<td class=""><?php echo $email['email'];?></td>
					<td class=""><?php echo $email['address'];?></td>
					<td class=""><?php echo $email['message'];?></td>
					<td class=""><?php echo $email['created'];?></td>

					<td class="hide">
						<a href="<?php echo site_url('mailsubricre/backend/mailsubricre/set/publish/'.$email['id'].'?redirect='.urlencode(current_url())); ?>" title="" class="status-publish">
							<img src="<?php echo ($email['publish'] > 0)? 'templates/backend/images/publish-check.png':'templates/backend/images/publish-deny.png'; ?>" alt="" />
						</a>
					</td>
					<td class="text-right">
						<div class="btn-group">
							<a href="<?php echo site_url('mailsubricre/backend/mailsubricre/update/'.$email['id']).'?redirect='.urlencode(current_url());?>" class="btn btn-default"><i class="fa fa-edit"></i></a>

							<a href="<?php echo site_url('mailsubricre/backend/mailsubricre/delete1/'.$email['id']).'?redirect='.urlencode(current_url());?>" class="btn btn-default"><span class="fa fa-trash"></span></a>
						</div>
					 </td>
				</tr>
				<?php } ?>
			</table>
		</div><!-- /.box-body -->
		<?php } else { ?>
		<div class="box-body">
			<div class="callout callout-danger">Không có dữ liệu</div>
		</div><!-- /.box-body -->
		<?php } ?>
		<div class="box-footer clearfix">
			<?php echo isset($listPagination)?$listPagination:'';?>
		</div>
	  </div><!-- /.box -->
	</div>
  </div>
</section><!-- /.content -->
<!--<div class="countdown">144</div><div class="error"></div>-->
<!--<script>-->
<!--	$(document).ready(function() {-->
<!--		var doUpdate = function() {-->
<!--			$('.countdown').each(function() {-->
<!--				var count = parseInt($(this).html());-->
<!--				if (count !== 0) {-->
<!--					$(this).html(count - 1);-->
<!--					$('.error').html('Còn 2 ngày');-->
<!--				}else if (count < 144 && count >140) {-->
<!--					$(this).html(count - 1);-->
<!--					$('.error').html('Còn 1 ngày');-->
<!--				}else{-->
<!--					$('.error').html('Mã giảm giá không tồn tại');-->
<!--				}-->
<!--			});-->
<!--		};-->
<!--		setInterval(doUpdate, 1000);-->
<!--	});-->
<!--</script>-->
