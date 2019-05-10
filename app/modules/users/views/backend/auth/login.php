<div id="loginbox">

    <form id="loginform" class="form-vertical validate form-horizontal" action="" method="post">
        <div class="control-group normal_text"><h3><img src="../templates/backend/login/images/logo.png" alt="Logo"/>
            </h3>

            <?php echo show_flashdata(FALSE);?>
            <?php $error = validation_errors(); echo !empty($error)?'<div class="alert alert-danger">'.$error.'</div>':'';?>
        </div>

        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_lg"><i class="icon-user"> </i></span>

                    <?php echo form_input('email', set_value('email'), 'class="form-control" placeholder="Email"'); ?>
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_ly"><i class="icon-lock"></i></span>

                    <?php echo form_password('password', set_value('password'), 'class="form-control" placeholder="Mật khẩu"'); ?>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <div class="has-feedback">
                <select name="lang" id="lang" class="form-control">
                    <option value="vietnamese">Vietnamese</option>
                    <option value="english">English</option>
                </select>
                <i class="fa fa-language form-control-feedback" aria-hidden="true"></i>
            </div>

            <span class="pull-right"><input tabindex="5" name="login" type="submit" class="btn btn-success"
                                            value="Đăng nhập"></span>
        </div>
    </form>

</div>


