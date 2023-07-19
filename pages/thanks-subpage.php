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
			width: 40%;
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
		<p>感谢如下的个人、团体、开源项目向萌言网直接/间接提供的帮助。</p>
		<hr style="height:2px;border:none;border-top:2px dotted #FF69B4;" />
		<h2><font color="#FF69B4">#</font> <font color="#696969">团体</font></h2>
		<p>感谢以下向萌言网提供帮助的团体：</p>
		<?php
		$mu = file_get_contents("../config/thanks_team.txt");
		$you = preg_match_all("/『名字：(.*?)』『链接：(.*?)』『简介：(.*?)』『头像：(.*?)』/",$mu,$v);
		if($you== 0){
		echo "";
		}else{
		for( $i = 0 ; $i < $you && $i < $you ; $i ++ ){
		$name=$v[1][$i];
		$link=$v[2][$i];
		$about=$v[3][$i];
		$tx=$v[4][$i];
		echo '<a href="'.$link.'" style="color: #FF69B4;text-decoration:none;font-family:dk;" target="_blank"><div class="box"><div class="tou"><img src="'.$tx.'" width="60" height="60" alt="头像被外星人劫走啦" style="border-radius: 50%;"></div><div class="limit"><b>'.$name.'</b></div><div class="limit">'.$about.'</div></div></a>';
		}}?>
		<div style="clear:left;">
			<h2><font color="#FF69B4">#</font> <font color="#696969">个人</font></h2>
			<p>感谢以下向萌言网提供帮助的个人：</p>
		</div>
		<?php
		$mu = file_get_contents("../config/thanks_per.txt");
		$you = preg_match_all("/『名字：(.*?)』『链接：(.*?)』『简介：(.*?)』『头像：(.*?)』/",$mu,$v);
		if($you== 0){
		echo "";
		}else{
		for( $i = 0 ; $i < $you && $i < $you ; $i ++ ){
		$name1=$v[1][$i];
		$link1=$v[2][$i];
		$about1=$v[3][$i];
		$tx1=$v[4][$i];
		echo '<a href="'.$link1.'" style="color: #FF69B4;text-decoration:none;font-family:dk;" target="_blank"><div class="box"><div class="tou"><img src="'.$tx1.'" width="60" height="60" alt="头像被外星人劫走啦" style="border-radius: 50%;"></div><div class="limit"><b>'.$name1.'</b></div><div class="limit">'.$about1.'</div></div></a>';
		}}?>
		<div style="clear:left;">
			<h2><font color="#FF69B4">#</font> <font color="#696969">开源项目</font></h2>
			<p>感谢Moey直接使用到的部分开源项目（排名不分先后）：</p>
			<p><a href="https://github.com/hitokoto-osc/sentences-bundle" style="color: #FF69B4;text-decoration:none;" target="_blank">sentences-bundle</a>(一言语句库)</p>
		</div>
	</div>
	<center><p>¯\_(ツ)_/¯</p></center>
	<div id="rin-bg"></div>
	<script type="text/javascript">(function() {var coreSocialistValues = ["❤️", "🧡", "💛", "💚", "💙", "💜"], index = Math.floor(Math.random() * coreSocialistValues.length);document.body.addEventListener('click', function(e) {if (e.target.tagName == 'A') {return;}var x = e.pageX, y = e.pageY, span = document.createElement('span');span.textContent = coreSocialistValues[index];index = (index + 1) % coreSocialistValues.length;span.style.cssText = ['z-index: 9999999; position: absolute; font-weight: bold; color: #ff6651; top: ', y - 20, 'px; left: ', x, 'px;'].join('');document.body.appendChild(span);animate(span);});function animate(el) {var i = 0, top = parseInt(el.style.top), id = setInterval(frame, 16.7);function frame() {if (i > 180) {clearInterval(id);el.parentNode.removeChild(el);} else {i+=2;el.style.top = top - i + 'px';el.style.opacity = (180 - i) / 180;}}}}());</script>
	<div style=" position:fixed; right:0px; bottom:0px; width:80px; height:100px; background-image:url('../images/dt.gif');background-repeat: no-repeat;background-size: 100% 100%;"></div>
</body>
</html>