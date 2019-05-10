<script src="templates/frontend/resources/cart/uikit.min.js"></script>
<link href="templates/frontend/resources/cart/uikit.modify.css" rel="stylesheet"/>
<link href="templates/frontend/resources/cart/library.css" rel="stylesheet"/>
<link href="templates/frontend/resources/cart/reset.css" rel="stylesheet"/>
<style>
    .wapper_pos1{display: none}
</style>
<div class="clearfix"></div>
<style type="text/css">

    @media (min-width: 1220px)
    {
        .uk-container {
            max-width: 1140px;
            padding: 0;
        }
    }
    .paymentsuccess-2{
        margin-top: 20px;;
    }
    .paymentsuccess-2 .payment .step .item {
        float: left;
        width: 33.33%;
    }

    .paymentsuccess-2 .payment .step .link {
        display: block;
        padding: 8px 35px 8px 30px;
        font-size: 13px;
        line-height: 20px;
        color: #333;
        font-weight: bold;
        background: #f0f0f0;
        position: relative;
    }

    .paymentsuccess-2 .payment .step .item:first-child .link {
        padding-left: 20px;
    }

    .paymentsuccess-2 .payment .step .active .link {
        background: #f4f9fd;
    }

    .paymentsuccess-2 .payment .step .link:before, .paymentsuccess-2 .payment .step .link:after {
        content: "";
        position: absolute;
        top: 50%;
        -webkit-transform: translate(0, -50%);
        -ms-transform: translate(0, -50%);
        -o-transform: translate(0, -50%);
        transform: translate(0, -50%);
        border-top: 20px solid transparent;
        border-bottom: 20px solid transparent;
        border-left: 13px solid;
        right: -13px;
    }

    .paymentsuccess-2 .payment .step .link:before {
        border-left-color: #f4f9fd;
        right: -13px;
        z-index: 1;
    }

    .paymentsuccess-2 .payment .step .link:after {
        z-index: 2;
        border-left-color: #f1f1f1;
    }

    .paymentsuccess-2 .payment .step .step-3 .link:after, .paymentsuccess-2 .payment .step .step-3 .link:after {
        display: none;
    }

    .paymentsuccess-2 .payment .step .active .link:after {
        border-left-color: #f4f9fd;
    }

    .paymentsuccess-2 .payment .step .number {
        display: inline-block;
        margin-right: 5px;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #999;
        color: #fff;
        text-align: center;
        font-size: 12px;
        line-height: 24px;
    }

    .paymentsuccess-2 .payment .step .complete .number {
        text-indent: -999999px;
        background: url(templates/backend/images/icon-checked.png) 0% 0% no-repeat;
    }

    .paymentsuccess-2 .payment .step .active .number {
        background: #0492d5;
    }

    .paymentsuccess-2 .information .uk-panel, .paymentsuccess-2 .completed {
        border: 1px solid #eee;
        background: #fff;
        padding: 5px;
    }

    .paymentsuccess-2 .information .panel-head {
        padding: 10px 15px;
        background: #f7f7f7;
        border-bottom: 1px solid #eee;
    }

    .paymentsuccess-2 .information .panel-head .title {
        font-size: 14px;
        margin: 0;
        color: #333;
    }

    .paymentsuccess-2 .information .panel-head .title .number {
        color: #666;
        font-size: 13px;
    }

    .paymentsuccess-2 .information .panel-head .change {
        color: #0386ca;
        font-size: 12px;
    }

    .paymentsuccess-2 .listorder > .item {
        padding: 15px 15px;
        overflow: hidden;
    }

    .paymentsuccess-2 .listorder > .item + .item {
        border-top: 1px dotted #ccc;
    }

    .paymentsuccess-2 .listorder .colimg {
        width: 80px;
        margin-right: 15px;
    }

    .paymentsuccess-2 .listorder .colinfo {
        width: calc(100% - 95px);
        -moz-width: calc(100% - 95px);
        -webkit-width: calc(100% - 95px);
        -o-width: calc(100% - 95px);
        -ms-width: calc(100% - 95px)
    }

    .paymentsuccess-2 .listorder .colimg .img {
        height: 80px;
        border: 1px solid #ebebeb;
    }

    .paymentsuccess-2 .listorder .colinfo .title {
        font-size: 13px;
        line-height: 18px;
        margin-bottom: 10px;
        width: 70%;
        height: 54px;
        font-weight: bold;
    }

    .paymentsuccess-2 .listorder .colinfo .title .link {
        color: #555;
    }

    .paymentsuccess-2 .listorder .colinfo .title .link:hover {
        color: #288ad6;
    }

    .paymentsuccess-2 .listorder .colinfo .price {
        font-size: 13px;
        line-height: 18px;
        text-align: right
    }

    .paymentsuccess-2 .total {
        padding: 8px 15px;
        border-top: 1px solid #ebebeb;
    }

    .paymentsuccess-2 .total .tt-price {
        border-top: 1px dashed #ccc;
        padding-top: 15px;
    }

    .paymentsuccess-2 .total .tt-price .price {
        color: #d60c0c;
    }

    .paymentsuccess-2 .completed .heading .text {
        position: relative;
        display: inline-block;
        padding: 7px 30px;
        line-height: 24px;
        font-size: 16px;
        color: #00af1d;
        font-weight: bold;
        text-align: center;
        text-transform: uppercase;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, .16);
        -webkit-transform: translate(0, -50%);
        -ms-transform: translate(0, -50%);
        -o-transform: translate(0, -50%);
        transform: translate(0, -50%);
    }

    .paymentsuccess-2 .completed .panel-body {
        padding: 0 20px 20px 20px;
    }

    .paymentsuccess-2 .infoorder .item {
        position: relative;
        padding-left: 15px;
    }

    .paymentsuccess-2 .infoorder .item:before {
        content: "";
        display: block;
        position: absolute;
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: #999;
        left: 0px;
        top: 7px;
    }

    .paymentsuccess-2 .infoorder .price span {
        font-weight: bold;
        color: #c10017;
    }

    .paymentsuccess-2 .support .link {
        font-weight: bold;
        color: #288ad6;
    }

    .paymentsuccess-2 .completed .label {
        padding: 5px 10px;
        text-transform: uppercase;
        background: #000;
    }

    .paymentsuccess-2 .infoorder .item {
        position: relative;
        padding-left: 15px
    }

    .paymentsuccess-2 .infoorder .item:before {
        content: "";
        display: block;
        position: absolute;
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: #999;
        left: 0px;
        top: 7px
    }

    .paymentsuccess-2 .infoorder .price span {
        font-weight: bold;
        color: #c10017
    }

    .paymentsuccess-2 .support .link {
        font-weight: bold;
        color: #288ad6
    }



    .confirm {
        border: 0;
        padding: 8px 15px;
        border-radius: 5px !important;
        background: #87020a;
        color: #fff !important;
        -webkit-box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.75);
        box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.75);
        cursor: pointer;
    }

    .picture.ec-cover {
        padding: 10px;
    }

    .confirm:hover {
        background: #e60000;
    }
