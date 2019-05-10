<section class="content-header">
	<h1>Thành viên</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
		<li class="active"><a href="<?php echo site_url('customers/backend/formlist/view');?>">Khách hàng - Thanh toán</a></li>
	</ol>
</section>
<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header">
			<h3 class="box-title pull-right">
				<div class="btn-group">
					<a href="<?php echo site_url('customers/backend/formlist/create');?>" class="btn btn-default btn-flat"><i class="fa fa-plus"></i> Thêm mới</a>
				</div>
			</h3>
			<div class="box-tools pull-left">
				<form method="get" action="<?php echo site_url('customers/backend/formlist/view');?>">
					<div class="pull-left" style="width: 200px;margin-right:8px;">
						<?php echo form_dropdown('groupsid', $this->BackendCustomersGroups_Model->dropdown(), set_value('groupsid', $this->input->get('groupsid')), 'class="form-control"');?>
					</div>
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
		<?php if(isset($Listpayment) && is_array($Listpayment) && count($Listpayment)){ ?>
		<div class="box-body table-responsive no-padding">
			<table class="table table-hover" id="diagnosis-list">
				<tr>
					<th>ID</th>
					<th>Ngày xét nghiệm</th>
					<th>Tên bệnh nhân</th>
					<th>Bác sỹ</th>
					<th>Loại xét nghiệm</th>
					<th>Files kết quả</th>
					<th>Trang thái</th>
					<th class="text-right">Thao tác</th>
				</tr>
				<?php foreach($Listpayment as $key => $item){ ?>
					<?php $arr = json_decode($item['result'], TRUE); ?>
					<tr>
						<td><?php echo $item['id'];?></td>
						<td style="text-align: center;"><?php echo $item['date']; ?></td>
						<td><?php echo $item['customers_title']; ?></td>
						<td><?php echo $item['doctor_title']; ?></td>
						<td><?php echo $item['type']; ?></td>
						<td>
							<?php if (isset($arr) && is_array($arr) && count($arr)) { ?>
								<?php foreach ($arr as $key => $val) { ?>
									<a href="<?php echo BASE_URL.$val['file'] ?>" title="Địa chỉ files kết quả">
										<?php echo (($key == 0) ? '' : ', ') ?>
										<img src="templates/backend/images/link.png" alt="links">
									</a>
								<?php } ?>
							<?php } ?>
						</td>
						<td>
							<a href="<?php echo site_url('customers/backend/formlist/set/publish/'.$item['id'].'?redirect='.urlencode(current_url())); ?>" title="" class="status-publish">
								<img src="<?php echo ($item['publish'] > 0)? 'templates/backend/images/publish-check.png':'templates/backend/images/publish-deny.png'; ?>" alt="" />
							</a>
						</td>
						<td class="text-right">
							<div class="btn-group" style="min-width: 75px;">
								<a href="<?php echo site_url('customers/backend/formlist/delete/'.$item['id']).'?redirect='.urlencode(current_url());?>" class="btn btn-danger <?php echo (($item['publish'] == 1) ? 'disabled' : '') ?>"><span class="fa fa-trash"></span></a>
								<a href="<?php echo site_url('customers/backend/formlist/update/'.$item['id']).'?redirect='.urlencode(current_url());?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
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
			<?php echo isset($ListPagination)?$ListPagination:'';?>
		</div>
	  </div><!-- /.box -->
	</div>
  </div>
</section><!-- /.content -->