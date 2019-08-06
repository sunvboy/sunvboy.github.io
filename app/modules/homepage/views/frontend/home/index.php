<?php $slide = $this->FrontendSlides_Model->Read('index-slide', $this->fc_lang); ?>
<?php if (isset($slide) && is_array($slide) && count($slide)) { ?>
<div id="section_banner" class="animatedParent animateOnce">
    <div class="bxslider">
        <?php foreach ($slide as $key => $val) { ?>
        <div class='item'  style='background-image: url("<?php echo $val['image']; ?>")'>
        </div>
        <?php } ?>
    </div>
    <div class="slider-content animatedParent"> </div>
</div>
<?php } ?>
<?php if (isset($khonggiansong) && is_array($khonggiansong) && count($khonggiansong)) { ?>
<?php foreach ($khonggiansong as $key => $val) { ?>
<div id="section_about" class="animatedParent animateOnce">
    <div class="container-cus">
        <div class="row">
            <div class="col-xs-12 col-md-5 col-lg-4 fadeInLeftShort animated delay-500">
                <div style="text-align: justify;">
                    <h3 class="title" style="box-sizing: border-box; font-family: MyriadPro, sans-serif; line-height: 1.2em; color: rgb(61, 61, 61); margin-top: 20px; margin-bottom: 30px; font-size: 32px; outline: 0px; border-width: 0px 0px 1px; border-top-style: initial; border-right-style: initial; border-bottom-style: solid; border-left-style: initial; border-top-color: initial; border-right-color: initial; border-bottom-color: rgb(0, 84, 185); border-left-color: initial; border-image: initial; position: relative; padding-bottom: 15px;">
                        <?php echo $val['title']?></h3>
                    <?php echo $val['description']?>
                    <?php $list =   json_decode($val['albums'],TRUE)?>
                    <ul class="ls-about" style="box-sizing: border-box; margin-top: 0px; margin-bottom: 25px; outline: 0px; border: 0px; list-style: none; padding-right: 0px; padding-left: 0px; color: rgb(61, 61, 61); font-family: MyriadPro, sans-serif; font-size: 16px;">
                        <?php if (isset($list) && is_array($list) && count($list)) { ?>
                        <?php foreach ($list as $keyL => $valL) { ?>
                        <li style="box-sizing: border-box; outline: 0px; border: 0px; float: left; width: 128.875px; font-size: 18px; text-transform: uppercase;">
                            <img alt="Số căn hộ" class="img-responsive" src="<?php echo $valL['images']?>" style="box-sizing: border-box; border: 0px; vertical-align: middle; outline: 0px; padding: 0px; display: block; max-width: 100%; width: 60px; height: 32px;" title="Số căn hộ" />
                            <span style="box-sizing: border-box; font-weight: 600; outline: 0px; border: 0px; display: block; line-height: 25px; margin-top: 20px;"><?php echo $valL['title']?></span><span style="box-sizing: border-box; outline: 0px; border: 0px;"><?php echo $valL['description']?></span>
                        </li>
                            <?php }?>
                        <?php }?>
                    </ul>
                </div>

                <div class="clearfix"></div>

            </div>
            <div class="col-xs-12 col-md-7 col-lg-8 fadeInRightShort animated delay-500">
                <img class="img-responsive" src="<?php echo $val['images']?>" alt="<?php echo $val['title']?>">
            </div>
        </div>
    </div>
</div>
<?php }?>
<?php }?>

<style type="text/css">
    #section_about {
        margin-bottom: 3%
    }
</style>

