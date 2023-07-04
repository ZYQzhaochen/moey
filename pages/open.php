<?php 
header('Content-type:text/html; charset=utf-8');
require"../config/config.php";
?>
<!DOCTYPE html>
<html lang="cn">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1,maximum-scale=1,maximum-scale=1, user-scalable=no" name="viewport">
	<title>开源 | 萌言网Moey</title>
	<link rel="stylesheet" href="../static/css/reset.css">
	<link rel="stylesheet" href="../static/css/lanren.css">
	<link rel="stylesheet" href="../static/css/ty.css">
	<link rel="Shortcut Icon"href="../favicon.ico">
</head>
<body>
	<script src="../static/js/yinghua.js"></script>
	<header class="header">
		<span class="btn-slide-bar"></span>
		<h1 class="page-title">开源</h1>
	</header>
	<section class="wraper-page">
		<iframe src="open-subpage.php" style="width:100%;height:100%;border:medium none;background:white"></iframe>
	</section>
	<footer class="footer"><?php echo $foot ?></footer>
	<section class="slide-bar">
		<ul>
			<li><center><div class="ttf-kat">萌言</div></center></li>
			<li><a href="../index.php" style="color: #FF69B4;" target="_top">首页</a></li>
			<li><a href="about.php" style="color: #FF69B4;" target="_top">关于萌言</a></li>
			<li><a href="links.php" style="color: #FF69B4;" target="_top">友人帐(友链)</a></li>
			<li>API接口：</li>
			<li>&nbsp;• <a href="yapi-help.php" style="color: #FF69B4;" target="_top">语句</a></li>
			<li>投稿：</li>
			<li>&nbsp;• <a href="submit_y.php" style="color: #FF69B4;" target="_top">语句</a></li>
			<li>支持我们：</li>
			<li>&nbsp;• <a href="thanks.php" style="color: #FF69B4;" target="_top">鸣谢</a></li>
			<li>&nbsp;• <a href="donate.php" style="color: #FF69B4;" target="_top">赞赏</a></li>
			<li>More：</li>
			<li>&nbsp;• <a href="open.php" style="color: #FF69B4;" target="_top">开源</a></li>
			<li>&nbsp;• <a href="tiaokuan.html" style="color: #FF69B4;" target="_blank">使用条款</a></li>
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
	<!--鼠标特效-->
		<script type="text/javascript">(function() {var coreSocialistValues = ["❤️", "🧡", "💛", "💚", "💙", "💜"], index = Math.floor(Math.random() * coreSocialistValues.length);document.body.addEventListener('click', function(e) {if (e.target.tagName == 'A') {return;}var x = e.pageX, y = e.pageY, span = document.createElement('span');span.textContent = coreSocialistValues[index];index = (index + 1) % coreSocialistValues.length;span.style.cssText = ['z-index: 9999999; position: absolute; font-weight: bold; color: #ff6651; top: ', y - 20, 'px; left: ', x, 'px;'].join('');document.body.appendChild(span);animate(span);});function animate(el) {var i = 0, top = parseInt(el.style.top), id = setInterval(frame, 16.7);function frame() {if (i > 180) {clearInterval(id);el.parentNode.removeChild(el);} else {i+=2;el.style.top = top - i + 'px';el.style.opacity = (180 - i) / 180;}}}}());</script>
	<!--鼠标特效结束-->
</body>
</html>