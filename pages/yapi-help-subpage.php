<!DOCTYPE html>
<html lang="cn">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1,maximum-scale=1,maximum-scale=1, user-scalable=no" name="viewport">
	<title>萌言</title>
	<link rel="stylesheet" href="../static/css/ty.css">
	<style>
		p {
			color: #696969;
			font-family:dk;
		}
	</style>
</head>
<body>
	<script src="../static/js/yinghua.js"></script>
	<div style="background:rgba(255,255,255,0.6); border: 2px dashed #C0C0C0; min-height: 50px; font-size: 16px; line-height: 1.5; margin: 5px; border-radius: 0.8em;padding: 10px;">
		<h2><font color="#FF69B4">#</font> <font color="#696969">注意</font></h2>
		<p>调用本站服务或在本站进行投稿，代表您已仔细阅读并同意<a href="tiaokuan.html" style="color: #FF69B4;text-decoration:none;">使用条款</a>。</p>
		<hr style="height:2px;border:none;border-top:2px dotted #FF69B4;" />
		<h2><font color="#FF69B4">#</font> <font color="#696969">请求地址</font></h2>
		<div style="background-color:white;color: #696969;padding:14px;border-left: 6px solid;border-color:#6495ED;">
			<b>请求地址：</b><?php echo filter_input(INPUT_SERVER, "SERVER_NAME"); ?>/yan<br>
			<b>访问协议：</b>HTTPS<br>
			<b>请求方式：</b>GET<br>
			<b>请求示例：</b>https://<?php echo filter_input(INPUT_SERVER, "SERVER_NAME"); ?>/yan?type=json
		</div>
		<h2><font color="#FF69B4">#</font> <font color="#696969">请求参数</font></h2>
		<div style="background-color:white;color: #696969;padding:14px;border-left: 6px solid;border-color:#6495ED;">
			<b>type：</b><i>（选填）</i>返回输出类型，填text/json，不填默认为text(只返回正文和出处来源)<br>
			<b>form：</b><i>（选填）</i>句子类型，详细参数说明请看下文“句子类型”，不填默认为all(全部类型)<br>
		</div>
		<h2><font color="#FF69B4">#</font> <font color="#696969">句子类型</font></h2>
		<div style="background-color:white;color: #696969;padding:14px;border-left: 6px solid;border-color:#6495ED;">
			<b>all：</b>以下全部类型<br>
			<b>a：</b>动画<br>
			<b>b：</b>漫画<br>
			<b>c：</b>游戏<br>
			<b>d：</b>文学<br>
			<b>e：</b>原创<br>
			<b>f：</b>来自网络<br>
			<b>g：</b>其他<br>
			<b>h：</b>影视<br>
			<b>i：</b>诗词<br>
			<b>j：</b>网抑云<br>
			<b>k：</b>哲学<br>
			<b>l：</b>抖机灵<br>
		</div>
		<h2><font color="#FF69B4">#</font> <font color="#696969">返回参数（json格式时）</font></h2>
		<div style="background-color:white;color: #696969;padding:14px;border-left: 6px solid;border-color:#6495ED;">
			<b>code：</b>状态码<br>
			<b>id：</b>句子序号<br>
			<b>text：</b>正文<br>
			<b>form：</b>句子类型<br>
			<b>from：</b>句子出处<br>
			<b>from_who：</b>句子作者(该参数可能返回null，注意替换)<br>
			<b>creator：</b>提交者<br>
			<b>length：</b>句子长度<br>
		</div>
		<h2><font color="#FF69B4">#</font> <font color="#696969">返回示例</font></h2>
		<div style="background-color:white;padding:14px;border-left: 6px solid;border-color:red;">
			<?php
			$s = file_get_contents("http://".$_SERVER['HTTP_HOST']."/yan/?type=json&form=all");
			echo $s;
			?>
		</div>
		<font color="#696969">上方显示的是type值为json、form值为all时的输出结果</font>
	</div>
	<center><p>¯\_(ツ)_/¯</p></center>
	<div id="rin-bg"></div>
	<script type="text/javascript">(function() {var coreSocialistValues = ["❤️", "🧡", "💛", "💚", "💙", "💜"], index = Math.floor(Math.random() * coreSocialistValues.length);document.body.addEventListener('click', function(e) {if (e.target.tagName == 'A') {return;}var x = e.pageX, y = e.pageY, span = document.createElement('span');span.textContent = coreSocialistValues[index];index = (index + 1) % coreSocialistValues.length;span.style.cssText = ['z-index: 9999999; position: absolute; font-weight: bold; color: #ff6651; top: ', y - 20, 'px; left: ', x, 'px;'].join('');document.body.appendChild(span);animate(span);});function animate(el) {var i = 0, top = parseInt(el.style.top), id = setInterval(frame, 16.7);function frame() {if (i > 180) {clearInterval(id);el.parentNode.removeChild(el);} else {i+=2;el.style.top = top - i + 'px';el.style.opacity = (180 - i) / 180;}}}}());</script>
	<div style=" position:fixed; right:0px; bottom:0px; width:80px; height:100px; background-image:url('../images/dt.gif');background-repeat: no-repeat;background-size: 100% 100%;"></div>
</body>
</html>