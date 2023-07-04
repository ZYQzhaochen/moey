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
		}
		.tou{
			float:left;
			height:80px;
			width:80px;
			margin-right:8px;
		}
		.box{
			height: 80px;
			background:repeating-linear-gradient(to left,#FFC0CB,white);
			transition: all 0.2s;/* 上浮过程需要的时间 */
			border: 1px solid #C0C0C0;
			font-size: 15px;
			line-height: 1.5;
			margin: 5px;
			border-radius: 1em;
			padding: 10px;
		}
		.box:hover {
			box-shadow: 0 16px 32px 0 rgba(48, 55, 66, 0.15);/* 鼠标悬浮时盒子出现的阴影 */
			transform: translate(0, -7px);/* 鼠标悬浮时盒子上移10px */
			cursor: pointer;
		}
	</style>
</head>
<body>
	<div style="background:rgba(255,255,255,0.6); border: 2px dashed #C0C0C0; min-height: 50px; font-size: 16px; line-height: 1.5; margin: 5px; border-radius: 0.8em;padding: 10px;">
		<h2><font color="#FF69B4">#</font> <font color="#696969">友链要求</font></h2>
		<p>只只只有一丢丢的要求：</p>
		<ul style="color:#696969;">
			<li>内容积极向上</li>
			<li>二次元、技术型、dalao型优先（附赠膝盖</li>
			<li>站点内不允许存在大量违反法律的内容</li>
			<li>并不是经常性不能访问（扶着墙也可以）（其余不对任何指标做任何计量）</li>
			<li>有♥，用♥</li>
		</ul>
		<p>如果符合上述条件并需要交换友链，请发送一份包含贵站信息的邮件给我们，内容可参考下方的“本站信息”。记得把本站加进你的友链列表中哦～ <a href="mailto:moeyz@qq.com" style="color: #FF69B4;text-decoration:none;" target="_blank">戳这里发送邮件(moeyz@qq.com)</a></p>
		<h2><font color="#FF69B4">#</font> <font color="#696969">站点信息</font></h2>
		<p>站点名称：萌言网<br>简介：可能是最最最萌的一言网站～<br>站点链接：https://moey.cn<br>站点头像url：https://moey.cn/favicon.ico</p>
		<hr style="height:2px;border:none;border-top:2px dotted #FF69B4;" />
		<center><h2>基情链接</h2></center>
		<center><p>同利者为朋，同心者为友。</p></center>
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
		echo '<a href="'.$link.'" style="color: #FF69B4;text-decoration:none;" target="_blank"><div class="box"><div class="tou"><img src="'.$tx.'" width="80" height="80" alt="该站点头像被外星人劫走啦qwq" style="border-radius: 50%;"></div><div class="limit"><b>'.$name.'</b></div><div class="limit">简介:'.$about.'</div></div></a>';
		}}?>
		<center><h2>自建网站</h2></center>
		<?php
		$mu = file_get_contents("../config/links-mynet.txt");
		$you = preg_match_all("/『站点名：(.*?)』『链接：(.*?)』『简介：(.*?)』『头像：(.*?)』/",$mu,$v);
		if($you== 0){
		echo "";
		}else{
		for( $i = 0 ; $i < $you && $i < $you ; $i ++ ){
		$name1=$v[1][$i];
		$link1=$v[2][$i];
		$about1=$v[3][$i];
		$tx1=$v[4][$i];
		echo '<a href="'.$link1.'" style="color: #FF69B4;text-decoration:none;" target="_blank"><div class="box"><div class="tou"><img src="'.$tx1.'" width="80" height="80" alt="该站点头像被外星人劫走啦qwq" style="border-radius: 50%;"></div><div class="limit"><b>'.$name1.'</b></div><div class="limit">简介:'.$about1.'</div></div></a>';
		}}?>
	</div>
	<center><p>¯\_(ツ)_/¯</p></center>
	<!--鼠标特效-->
	<script type="text/javascript">(function() {var coreSocialistValues = ["❤️", "🧡", "💛", "💚", "💙", "💜"], index = Math.floor(Math.random() * coreSocialistValues.length);document.body.addEventListener('click', function(e) {if (e.target.tagName == 'A') {return;}var x = e.pageX, y = e.pageY, span = document.createElement('span');span.textContent = coreSocialistValues[index];index = (index + 1) % coreSocialistValues.length;span.style.cssText = ['z-index: 99; position: absolute; font-weight: bold; color: #ff6651; top: ', y - 20, 'px; left: ', x, 'px;'].join('');document.body.appendChild(span);animate(span);});function animate(el) {var i = 0, top = parseInt(el.style.top), id = setInterval(frame, 16.7);function frame() {if (i > 180) {clearInterval(id);el.parentNode.removeChild(el);} else {i+=2;el.style.top = top - i + 'px';el.style.opacity = (180 - i) / 180;}}}}());</script>
	<!--鼠标特效结束-->
</body>
</html>