<!DOCTYPE html>
<html>
<head>
    <base href="<?php echo base_url(); ?>"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="content-language" content="vi"/>
    <link rel="alternate" href="<?php echo base_url(); ?>" hreflang="vi-vn"/>
    <meta name="robots" content="index,follow"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="author" content="<?php echo getSystem('homepage_brandname'); ?>"/>
    <meta name="copyright" content="<?php echo getSystem('homepage_brandname'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes"/>
    <meta http-equiv="refresh" content="1800"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- for Google -->
    <title><?php echo isset($meta_title) ? htmlspecialchars($meta_title) : ''; ?></title>
    <meta name="keywords" content="<?php echo isset($meta_keyword) ? htmlspecialchars($meta_keyword) : ''; ?>"/>
    <meta name="description"
          content="<?php echo isset($meta_description) ? htmlspecialchars($meta_description) : ''; ?>"/>
    <meta name="revisit-after" content="1 days">
    <meta name="rating" content="general">
    <?php echo isset($canonical) ? '<link rel="canonical" href="' . $canonical . '" />' : ''; ?>

    <!-- for Facebook -->
    <meta property="og:title"
          content="<?php echo (isset($meta_title) && !empty($meta_title)) ? htmlspecialchars($meta_title) : ''; ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:image"
          content="<?php echo (isset($meta_images) && !empty($meta_images)) ? $meta_images : base_url(getSystem('seo_meta_image')); ?>"/>
    <?php echo isset($canonical) ? '<meta property="og:url" content="' . $canonical . '" />' : ''; ?>
    <meta property="og:description"
          content="<?php echo (isset($meta_description) && !empty($meta_description)) ? htmlspecialchars($meta_description) : ''; ?>"/>
    <meta property="og:site_name" content="<?php echo getSystem('homepage_brandname'); ?>"/>
    <meta property="fb:admins" content="<?php echo getSystem('system_fbadmins'); ?>"/>
    <meta property="fb:app_id" content="<?php echo getSystem('system_fbappid'); ?>"/>

    <!-- for Twitter -->
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:title" content="<?php echo isset($meta_title) ? htmlspecialchars($meta_title) : ''; ?>"/>
    <meta name="twitter:description"
          content="<?php echo (isset($meta_description) && !empty($meta_description)) ? htmlspecialchars($meta_description) : ''; ?>"/>
    <meta name="twitter:image"
          content="<?php echo (isset($meta_images) && !empty($meta_images)) ? $meta_images : base_url(getSystem('seo_meta_image')); ?>"/>
    <link rel="icon" href="<?php echo $this->fcSystem['homepage_favicon']; ?>" type="image/png" sizes="30x30">

    <?php $this->load->view('homepage/frontend/common/head'); ?>

    <script type="text/javascript">
        var BASE_URL = '<?php echo base_url(); ?>';
    </script>
    <?php /*?><script type="text/javascript">
        function setActive() {
            var aObj = document.getElementById('menu2').getElementsByTagName('a');
            for (i = 0; i < aObj.length; i++) {
                if (aObj[i].href == document.location.href)
                    aObj[i].className = 'active';
            }
        }
        window.onload = setActive;
    </script><?php */?>
    <?php echo $this->fcSystem['script_header'] ?>

</head>
<body class="lang-vi-VN  homepage">

    <?php $this->load->view('homepage/frontend/common/header2'); ?>
    <?php $this->load->view(isset($template) ? $template : ''); ?>
    <?php $this->load->view('homepage/frontend/common/footer'); ?>
    <?php $this->load->view('homepage/frontend/common/fb-chat'); ?>
    <div id="show_success_mss" style="position: fixed; top: 150px; right: 20px;z-index: 999999999999999999999999">
        <?php if ($this->session->flashdata('message-success')) { ?>

            <div class="alert alert-success alert-dismissible" role="alert">

                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

                <?php echo $this->session->flashdata('message-success'); ?>

            </div>

            <?php
        } ?>
    </div>
    <?php echo $this->fcSystem['script_body'] ?>
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2&appId=548945608802089&autoLogAppEvents=1';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <script>
        setTimeout(function () {
            jQuery('#show_success_mss').fadeOut().empty();
        }, 5000);
    </script>

</body>
</html>