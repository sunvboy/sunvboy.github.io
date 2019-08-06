<div class="clear" style="height:20px;"></div>
<main id="main">
    <section id="content">
        <script language="javascript" src="js/my_script.js"></script>

        <div id="sanpham">
            <div class="container">
                <div class="box">
                    <div class="thanh_index wow fadeInUp" data-wow-delay="0.3s"><h2>Liên hệ</h2></div>
                    <div class="clear" style="height:20px;"></div>

                    <div class="form_contact wow fadeInUp" data-wow-delay="0.4s">
                        <p></p>

                        <h2><?php echo $this->fcSystem['homepage_company'] ?></h2>

                        <?php echo $this->fcSystem['contact_contact'] ?>
                    </div>
                    <div class="clear" style="height:20px;"></div>
                    <div class="form_lh wow fadeInUp" data-wow-delay="0.5s">
                        <form method="post" name="frm" action="" enctype="multipart/form-data">
                            <?php $error = validation_errors();
                            echo !empty($error) ? '<div class="callout callout-danger" style="padding:10px;background:rgb(195, 94, 94);color:#fff;margin-bottom:10px;">' . $error . '</div>' : ''; ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xx-12 col-xs-12"
                                 style="padding:5px;box-sizing:border-box;">

                                <label>Họ Tên (mục phải nhập)</label>
                                <input name="fullname" type="text" class="tflienhe" id="ten" placeholder="">

                                <label>Email Của Bạn (mục phải nhập)</label>
                                <input name="email" type="text" class="tflienhe" id="email" placeholder="">

                                <label>Điện Thoại </label>
                                <input name="phone" type="text" class="tflienhe" id="dienthoai" placeholder="">

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xx-12 col-xs-12"  style="padding:5px;box-sizing:border-box;">

                                <label>Địa chỉ</label>
                                <input name="address" type="text" class="tflienhe" id="tieude" placeholder="">

                                <label>Nội Dung</label>
                                <textarea name="message" class="ta_noidung" id="noidung" placeholder=""></textarea>

                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xx-12 col-xs-12">
                                <input type="submit" name="create" value="Gửi" style="background: #000;color: #fff">
                            </div>

                        </form>
                    </div>
                    <div class="khung_phai wow fadeInUp" data-wow-delay='0.5s'>
                        <script>
                            function initialize() {
                                var myLatlng = new google.maps.LatLng(10.7007102,106.6229411,17.77);
                                var mapOptions = {
                                    zoom: 17,
                                    center: myLatlng
                                };

                                var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

                                var contentString = "<table style='text-align:left; font-weight:100;'><tr><th style='font-size:16px; color:#039BB2; font-weight:bold; text-transform: uppercase;'><?php echo $this->fcSystem['homepage_company']?></th></tr><tr><th>Địa chỉ : <?php echo $this->fcSystem['contact_address']?></th></tr><tr><th>Điện Thoại  : <?php echo $this->fcSystem['contact_phone']?></th></tr><tr><th>Hotline  : <?php echo $this->fcSystem['contact_hotline']?></th></tr><tr><th>Email : <?php echo $this->fcSystem['contact_email']?></th></tr></table>";
                                var infowindow = new google.maps.InfoWindow({
                                    content: contentString
                                });

                                var marker = new google.maps.Marker({
                                    position: myLatlng,
                                    map: map,
                                    title: "<?php echo $this->fcSystem['homepage_company']?>"
                                });
                                infowindow.open(map, marker);
                            }

                            google.maps.event.addDomListener(window, 'load', initialize);


                        </script>
                        <div id="map_canvas"></div>
                    </div>
                    <div class="clear" style="height:20px;"></div>
                </div>
            </div>
        </div>
    </section>
    <div class="clear"></div>
</main>