<div id="section_masterplan" class="animatedParent animateOnce">
    <div id="master_plan" class="hover-map">
        <div class="divmap text-center">

            <img alt="Sơ đồ mặt bằng tổng thể" class="img-responsive img-backgroud" width="1920" height="808" src="<?php echo $this->fcSystem['SODOMATBANGTONGTHE_images']?>" />

            <img alt="Sơ đồ mặt bằng tổng thể" class="img-responsive map" width="1920" height="808" src="templates/frontend/images/mat-bang-tong-the-tran.svg" usemap="#mymap" id="imgMap" />
            <map name="mymap">
                <area shape="poly"
                      coords="619, 195, 739, 195, 740, 223, 797, 276, 856, 227, 937, 267, 946, 447, 809, 586, 763, 550, 685, 381, 728, 343, 724, 335, 792, 281, 736, 227, 620, 227"
                      data-key="K4" title="Block D " />
                <area shape="poly"
                      coords="967, 95, 1036, 129, 1008, 158, 1022, 169, 1004, 189, 997, 340, 1020, 358, 1009, 383, 932, 467, 919, 285, 909, 274, 920, 263, 870, 234, 874, 227, 856, 217, 869, 203, 864, 199, 880, 187, 879, 178, 872, 172, 920, 132, 860, 79, 745, 79, 742, 47, 860, 47, 862, 79, 922, 135"
                      data-key="K5" title="Block C" />
                <area shape="poly"
                      coords="1187, 62, 1302, 62, 1301, 101, 1188, 101, 1128, 155, 1171, 175, 1164, 183, 1187, 195, 1182, 205, 1199, 213, 1137, 282, 1145, 289, 1126, 314, 1119, 309, 1086, 344, 1094, 350, 1078, 368, 1065, 432, 997, 390, 1019, 361, 993, 343, 1003, 182, 1014, 175, 1023, 164, 1010, 157, 1053, 119, 1128, 154, 1187, 99"
                      data-key="K6" title="Block B" />
                <area shape="poly"
                      coords="1294, 162, 1411, 161, 1413, 201, 1294, 201, 1264, 231, 1285, 242, 1274, 256, 1278, 262, 1199, 436, 1122, 536, 1086, 516, 1072, 542, 1045, 521, 1078, 361, 1094, 345, 1088, 341, 1122, 307, 1125, 312, 1135, 300, 1138, 284, 1208, 202, 1263, 231, 1295, 199"
                      data-key="K7" title="Block A" />
            </map>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="box-masterplan fadeInLeftShort animated delay-500">
        <p>
            <span style=\ "color: rgb(255, 255, 255); font-family: MyriadPro, sans-serif; font-size: 32px;
            font-weight: 700; text-align: center; text-transform: uppercase; background-color: rgb(15, 113,
            85);\"><?php echo $this->fcSystem['SODOMATBANGTONGTHE_title']?></span></p>
    </div>
