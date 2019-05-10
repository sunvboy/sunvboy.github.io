<div class="clearfix"></div>
<!-- <html> -->
<main>
    <section class="order-1">
        <div class="col-md-12">
            <div class="box_cart mb20">
                <form method="post" action="">
                    <div class="payment mtb20">
                        <ul class="uk-list uk-clearfix step">
                            <li class="item step-1 complete"><a class="link" href="<?php echo base_url(); ?>"
                                                                title="Mua hàng"><span
                                        class="number">1</span> <?php echo $this->lang->line('order_payment') ?></a>
                            </li>
                            <li class="item step-2 active"><a class="link" href="<?php echo site_url('dat-mua'); ?>"
                                                              title=""><span
                                        class="number">2</span> <?php echo $this->lang->line('order_payment_information') ?>
                                </a>
                            </li>
                            <li class="item step-3"><a class="link" href="" onclick="return false;" title=""><span
                                        class="number">3</span> <?php echo $this->lang->line('order_payment_succesfully') ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- .payment -->
                    <div class="uk-grid uk-grid-medium information">
                        <div class="uk-width-medium-6-10">
                            <div class="uk-panel customer mb20">
                                <header class="panel-head"><h3 class="title"><span
                                            class="text"><?php echo $this->lang->line('payment_information') ?></span>
                                    </h3>
                                </header>
                                <div class="panel-body">
                                    <?php $error = validation_errors();
                                    if (isset($error) && !empty($error)) { ?>
                                        <div class="">
                                            <div class="alert alert-danger">
                                                <?php echo $error; ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class=" uk-clearfix mb15">
                                        <div class="col left"><label for="" class="label">Hệ thống nhà hàng <span
                                                    class="no-required"></span></label></div>
                                        <div class="col right">
                                            <select name="hethong" class="form-control title">
                                                <option value="">--- Nhà hàng trong hệ thống ---</option>
                                                <?php
                                                $address = $this->Frontendaddress_Model->ReadByCondition(array(
                                                    'select' => 'id, title, address,type,phone,size,email',
                                                    'table' => 'address',
                                                    'where' => array('publish' => 1, 'trash' => 0),
                                                    'limit' => 100,
                                                    'order_by' => 'id asc',
                                                ));
                                                ?> <?php if (is_array($address) && isset($address) && count($address)) { ?>
                                                    <?php foreach ($address as $key => $val) { ?>
                                                        <option
                                                            value="<?php echo $val['email']; ?>"><?php echo $val['title']; ?></option>
                                                    <?php }
                                                } ?>
                                            </select>


                                        </div>
                                    </div>
                                    <div class=" uk-clearfix mb15">
                                        <div class="col left"><label for=""
                                                                     class="label">Số khách(người lớn)</label>
                                        </div>
                                        <div class="col right"><input type="text" name="person"
                                                                      class="text uk-width-1-1 form-control"
                                                                      placeholder="Số khách(người lớn)"/></div>
                                    </div>
                                    <div class=" uk-clearfix mb15">
                                        <div class="col left"><label for=""
                                                                     class="label">Số khách(trẻ em)</label>
                                        </div>
                                        <div class="col right"><input type="text" name="child"
                                                                      class="text uk-width-1-1 form-control"
                                                                      placeholder="Số khách(trẻ em)"/></div>
                                    </div>
                                    <div class=" uk-clearfix mb15">
                                        <div class="col left"><label for=""
                                                                     class="label">Họ và tên</label>
                                        </div>
                                        <div class="col right"><input type="text" name="fullname"
                                                                      class="text uk-width-1-1 form-control"
                                                                      placeholder="Họ và tên"/></div>
                                    </div>
                                    <div class=" uk-clearfix mb15">
                                        <div class="col left"><label for=""
                                                                     class="label">Số điện thoại</label>
                                        </div>
                                        <div class="col right"><input type="text" name="phone"
                                                                      class="text uk-width-1-1 form-control"
                                                                      placeholder="Số điện thoại"/></div>
                                    </div>

                                    <div class=" uk-clearfix mb15">
                                        <div class="col left"><label for="" class="label">Email <span
                                                    class="no-required"></span></label></div>
                                        <div class="col right"><input type="text" name="email"
                                                                      class="text uk-width-1-1 form-control"
                                                                      placeholder="supportxyz@gmail.com"/></div>
                                    </div>

                                    <div class=" provincial uk-clearfix mb15" style="display: none">
                                        <div class="col left"><label for=""
                                                                     class="label">Tỉnh/Thành phố</label>
                                        </div>
                                        <div class="col right">
                                            <?php echo form_dropdown('cityid', location_dropdown('Tỉnh/Thành Phố', array('parentid' => 0)), set_value('cityid'), 'class="form-control"  style="width: 100%;" id="cityid"'); ?>
                                        </div>
                                    </div>

                                    <div class=" provincial uk-clearfix mb15" style="display: none">
                                        <div class="col left"><label for=""
                                                                     class="label">Quận/Huyện</label>
                                        </div>
                                        <div class="col right">
                                            <?php echo form_dropdown('districtid', array('--Quận/Huyện--'), set_value('districtid'), 'class="form-control"  style="width: 100%;" id="districtid"'); ?>
                                        </div>
                                    </div>

                                    <div class=" uk-clearfix mb15" style="display: none">
                                        <div class="col left"><label for=""
                                                                     class="label">Địa chỉ</label>
                                        </div>
                                        <div class="col right"><input type="text" name="address"
                                                                      class="text uk-width-1-1 form-control"
                                                                      placeholder="Địa chỉ giao hàng"/></div>
                                    </div>
                                    <div class=" uk-clearfix mb15">
                                        <div class="col left"><label for=""
                                                                     class="label">Ghi chú
                                                <span class="no-required"></span></label></div>
                                        <div class="col right"><textarea name="message"
                                                                         class="text uk-width-1-1 form-control"
                                                                         placeholder="Ghi chú"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="continue uk-text-right mb20">
                                <button type="submit" name="create" value="create"
                                        class="uk-button btn">Đặt hàng
                                </button>
                            </div>
                        </div>
                        <!-- .uk-width -->

                        <div class="uk-width-medium-4-10">
                            <div class="uk-panel">
                                <header class="panel-head uk-flex uk-flex-middle uk-flex-space-between">
                                    <h3 class="title"><span class="text">Sản phẩm<span
                                                class="number"> (<?php echo number_format($this->cart->total_items()); ?>
                                                sản phẩm)</span></span></h3>
                                    <?php /* <a class="change" href="" title="">Thay đổi</a> */ ?>
                                </header>
                                <div class="panel-body">
                                    <?php ?>
                                    <?php if (isset($cart) && is_array($cart) && count($cart)) { ?>
                                        <ul class="uk-list listorder">
                                            <?php $i = 1;
                                            foreach ($cart as $key => $val) {
                                                $val['detail']['href'] = rewrite_url($val['detail']['canonical'], $val['detail']['slug'], $val['detail']['id'], 'products');
                                                $price = ($val['detail']['saleoff']) ? $val['detail']['saleoff'] : $val['detail']['price']; ?>
                                                <li class="item uk-clearfix">
                                                    <input name="quantity" value="<?php echo $val['rowid'] ?>"
                                                           class="quantity ajax-quantity" type="hidden">

                                                    <div class="colimg uk-float-left">
                                                        <a href="<?php echo $val['detail']['href']; ?>"
                                                           title="<?php echo htmlspecialchars($val['detail']['title']); ?>"
                                                           class="img img-scaledown" target="_blank"><img
                                                                src="<?php echo getthumb($val['detail']['images']); ?>"
                                                                alt="<?php echo htmlspecialchars($val['detail']['title']); ?>"/></a>
                                                    </div>
                                                    <div class="colinfo uk-float-right">
                                                        <div class=" uk-flex uk-flex-space-between mb10">
                                                            <div class="title ec-line-3"><a
                                                                    href="<?php echo $val['detail']['href']; ?>"
                                                                    title="<?php echo htmlspecialchars($val['detail']['title']); ?>"
                                                                    class="link"
                                                                    target="_blank"><?php echo $val['detail']['title']; ?></a><br/>


                                                                <div style="clear: both"></div>
                                                                <span class="delete delete_item"><i
                                                                        class="fa fa-trash"></i>Xóa</span>
                                                            </div>
                                                            <div class="price_tt">
                                                                <div
                                                                    class="tt-price"><?php echo number_format($price); ?>
                                                                    đ
                                                                </div>
                                                                <div class="quantity" style="color:red;">x<input
                                                                        class="fc-cart-update"
                                                                        data-id="<?php echo $val['rowid'] ?>"
                                                                        type="text"
                                                                        value="<?php echo number_format($val['qty']); ?>"
                                                                        name="<?php echo $i ?>[qty]"
                                                                        style="width:35px;text-align: center;margin-left: 10px;height: 25px;border-color: #ececec;"/>
                                                                </div>
                                                                <div class="tt-price">
                                                                    <strong><?php echo number_format($price * $val['qty']); ?>
                                                                        đ</strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                    <div class="total">
                                        <div class=" uk-flex uk-flex-middle uk-flex-space-between mb10">
                                            <div class="title">Tổng tiền</div>
                                            <div class="price_tt">
                                                <strong><?php echo number_format($this->cart->total()); ?>đ</strong>
                                            </div>
                                        </div>

                                        <div class=" tt-price uk-flex uk-flex-middle uk-flex-space-between">
                                            <div class="title">Tổng tiền thanh toán</div>
                                            <div class="price_tt">
                                                <strong><?php echo number_format($this->cart->total()); ?>đ</strong>
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
                </form>
            </div>
        </div>
    </section>
    <!-- .order-1 -->
</main>
<div class="clearfix"></div>
<!-- </html> -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#cityid').change(function () {
            var city_id = $('#cityid').val();
            $.post('<?php echo site_url('products/ajax/cart/ajax_location')?>', {
                    cityid: city_id,
                },
                function (data) {
                    var json = JSON.parse(data);
                    $('#districtid').html(json.option);
                });
            return false;
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.fc-cart-update').change(function () {
            var qty = $(this).val();
            var rowid = $(this).attr('data-id');
            $.post('<?php echo site_url('products/ajax/cart/updateitemcart')?>', {
                    qty: qty,
                    rowid: rowid,
                },
                function (data) {
                    window.location.href = 'dat-mua.html';
                });
            return false;
        });
    });
    $(document).on('click', '.delete_item', function () {
        var item = $(this);
        var idprd = item.parent().parent().parent().parent().find('.ajax-quantity').val();
        ajax_cart_update1(idprd);
        return false;
    });
    function ajax_cart_update1(idprd) {
        $.post('<?php echo site_url('products/ajax/cart/deletecart');?>', {idprd: idprd}, function (data) {
            window.location.href = 'dat-mua.html';
        });
    }
