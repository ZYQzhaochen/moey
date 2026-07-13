<?php 
header('Content-type:text/html; charset=utf-8');
require"../config/config.php";
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1,maximum-scale=1,maximum-scale=1, user-scalable=no" name="viewport">
	<title>开源 | 萌言Moey</title>
	<link rel="stylesheet" href="../static/css/reset.css">
	<link rel="stylesheet" href="../static/css/lanren.css">
	<link rel="stylesheet" href="../static/css/ty.css">
	<link rel="Shortcut Icon"href="../favicon.ico">
</head>
<body>
	<header class="header">
		<span class="btn-slide-bar"></span>
		<h1 class="page-title">人人为我，我为人人</h1>
	</header>
	<section class="wraper-page">
	<script src="../static/js/yinghua.js"></script>
	<div style="background:rgba(255,255,255,0.6);border:2px dashed #C0C0C0;min-height:50px;font-size:16px;line-height:1.5;margin: 5px auto;border-radius:0.8em;padding:10px;max-width:1000px;">
		<div class="bt"><font color="#FF69B4">#</font> 开源地址</div>
		<p><img style="width:15px;height:15px" src="../images/github.png"> Moey的github主页：<a href="https://github.com/ZYQzhaochen/moey" target="_blank">https://github.com/ZYQzhaochen/moey</a></p>
		<div class="bt"><font color="#FF69B4">#</font> 开源情况</div>
		<p>除了后台不便暴露的接口/页面等敏感部分，其他全部开源。敏感部分在版本迭代后，旧版本将开源。</p>
		<div class="bt"><font color="#FF69B4">#</font> 开源协议</div>
		<p>API及语句库采用AGPL-3.0协议(语句库需要遵循AGPL协议为第三方开源项目的要求)，其它采用MIT协议。</p>
		<div class="bt"><font color="#FF69B4">#</font> 注意</div>
		<p>本项目代码开源不代表您可以随意使用本站包括语句和图片在内的网络资源以及图标。站内资源严禁商用。本站图标版权归中山市域方网络科技有限公司所有，本站拥有图标使用权，点此<a href="../images/sqed.png" target="_blank">查看详情</a>。本站图标严禁盗用、修改、转载。</p>
	</div>
	<center><p style="animation: shake 1s;animation-iteration-count: infinite;">¯\_(ツ)_/¯</p></center>
	<center><p>萌言勉强运行了<span id="momk"></span></p></center>
	<div id="rin-bg"></div>
	<script src="../static/js/ty.js"></script>
	</section>
	<footer class="footer"><?php echo $foot ?></footer>
	<section class="slide-bar">
		<ul>
			<li class="logo-li"><center><div class="ttf-kat">萌言Moey</div></center></li>
			<li><a href="../" target="_top" class="sa"><img style="width:15px;height:15px" src="../images/home.svg"> 首页</a></li>
			<li><a href="about.php" target="_top" class="sa"><img style="width:15px;height:15px" src="../images/about.svg"> 关于萌言</a></li>
			<li><a href="links.php" target="_top" class="sa"><img style="width:15px;height:15px" src="../images/link.svg"> 友情链接</a></li>
		<li class="sec-title">API接口：</li>
			<li><a href="yapi-help.php" target="_top" class="sa"><img style="width:15px;height:15px" src="../images/yan.svg"> 一言语句</a></li>
			<li><a href="wpapi-help.php" target="_top" class="sa"><img style="width:15px;height:15px" src="../images/wp.svg"> 二次元图片</a></li>
		<li class="sec-title">投稿：</li>
			<li><a href="submit_y.php" target="_top" class="sa"><img style="width:15px;height:15px" src="../images/submit.svg"> 一言语句</a></li>
			<li><a href="submit_wp.php" target="_top" class="sa"><img style="width:15px;height:15px" src="../images/submit.svg"> 二次元图片</a></li>
		<li class="sec-title">More：</li>
			<li><a href="chat.php" target="_top" class="sa"><img style="width:15px;height:15px" src="../images/chat.svg"> 留言板</a></li>
			<li><a href="support.php" target="_top" class="sa"><img style="width:15px;height:15px" src="../images/donate.svg"> 支持我们</a></li>
			<li><a href="infringment.php" target="_top" class="sa"><img style="width:15px;height:15px" src="../images/su.svg"> 侵权申诉</a></li>
			<li><a href="open.php" target="_top" class="sa"><img style="width:15px;height:15px" src="../images/ky.svg"> 开源</a></li>
		<li><a href="https://www.travellings.cn/go.html" target="_blank" rel="noopener" title="开往-友链接力" class="sa"><img style="width:15px;height:15px" src="../images/tl.svg"> 「开往」</a></li>
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