</div>
<?php if (isset($vitridatgia) && is_array($vitridatgia) && count($vitridatgia)) { ?>
<?php foreach ($vitridatgia as $key => $val) { ?>
<div id="section_location" class="animatedParent animateOnce">
    <div class="container-cus">
        <div class="row">
            <div class="col-xs-12 col-md-5 col-lg-4 pull-right  fadeInRightShort animated delay-500">
                <h3 class="title" style="box-sizing: border-box; font-family: MyriadPro, sans-serif; line-height: 1.2em; color: rgb(61, 61, 61); margin-top: 0px; margin-bottom: 20px; font-size: 32px; outline: 0px; border: 0px; position: relative;">
                    <?php echo $val['title']?>
                </h3>
                <?php echo $val['description']?>
                <p>
                    <img alt="Xem trên Google Map" class="img-responsive" src="templates/frontend/images/ico-google-map.png" style="box-sizing: border-box; border: 0px; vertical-align: middle; outline: 0px; padding: 0px; display: inline-block; max-width: 100%; margin-right: 15px; width: 41px; height: 41px;"
                         title="Xem trên Google Map" />
                    <a target="_blank" href="<?php echo $this->fcSystem['contact_addressL']?>" class="bt-google-map" style="box-sizing: border-box; color: rgb(97, 135, 197); outline: 0px; border: 0px; cursor: pointer; transition: all 0.3s ease-in-out; position: relative; font-weight: 700; margin-bottom: 15px; display: inline-block; font-family: MyriadPro, sans-serif; font-size: 16px;">Xem tr&ecirc;n Google Map</a>
                </p>
            </div>
            <div class="col-xs-12 col-md-7 col-lg-8  fadeInLefthort animated delay-750">
                <img class="img-responsive" src="<?php echo $val['images']?>" alt="<?php echo $val['title']?>" title="<?php echo $val['title']?>">
            </div>
        </div>
    </div>
</div>
    <?php }?>
<?php }?>
<?php if (isset($tienichvang) && is_array($tienichvang) && count($tienichvang)) { ?>
<?php foreach ($tienichvang as $key => $val) { ?>
<div id="section_utilities" class="animatedParent animateOnce">
    <div class="box-utilities fadeInRightShort animated delay-500">
        <h3 class="title"><span><?php echo $val['title']?></span></h3>
        <?php echo $val['description']?>
        <div class="clearfix"></div>
    </div>
    <div id="master_utilities" class="hover-map">
        <div class="divmap text-center">

            <img alt="<?php echo $val['title']?>" class="img-responsive img-backgroud" width="1920" height="1420" src=" <?php echo $val['images']?>" />

            <img class="img-responsive map" width="1920" height="1420" src="templates/frontend/images/tien-ich-du-an-tran.svg" <map name="myutimap">
                <area shape="poly" coords="666, 51, 687, 42, 733, 37, 773, 48, 919, 130, 947, 164, 959, 201, 958, 392, 939, 435, 914, 459, 768, 540, 734, 549, 698, 549, 624, 514, 520, 451, 493, 421, 481, 362, 483, 205, 495, 161, 535, 122" data-key="U1" href="templates/frontend/images/pic-ho-boi-trann.jpg"
                      class="fancybox" rel="album-tien-ich" title="Hồ bơi tràn" />
                <area shape="poly" coords="244, 797, 244, 626, 255, 583, 282, 553, 440, 465, 484, 459, 523, 467, 680, 555, 706, 586, 717, 619, 717, 814, 692, 857, 664, 882, 512, 963, 482, 968, 448, 963, 409, 946, 285, 872, 259, 848, 245, 818" data-key="U2" href="templates/frontend/images/pic-sanh-chinh.jpg"
                      class="fancybox" rel="album-tien-ich" title="Sảnh chính" />
                <area shape="poly" coords="724, 796, 727, 616, 743, 575, 767, 551, 916, 468, 961, 458, 996, 462, 1165, 554, 1194, 594, 1200, 629, 1199, 812, 1185, 848, 1158, 874, 1000, 961, 955, 968, 927, 961, 776, 880, 749, 856, 734, 831" data-key="U3" href="templates/frontend/images/pic-phong-tap-gym.jpg"
                      class="fancybox" rel="album-tien-ich" title="Phòng tập gym" />
                <area shape="poly" coords="1206, 625, 1219, 587, 1244, 554, 1401, 467, 1455, 460, 1492, 469, 1635, 547, 1664, 576, 1679, 607, 1679, 810, 1669, 844, 1642, 874, 1481, 962, 1444, 969, 1405, 962, 1249, 876, 1216, 840, 1206, 798" data-key="U4" href="templates/frontend/images/pic-shopping-housee.jpg"
                      class="fancybox" rel="album-tien-ich" title="Shopping House" />
                <area shape="poly" coords="50, 960, 198, 880, 236, 874, 284, 883, 435, 967, 462, 997, 476, 1034, 475, 1217, 468, 1247, 439, 1287, 277, 1375, 236, 1382, 204, 1375, 70, 1307, 24, 1274, 1, 1222, 0, 1035, 23, 983" data-key="U5" href="templates/frontend/images/pic-cong-vienn.jpg"
                      class="fancybox" rel="album-tien-ich" title="Công viên" />
                <area shape="poly" coords="484, 1035, 503, 994, 534, 962, 687, 882, 733, 878, 762, 883, 908, 964, 937, 993, 954, 1029, 957, 1212, 950, 1253, 926, 1286, 761, 1376, 731, 1382, 694, 1381, 538, 1302, 503, 1271, 483, 1224" data-key="U6" href="templates/frontend/images/pic-phong-khachh.jpg"
                      class="fancybox" rel="album-tien-ich" title="Phòng khách" />
                <area shape="poly" coords="1438, 1217, 1438, 1046, 1433, 1022, 1413, 986, 1399, 968, 1241, 884, 1184, 878, 1162, 883, 1002, 972, 973, 1009, 963, 1043, 966, 1233, 991, 1279, 1029, 1308, 1174, 1384, 1213, 1384, 1249, 1373, 1301, 1347, 1407, 1286, 1427, 1256"
                      data-key="U7" href="templates/frontend/images/pic-coffee-shop.jpg" class="fancybox" rel="album-tien-ich" title="Coffee shop" />
                <area shape="poly" coords="1447, 1038, 1456, 1009, 1485, 975, 1634, 892, 1679, 880, 1711, 885, 1863, 964, 1894, 987, 1917, 1030, 1918, 1234, 1899, 1277, 1871, 1302, 1724, 1379, 1689, 1389, 1651, 1384, 1488, 1297, 1459, 1269, 1444, 1221, 1446, 1050" data-key="U8"
                      href="templates/frontend/images/pic-khu-vui-choi-tre-em.jpg" class="fancybox" rel="album-tien-ich" title="Khu vui chơi trẻ em" />
            </map>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>


</div>
    <?php }?>
<?php }?>
<?php if (is_array($hinhanh) && isset($hinhanh) && count($hinhanh)) { ?>
<?php foreach ($hinhanh as $key => $value) { ?>
<?php
$href = rewrite_url($value['canonical'], $value['slug'], $value['id'], 'gallerys_catalogues');
?>
<div id="section_picture360">
    <div id="main360">
        <div class=" gutter-0 row-eq-height">
            <div class="col-sm-12 div360 div360-2" style="background: url('<?PHP ECHO $value['images'] ?>');background-repeat: no-repeat;background-size: cover">
                <div class="inner">
                    <a href="<?php echo $href?>">
                        <img src="templates/frontend/images/icon-thuvien.png" class="img-responsive" alt="thư viện hình ảnh" />
                    </a>
                    <h3><strong>Thư Viện Hình Ảnh</strong> </h3>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php } ?>
<?php } ?>
<?php if (is_array($gioithieu) && isset($gioithieu) && count($gioithieu)) { ?>
<?php foreach ($gioithieu as $key => $val) { ?>
<div id="section_investor" class="animatedParent animateOnce">
    <div class="container-cus">
        <div class="row">
            <div class="col-xs-12">
                <img class="img-responsive margintop30" src="<?php echo $val['images'] ?>" alt="<?php echo $val['title'] ?>" title="<?php echo $val['title'] ?>">
            </div>
            <div class='clearfix'></div>
            <div class="box-investor fadeInUpShort animated delay-500">
                <div class="box-left">
                    <?php echo $val['description'] ?>
                </div>
                <div class="box-right">
                    <?php $adversite1 = $this->FrontendSlides_Model->Read('adversite-1', $this->fc_lang); ?>
                    <?php $ReadGroupSlide1 = $this->FrontendSlides_Model->ReadGroupSlide('adversite-1', $this->fc_lang); ?>
                    <?php if (isset($adversite1) && is_array($adversite1) && count($adversite1)) { ?>
                        <div class="line-title"><span><?php echo $ReadGroupSlide1['title']?></span></div>
                        <ul class="ls-investor first">
                         <?php foreach ($adversite1 as $keyA => $valA) { ?>
                            <li><img class="img-responsive" src="<?php echo $valA['image']?>" alt="<?php echo $valA['title']?>" title="<?php echo $valA['title']?>"></li>
                        <?php } ?>

                        </ul>
                     <?php } ?>
                    <?php $adversite2 = $this->FrontendSlides_Model->Read('adversite-2', $this->fc_lang); ?>
                    <?php $ReadGroupSlide2 = $this->FrontendSlides_Model->ReadGroupSlide('adversite-2', $this->fc_lang); ?>
                    <?php if (isset($adversite2) && is_array($adversite2) && count($adversite2)) { ?>
                        <div class="line-title"><span><?php echo $ReadGroupSlide1['title']?></span></div>
                        <ul class="ls-investor first">
                            <?php foreach ($adversite2 as $keyA => $valA) { ?>
                                <li><img class="img-responsive" src="<?php echo $valA['image']?>" alt="<?php echo $valA['title']?>" title="<?php echo $valA['title']?>"></li>
                            <?php } ?>

                        </ul>
                    <?php } ?>
                </div>
                <div class='clearfix'></div>
            </div>
        </div>
    </div>

</div>
    <?php }
} ?>
<?php if (is_array($hotrotaichinh) && isset($hotrotaichinh) && count($hotrotaichinh)) { ?>
<?php foreach ($hotrotaichinh as $key => $value) { ?>
<?php
$href = rewrite_url($value['canonical'], $value['slug'], $value['id'], 'articles_catalogues');
?>
<?php if (is_array($value['post']) && isset($value['post']) && count($value['post'])) { ?>

<div id="section_support">
    <div class="container-cus">
        <h2 class="background double"><span><?php echo $value['title'] ?></span></h2>
        <div class="row gutter-0 row-eq-height">
        <?php $i = 0;
        foreach ($value['post'] as $keyp => $val) {
            $i++; ?>
            <?php
            $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');
            $image = getthumb($val['images'], TRUE);
            $description = $val['description'];
            ?>
            <div class="col-sm-6 ">
                <div class="main">
                    <h3 class="title"><?php echo $val['title'] ?></h3>
                    <?php echo $description ?>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
</div>
        <?php } ?>
    <?php } ?>
<?php } ?>
<style type="text/css">
    #section_support .col-sm-6:nth-child(2)>.main,
    #section_support .col-sm-6:nth-child(2)>.main h3 {
        background: #197a5e;
        color: white
    }

    #section_support .col-sm-6:nth-child(2)>.main h3:after {
        background: white
    }
