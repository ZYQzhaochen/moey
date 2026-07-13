<?php 
header('Content-type:text/html; charset=utf-8');
require"../config/config.php";
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1,maximum-scale=1,maximum-scale=1, user-scalable=no" name="viewport">
	<title>侵权申诉 | 萌言Moey</title>
	<link rel="stylesheet" href="../static/css/reset.css">
	<link rel="stylesheet" href="../static/css/lanren.css">
	<link rel="stylesheet" href="../static/css/ty.css">
	<link rel="Shortcut Icon"href="../favicon.ico">
</head>
<body>
	<header class="header">
		<span class="btn-slide-bar"></span>
		<h1 class="page-title">侵权申诉</h1>
	</header>
	<section class="wraper-page">
	<script src="../static/js/yinghua.js"></script>
	<div style="background:rgba(255,255,255,0.6);border:2px dashed #C0C0C0;min-height:50px;font-size:16px;line-height:1.5;margin: 5px auto;border-radius:0.8em;padding:10px;max-width:1000px;">
		<div class="bt"><font color="#FF69B4">#</font> Sorry！！（180°鞠躬）</div>
		<p>非常抱歉我们的网站侵害了您的权益，对此我们不作辩解，并深表歉意。请您将侵权详情（截图等）发送邮件至<a href="mailto:zc@moey.cn">zc@moey.cn</a>，我们会尽快对侵权资源作下架处理！</p><br>
		<p>We are very sorry that our website has infringed your rights and interests. We have no excuse for this and we deeply apologize. Please send the infringement details (screenshots, etc.) to <a href="mailto:zc@moey.cn">zc@moey.cn</a> , and we will remove the infringing resources as soon as possible!</p><br>
		<p>すみません、私達のウェブサイトはあなたの権益を侵害しました。これに対しては弁解しません。そして、深くお詫びします。侵害の詳細（スクリーンショットなど）をメール（<a href="mailto:zc@moey.cn">zc@moey.cn</a>）で送ってください。私たちはできるだけ早く侵害資源に処理します！</p>
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