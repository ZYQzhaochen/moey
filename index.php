<?php 
header('Content-type:text/html; charset=utf-8');
require"config/config.php";
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1,maximum-scale=1,maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="robots" content="index,follow">
	<meta name="copyright" content="萌云网络">
	<meta name="keywords" content="萌言,萌言网,一言,api,接口,moey,二次元">
	<meta name="description" content="可能是最萌的一言/二次元图片接口网站～萌言是建立于2023年的非盈利公益性API调用平台，致力于传递更多爱和感动。">
	<meta name="author" content="moey">
	<title>萌言 - Moey</title>
	<link rel="stylesheet" href="static/css/reset.css">
	<link rel="stylesheet" href="static/css/lanren.css">
	<link rel="stylesheet" href="static/css/ty.css">
	<link rel="stylesheet" href="static/css/load.css">
	<link rel="stylesheet" href="static/css/moey-style.css">
	<link rel="Shortcut Icon"href="favicon.ico">
	<script src='static/js/jquery-3.7.0.min.js'></script>
	<script src='static/js/load.js'></script>
	<style>
	.wraper-page{display: flex;justify-content: center;align-items: center;touch-action:pan-y;}
	#rin-bg:after {
	top:0;
	left:0;
	right:0;
	bottom:0;
	content:'';
	z-index:-1;
	position:fixed;
	background-color:rgba(66,66,66,0.25);
		}
		body { overflow-x: hidden; touch-action: pan-y; }
	}

		/* 内容居中优化 */
		.container .card .content { padding: 30px 20px; display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:100%; }
		.container .card .content h2 { top: -30px; margin-bottom: 4px; color: rgba(255,255,255,0.5); text-shadow: 0 2px 20px rgba(255,105,180,0.5); }
		/* 字体优化 */
		#text { text-shadow: 0 2px 8px rgba(0,0,0,0.4); line-height: 1.6; margin-bottom: 2px; transition: opacity 0.4s ease; letter-spacing: 0.5px; }
		/* 按钮美化 - 毛玻璃风格 */
		.container .card .content button {
			background: rgba(255,105,180,0.35);
			backdrop-filter: blur(10px);
			color: #fff;
			border: 1px solid rgba(255,255,255,0.5);
			letter-spacing: 2px;
			padding: 8px 22px;
			font-size: 16px;
			font-family: sq;
			border-radius: 50px;
			box-shadow: 0 4px 15px rgba(0,0,0,0.15);
			transition: all 0.3s ease;
			cursor: pointer;
		}
		.container .card .content button:active {
			background: rgba(255,255,255,0.25);
			box-shadow: 0 6px 20px rgba(0,0,0,0.25);
		}
		@media (hover: hover) {
			.container .card .content button:hover {
				background: rgba(255,255,255,0.25);
				box-shadow: 0 6px 20px rgba(0,0,0,0.25);
			}
		}
		/* PC端卡片放大 */
		@media (min-width: 768px) {
			.container .card { width: 480px; height: 520px; border-radius: 24px; }
			.container .card .content { padding: 40px 30px; }
			.container .card .content h2 { font-size: 5.5em; top: -42px; }
			.container .card .content p { font-size: 1.8em; line-height: 1.7; }
			.container .card .content button { padding: 8px 28px; font-size: 17px; }
		}	</style>
</head>
<body>
	<div class="loaderbg">
		<div class="loading"></div>
		<p class="loadp">Loading</p>
	</div>
	<noscript>
		<style>
		.loaderbg {
			display: none;
		}
		</style>
	</noscript>
	<header class="header">
		<span class="btn-slide-bar"></span>
		<h1 class="page-title">Moey</h1>
	</header>
	<section class="wraper-page">
<div class="container">
<div class="card">
<div class="content">
<h2>萌言</h2>
<p id="text">正在装填萌言……</p>
<script>
var _timer=null;
function refreshHitokoto(){var el=document.getElementById('text');fetch('/jsapi.php').then(function(r){return r.json()}).then(function(d){el.style.opacity=0;setTimeout(function(){el.innerHTML=d.text;el.style.opacity=1},400)}).catch(function(){});clearInterval(_timer);_timer=setInterval(function(){refreshHitokoto()},30000)}
refreshHitokoto();
</script>
<button onclick="refreshHitokoto()" style="cursor:url('images/pointer.cur'),pointer;-webkit-tap-highlight-color:transparent;font-family:sq;">换一个</button>
</div>
</div>
</div>
<div id="rin-bg"></div>
<script src='static/js/vanilla-tilt.min.js'></script>
<script src="static/js/script.js"></script>
<script src="static/js/yinghua.js"></script>
	</section>
	<footer class="footer"><?php echo $foot ?></footer>
	<section class="slide-bar">
	<ul>
		<li class="logo-li"><center><div class="ttf-kat">萌言Moey</div></center></li>
		<li><a href="./" target="_top" class="sa"><img style="width:15px;height:15px" src="images/home.svg"> 首页</a></li>
		<li><a href="pages/about.php" target="_top" class="sa"><img style="width:15px;height:15px" src="images/about.svg"> 关于萌言</a></li>
		<li><a href="pages/links.php" target="_top" class="sa"><img style="width:15px;height:15px" src="images/link.svg"> 友情链接</a></li>
		<li class="sec-title">API接口：</li>
		<li><a href="pages/yapi-help.php" target="_top" class="sa"><img style="width:15px;height:15px" src="images/yan.svg"> 一言语句</a></li>
		<li><a href="pages/wpapi-help.php" target="_top" class="sa"><img style="width:15px;height:15px" src="images/wp.svg"> 二次元图片</a></li>
		<li class="sec-title">投稿：</li>
		<li><a href="pages/submit_y.php" target="_top" class="sa"><img style="width:15px;height:15px" src="images/submit.svg"> 一言语句</a></li>
		<li><a href="pages/submit_wp.php" target="_top" class="sa"><img style="width:15px;height:15px" src="images/submit.svg"> 二次元图片</a></li>
		<li class="sec-title">More：</li>
		<li><a href="pages/chat.php" target="_top" class="sa"><img style="width:15px;height:15px" src="images/chat.svg"> 留言板</a></li>
		<li><a href="pages/support.php" target="_top" class="sa"><img style="width:15px;height:15px" src="images/donate.svg"> 支持我们</a></li>
		<li><a href="pages/infringment.php" target="_top" class="sa"><img style="width:15px;height:15px" src="images/su.svg"> 侵权申诉</a></li>
		<li><a href="pages/open.php" target="_top" class="sa"><img style="width:15px;height:15px" src="images/ky.svg"> 开源</a></li>
		<li><a href="https://www.travellings.cn/go.html" target="_blank" rel="noopener" title="开往-友链接力" class="sa"><img style="width:15px;height:15px" src="images/tl.svg"> 「开往」</a></li>
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