</style>
<?php if (is_array($tintuc) && isset($tintuc) && count($tintuc)) { ?>
<?php foreach ($tintuc as $key => $value) { ?>
<?php
$href = rewrite_url($value['canonical'], $value['slug'], $value['id'], 'articles_catalogues');
?>
<?php if (is_array($value['post']) && isset($value['post']) && count($value['post'])) { ?>
<div id="section_news" class="animatedParent animateOnce">
    <div class="container">
        <div class="title fadeInLeftShort animated"><?php echo $value['title']?></div>

        <div class="news-content row">
            <div class="slick">
        <?php foreach ($value['post'] as $keyp => $val) {
            $hrefA = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');
            $image = getthumb($val['images'], TRUE);
            $description = cutnchar($val['description'], 300);
            ?>
                <div class="item">
                    <a class="news-thumbnail" href="<?php echo $hrefA ?>" style="background-image:url('<?php echo $image ?>');"></a>
                    <div class="news-info">
                        <div class="date-time"><?php echo show_time($val['created'], 'd/m/y'); ?></div>
                        <div class="title">
                            <a href="<?php echo $hrefA ?>"><?php echo $val['title'] ?></a>
                        </div>
                    </div>
                </div>
            <?php }?>
            </div>
        </div>
    </div>
</div>
        <?php } ?>
    <?php } ?>
<?php } ?>

