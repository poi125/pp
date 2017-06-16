<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>后台管理中心</title>  
    <link rel="stylesheet" href="/Public/Admin/css/pintuer.css">
    <link rel="stylesheet" href="/Public/Admin/css/admin.css">
    <script src="/Public/Admin/js/jquery.js"></script>   
</head>
<body style="background-color:#f2f9fd;">
<div class="header bg-main">
  <div class="logo margin-big-left fadein-top">
    <h1 style="color: #01aeff;"><img src="/Public/Admin/images/xmao.jpg" class="radius-circle rotate-hover" height="60" alt="" />后台管理中心</h1>
  </div>
  <div class="head-l"><a class="button button-little bg-green" href="" target="_blank"><span class="icon-home"></span> 前台首页</a> &nbsp;&nbsp;<a href="##" class="button button-little bg-blue"><span class="icon-wrench"></span> 清除缓存</a> &nbsp;&nbsp;<a class="button button-little bg-red" href="<?php echo U('Login/logout');?>"><span class="icon-power-off"></span> 退出登录</a> </div>
  <div class="pu margin-big-right fadein-bottom">
    <h1 style="color: #01aeff; margin-top: 40px;"><img src="/Public/Admin/images/xmao.jpg" class="radius-circle rotate-hover" height="50" alt="" /></h1>
  </div>
</div>
<div class="leftnav">
  <div class="leftnav-title"><strong><span class="icon-list"></span>菜单列表</strong></div>
  <h2><span class="icon-user"></span>商品管理</h2>
  <ul style="display:block">
    <li><a href="<?php echo U('Category/index');?>" target="right"><span class="icon-caret-right"></span>分类管理</a></li>
    <li><a href="<?php echo U('Brand/index');?>" target="right"><span class="icon-caret-right"></span>品牌管理</a></li>
    <li><a href="<?php echo U('Goods/index');?>" target="right"><span class="icon-caret-right"></span>商品管理</a></li>  
    <li><a href="<?php echo U('Spec/index');?>" target="right"><span class="icon-caret-right"></span>规格管理</a></li>   
  </ul>   
  <h2><span class="icon-pencil-square-o"></span>用户管理</h2>
  <ul>
    <li><a href="<?php echo U('Admin/index');?>" target="right"><span class="icon-caret-right"></span>内容管理</a></li>
    <li><a href="<?php echo U('Admin/add');?>" target="right"><span class="icon-caret-right"></span>添加用户</a></li>       
  </ul>  
</div>
<script type="text/javascript">
$(function(){
  $(".leftnav h2").click(function(){ 
	  $(this).next().slideToggle(200);	
	  $(this).toggleClass("on"); 
  })
  $(".leftnav ul li a").click(function(){
	    $("#a_leader_txt").text($(this).text());
  		$(".leftnav ul li a").removeClass("on");
		$(this).addClass("on");
  })
});
</script>
<ul class="bread">
  <li><a href="<?php echo U('Index/info');?>" target="right" class="icon-home"> 首页</a></li>
  <li><a href="##" id="a_leader_txt">网站信息</a></li>
  <li><b>当前语言：</b><span style="color:red;">中文</php></span>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;切换语言：<a href="##">中文</a> &nbsp;&nbsp;<a href="##">英文</a> </li>
</ul>
<div class="admin">
  <iframe scrolling="auto" rameborder="0" src="<?php echo U('Index/welcome');?>" name="right" width="100%" height="100%"></iframe>
</div>

</div>
</body>
</html>