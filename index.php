<?php 
header('Content-type:text/html; charset=utf-8');
require"config/config.php";
?>
<!DOCTYPE html>
<html lang="cn">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1,maximum-scale=1,maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="robots" content="index">
	<meta name="copyright" content="萌云网络">
	<meta name="keyword" content="萌言,萌言网,一言,一言网,萌云网络,一言api,moey,hitokoto">
	<meta name="description" content="可能是最萌的一言/二次元图片API接口网站～">
	<title><?php echo $name ?></title>
	<link rel="stylesheet" href="static/css/reset.css">
	<link rel="stylesheet" href="static/css/lanren.css">
	<link rel="stylesheet" href="static/css/ty.css">
	<link rel="Shortcut Icon"href="favicon.ico">
	<style>
	a {
	color: #FF69B4;
	font-family:dk;
	}
	</style>
	<script>
	var _hmt = _hmt || [];
	(function() {
	  var hm = document.createElement("script");
	  hm.src = "https://hm.baidu.com/hm.js?4026c1404a4fc8fb41a7bf4b1fa325e6";
	  var s = document.getElementsByTagName("script")[0]; 
	  s.parentNode.insertBefore(hm, s);
	})();
	</script>
</head>
<body>
	<header class="header">
		<span class="btn-slide-bar"></span>
		<h1 class="page-title">Moey</h1>
	</header>
	<section class="wraper-page">
		<iframe src="cn.php" style="width:100%;height:100%;border:medium none;background:white"></iframe>
	</section>
	<footer class="footer"><?php echo $foot ?></footer>
	<section class="slide-bar">
	<ul>
		<li><center><div class="ttf-kat">萌言Moey</div></center></li>
		<li><a href="./" target="_top"><img style="width:15px;height:15px" src="images/home.svg"> 首页</a></li>
		<li><a href="pages/about.php" target="_top"><img style="width:15px;height:15px" src="images/about.svg"> 关于萌言</a></li>
		<li><a href="pages/links.php" target="_top"><img style="width:15px;height:15px" src="images/link.svg"> 友情链接</a></li>
		<li>API接口：</li>
		<li>&nbsp;• <a href="pages/yapi-help.php" target="_top"><img style="width:15px;height:15px" src="images/yan.svg"> 随机一言</a></li>
		<li>&nbsp;• <a href="pages/wpapi-help.php" target="_top"><img style="width:15px;height:15px" src="images/wp.svg"> 二次元壁纸</a></li>
		<li>投稿：</li>
		<li>&nbsp;• <a href="pages/submit_y.php" target="_top"><img style="width:15px;height:15px" src="images/submit.svg"> 一言句子</a></li>
		<li>&nbsp;• <a href="pages/submit_wp.php" target="_top"><img style="width:15px;height:15px" src="images/submit.svg"> 二次元壁纸</a></li>
		<li>支持我们：</li>
		<li>&nbsp;• <a href="pages/thanks.php" target="_top"><img style="width:15px;height:15px" src="images/thank.svg"> 鸣谢</a></li>
		<li>&nbsp;• <a href="pages/donate.php" target="_top"><img style="width:15px;height:15px" src="images/donate.svg"> 赞赏</a></li>
		<li>More：</li>
		<li>&nbsp;• <a href="pages/infringment.php" target="_top">侵权申诉</a></li>
		<li>&nbsp;• <a href="pages/open.php" target="_top">开源</a></li>
		<li>&nbsp;• <a href="https://www.travellings.cn/go.html" target="_blank" rel="noopener" title="开往-友链接力"><img src="https://www.travellings.cn/assets/logo.svg" alt="开往-友链接力" width="100"></a></li>
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
	<script src="static/js/ty.js"></script>
	<script type="text/javascript">(function() {var coreSocialistValues = ["❤️", "🧡", "💛", "💚", "💙", "💜"], index = Math.floor(Math.random() * coreSocialistValues.length);document.body.addEventListener('click', function(e) {if (e.target.tagName == 'A') {return;}var x = e.pageX, y = e.pageY, span = document.createElement('span');span.textContent = coreSocialistValues[index];index = (index + 1) % coreSocialistValues.length;span.style.cssText = ['z-index: 99; position: absolute; font-weight: bold; color: #ff6651; top: ', y - 20, 'px; left: ', x, 'px;'].join('');document.body.appendChild(span);animate(span);});function animate(el) {var i = 0, top = parseInt(el.style.top), id = setInterval(frame, 16.7);function frame() {if (i > 180) {clearInterval(id);el.parentNode.removeChild(el);} else {i+=2;el.style.top = top - i + 'px';el.style.opacity = (180 - i) / 180;}}}}());</script>
</body>
</html>