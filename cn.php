<!DOCTYPE html>
<html lang="cn">
<head>
<meta charset="UTF-8">
<title>萌言</title>
<link rel="preconnect" href="">
<link rel="preconnect" href="" crossorigin="">
<link rel="stylesheet" href="static/css/moey-style.css">
<link rel="stylesheet" href="static/css/ty.css">
<script src='static/js/jquery2.2.4.min.js'></script>
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
<style>
p {
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
<p id="text">努力捕获萌言中……<br>(等待网页资源Loarding)<br>(如长时间未加载请刷新网页)</p>
<button onclick="get_hitokoto()" style="cursor:url('images/pointer.cur'),pointer;">换一个</button>
</div>
</div>
</div>
<div id="rin-bg"></div>
<script src='static/js/vanilla-tilt.min.js'></script>
<script src="static/js/script.js"></script>
<script type="text/javascript">(function() {var coreSocialistValues = ["❤️", "🧡", "💛", "💚", "💙", "💜"], index = Math.floor(Math.random() * coreSocialistValues.length);document.body.addEventListener('click', function(e) {if (e.target.tagName == 'A') {return;}var x = e.pageX, y = e.pageY, span = document.createElement('span');span.textContent = coreSocialistValues[index];index = (index + 1) % coreSocialistValues.length;span.style.cssText = ['z-index: 9999999; position: absolute; font-weight: bold; color: #ff6651; top: ', y - 20, 'px; left: ', x, 'px;'].join('');document.body.appendChild(span);animate(span);});function animate(el) {var i = 0, top = parseInt(el.style.top), id = setInterval(frame, 16.7);function frame() {if (i > 180) {clearInterval(id);el.parentNode.removeChild(el);} else {i+=2;el.style.top = top - i + 'px';el.style.opacity = (180 - i) / 180;}}}}());</script>
<div style=" position:fixed; right:0px; bottom:0px; width:80px; height:100px; background-image:url('images/dt.gif');background-repeat: no-repeat;background-size: 100% 100%;"></div>
<script src="static/js/yinghua.js"></script>
</body>
</html>