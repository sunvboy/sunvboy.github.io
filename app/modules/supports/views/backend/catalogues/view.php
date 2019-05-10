<section class="content-header">
	<h1>Danh sách nhóm hỗ trợ trực tuyến</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
		<li class="active"><a href="<?php echo site_url('supports/backend/catalogues/view');?>">nhóm hỗ trợ trực tuyến</a></li>
	</ol>
</section>
<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header">
			<h3 class="box-title pull-right">
				<div class="btn-group">
					<a href="<?php echo site_url('supports/backend/catalogues/create');?>" class="btn btn-default btn-flat"><i class="fa fa-plus"></i> Thêm mới</a>
				</div>
			</h3>
			<div class="box-tools pull-left">
				<form method="get" action="<?php echo site_url('supports/backend/catalogues/view');?>">
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
		<?php if(isset($listSupports) && is_array($listSupports) && count($listSupports)){ ?>
		<div class="box-body table-responsive no-padding">
			<table class="table table-hover table-bordered table-striped">
				<tr style="text-align: center">
					<th>ID</th>
					<th>Tên nhóm</th>
<!--					<th>Số người</th>-->
					<th style="text-align: center">Hiển thị</th>
					<th>Thời gian</th>
					<th style="text-align: right">Thao tác</th>
				</tr>
				<?php foreach($listSupports as $key => $contact){ ?>
				<tr>
					<td><?php echo $contact['id'];?></td>
					<td><?php echo $contact['title'];?></td>
					<td class="hide"><?php echo $contact['count_supports'];?></td>
					<td style="max-width:268px;" class="hide"><?php echo cutnchar(strip_tags($contact['description']), 168);?></td>
					<td class="">
						<a href="<?php echo site_url('supports/backend/catalogues/set/publish/' . $contact['id'] . '?redirect=' . urlencode(current_url())); ?>"
						   title="" class="status-publish">
							<img
								src="<?php echo ($contact['publish'] > 0) ? 'templates/backend/images/publish-check.png' : 'templates/backend/images/publish-deny.png'; ?>"
								alt=""/>
						</a>
					</td>

					<td><?php echo show_time($contact['created']);?></td>
					<td class="text-right">
						<div class="btn-group">
							<a href="<?php echo site_url('supports/backend/catalogues/delete/'.$contact['id']).'?redirect='.urlencode(current_url());?>" class="btn btn-default"><span class="fa fa-trash"></span></a>
							<a href="<?php echo site_url('supports/backend/catalogues/update/'.$contact['id']).'?redirect='.urlencode(current_url());?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
							<a href="<?php echo site_url('supports/backend/catalogues/read/'.$contact['id']).'?redirect='.urlencode(current_url());?>" class="btn btn-default"><i class="fa fa-eye"></i></a>
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