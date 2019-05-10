<aside class="sidebar">
	<ul class="uk-list uk-clearfix user-menu">
		<!--<li class="item <?php echo (isset($active) && $active == 'tao-van-don' ) ? 'active' : ''; ?>">
			<a href="tao-van-don.html" title="Tạo vận đơn" class="link">
				<span class="icon active"><img src="templates/manage/resources/img/upload/create-1.png" alt="" /></span>
				<span class="icon"><img src="templates/manage/resources/img/upload/create.png" alt="" /></span>
				<span class="title">Tạo vận đơn</span>
			</a>
		</li>-->
		<!--<li class="item <?php echo (isset($active) && $active == 'quan-ly-van-don' ) ? 'active' : ''; ?>">
			<a href="quan-ly-van-don.html" title="" class="link ">
				<span class="icon active"><img src="templates/manage/resources/img/upload/manager-1.png" alt="" /></span>
				<span class="icon"><img src="templates/manage/resources/img/upload/manager.png" alt="" /></span>
				<span class="title">Quản lý đơn hàng</span>
			</a>
		</li>-->
		<!--<li class="item">
			<a href="" title="" class="link">
				<span class="icon active"><img src="templates/manage/resources/img/upload/order-1.png" alt="" /></span>
				<span class="icon"><img src="templates/manage/resources/img/upload/order.png" alt="" /></span>
				<span class="title">Vận đơn cần xử lý</span>
			</a>
		</li> -->
		<li class="item <?php echo (isset($active) && $active == 'thong-tin-tai-khoan' ) ? 'active' : ''; ?>">
			<a href="thong-tin-tai-khoan.html" title="" class="link">
				<span class="icon"><img src="templates/manage/resources/img/upload/user.png" alt="" /></span>
				<span class="title">Thông tin cơ bản</span>
			</a>
		</li>
		<li class="item <?php echo (isset($active) && $active == 'thay-doi-mat-khau' ) ? 'active' : ''; ?>">
			<a href="<?php echo site_url('thay-doi-mat-khau'); ?>" title="" class="link">
				<span class="icon"><img src="templates/manage/resources/img/upload/order.png" alt="" /></span>
				<span class="title">Thay đổi mật khẩu</span>
			</a>
		</li>
	</ul><!-- .user-menu -->
</aside><!-- .sidebar -->