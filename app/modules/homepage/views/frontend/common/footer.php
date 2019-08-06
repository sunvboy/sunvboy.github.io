<link rel="stylesheet" href="templates/frontend/css/slick-theme.css" type="text/css" />
<link rel="stylesheet" href="templates/frontend/css/slick.css" type="text/css" />
<script type="text/javascript" src="templates/frontend/js/slick.js"></script>
<script type="text/javascript" src="templates/frontend/js/homepage.js"></script>

<?php $partner = $this->FrontendSlides_Model->Read('partner', $this->fc_lang); ?>
<?php if (isset($partner) && is_array($partner) && count($partner)) { ?>
<div id="section_partner">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="wrap-partner">
                    <h3 class="title">ĐỐI TÁC PHÂN PHỐI <span>chính thức</span></h3>
                    <ul class="ls-partner">
                        <?php foreach ($partner as $key => $val) { ?>
                        <li><img class="img-responsive inline-block" src="<?php echo $val['image']; ?>" alt="<?php echo $val['title']; ?>" title="<?php echo $val['title']; ?>">
                            <a href="javascript:void(0)">
                                <p>
                                    <span style="color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 16px;"><?php echo $this->fcSystem['contact_phone']?></span>
                                </p>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
<?php }?>
<footer id="footer">
    <div class="container-cus">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <p>
                <p>
                    &nbsp;</p>
                <p>
                            <span style="font-size:16px;"><?php echo $this->fcSystem['contact_address']?></span></p>
                <p>
                            <span style="font-size:14px;">Điện thoại: <?php echo $this->fcSystem['contact_phone']?></span></p>
                <p>
                    <span style="font-size:14px;"><?php echo base_url()?></span></p>
                </p>
            </div>
            <div class="col-xs-12 col-md-6 box-right">
                <ul class="ls-social">
                    <li><a href="<?php echo $this->fcSystem['social_facebook']?>" target="_blank" class="bt-facebook">Facebook</a></li>
                    <li><a href="<?php echo $this->fcSystem['social_youtube']?>" target="_blank" class="bt-youtube">Youtube</a></li>
                </ul>

            </div>
        </div>
    </div>
</footer>



<div class="wrap-fixed">
    <a class="bt-control bt-res">Res</a>
    <a class="bt-control bt-download" href="<?php echo $this->fcSystem['homepage_Link']?>" target="_blank">Download</a>
    <div class="wrap-res">
        <div class="title">Hotline</div>
        <ul class="ls-hotline">
            <li><a href="tel:<?php echo $this->fcSystem['contact_phone']?>"><?php echo $this->fcSystem['contact_phone']?></a></li>
            <li><a href="javscript:void();"><?php echo $this->fcSystem['contact_address']?></a></li>
        </ul>

    </div>
    <a id="gotop" class="logo btn-scroll"></a>
    <div class="hidden">
        <div id="startpopup" class="startpopup">
            <div class="content">

            </div>
        </div>
    </div>
    <style type="text/css">
        .wrap-res .renewCaptcha {
            top: 0px;
            bottom: 0px;
        }

        .wrap-res .imgCaptcha {
            margin-bottom: 10px
        }
    </style>
    <script type="text/javascript" src="templates/frontend/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="templates/frontend/js/bootbox.min.js"></script>
    <script type="text/javascript" src="templates/frontend/js/css3-animate-it.js"></script>
    <script type="text/javascript" src="templates/frontend/js/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="templates/frontend/js/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="templates/frontend/js/stickytooltip.js"></script>
    <script type="text/javascript" src="templates/frontend/js/SmoothScroll.js"></script>
    <script type="text/javascript" src="templates/frontend/js/jquery.imagemapster.min.js"></script>

    <link href="templates/frontend/css/animations.css" rel="Stylesheet" rev="Stylesheet" />
    <link href="templates/frontend/css/jquery.fancybox.css" rel="stylesheet">
    <link href="templates/frontend/css/jquery.bxslider.min.css" rel="stylesheet">
    <script type="text/javascript" src="templates/frontend/js/jquery.tint.js"></script>
</div>
</section>