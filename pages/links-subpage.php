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
		.tou{
			float:left;
			height:60px;
			width:60px;
			margin-right:8px;
		}
		.box{
			height: 60px;
			background:repeating-linear-gradient(to left,#FFC0CB,white);
			transition: all 0.25s;/*上浮过程需要的时间*/
			border: 0px solid #C0C0C0;
			font-size: 15px;
			line-height: 1.5;
			margin: 5px;
			border-radius: 0.5em;
			padding: 10px;
			cursor:url('../images/pointer.cur'),pointer;
		}
		@media all and (orientation : landscape){
		.box{
			float:left;
			height: 60px;
			width: 42%;
			background:repeating-linear-gradient(to left,#FFC0CB,white);
			transition: all 0.25s;/*上浮过程需要的时间*/
			border: 0px solid #C0C0C0;
			font-size: 15px;
			line-height: 1.5;
			margin: 5px;
			border-radius: 0.5em;
			padding: 10px;
			cursor:url('../images/pointer.cur'),pointer;
		}
		}
		.box:hover {
			box-shadow: 0 10px 10px 0 rgba(48, 55, 66, 0.4);/*鼠标悬浮时盒子出现的阴影*/
			transform: translate(0, -2px);/*鼠标悬浮时盒子上移的px*/
			cursor:url('../images/pointer.cur'),pointer;
		}
	</style>
</head>
<body>
	<script src="../static/js/yinghua.js"></script>
	<div style="background:rgba(255,255,255,0.6); border: 2px dashed #C0C0C0; min-height: 50px; font-size: 16px; line-height: 1.5; margin: 5px; border-radius: 0.8em;padding: 10px;">
		<center><h2>基情链接</h2></center>
		<p style="text-align:center;">同利者为朋，同心者为友。</p>
		<?php
		$mu = file_get_contents("../config/links.txt");
		$you = preg_match_all("/『站点名：(.*?)』『链接：(.*?)』『简介：(.*?)』『头像：(.*?)』/",$mu,$v);
		if($you== 0){
		echo "";
		}else{
		for( $i = 0 ; $i < $you && $i < $you ; $i ++ ){
		$name=$v[1][$i];
		$link=$v[2][$i];
		$about=$v[3][$i];
		$tx=$v[4][$i];
		echo '<a href="'.$link.'" style="color: #FF69B4;text-decoration:none;font-family:dk;" target="_blank"><div class="box"><div class="tou"><img src="'.$tx.'" width="60" height="60" alt="站点头像被外星人劫走啦" style="border-radius: 50%;"></div><div class="limit"><b>'.$name.'</b></div><div class="limit">简介:'.$about.'</div></div></a>';
		}}?>
		<div style="clear:left;">
			<hr style="height:2px;border:none;border-top:2px dotted #FF69B4;" />
			<h2><font color="#FF69B4">#</font> <font color="#696969">友链要求</font></h2>
			<p>只只只有一丢丢的要求：</p>
			<ul style="color:#696969;font-family:dk;">
				<li>内容积极向上</li>
				<li>二次元、技术型、dalao型优先（附赠膝盖</li>
				<li>站点内不允许存在大量违反法律的内容</li>
				<li>并不是经常性不能访问（扶着墙也可以）（其余不对任何指标做任何计量）</li>
				<li>有♥，用♥</li>
			</ul>
			<p>如果符合上述条件并需要交换友链，请填写下方的友链申请问卷或者发送一份包含贵站信息的邮件给我们，内容可参考下方的“本站信息”。记得把本站加进你的友链列表中哦～</p><p>友链申请表：<a href="https://wj.qq.com/s2/12711746/1a14/" style="color: #FF69B4;text-decoration:none;" target="_blank">https://wj.qq.com/s2/12711746/1a14/</a><br>邮箱：<a href="mailto:zc@moey.cn" style="color: #FF69B4;text-decoration:none;" target="_blank">zc@moey.cn</a><br>↑请选择您想要的姿势_(:зゝ∠)_</p><p>如需修改友链信息，也请同上发送邮件给我们～</p>
			<h2><font color="#FF69B4">#</font> <font color="#696969">本站信息</font></h2>
			<p>站点名称：萌言网Moey<br>站点描述：二次元图片/一言接口网站<br>站点链接：https://moey.cn/<br>站点头像url：https://moey.cn/favicon.ico</p>
		</div>
	</div>
	<center><p>¯\_(ツ)_/¯</p></center>
	<div id="rin-bg"></div>
	<script type="text/javascript">(function() {var coreSocialistValues = ["❤️", "🧡", "💛", "💚", "💙", "💜"], index = Math.floor(Math.random() * coreSocialistValues.length);document.body.addEventListener('click', function(e) {if (e.target.tagName == 'A') {return;}var x = e.pageX, y = e.pageY, span = document.createElement('span');span.textContent = coreSocialistValues[index];index = (index + 1) % coreSocialistValues.length;span.style.cssText = ['z-index: 99; position: absolute; font-weight: bold; color: #ff6651; top: ', y - 20, 'px; left: ', x, 'px;'].join('');document.body.appendChild(span);animate(span);});function animate(el) {var i = 0, top = parseInt(el.style.top), id = setInterval(frame, 16.7);function frame() {if (i > 180) {clearInterval(id);el.parentNode.removeChild(el);} else {i+=2;el.style.top = top - i + 'px';el.style.opacity = (180 - i) / 180;}}}}());</script>
	<div style=" position:fixed; right:0px; bottom:0px; width:80px; height:100px; background-image:url('../images/dt.gif');background-repeat: no-repeat;background-size: 100% 100%;"></div>
</body>
</html>