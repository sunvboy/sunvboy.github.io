<footer id="footer-site" class="wow fadeInUp">
    <div class="container">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="logo-footer"><img src="<?php echo $this->fcSystem['homepage_logo1'] ?>"
                                          alt="<?php echo $this->fcSystem['homepage_brandname'] ?>"></div>
            <div class="social-footer">
                <ul>
                    <li><a href="<?php echo $this->fcSystem['social_facebook'] ?>" target="_blank"><img
                                src="templates/frontend/resources/images/f1.png" alt="facebook"></a></li>
                    <li><a href="<?php echo $this->fcSystem['social_youtube'] ?>" target="_blank"><img
                                src="templates/frontend/resources/images/f2.png" alt="youtube"></a></li>
                    <li><a href="<?php echo $this->fcSystem['social_bocongthuong'] ?>" target="_blank"> <img
                                src="templates/frontend/resources/images/f3.png" alt="bộ công thương"></a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="top-footer">
                <div class="item">
                    <ul>
                        <li><img src="templates/frontend/resources/images/phone.png"
                                 alt=""><span>Điện thoại:</span><?php echo $this->fcSystem['contact_phone'] ?></li>
                        <li><img src="templates/frontend/resources/images/email.png"
                                 alt=""><span>Email:</span><?php echo $this->fcSystem['contact_email'] ?></li>
                        <li><img src="templates/frontend/resources/images/ws.png"
                                 alt=""><span>website:</span><?php echo $this->fcSystem['contact_web'] ?></li>
                    </ul>
                </div>
                <div class="item">
                    <h3 class="title-footer"><?php echo $this->fcSystem['homepage_company'] ?></h3>

                    <p class="desc"><?php echo $this->fcSystem['homepage_note'] ?></p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="adress-footer">

                <?php
                $address = $this->Frontendaddress_Model->ReadByCondition(array(
                    'select' => 'id, title, address',
                    'table' => 'address',
                    'where' => array('publish' => 1, 'trash' => 0),
                    'limit' => 100,
                    'order_by' => 'order asc,id desc',
                ));
                ?>
                <?php if (is_array($address) && isset($address) && count($address)) { ?>
                    <?php foreach ($address as $key => $val) { ?>
                        <div class="item-adress">
                            <h4 class="title"><i class="fas fa-map-marker-alt"></i><?php echo $val['title']; ?></h4>

                            <p class="desc"><?php echo $val['address']; ?></p>
                        </div>
                    <?php }
                } ?>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>


</footer>
<script type="text/javascript" src="templates/frontend/resources/js/bootstrap.min.js"></script>
<script type="text/javascript" src="templates/frontend/resources/js/wow.min.js"></script>
<script type="text/javascript" src="templates/frontend/resources/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="templates/frontend/resources/js/carousel.js"></script>

<script src="templates/frontend/resources/js/hc-offcanvas-nav.js?ver=3.3.0"></script>
<script type="text/javascript" src="templates/frontend/resources/js/buong.js"></script>
<script>
    //hieu ung wow------------------------------------------
    wow = new WOW(
        {
            animateClass: 'animated',
            offset: 100,
            callback: function (box) {
                console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
            }
        }
    );
    wow.init();


</script>