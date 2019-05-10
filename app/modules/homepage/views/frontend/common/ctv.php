<section class="register-home wow fadeInUp"
         style="background: url('http://havigroup.vn/wp-content/uploads/2017/04/12953297_1065879266802981_2099663072_o.jpg');">
    <div class="container">
        <div class="section-header row text-center">
            <div class="col-md-12">
                <h3 class="uppercase"><?php echo $this->fcSystem['homepage_logo1']?></h3>
                <summary><?php echo $this->fcSystem['homepage_cover']?>
                </summary>
            </div>
        </div>
        <div id="frm-dangkyctv" class="row">
            <div role="form" class="wpcf7" id="wpcf7-f79-o1" lang="vi" dir="ltr">
                <div class="screen-reader-response"></div>

                <form action="mailsubricrectv.html" method="post" id="sform_footerctv">
                    <div class="error uk-alert"></div>
                    <div class="col-sm-3"><label class="name"><input type="text" name="fullname" class="fullname"
                                                                     placeholder="Nhập Họ tên *"></label></div>
                    <div class="col-sm-3"><label class="mail"><input type="email" name="email" class="email"
                                                                     placeholder="Nhập Email *"></label></div>
                    <div class="col-sm-3"><label class="phone"><input type="text" name="phone" placeholder="Nhập SĐT"></label>
                    </div>
                    <input type="hidden" name="title" value="Đăng ký CTV">
                    <input type="hidden" name="type" value="2">
                    <div class="col-sm-3"><input class="uppercase" type="submit" value="Đăng ký"></div>
                </form>


            </div>
        </div>
    </div>
</section>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#sform_footerctv .error').hide();
        var uri = $('#sform_footerctv').attr('action');
        $('#sform_footerctv').on('submit', function () {
            var postData = $(this).serializeArray();
            $.post(uri, {post: postData, fullname: $('#sform_footerctv .fullname').val(), email: $('#sform_footerctv .email').val()},
                function (data) {
                    var json = JSON.parse(data);
                    $('#sform_footerctv .error').show();
                    if (json.error.length) {
                        $('#sform_footerctv .error').removeClass('alert alert-success').addClass('alert alert-danger');
                        $('#sform_footerctv .error').html('').html(json.error);
                    } else {
                        $('#sform_footerctv .error').removeClass('alert alert-danger').addClass('alert alert-success');
                        $('#sform_footerctv .error').html('').html('Đăng ký CTV thành công!.');
                        $('#sform_footerctv').trigger("reset");
                        setTimeout(function () {
                            location.reload();
                        }, 5000);
                    }
                });
            return false;
        });
    });
</script>