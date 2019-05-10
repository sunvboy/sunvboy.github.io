<style>
    .fix{float:right;}
    .fix a{    display: block;font-size: 12px; line-height: 16px;  background: #f4c58f; padding: 3px;border-radius: 3px;color: #815621 !important;font-weight: bold;}
    #infor .item{margin-bottom:15px;}
    #infor .item .text{font-weight:bold;padding-left:3px;}
    #infor .item input{border:1px solid #e3e3e3;width:100%;padding:0 8px 0 8px;border-radius:5px;height:32px;}
    #infor .item select{height:32px;border-radius:3px;border-color:#e3e3e3;}
    #infor .save{background:#6b1313;border:0;border-radius:3px;color:#fff;padding: 5px 16px;}

</style>

<section class="content-header">
    <h1>Chi tiết đơn đặt hàng</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
        <li class="active"><a href="<?php echo site_url('mailsubricre/backend/mailsubricre/viewguiyeucau');?>">Danh sách đặt hàng</a></li>
    </ol>
</section>
<section class="content" id="print">
    <div class="row">
        <div class="col-xs-9">
            <div class="box">

                <?php if(isset($payment_list) && is_array($payment_list) && count($payment_list)){ ?>

                    <div class="box-body table-responsive no-padding">
                        <form method="post" action="" id="fcFrom">
                            <table class="table table-hover" id="diagnosis-list">
                                <tr>
                                    <th style="width: 10%">STT</th>
                                    <th style="width: 30%">Tiêu đề</th>
                                    <th style="width: 30%">Số lượng</th>
                                    <th style="width: 30%">Ghi chú</th>
                                </tr>
                                <?php foreach($payment_list as $key => $item){ ?>
                                    <tr>

                                        <td style="width: 10%"><?php echo $key+1; ?></td>
                                        <td style="width: 30%"><a href="<?php echo $item['name']; ?>" ><?php echo $item['name']; ?></a></td>
                                        <td style="width: 30%"><?php echo $item['quanty'] ?></td>
                                        <td style="width: 30%"><strong><?php echo $item['note'] ?></strong></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </form>
                    </div><!-- /.box-body -->
                <?php } else { ?>
                    <div class="box-body">
                        <div class="callout callout-danger" >Không có dữ liệu</div>
                    </div><!-- /.box-body -->
                <?php } ?>



            </div><!-- /.box -->
        </div>
        <div class="col-xs-3">
            <div class="box">
                <div class="box-header">
                    <span class="address">Địa chỉ giao hàng</span>
                </div>
                <div class="box-body">

                    <p><i class="fa fa-credit-card" aria-hidden="true"></i> <span style="font-weight:bold;margin-left:10px;"><?php echo $Detailmailsubricre['fullname']; ?></span></p>
                    <p><i class="fa fa-envelope-o" aria-hidden="true"></i> <span style="font-weight:bold;margin-left:10px;"><?php echo $Detailmailsubricre['email']; ?></span></p>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i> <span style="font-weight:bold;margin-left:10px;"><?php echo $Detailmailsubricre['address']; ?></span></p>
                    <p><i class="fa fa-phone-square" aria-hidden="true"></i> <span style="font-weight:bold;margin-left:10px;"><?php echo $Detailmailsubricre['phone']; ?></span></p>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->
<!-- Modal -->
