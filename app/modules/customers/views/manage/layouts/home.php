<!DOCTYPE html>
<html>
<head>
<base href="<?php echo base_url();?>" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="vi" />
<link rel="alternate" href="<?php echo base_url();?>" hreflang="vi-vn" />
<meta name="robots" content="index,follow" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="author" content="<?php echo getSystem('homepage_brandname');?>" />
<meta name="copyright" content="<?php echo getSystem('homepage_brandname');?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
<meta http-equiv="refresh" content="1800" />

<!-- for Google -->
<title><?php echo isset($meta_title)?htmlspecialchars($meta_title):'';?></title>
<meta name="keywords" content="<?php echo isset($meta_keywords)?htmlspecialchars($meta_keywords):'';?>" />
<meta name="description" content="<?php echo isset($meta_description)?htmlspecialchars($meta_description):'';?>" />
<?php echo isset($canonical)?'<link rel="canonical" href="'.$canonical.'" />':'';?>

<!-- for Facebook -->
<meta property="og:title" content="<?php echo (isset($meta_title) && !empty($meta_title))?htmlspecialchars($meta_title):'';?>" />
<meta property="og:type" content="article" />
<meta property="og:image" content="<?php echo (isset($meta_images) && !empty($meta_images))?$meta_images:base_url(getSystem('seo_meta_image'));?>" />
<?php echo isset($canonical)?'<meta property="og:url" content="'.$canonical.'" />':'';?>
<meta property="og:description" content="<?php echo (isset($meta_description) && !empty($meta_description))?htmlspecialchars($meta_description):'';?>" />
<meta property="og:site_name" content="<?php echo getSystem('homepage_brandname');?>" />
<meta property="fb:admins" content="<?php echo getSystem('system_fbadmins');?>"/>
<meta property="fb:app_id" content="<?php echo getSystem('system_fbappid');?>" />

<!-- for Twitter -->          
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?php echo isset($meta_title)?htmlspecialchars($meta_title):'';?>" />
<meta name="twitter:description" content="<?php echo (isset($meta_description) && !empty($meta_description))?htmlspecialchars($meta_description):'';?>" />
<meta name="twitter:image" content="<?php echo (isset($meta_images) && !empty($meta_images))?$meta_images:base_url(getSystem('seo_meta_image'));?>" />

<link rel="icon" href="<?php echo $this->fcSystem['homepage_favicon']; ?>"  type="image/png" sizes="30x30">
<?php $this->load->view('customers/manage/common/head'); ?>
</head>
<body>
	<?php $this->load->view('customers/manage/common/header');  ?>
	<div id="body">
		
		<?php $this->load->view((isset($template)) ? $template : ''); ?>
	</div><!-- #body -->
	<?php $this->load->view('customers/manage/common/footer');?>
	<?php $this->load->view('customers/manage/common/offcanvas');?>
	<?php $this->load->view('customers/manage/common/script');?>
</body>
</html>