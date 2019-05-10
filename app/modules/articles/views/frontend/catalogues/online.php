<main>
    <div class="breadcrumb_pc">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo base_url() ?>">Trang chủ</a></li>
                        <li><a href="javascript:void();">Đặt hàng online</a></li>
                    </ul>
                </div>

            </div>

        </div>

    </div>
    <div class="clearfix-20"></div>
    <section id="news">
        <div class="container">
            <div class="row">

                <h1 style="text-align: center;">ĐẶT HÀNG ONLINE</h1>

                <div class="clearfix-40"></div>
                <div class="col-md-5 col-xs-12 col-sm-5">
                    <img src="<?php echo $this->fcSystem['sanpham_images'] ?>"
                         alt="<?php echo $this->fcSystem['sanpham_title'] ?>">

                </div>
                <div class="col-md-7 col-xs-12 col-sm-7">
                    <div class="et_pb_text_inner">

                        <p><b><?php echo $this->fcSystem['sanpham_description'] ?><br> </b></p>

                        <h3 style="color: #0057af"><strong>Giá: <?php echo $this->fcSystem['sanpham_saleoff'] ?> / hộp (20 gói)</strong></h3>

                        <div class="clearfix-20"></div>
                        <p><b>THÔNG TIN ĐẶT HÀNG</b></p>


                        <div class="forrm_dathangonlien row">

                            <form action="cartonline.html" method="post" id="online_form">
                                <div class="col-md-12">
                                    <div class="error uk-alert"></div>
                                </div>
                                <input type="hidden" name="title"
                                       value="<?php echo $this->fcSystem['sanpham_title'] ?>">
                                <input type="hidden" name="images"
                                       value="<?php echo $this->fcSystem['sanpham_images'] ?>">
                                <input type="hidden" name="saleoff"
                                       value="<?php echo $this->fcSystem['sanpham_saleoff'] ?>">
                                <input type="hidden" id="totalSum" name="total_price">

                                <div class="col-md-6 col-xs-12 col-sm-12 pd10">
                                    <label>Họ tên <span>*</span></label>

                                    <div class="">
                                        <input placeholder="Họ tên (Bắt buộc)" type="text" class="fullname"
                                               name="fullname">
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12 col-sm-12 pd10">
                                    <label>Số điện thoại <span>*</span></label>

                                    <div class="">
                                        <input placeholder="Số điện thoại (Bắt buộc)" type="text" class="phone"
                                               name="phone">
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12 col-sm-12 pd10">
                                    <label>Địa chỉ <span>*</span></label>

                                    <div class="">
                                        <input placeholder="Địa chỉ (Bắt buộc)" type="text" class="address"
                                               name="address">
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12 col-sm-12 pd10 price">
                                    <label>Số lượng đặt <span>*</span></label>

                                    <div class="">
                                        <input placeholder="Số lượng đặt (Bắt buộc)" value="1" type="number" min="1"
                                               name="quantity" class="quantity input_quantity">
                                    </div>
                                </div>
                                <?php
                                $saleoff = $this->fcSystem['sanpham_saleoff'];
                                if ($saleoff > 0) {
                                    $gia = str_replace(',', '.', number_format($saleoff));
                                } else {
                                    $gia = 'Liên hệ';
                                }
                                ?>
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <h3 class="total-line">Tổng: <span id="fld_1543072_1"> <?php echo $gia ?></span>đ
                                    </h3>

                                    <div class="clearfix"></div>
                                    <input class="btn btn-default" type="submit" id="fld_8111642_1" value="ĐẶT HÀNG">
                                </div>

                            </form>


                        </div>


                    </div>

                </div>
                <div class="clearfix-20"></div>
                <div class="col-md-12 col-xs-12 col-sm-12">

                    <style>
                        .et_pb_text_inner img, .et_pb_text_inner iframe {
                            max-width: 100%;
                            height: auto !important;

                        }

                        .et_pb_text_inner ul, .et_pb_text_inner ol {
                            margin: 0px;
                            padding: 0px 0px 0px 15px;
                        }
                    </style>
                    <div class="et_pb_text_inner">
                        <?php echo $this->fcSystem['sanpham_content'] ?>

                        <div class="clearfix-20"></div>


                        <div class="et_pb_text_inner">

                            <p style="font-size: 25px;color: #0057af"><b>Đánh giá tỉ lệ loãng xương</b></p>

                            <div class="forrm_dathangonlien row">

                                <form action="formlx.html" method="post" id="form_lx">
                                    <div class="col-md-12">
                                        <div class="error uk-alert"></div>
                                    </div>

                                    <div class="col-md-6 col-xs-12 col-sm-12 pd10">
                                        <label>Tuổi <span>*</span></label>

                                        <div class="">
                                            <input placeholder="Tuổi (Bắt buộc)" type="text" class="tuoi" name="tuoi">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12 col-sm-12 pd10">
                                        <label>Cân nặng<span>*</span></label>

                                        <div class="">
                                            <input placeholder="Cân nặng (Bắt buộc)" type="text" class="cannang" name="cannang">
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-xs-12 col-sm-12">

                                        <input class="btn btn-default" type="submit" id="fld_8111642_2" value="Kết quả">
                                    </div>

                                </form>


                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </section>


