<div class="register-dt wow fadeInUp">
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="logo-tv"><img src="<?php echo $this->fcSystem['homepage_logo2']?>" alt="<?php echo $this->fcSystem['homepage_company']?>">
            </div>
            <h3 class="title-name"><?php echo $this->fcSystem['homepage_slogan']?></h3>

            <p class="title-tv">Tư vấn 24/7</p>

            <p class="phone-t"><i class="fas fa-phone"></i>Hà Nội: <?php echo $this->fcSystem['contact_hotline_hanoi']?></p>

            <p class="phone-t"><i class="fas fa-phone"></i>Hồ chí Minh: <?php echo $this->fcSystem['contact_hotline_hcm']?></p>

            <div class="dktv">
                <a href="" data-toggle="modal" data-target="#myModal">Đăng ký tư vấn</a>
            </div>
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="logo-popup">
                                <img src="<?php echo $this->fcSystem['homepage_logo3']?>" alt="<?php echo $this->fcSystem['homepage_company']?>">
                                <h3 class="title">Đăng ký tư vấn</h3>
                            </div>
                        </div>
                        <div class="modal-body">
                            <form action="mailsubricre.html" method="post" id="sform_footer">
                                <div class="error uk-alert"></div>
                                <input type="hidden" name="type" value="1">
                                <input type="text" name="fullname" class="fullname" placeholder="Họ và tên">
                                <input type="text" name="phone" class="phone" placeholder="Số điện thoại">
                                <input type="text" name="email" placeholder="Email">
                                <input type="text" name="message" placeholder="Nhu cầu tư vấn">
                                <div class="click-register"><button type="submit"><img src="templates/frontend/resources/images/s.png" alt="Đăng ký ngay">Đăng ký ngay</button></div>

                            </form>
                            <p class="note">Tư vấn trực tiếp 24/7: <?php echo $this->fcSystem['contact_phone']?></p>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#sform_footer .error').hide();
        var uri = $('#sform_footer').attr('action');
        $('#sform_footer').on('submit', function () {
            var postData = $(this).serializeArray();
            $.post(uri, {post: postData, phone: $('#sform_footer .phone').val(), fullname: $('#sform_footer .fullname').val()},
                function (data) {
                    var json = JSON.parse(data);
                    $('#sform_footer .error').show();
                    if (json.error.length) {
                        $('#sform_footer .error').removeClass('alert alert-success').addClass('alert alert-danger');
                        $('#sform_footer .error').html('').html(json.error);
                    } else {
                        $('#sform_footer .error').removeClass('alert alert-danger').addClass('alert alert-success');
                        $('#sform_footer .error').html('').html('Đăng ký tư vấn thành công!.');
                        $('#sform_footer').trigger("reset");
                        setTimeout(function () {
                            location.reload();
                        }, 5000);
                    }
                });
            return false;
        });
    });
</script>