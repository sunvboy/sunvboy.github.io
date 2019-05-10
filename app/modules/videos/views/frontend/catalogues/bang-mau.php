<link href="templates/frontend/resources/css/style-bangmau.css" type="text/css" rel="stylesheet"/>
<script src="templates/frontend/resources/js/tabcontent.js" type="text/javascript"></script>
<link href="templates/frontend/resources/css/tabcontent.css" rel="stylesheet" type="text/css"/>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="main" class="clearfix" role="main">
                <div id="content">
                    <div class="tabs"></div>
                    <div class="region region-content">
                        <div id="block-system-main" class="block block-system block-even clearfix">
                            <div class="block-inner">
                                <div class="content">
                                    <div class="main-content">
                                        <div class="content-bangmau"><h2 class="title-bangmau">MÀU SẮC MỚI</h2>

                                            <p class="caption-title">Lựa chọn màu sắc phù hợp với bạn</p>

                                            <div class="bangmau-select">
                                                <div id="device" class="bangmau-select-item">
                                                    <ul class="tabs" data-persist="true">
                                                        <?php if (isset($products_cat) && is_array($products_cat) && count($products_cat)) { ?>
                                                            <?php $i = 0;
                                                            foreach ($products_cat as $key => $val) {
                                                                $i++; ?>
                                                                <li>
                                                                    <a style="background:url(<?php echo $val['images'] ?>);background-size: 100% 100%;"
                                                                       href="#view<?php echo $i; ?>"></a></li>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                                <div class="tabcontents">

                                                    <?php $i = 0;
                                                    foreach ($products_cat as $key => $val) {
                                                        $i++; ?>
                                                        <div id="view<?php echo $i; ?>">
                                                            <script type="text/javascript">var isAbsolute = false;
                                                                var isFixed = true;
                                                                $(document).ready(function () {
                                                                    $("#devicex<?php echo $i; ?>").gridalicious({
                                                                        gutter: 10,
                                                                        width: 240,
                                                                        animate: true,
                                                                        animationOptions: {
                                                                            speed: 300,
                                                                            duration: 500,
                                                                            complete: onComplete
                                                                        },
                                                                    });
                                                                    function onComplete(data) {
                                                                    }
                                                                });</script>
                                                            <div id="devicex<?php echo $i; ?>" class="bangmau-item">
                                                                <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                                                                    <ul class="tabs" style="border-bottom-color:#831c26"
                                                                        data-persist="true">
                                                                        <?php $j = 0;
                                                                        foreach ($val['post'] as $key => $value) {
                                                                            $j++; ?>
                                                                            <li>
                                                                                <a style="background:<?php echo $value['videos_code'] ?>;color:#ffffff"
                                                                                   href="#views2<?php echo $j ?>"><?php echo $value['title'] ?></a>
                                                                            </li>
                                                                        <?php } ?>
                                                                    </ul>
                                                                <?php } ?>
                                                            </div>

                                                            <div class="tabcontents">
                                                                <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                                                                    <?php $j = 0;
                                                                    foreach ($val['post'] as $key => $value) {
                                                                        $j++; ?>
                                                                        <div id="views2<?php echo $j ?>">
                                                                            <div class="box-item-bangmau">
                                                                                <div class="list-item-bangmau">
                                                                                    <?php $color = explode(",", $value['description']); ?>
                                                                                    <?php foreach ($color as $val) { ?>
                                                                                        <a class="inline"
                                                                                           href="javascript:void();"
                                                                                           style="background:<?php echo $val?>">
                                                                                            <p style="Color:#565151">
                                                                                                <?php echo $val?></p></a>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /block-inner /block --> </div>
                </div>
            </div>
        </div>


    </div>
</div>