</script>
<script src="templates/frontend/resources/cart/uikit.min.js"></script>
<link href="templates/frontend/resources/cart/uikit.modify.css" rel="stylesheet"/>
<link href="templates/frontend/resources/cart/library.css" rel="stylesheet"/>
<link href="templates/frontend/resources/cart/reset.css" rel="stylesheet"/>
<style tyle="text/css">


    .order-1 .payment .step .item {
        float: left;
        width: 33.33%;
    }

    .order-1 .payment .step .item:last-child a:before {
        display: none;
    }

    .order-1 .payment .step .link {
        display: block;
        padding: 8px 35px 8px 30px;
        font-size: 13px;
        line-height: 20px;
        color: #333;
        font-weight: bold;
        background: #f0f0f0;
        position: relative;
    }

    .order-1 .payment .step .active .link {
        background: #f4f9fd;
    }

    .order-1 .payment .step .link:before, .order-1 .payment .step .link:after {
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

    .order-1 .payment .step .link:before {
        border-left-color: #fff;
        right: -14px;
        z-index: 1;
    }

    .order-1 .payment .step .link:after {
        z-index: 2;
        border-left-color: #f1f1f1;
    }

    .order-1 .payment .step .step-3 .link:after, .order-1 .payment .step .step-3 .link:after {
        display: none;
    }

    .order-1 .payment .step .active .link:after {
        border-left-color: #f4f9fd;
    }

    .order-1 .payment .step .number {
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

    @media (min-width: 1220px) {
        .uk-container {
            max-width: 1140px;
            padding: 0;
        }
    }

    .order-1 .payment .step .complete .number {
        text-indent: -999px;
        background: url(templates/backend/images/icon-checked.png) 0% 0% no-repeat;
    }

    .order-1 .payment .step .active .number {
        background: #0492d5;
    }

    .order-1 .information .uk-panel {
        border: 1px solid #eee;
    }

    .order-1 .information .panel-head {
        padding: 10px 15px;
        background: #f7f7f7;
        border-bottom: 1px solid #eee;
    }

    .order-1 .information .panel-head .title {
        font-size: 14px;
        margin: 0;
        color: #333;
    }

    .order-1 .information .panel-head .title .number {
        color: #666;
        font-size: 13px;
    }

    .order-1 .information .panel-head .change {
        color: #0386ca;
        font-size: 12px;
    }

    .order-1 .listorder > .item {
        padding: 15px 15px;
        overflow: hidden;
    }

    .order-1 .listorder > .item + .item {
        border-top: 1px dotted #ccc;
    }

    .order-1 .listorder .colimg {
        width: 80px;
        margin-right: 15px;
    }

    .order-1 .listorder .colinfo {
        width: calc(100% - 95px);
        -moz-width: calc(100% - 95px);
        -webkit-width: calc(100% - 95px);
        -o-width: calc(100% - 95px);
        -ms-width: calc(100% - 95px)
    }

    .order-1 .listorder .colimg .img {
        height: 80px;
        border: 1px solid #ebebeb;
    }

    .order-1 .listorder .colinfo .title {
        font-size: 13px;
        line-height: 18px;
        margin-bottom: 10px;
        width: 70%;
        height: 54px;
        font-weight: bold;
    }

    .order-1 .listorder .colinfo .title .link {
        color: #555;
        font-size: 12px;
    }

    .order-1 .listorder .colinfo .title .link:hover {
        color: #288ad6;
    }

    .order-1 .listorder .colinfo .price {
        font-size: 13px;
        line-height: 18px;
        text-align: right
    }

    .order-1 .total {
        padding: 8px 15px;
        border-top: 1px solid #ebebeb;
    }

    .order-1 .total .tt-price {
        border-top: 1px dashed #ccc;
        padding-top: 15px;
    }

    .order-1 .total .tt-price .price {
        color: #d60c0c;
    }

    .order-1 .customer .panel-body, .order-1 .payment-methods .panel-body {
        padding: 20px 30px 5px 30px;
        background: #fff;
    }

    .panel-body {
        background: #fff;
    }

    .order-1 .customer .col.left {
        float: left;
        width: 105px;
    }

    .order-1 .customer .col.right {
        float: right;
        width: -moz-calc(100% - 115px);
        width: -webkit-calc(100% - 115px);
        width: -o-calc(100% - 115px);
        width: calc(100% - 115px)
    }

    .order-1 .customer label.label, .order-1 .customer span.no-required {
        display: block;
        font-size: 13px;
        color: #000;
    }

    .order-1 .customer span.no-required {
        color: #999;
    }

    .order-1 .customer .panel-body .text, .order-1 .customer .panel-body .select {
        border: 1px solid #ccc;
        border-radius: 3px;
        font-size: 13px;
        color: #252525;
    }

    .order-1 .customer .sex .item + .item {
        margin-left: 20px;
    }

    .order-1 .customer .sex input {
        margin-right: 5px;
    }

    .order-1 .giftcode .panel-body {
        padding: 20px 30px 20px 30px;
    }

    .order-1 .giftcode {
        max-width: 230px
    }

    .order-1 .giftcode .text {
        height: 30px;
        border: 1px solid #ccc;
    }

    .order-1 .giftcode .btn {
        position: absolute;
        height: 30px;
        padding: 4px 15px;
        font-size: 13px;
        color: #fff;
        background: #0388cd;
        border: none;
        top: 0px;
        right: -80px;
        cursor: pointer;
    }

    .order-1 .giftcode .note {
        font-size: 13px;
        font-style: italic;
        color: #999;
    }

    .order-1 .giftcode .note .text-black {
        color: #252525;
    }

    .order-1 .giftcode .note .link {
        color: #0386ca;
    }

    .order-1 .payment-methods input[type=radio] {
        display: none;
    }

    .order-1 .payment-methods input[type=radio]:checked + .label .inner {
        border-color: #0388cd;
    }

    .order-1 .payment-methods input[type=radio]:checked + .label:before {
        border: 4px solid #0388cd;
    }

    .order-1 .payment-methods .label {
        display: block;
        position: relative;
        padding-left: 25px;
        cursor: pointer;
    }

    .order-1 .payment-methods .label:before {
        content: "";
        display: block;
        position: absolute;
        width: 14px;
        height: 14px;
        left: 0;
        top: 50%;
        margin-top: -7px;
        border: 1px solid #666;
        border-radius: 50%;
    }

    .order-1 .payment-methods .inner {
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .order-1 .payment-methods .thumb {
        float: left;
        width: 80px;
        padding: 4px;
        height: 76px;
        border-right: 1px solid #ccc;
    }

    .order-1 .payment-methods .description {
        float: left;
        width: -moz-calc(100% - 80px);
        width: -webkit-calc(100% - 80px);
        width: -o-calc(100% - 80px);
        width: -ms-calc(100% - 80px);
        width: calc(100% - 80px);
        font-size: 13px;
        color: #333;
        padding: 8px 16px 8px 16px;
    }

    .order-1 .payment-methods .description .subtitle {
        color: #999;
    }

    .order-1 .continue .btn {
        display: inline-block;
        position: relative;
        padding: 8px 50px 8px 40px;
        background: #d60c0c;
        color: #fff;
        border: none;
        font-size: 13px;
        line-height: 20px;
        cursor: pointer;
        border-radius: 4px;
    }

    .order-1 .continue .btn:after {
        content: "";
        display: block;
        position: absolute;
        width: 12px;
        height: 8px;
        background: url(templates/backend/images/spritesheet.png) -264px -81px no-repeat;
        top: 14px;
        right: 15px;
    }

    .delete.delete_item {
        cursor: pointer;
        display: block;
        margin-top: 10px;
    }

    @media (max-width: 650px) {
        .order-1 .payment .step .item {
            width: 100% !important;
        }

        .order-1 .customer .panel-body, .order-1 .payment-methods .panel-body {
            padding: 10px;
        }

        .order-1 .payment-methods .description {
            width: 100%;
        }

        .order-1 .payment-methods .thumb {
            float: left;
            width: 100%;
            padding: 4px;
            height: 76px;
            border-right: 0;
            text-align: center;
        }

        .order-1 .giftcode .btn {
            right: 0;
        }

        .continue.uk-text-right {
            margin-bottom: 20px;
        }

        .order-1 .customer .col.left, .order-1 .customer .col.right {
            float: left;
            width: 100% !important;
            margin: 5px 0;
        }
    }
</style>