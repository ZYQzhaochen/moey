<?php 
header('Content-type:text/html; charset=utf-8');
require"../config/config.php";
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1,maximum-scale=1,maximum-scale=1, user-scalable=no" name="viewport">
	<title>语句接口使用文档 | 萌言Moey</title>
	<meta name="robots" content="index,follow">
	<meta name="keywords" content="萌言,萌言网,一言,一言网,萌云网络,一言api,moey,hitokoto,一言接口">
	<meta name="description" content="萌言Moey是一个创立于2023年的非盈利公益性项目，致力于提供稳定、免费的接口服务。此页面为萌言网一言接口使用文档。">
	<link rel="stylesheet" href="../static/css/reset.css">
	<link rel="stylesheet" href="../static/css/lanren.css">
	<link rel="stylesheet" href="../static/css/ty.css">
	<link rel="Shortcut Icon"href="../favicon.ico">
	<style>
		a {
			color: #FF69B4;
			font-family:dk;
		}
		a:hover {
			color: #EE82EE;
		}
	</style>
</head>
<body>
	<header class="header">
		<span class="btn-slide-bar"></span>
		<h1 class="page-title">语句接口使用说明</h1>
	</header>
	<section class="wraper-page">
		<iframe src="yapi-help-subpage.php" style="width:100%;height:100%;border:medium none;background:white"></iframe>
	</section>
	<footer class="footer"><?php echo $foot ?></footer>
	<section class="slide-bar">
		<ul>
			<li><center><div class="ttf-kat">萌言Moey</div></center></li>
			<li><a href="../" target="_top"><img style="width:15px;height:15px" src="../images/home.svg"> 首页</a></li>
			<li><a href="about.php" target="_top"><img style="width:15px;height:15px" src="../images/about.svg"> 关于萌言</a></li>
			<li><a href="links.php" target="_top"><img style="width:15px;height:15px" src="../images/link.svg"> 友情链接</a></li>
			<li>API接口：</li>
			<li>•<a href="yapi-help.php" target="_top"><img style="width:15px;height:15px" src="../images/yan.svg"> 一言语句</a></li>
			<li>•<a href="wpapi-help.php" target="_top"><img style="width:15px;height:15px" src="../images/wp.svg"> 二次元图片</a></li>
			<li>投稿：</li>
			<li>•<a href="submit_y.php" target="_top"><img style="width:15px;height:15px" src="../images/submit.svg"> 一言语句</a></li>
			<li>•<a href="submit_wp.php" target="_top"><img style="width:15px;height:15px" src="../images/submit.svg"> 二次元图片</a></li>
			<li>More：</li>
			<li><a href="chat.php" target="_top"><img style="width:15px;height:15px" src="../images/chat.svg"> 留言板</a></li>
			<li><a href="support.php" target="_top"><img style="width:15px;height:15px" src="../images/donate.svg"> 支持我们</a></li>
			<li><a href="infringment.php" target="_top"><img style="width:15px;height:15px" src="../images/su.svg"> 侵权申诉</a></li>
			<li><a href="https://www.travellings.cn/go.html" target="_blank" rel="noopener" title="开往-友链接力"><img style="width:15px;height:15px" src="../images/tl.svg"> 「开往」</a></li>
		</ul>
	</section>
	<script>
		document.addEventListener("DOMContentLoaded", function(){
			(function(){
				var _btn  = document.querySelector(".btn-slide-bar"),
					_body = document.querySelector("body");
					_btn.onclick = function(){
						_body.classList.toggle("active");
					}
			})(window)
		},false);
	</script>
</body>
</html>