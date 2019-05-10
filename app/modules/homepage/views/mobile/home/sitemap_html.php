<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Site Map - Generated by ThanhHai.name</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<style type="text/css">
body {
background-color: #DDD;
font: normal 80%  "Trebuchet MS", "Helvetica", sans-serif;
margin:0;
text-align:center;
}
#cont{
margin:auto;
width:800px;
text-align:left;
}
a:link,a:visited {
color: #0180AF;
text-decoration: underline;
}
a:hover {
color: #666;
}
h1 {
background-color:#fff;
padding:20px;
color:#00AEEF;
text-align:left;
font-size:32px;
margin:0px;
}
h3 {
font-size:12px;
background-color:#B8DCE9;
margin:0px;
padding:10px;
}
h3 a {
float:right;
font-weight:normal;
display:block;
}
th {
text-align:center;
background-color:#00AEEF;
color:#fff;
padding:4px;
font-weight:normal;
font-size:12px;
}
td {
font-size:12px;
padding:3px;
text-align:left;
}
tr {background: #fff}
tr:nth-child(odd) {background: #f0f0f0}
#footer {
background-color:#B8DCE9;
padding:10px;
}
.pager,.pager a {
background-color:#00AEEF;
color:#fff;
padding:3px;
}
.lhead {
background-color:#fff;
padding:3px;
font-weight:bold;
font-size:16px;
}
.lpart {
background-color:#f0f0f0;
padding:0px;
}
.lpage {
font:normal 12px verdana;
}
.lcount {
background-color:#00AEEF;
color:#fff;
padding:2px;
margin:2px;
font:bold 12px verdana;
}
a.aemphasis {
color:#009;
font-weight:bold;
}
</style>
</head>
<body>
<div id="cont">
<h1>HTML Site Map</h1>
<h3><a href="<?php echo base_url();?>" title="<?php echo getSystem('homepage_name');?>">Homepage</a>
Last updated: <?php echo gmdate('Y, F d', time() + 7*3600);?>
</h3>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr valign="top">
<td class="lpart" colspan="100"><div class="lhead">/
<span class="lcount"><?php echo (count($ArticlesNews) + count($ArticlesCatalogues));?> pages</span></div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<?php if(isset($ArticlesNews) && is_array($ArticlesNews) && count($ArticlesNews)){ ?>
<?php foreach($ArticlesNews as $keyMain => $valMain){ ?>
<?php
$title = htmlspecialchars($valMain['title']);
$url = rewrite_url($valMain['canonical'], $valMain['slug'], $valMain['id'], 'articles');						
?>
<tr><td class="lpage"><a href="<?php echo $url;?>" title="<?php echo $title;?>"><?php echo $title;?></a></td></tr>
<?php } ?>
<?php } ?>
<?php if(isset($ArticlesCatalogues) && is_array($ArticlesCatalogues) && count($ArticlesCatalogues)){ ?>
<?php foreach($ArticlesCatalogues as $keyMain => $valMain){ ?>
<?php
$title = htmlspecialchars($valMain['title']);
$url = rewrite_url($valMain['canonical'], $valMain['slug'], $valMain['id'], 'articles_catalogues');						
?>
<tr><td class="lpage"><a href="<?php echo $url;?>" title="<?php echo $title;?>"><?php echo $title;?></a></td></tr>
<?php } ?>
<?php } ?>
</table>
</td>
</tr>
</table>
<!--
Please note:
You are not allowed to remove the copyright notice below.
Thank you!
thanhhai.name
-->
<div id="footer">
Page generated by ThanhHai.name - <a target="_blank" href="https://thanhhai.name">Google XML sitemap and html sitemaps generator</a>
|
Copyright &copy; 2015-<?php echo gmdate('Y', time() + 7*3600);?>
</div>
</div>
</body>
</html>