</style>
<!-- </css> -->
<!-- <html> -->

<form class="uk-form" method="post" action="">
    <section class="paymentsuccess-2" style="margin-bottom: 20px">
        <div class="col-md-12">
            <div class="box_cart">
                <div class="payment">
                    <ul class="uk-list uk-clearfix step">
                        <li class="item step-1 complete"><a class="link" href="" title=""><span
                                    class="number">1</span> <?php echo $this->lang->line('order_payment') ?></a></li>
                        <li class="item step-2 complete"><a class="link" href="" title=""><span
                                    class="number">2</span> <?php echo $this->lang->line('order_payment_information') ?>
                            </a></li>
                        <li class="item step-3 active"><a class="link" href="" title=""><span
                                    class="number">3</span> <?php echo $this->lang->line('order_payment_succesfully') ?>
                            </a></li>
                    </ul>
                </div>
                <div style="clear: both"></div>
                <!-- .payment -->
                <div class="uk-grid uk-grid-medium" style="margin-top: 20px;">
                    <div class="uk-width-medium-6-10">
                        <div class="uk-panel completed mb20">
                            <header class="panel-head">

                                <h1 class="heading uk-text-center"><span class="text"><i
                                            class="fa fa-check"></i> <?php echo $this->lang->line('order_payment_succesfully') ?></span>
                                </h1></header>
                            <div class="panel-body">
                                <div class="thank mb20">Cảm ơn
                                    <strong><?php echo(($payment['gender'] != '') ? (($payment['gender'] == 0) ? '' . $this->lang->line('brother') . ' ' : '' . $this->lang->line('older_sister') . ' ') : '' . $this->lang->line('your') . ' '); ?><?php echo $payment['fullname']; ?></strong> <?php echo $this->lang->line('give_for_us') ?> <?php echo $this->fcSystem['homepage_company']; ?> <?php echo $this->lang->line('payment_note') ?>
                                </div>
                                <div class="label mb10"><?php echo $this->lang->line('payment_information') ?>:</div>
                                <div class="infoorder mb15" style="margin-top: 20px;">
                                    <div class="item mb5"><strong>Số khách(người lớn)
                                            :</strong> <?php echo !empty($payment['person']) ? $payment['person'] : '-'; ?>
                                    </div>
                                    <div class="item mb5"><strong>Số khách(trẻ em)
                                            :</strong> <?php echo !empty($payment['child']) ? $payment['child'] : '-'; ?>
                                    </div>
                                    <div class="item mb5"><strong><?php echo $this->lang->line('fullname_customers') ?>
                                            :</strong> <?php echo !empty($payment['fullname']) ? $payment['fullname'] : '-'; ?>
                                    </div>
                                    <div class="item mb5"><strong><?php echo $this->lang->line('phone_customers') ?>
                                            :</strong> <?php echo !empty($payment['phone']) ? $payment['phone'] : '-'; ?>
                                    </div>
                                    <div class="item mb5">
                                        <strong>Email:</strong> <?php echo !empty($payment['email']) ? $payment['email'] : '-'; ?>
                                    </div>
                                    <div class="item mb5" style="display: none">
                                        <strong>Địa chỉ
                                            :</strong> <?php echo !empty($payment['address']) ? $payment['address'] : '-'; ?>
                                    </div>
                                    <div class="item mb5">
                                        <strong>Ghi chú
                                            :</strong> <?php echo !empty($payment['message']) ? $payment['message'] : '-'; ?>
                                    </div>


                                </div>
                                <div class="support"><?php echo $this->lang->line('order_payment_succesfully_before') ?>

                                    <a href="tel:<?php echo $this->fcSystem['contact_phone']; ?>" title=""
                                       class="link"><?php echo $this->fcSystem['contact_phone']; ?></a>
                                </div>
                            </div>
                            <!-- .panel-body -->
                        </div>
                        <!-- .uk-panel -->
                    </div>
                    <!-- .uk-width -->

                    <div class="uk-width-medium-4-10 information">
                        <div class="uk-panel">
                            <header class="panel-head uk-flex uk-flex-middle uk-flex-space-between">
                                <h3 class="title"><span class="text"><?php echo $this->lang->line('order') ?> <span
                                            class="number">(<?php echo number_format($payment['quantity']); ?> <?php echo $this->lang->line('products') ?>
                                            )</span></span></h3>
                            </header>
                            <div class="panel-body">
                                <?php $cart = json_decode($payment['data'], TRUE);
                                if (isset($cart) && is_array($cart) && count($cart)) { ?>
                                    <ul class="uk-list listorder">
                                        <?php $i = 1;
                                        foreach ($cart as $key => $val) {
                                            $val['detail']['href'] = rewrite_url($val['detail']['canonical'], $val['detail']['slug'], $val['detail']['id'], 'products');
                                            $price = ($val['detail']['saleoff']) ? $val['detail']['saleoff'] : $val['detail']['price']; ?>
                                            <li class="item uk-clearfix">
                                                <div class="colimg uk-float-left">
                                                    <a href="<?php echo $val['detail']['href']; ?>"
                                                       title="<?php echo htmlspecialchars($val['detail']['title']); ?>"
                                                       class="img img-scaledown" target="_blank"><img
                                                            src="<?php echo getthumb($val['detail']['images']); ?>"
                                                            alt="<?php echo htmlspecialchars($val['detail']['title']); ?>"/></a>
                                                </div>
                                                <div class="colinfo uk-float-right">
                                                    <div class="row uk-flex uk-flex-space-between mb10">
                                                        <div class="title ec-line-3"><a
                                                                href="<?php echo $val['detail']['href']; ?>"
                                                                title="<?php echo htmlspecialchars($val['detail']['title']); ?>"
                                                                class="link"
                                                                target="_blank"><?php echo $val['detail']['title']; ?></a><br>

                                                        </div>
                                                        <div class="price">
                                                            <div class="tt-price">
                                                                <strong><?php echo number_format($price); ?><?php echo $this->lang->line('products_currency') ?></strong>
                                                            </div>
                                                            <div class="quantity">
                                                                x<?php echo number_format($val['qty']); ?></div>
                                                            <div class="tt-price">
                                                                <strong><?php echo number_format($price * $val['qty']); ?><?php echo $this->lang->line('products_currency') ?></strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                                <div class="total">
                                    <div class="row uk-flex uk-flex-middle uk-flex-space-between mb10">
                                        <div class="title"><?php echo $this->lang->line('cart_products_total') ?></div>
                                        <div class="price">
                                            <strong><?php echo number_format($payment['total_price']); ?><?php echo $this->lang->line('products_currency') ?></strong>
                                        </div>
                                    </div>

                                    <div class="row tt-price uk-flex uk-flex-middle uk-flex-space-between">
                                        <div class="title"><?php echo $this->lang->line('payment_money_after') ?></div>
                                        <div class="price">
                                            <strong><?php echo number_format($payment['total_price']); ?><?php echo $this->lang->line('products_currency') ?></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .uk-panel -->
                    </div>
                    <!-- .uk-width -->
                </div>
                <!-- .uk-grid -->
                <div class="uk-text-center mt20">
                    <input type="submit" value="<?php echo $this->lang->line('receiving_mail_system') ?>"
                           class="confirm" name="confirm"/>
                </div>
            </div>
        </div>
    </section>
    <!-- .paymentsuccess-2 -->
    <!-- </html> -->
</form>
<div class="clearfix"></div>
	