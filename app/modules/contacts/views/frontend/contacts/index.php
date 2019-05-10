<div id="main" class="wrapper">
    <div id="main-category">
        <div id="main-contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="content-contact">
                            <p class="thank-you">Thank you for visiting our website.</p>

                            <h1 class="title-contact"><?php echo $this->fcSystem['homepage_company']; ?></h1>
                            <ul class="adress-contact">
                                <li><span>Address: </span><?php echo $this->fcSystem['contact_address']; ?></li>
                                <li><span>Hotline: </span><?php echo $this->fcSystem['contact_phone']; ?></li>
                                <li><span>Email:</span><?php echo $this->fcSystem['contact_email']; ?></li>
                                <li><span>Website: </span><?php echo $this->fcSystem['contact_web']; ?></li>
                            </ul>
                        </div>
                        <div class="map-contact">
                            <?php echo $this->fcSystem['contact_map']; ?>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-contat">
                            <p class="desc">Please fill up the form and send to us. Our consultants will respond to you
                                as soon as possible.<br>
                                Thanks you!
                            </p>

                            <form action="" method="post" class="uk-form form" enctype="multipart/form-data">
                                <?php $error = validation_errors();
                                echo !empty($error) ? '<div class="callout callout-danger" style="padding:10px;background:rgb(195, 94, 94);color:#fff;margin-bottom:10px;">' . $error . '</div>' : ''; ?>
                                <input type="text" name="fullname" placeholder="Họ và tên *">
                                <input type="text" name="phone" placeholder="Số điện thoại *">
                                <input type="text" name="email" placeholder="Email">
                                <input type="text" name="address" placeholder="Địa chỉ">
                                <textarea name="message" cols="40" rows="10" placeholder="Nội dung"></textarea>

                                <div class="send-contact">

                                    <div class="item">
                                        <input type="hidden" name="title" value="Thông tin liên hệ">
                                        <input type="submit" name="create" value="Send">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>