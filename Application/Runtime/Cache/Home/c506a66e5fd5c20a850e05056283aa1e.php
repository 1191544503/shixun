<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <title>管理员端</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="Creative Resume Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link href="/shixun/Public/CSS/bootstrap.css" rel="stylesheet" type="text/css" media="all" />

<!-- //font -->
  <script type="text/javascript" src="/shixun/Public/js/jquery-3.2.1.min.js"></script>


<style type="text/css">
 
  .haha{
   height:1000px;
    width:90%;
    float:right;
    background-color:white;

 }
 .list{
    height:100px;
    width:50px;
    text-align:center;
    margin-top:100px;
 }
 .a{
     float:left;
     width:10%;
     height:1000px;
 }
 .main{
 height:100%;
 width:100%;
 background-color:green;
 }
</style>

</head>
<body>
<div class="main">
<div class="a">
<ul class="nav nav-pills nav-stacked">
  <li ><a href="<?php echo U('Admin/managefile');?>" Target="RightMain">管理资源</a></li>
  <li><a href="<?php echo U('Admin/jubaofile');?>" Target="RightMain">审查举报文件</a></li>
  <li><a href="<?php echo U('Index/index');?>">返回前端</a></li>
</ul>
</div>
<iframe class="haha" id="RightMain" name="RightMain"></iframe>
</div>
</body>	
</html>