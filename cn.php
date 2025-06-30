<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<title>萌言</title>
<meta name="robots" content="noindex">
<link rel="stylesheet" href="static/css/moey-style.css">
<link rel="stylesheet" href="static/css/ty.css">
<script src='static/js/jquery-3.7.0.min.js'></script>
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
<style>
p {
font-family:sq;
}
b {
font-family:sq;
}
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
</style>
</head>
<body onload="get_hitokoto()">
<div class="container">
<div class="card">
<div class="content">
<h2>萌言</h2>
<p id="text">正在装填萌言……<br>(等待网页资源Loarding)</p>
<button onclick="get_hitokoto()" style="cursor:url('images/pointer.cur'),pointer;-webkit-tap-highlight-color: transparent;">换一个</button>
</div>
</div>
</div>
<div id="rin-bg"></div>
<script src='static/js/vanilla-tilt.min.js'></script>
<script src="static/js/script.js"></script>
<script src="static/js/yinghua.js"></script>
</body>
</html>