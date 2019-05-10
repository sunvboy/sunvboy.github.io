

<div class="row-menu">
    <div class="col-md-4 row-0">
        <h3 class="title-col-menu bt-tl1">Thông tin công ty</h3>
        <ul class="menu-col1 col-mn">

            <li class="level0 first-item ">Địa chỉ: <?php echo $this->fcSystem['contact_address'] ?></li>
            <li class="level0 first-item ">Số điện thoại: <?php echo $this->fcSystem['contact_phone'] ?></li>
            <li class="level0 first-item ">Hotline: <?php echo $this->fcSystem['contact_hotline'] ?></li>
            <li class="level0 first-item ">Email: <?php echo $this->fcSystem['contact_email'] ?></li>
            <li class="level0 first-item ">Website: <?php echo $this->fcSystem['contact_web'] ?></li>
        </ul>
    </div>
    <?php $footer_nav = navigations_array('footer', $this->fc_lang); ?>
    <?php if (isset($footer_nav) && is_array($footer_nav) && count($footer_nav)) { ?>
        <?php $i=1; foreach ($footer_nav as $key => $val) { $i++; ?>
            <?php if (isset($val['child']) && is_array($val['child']) && count($val['child'])) { ?>
                <div class="col-md-4 row-0">
                    <h3 class="title-col-menu bt-tl<?php echo $i?>"><?php echo $val['title'] ?></h3>
                    <ul class="menu-col1 col-mn">
                        <?php foreach ($val['child'] as $key => $vals) { ?>
                            <li class="level0 first-item "><a
                                    href="<?php echo $vals['href']; ?>"><?php echo $vals['title']; ?></a></li>
                        <?php } ?>
                        <div class="clear"></div>
                    </ul>
                </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>


</div>