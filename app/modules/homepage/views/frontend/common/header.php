<section class="content">
    <script type='text/javascript'>
        $('body').attr('id', 'home');
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".bt-res").click(function () {
                $('.bt-res').toggleClass('open');
                $(".wrap-res").toggleClass('open');
            });
            if (!$("body").hasClass("homepage")) {
                $(".nav-menu .menu-link a").click(function (event) {
                    var id = $(this).data("link");
                    if (id != '') {
                        id = 'https://demo5000.web30s.vn/?idsection=' + id;
                        window.location.replace(id);
                    }
                });
            }
        });
    </script>
    <header class="page-header navbar navbar-inverse">
        <div class="container-cus">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <div class="logo-wrapper visible-xs visible-sm">
                    <div class="logo pull-left">
                        <a href="#section_banner" class="logo btn-scroll">
                            <img alt='Palazzo' class='img-responsive' width='180' height='98' src='<?php echo $this->fcSystem['homepage_logo']?>'> </a>
                    </div>
                </div>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="collapse navbar-collapse navbar-ex1-collapse SFUFuturaBook">
                <div class="row">
                    <div class="col-md-2 hidden-xs hidden-sm">
                        <a href="<?php echo base_url()?>" class="logo">
                            <img alt='Palazzo' class='img-responsive logo1' width='180' height='98' src='<?php echo $this->fcSystem['homepage_logo']?>'>
                            <img alt='Palazzo' class='img-responsive logo2' width='180' height='98' src='<?php echo $this->fcSystem['homepage_logo']?>'>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-10">
                        <ul class="nav-menu nav navbar-nav navbar-nav-right">
                            <li class="first home menu-link"><a data-link="section_banner">Home</a></li>
                            <li class="menu-link"><a data-link="section_about">Giới Thiệu</a></li>
                            <li class="menu-link"><a data-link="section_masterplan">Dự án</a></li>
                            <li class="menu-link"><a data-link="section_location">Vị Trí Thuận Lợi</a></li>
                            <li class="menu-link"><a data-link="section_utilities">Tiện ích</a></li>
                            <li class="menu-link"><a data-link="section_support">HỖ TRỢ TÀI CHÍNH</a></li>
                            <li class="menu-link"><a data-link="section_picture360">Thư Viện Hình Ảnh</a></li>
                            <li class="menu-link"><a data-link="section_news">Tin tức sự kiện</a></li>
                            <li class="menu-link"><a data-link="section_register">Liên Hệ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.navbar-collapse -->
            <div class="clearfix"></div>
        </div>
    </header>