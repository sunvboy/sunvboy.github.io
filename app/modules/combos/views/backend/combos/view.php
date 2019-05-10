<section class="content-header">
	<h1>Danh sách combo</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
		<li class="active"><a href="<?php echo site_url('combos/backend/combos/view');?>">combo</a></li>
	</ol>
</section>

<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header">
			<h3 class="box-title pull-right">
				<div class="btn-group">
					<a href="<?php echo site_url('combos/backend/combos/create');?>" class="btn btn-default btn-flat"><i class="fa fa-plus"></i> Thêm mới</a>
				</div>
			</h3>
			<div class="box-tools pull-left">
				<form method="get" action="<?php echo site_url('combos/backend/combos/view');?>">
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
		<?php if(isset($listCombos) && is_array($listCombos) && count($listCombos)){ ?>
		<div class="box-body table-responsive no-padding">
			<table class="table table-hover table-bordered table-striped">
				<tr>
					<th>ID</th>
					<th>Tên Combo</th>
					<th>Số món</th>
					<th style="text-align:center;">Tên món ăn</th>
					<th style="">Giá</th>
					<th style="">Ngày tạo</th>
					<th class="text-right">Thao tác</th>
				</tr>
				<?php foreach($listCombos as $key => $contact){ ?>
				<?php 
					$count = count(json_decode($contact['data'], TRUE));
					$productid = json_decode($contact['data'], TRUE);
					$product = $this->Autoload_Model->_get_where(array(
						'select' => 'id, title',
						'table' => 'products',
						'where' => array('publish' => 1,'trash' => 0),
						'where_in' => $productid,
						'where_in_field' => 'id',
						'order_by' => 'title asc'
					), TRUE);
				?>
				<tr>
					<td><?php echo $contact['id'];?></td>
					<td><?php echo $contact['title'];?></td>
					<td><?php echo $count;?></td>
					<td>
					<?php if(isset($product) && is_array($product) && count($product)){ ?>
						<ul>
						<?php foreach($product as $key => $val){ ?>
							<li><?php echo ($key + 1) ?>. <?php echo $val['title']; ?></li>
						<?php } ?>
						</ul>
					<?php }else{ echo '-'; }?>
					</td>
					<td><input type="text" style="text-align:right;width:100px;padding-right:10px;margin-bottom:10px;" value="<?php echo str_replace(',','.',number_format($contact['price'])); ?>" class="price" data-module="price" data-id="<?php echo $contact['id'] ?>"  /> đ</td>
					<td><?php echo gettime($contact['created'],'d/m/Y');?></td>
					
					<td class="text-right">
						<div class="btn-group">
							<a href="<?php echo site_url('combos/backend/combos/delete/'.$contact['id']).'?redirect='.urlencode(current_url());?>" class="btn btn-default"><span class="fa fa-trash"></span></a>
							<a href="<?php echo site_url('combos/backend/combos/update/'.$contact['id']).'?redirect='.urlencode(current_url());?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
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
<script type="text/javascript"> 
	var time;
	$(document).ready(function(){
		
		$('.price').on('keyup', function(event) {
			var _this = $(this);
			var price = $(this).val();
			var module = $(this).attr('data-module');
			var id = $(this).attr('data-id');
			var url = 'combos/ajax/combos/fast_price_update';
			clearTimeout(time);
			time = setTimeout(function() {
				$('.backend-loader').show();
				$.post(url, {price: price, id: id,module:module}, function(data){
				 $('.backend-loader').hide();
				_this.val(data);
				});
			}, 800);
		});
		
		
		
	});
</script>