</main>

<script>
    $(document).ready(function () {
        $('.input_quantity').change(function () {
            var valueSum = <?php echo $this->fcSystem['sanpham_saleoff'] ?>;
            $('.input_quantity').each(function () {
                valueSum = valueSum * parseInt($(this).val());
            })
            var valueSumNumber = number_format(valueSum, 0, '.', '.');
            $('#fld_1543072_1').html(valueSumNumber);
            $('#totalSum').val(valueSum);
        });
    });


    function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
</script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#form_lx .error').hide();
        var uri = $('#form_lx').attr('action');
        $('#form_lx').on('submit', function () {
            var postData = $(this).serializeArray();
            $.post(uri, {
                    post: postData,
                    tuoi: $('#form_lx .tuoi').val(),
                    cannang: $('#form_lx .cannang').val()
                },
                function (data) {
                    var json = JSON.parse(data);
                    $('#form_lx .error').show();
                    if (json.error.length) {
                        $('#form_lx .error').removeClass('alert alert-success').addClass('alert alert-danger');
                        $('#form_lx .error').html('').html(json.error);
                    } else {
                        $('#form_lx .error').removeClass('alert alert-danger').addClass('alert alert-success');
                        $('#form_lx .error').html('').html(json.message);
                        $('#form_lx').trigger("reset");
//                        setTimeout(function () {
//                            location.reload();
//                        }, 8000);
                    }
                });
            return false;
        });
    });
</script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#online_form .error').hide();
        var uri = $('#online_form').attr('action');
        $('#online_form').on('submit', function () {
            var postData = $(this).serializeArray();
            $.post(uri, {
                    post: postData,
                    fullname: $('#online_form .fullname').val(),
                    phone: $('#online_form .phone').val(),
                    address: $('#online_form .address').val(),
                    quantity: $('#online_form .quantity').val()
                },
                function (data) {
                    var json = JSON.parse(data);
                    $('#online_form .error').show();
                    if (json.error.length) {
                        $('#online_form .error').removeClass('alert alert-success').addClass('alert alert-danger');
                        $('#online_form .error').html('').html(json.error);
                    } else {
                        $('#online_form .error').removeClass('alert alert-danger').addClass('alert alert-success');
                        $('#online_form .error').html('').html('Đặt mua thành công! Chúng tôi sẽ liên hệ sớm với quý khách.');
                        $('#online_form').trigger("reset");
                        setTimeout(function () {
                            location.reload();
                        }, 8000);
                    }
                });
            return false;
        });
    });
</script>
<style>
    #fld_8111642_2 {
        width: auto;
        float: right;
        background: #0057af;
        color: #fff;
        height: 40px;
        line-height: 36px;
        padding: 0 10px 15px;
    }
</style>