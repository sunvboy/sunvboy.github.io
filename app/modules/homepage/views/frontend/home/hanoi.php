<main>
    <?php
    $address = $this->Frontendaddress_Model->ReadByCondition(array(
        'select' => 'id, title, address,type,phone,size,maps,timelv,albums',
        'table' => 'address',
        'where' => array('publish' => 1, 'ishome' => 1, 'trash' => 0),
        'limit' => 1,
        'order_by' => 'id desc',
    ));
    ?>
    <?php if (is_array($address) && isset($address) && count($address)) { ?>
        <?php foreach ($address as $keys => $vals) { ?>
            <div class="title-bread">
                <h1> Hệ thống cửa hàng Hà Nội </h1>

                <p id="breadcrumbs">
            <span>
                <span>
                    <a href="<?php echo base_url() ?>"> Trang chủ</a>


                    » <span class="breadcrumb_last">Hệ thống cửa hàng <?php echo $vals['title']; ?></span>


                </span>
            </span>
                </p>
            </div>
            <div id="primary" class="content-area">
                <div class="container">
                    <div class="row">
                        <div id="main" class="col-lg-9 col-md-9 col-sm-12 col-xs-12 site-main-cat">

                            <div class="maps">
                                <?php echo $vals['maps']; ?>
                            </div>
                            <div id="hethong" style="margin-top: 10px">
                                <p><strong style="color: #e32930;"><?php echo $vals['title']; ?></strong></p>

                                <p><i class="fa fa-map-marker" aria-hidden="true"></i> Địa chỉ:
                                    <strong><?php echo $vals['address']; ?></strong><br>
                                    <i class="fa fa-phone" aria-hidden="true"></i> Hotline:
                                    <strong><?php echo $vals['phone']; ?></strong><br>
                                    <i class="fa fa-phone" aria-hidden="true"></i> Phòng vip:
                                    <strong><?php echo $vals['size']; ?></strong><br>
                                    <i class="fa fa-clock-o" aria-hidden="true"></i> Giờ mở cửa:
                                    <strong><?php echo $vals['timelv']; ?>  </strong><br>
                                    <i class="fa fa-facebook" aria-hidden="true"></i> Fanpage:
                                    <strong><?php echo $vals['type']; ?></strong>
                                </p>
                            </div>
                            <div style="clear: both;height: 20px"></div>
                            <?php $albums = json_decode($vals['albums'], TRUE); ?>
                            <div class="row">
                                <?php if (isset($albums) && is_array($albums) && count($albums)) { ?>
                                    <?php foreach ($albums as $keyp => $valu) { ?>
                                        <div class="col-md-6 col-xs-12 col-sm-12" style="margin-bottom: 30px">

                                            <a href="<?php echo $valu['images']; ?>" data-fancybox="images" class="h_7065"style="object-fit: cover"><img
                                                    src="<?php echo $valu['images']; ?>" alt="hình ảnh nhà hàng"></a>


                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>


                            <style>
                                #hethong {
                                    font-size: 15px;
                                }
                            </style>
                        </div>
                        <!-- #main -->
                        <?php echo $this->load->view('homepage/frontend/common/aside') ?>
                        <!-- .sidebar-right -->

                    </div>
                    <!--.row -->
                </div>
                <!-- .container -->
            </div>
        <?php }
    } ?>
</main>
<script>
    $('[data-fancybox="images"]').fancybox({
        thumbs: {
            autoStart: true
        }
    })
</script>
<script src="templates/frontend/resources/js/jquery.fancybox.min.js"></script>
<link href="templates/frontend/resources/css/jquery.fancybox.min.css" rel="stylesheet"/>