<div id="section_register" class="animatedParent animateOnce">
    <img class="img-responsive" style="width:100%" src="<?php echo $this->fcSystem['banner_banner1']?>" alt="Thông tin liên lạc" title="Thông tin liên lạc">
    <div class="wrap-register container-cus">
        <div class="row">
            <div class="col-xs-12">
                <div class="contact-form fadeInDownShort animated delay-500">
                    <h3 class="title">Liên Hệ</h3>

                    <div class="row">
                        <form action="mailsubricre.html" method="post" id="sform_footer">
                            <div class="col-md-12 col-xs-12">
                                <div class="error uk-alert"></div>
                                <input type="hidden" name="type" value="1">

                            </div>
                            <div class="item col-xs-12 col-sm-6">
                                <input type="text" id="tendaydu" name="fullname" class="textbox txtcontactName fullname" placeholder="Họ tên" />
                            </div>
                            <div class="item col-xs-12 col-sm-6">
                                <input class="textbox txtcontactMobile phone" name="phone" id="dienthoai" type="tel" value="" minlength="10" maxlength="18" placeholder="Điện thoại"/>

                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <input name="email" type="text" id="email" class="textbox txtcontactEmail email" value="" placeholder="Email"  />
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <input name="address" type="text" id="diachi" class="textbox txtcontactAddress address" value="" placeholder="Địa chỉ" />
                            </div>
                            <div class="col-xs-12 col-sm-12">
                                <textarea name="message" cols="" rows="" id="noidung" class="textbox textarea txtcontactMessage message" placeholder="Nội dung"></textarea>
                            </div>
                            <div class="clearfix"></div>

                            <div class="col-xs-12 col-sm-12 text-center">
                                <button type="submit" id="cmdSend" class="cmdContactSend bt-send" style="border: 0px">Gửi</button>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                        <script type="text/javascript" charset="utf-8">
                            $(document).ready(function () {
                                $('#sform_footer .error').hide();
                                var uri = $('#sform_footer').attr('action');
                                $('#sform_footer').on('submit', function () {
                                    var postData = $(this).serializeArray();
                                    $.post(uri, {post: postData, fullname: $('#sform_footer .fullname').val(), phone: $('#sform_footer .phone').val(), email: $('#sform_footer .email').val(), address: $('#sform_footer .address').val()},
                                        function (data) {
                                            var json = JSON.parse(data);
                                            $('#sform_footer .error').show();
                                            if (json.error.length) {
                                                $('#sform_footer .error').removeClass('alert alert-success').addClass('alert alert-danger');
                                                $('#sform_footer .error').html('').html(json.error);
                                            } else {
                                                $('#sform_footer .error').removeClass('alert alert-danger').addClass('alert alert-success');
                                                $('#sform_footer .error').html('').html('Đăng ký thành công!.');
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .imgcode,
    .imgCaptcha {
        margin-left: 0
    }

    .contact-form .captcha-image {
        position: relative;
    }

    .renewCaptcha {
        color: white;
        background: #008484;
        position: absolute;
        right: 0px;
        top: 5px;
        bottom: 5px;
        width: 30px;
        text-align: center;
        line-height: 30px
    }
</style>
