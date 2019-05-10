<div id="body" class="body-container">
	<div class="breadcrumb">
		<div class="uk-container uk-container-center"> 
			<ul class="uk-breadcrumb">
				<li>
					<a href="<?php echo base_url(); ?>" title="<?php echo $this->lang->line('home_page') ?>">
					<i class="fa fa-home"></i> <?php echo $this->lang->line('home_page') ?></a>
				</li>
				<li class="uk-active">
					<a href="javascript:void(0)" title="Quản lý thành viên">Quản lý thành viên</a>
				</li>
				<li class="uk-active">
					<a href="javascript:void(0)" title="Quản lý thành viên">Quản lý tin đăng</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="uk-container uk-container-center">
		<?php $error = validation_errors(); echo !empty($error)?'<div class="uk-alert uk-alert-danger" data-uk-alert> <a href="" class="uk-alert-close uk-close"></a> <p>'.$error.'</p></div>' : ''; ?>
		<div class="uk-grid uk-grid-medium mb20">
			<div class="uk-width-large-2-3">
				<section class="profile_box">
					<header class="panel-head">
						<div class="heading-2"><span>Quản lý tin đăng</span></div>
					</header>
					<section class="panel-body">
						<div class="wrap-content">
							<div class="main-content management-lading">
								<div class="navbar-status mb15">
									<ul class="uk-list uk-clearfix">
										<li class="item active">
											<a href="" class="link" title="Tất cả">Tất cả (<?php echo count($OrderList) ?>)</a>
										</li>
									</ul>
								</div>
								<form action="" method="get" class="form">
									<div class="search-order uk-flex uk-flex-middle mb15 lib-grid-10">
										<div class="row search-box uk-position-relative">
											<label class="label-search">
												<select name="type" class="input-text uk-width-1-1">
													<option value="">Tất cả</option>
													<option value="1">Cần bán</option>
													<option value="2">Cần mua</option>
													<option value="3">Cần thuê</option>
													<option value="4">Cần cho thuê</option>
												</select>
											</label>
										</div>
										<div class="row search-box uk-position-relative">
											<label class="label-search">
												<input type="text" name="keyword" value="<?php echo $this->input->get('keyword'); ?>" class="input-text uk-width-1-1" placeholder="Từ khóa tìm kiếm" />
											</label>
										</div>
										
										<div class="row">
											<input type="submit" name="" value="Tìm kiếm" class="input-text btn-search" />
										</div>
									</div><!-- .search-order -->
									<div class="table-detail mb15">
										<div class="uk-overflow-container">
											<table class="table uk-table uk-table-middle uk-table-condensed uk-table-striped uk-table-hover">
												<thead>
													<tr>
														<th class="col-10 uk-text-center">#</th>
														<th class="col-100 uk-text-center">Mã</th>
														<th class="col-width">Tiêu đề</th>
														<th class="col-100 uk-text-center">Giá</th>
														<th class="col-100 uk-text-center">Tin Vip</th>
														<th class="col-100 uk-text-center">Ngày đăng</th>
														<th class="col-100 uk-text-center">Thao tác</th>
													</tr>
												</thead>
												<tbody>
												<?php $price = array(0 => 'Trăm triệu',1 => 'Triệu',2 => 'Tỷ',3 => 'Cây',4 => 'Ngàn USD'); ?>
												<?php if(isset($OrderList) && is_array($OrderList) && count($OrderList)){ ?>
												<?php foreach($OrderList as $key => $val){ ?>
													<tr>
														<td class="uk-text-center"><?php echo $key + 1 ?></td>
														<td class="uk-text-center"> 
															<a style="color: #004771;font-weight:bold;" href="<?php echo site_url('chi-tiet-don-hang/'.$val['id'].''); ?>" title=""><?php echo $val['code']; ?></a>
														</td>
														<td class="uk-text-left">
															<?php echo $val['title']; ?>
														</td>
														<td class="uk-text-center"> 
															<?php echo '<span class="red">'.$val['price'].'</span> '.$price[$val['measure']]; ?>
														</td>
														<td class="uk-text-center"><span class="<?php echo ($val['isaside'] == 0) ? 'blue': 'red'; ?>"><?php echo ($val['isaside'] == 0) ? 'Thường' : 'Vip'; ?></span></td>
														<td class="uk-text-center">
															<?php echo gettime($val['created'],'d/m/Y') ?>
														</td>
														<td class="uk-text-center">
															<div class="btn-group">
																<a href="members/delete-post/<?php echo $val['id']?>.html" class="btn btn-danger">
																	<span class="fa fa-trash"></span>
																</a>
																<a href="members/edit-post/<?php echo $val['id']?>.html" class="btn btn-success">
																	<i class="fa fa-edit"></i>
																</a>
															</div>
														</td>
													</tr>
												<?php }}else{ ?>
													<tr>
														<td colspan="6" class="uk-text-center uk-hidden">Không tìmm thấy vận đơn nào</td>
													</tr>
												<?php } ?>
												</tbody>
											</table><!-- .table -->
											<?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
										</div>
									</div>
								</form><!-- .form -->
							</div><!-- .management-lading -->
						</div><!-- .main-content -->
					</section>
				</section>
			</div>
			<div class="uk-width-large-1-3">
				<?php $this->load->view('homepage/frontend/common/customers_aside'); ?>
			</div>
		</div>
	</div>
</div><!-- #body -->