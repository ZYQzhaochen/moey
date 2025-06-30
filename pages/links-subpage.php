<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1,maximum-scale=1,maximum-scale=1, user-scalable=no" name="viewport">
	<title>萌言</title>
	<meta name="robots" content="noindex">
	<link rel="stylesheet" href="../static/css/ty.css">
	<link rel="stylesheet" href="../static/css/load.css">
	<style>
	p {
		color:#606060;
		font-family:dk;
	}
	a {
		color:#FF69B4;
		text-decoration:none;
		-webkit-tap-highlight-color: transparent;
	}
	a:hover {
		text-decoration:underline;
		text-decoration-style:dashed;
	}
	.tou{
		float:left;
		height:60px;
		width:60px;
		margin-right:8px;
		-webkit-transition: 0.4s;
		-webkit-transition: -webkit-transform 0.4s ease-out;
		transition: transform 0.4s ease-out;
		-moz-transition: -moz-transform 0.4s ease-out;
	}
	.tou:hover{
		-webkit-transform: rotateZ(360deg);
		transform:rotate(360deg);
	}
	.box{
		height:60px;
		background:repeating-linear-gradient(to left,#FFC0CB,white);
		transition:all 0.25s;/*上浮过程需要的时间*/
		border:1px solid #FFC0CB;
		font-size:15px;
		line-height:1.5;
		margin:5px;
		border-radius:0em;
		padding:10px;
		cursor:url('../images/pointer.cur'),pointer;
	}
	@media all and (orientation : landscape){
	.box{
		float:left;
		height:60px;
		width:42%;
		background:repeating-linear-gradient(to left,#FFC0CB,white);
		transition:all 0.25s;/*上浮过程需要的时间*/
		border:0px solid #C0C0C0;
		font-size:15px;
		line-height:1.5;
		margin:5px;
		border-radius:0.5em;
		padding:10px;
		cursor:url('../images/pointer.cur'),pointer;
	}}
	.box:hover {
		box-shadow: 0 10px 10px 0 rgba(48, 55, 66, 0.4);/*鼠标悬浮时盒子出现的阴影*/
		transform: translate(0, -2px);/*鼠标悬浮时盒子上移的px*/
		cursor:url('../images/pointer.cur'),pointer;
	}
	tr {
		text-align: center;
	}
	td {
		font-family:dk;
		color:#606060;
	}
	th {
		color:#666666;
	}
	.links {
		color:#666666;
		text-decoration:none;
		font-family:sq;
	}
	.links:hover {
		color:#FF69B4;
		text-decoration:none;
		font-family:sq;
	}
	</style>
	<script src='../static/js/jquery-3.7.0.min.js'></script>
	<script src='../static/js/load.js'></script>
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
	<script src="../static/js/yinghua.js"></script>
	<div style="background:rgba(255,255,255,0.6);border:2px dashed #C0C0C0;min-height:50px;font-size:16px;line-height:1.5;margin: 5px auto;border-radius:0.8em;padding:10px;max-width:1000px;">
		<p style="text-align:center;"><i style="color:#333333;font-size:21px;">同利者为朋，同心者为友</i><br>（友链随机排序，排名不分先后）</p>
		<?php
		$lines=file("../config/links.txt",FILE_IGNORE_NEW_LINES);
		shuffle($lines);
		$mu="";
		foreach ($lines as $line){
		$mu.=$line."\n";
		}$you=preg_match_all("/{name:(.*?)}{link:(.*?)}{about:(.*?)}{logo:(.*?)}/",$mu,$v);
		if($you==0){
		echo "";
		}else{
		for($i=0;$i<$you&&$i<$you;$i++){
		$name=$v[1][$i];
		$link=$v[2][$i];
		$about=$v[3][$i];
		$tx=$v[4][$i];
		echo '<a href="'.$link.'" class="links" target="_blank"><div class="box"><div class="tou"><img onerror="this.src=\'../images/fail.jpg\'" src="'.$tx.'" width="60" height="60" style="border-radius: 50%;"/></div><div class="limit"><b style="font-size:1.2rem;">'.$name.'</b></div><div class="limit">'.$about.'</div></div></a>';
		}}?>
		<div style="clear:left;">
			<hr style="height:2px;border:none;border-top:2px dotted #FF69B4;" />
			<h2><font color="#FF69B4">#</font> <font color="#606060">友链要求</font></h2>
			<p>只有一丢丢的要求：</p>
			<ul style="color:#606060;font-family:dk;">
				<li>内容积极向上</li>
				<li>二次元、技术型、dalao型优先（附赠膝盖</li>
				<li>站点内不允许存在大量违反法律的内容</li>
				<li>并不是经常性不能访问（扶着墙也可以）（其余不对任何指标做任何计量）</li>
				<li>有♥，用♥</li>
			</ul>
			<p>如果符合上述条件并需要交换友链，请填写下方的友链申请问卷或者发送一份包含贵站信息的邮件给我们，内容可参考下方的“本站信息”。记得把本站加进你的友链列表中哦～</p><p>友链申请表：<a href="https://wj.qq.com/s2/12711746/1a14/" target="_blank">https://wj.qq.com/s2/12711746/1a14/</a><br>邮箱：<a href="mailto:zc@moey.cn" target="_blank">zc@moey.cn</a><br>↑请选择您想要的姿势_(:зゝ∠)_</p><p>如需修改友链信息，也请同上发送邮件给我们～</p>
			<h2><font color="#FF69B4">#</font> <font color="#606060">本站信息</font></h2>
			<div style="background-color:rgba(255,255,255,0.9);color:#606060;padding:14px;border-left: 6px solid;border-color:rgba(100,149,237,0.9);">
			<b>站点名称：</b>萌言Moey<br>
			<b>站点描述：</b>一个萌萌の句子收藏站<br>
			<b>站点链接：</b>https://moey.cn/<br>
			<b>站点头像：</b><span id="copyText1" style="word-wrap:break-word;">https://pic.imgdb.cn/item/64a7c06e1ddac507ccdfe43f.jpg</span>
			<input type="button" onClick="copy1()" value="点我复制URL"/>
			</div>
			<h2><font color="#FF69B4">#</font> <font color="#606060">失联友链</font></h2>
			<p>以下临时停靠近期因各类原因与本站丢失契约的网站，如有特殊情况请通过邮件告知～</p>
			<table id="tab" align="center" border="1" width="100%" style="border-collapse:collapse;border-color:rgba(220,220,220,0.9);">
				<thead>
					<tr>
						<th>站点名称</th>
						<th>站点域名</th>
						<th>移除原因</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>暂无</td>
						<td>暂无</td>
						<td>暂无</td>
					</tr>
					<tr>
						<td>……</td>
						<td>……</td>
						<td>……</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<center><p style="animation: shake 1s;animation-iteration-count: infinite;">¯\_(ツ)_/¯</p></center>
	<center><p>萌言勉强运行了<span id="momk"></span></p></center>
	<div id="rin-bg"></div>
	<script type="text/javascript">
		$(function () {
			$("thead tr").css("background-color", "rgba(235,235,235,0.9)");
			$("tbody tr:even").css("background-color", "rgba(255,255,255,0.9)");
			$("tbody tr:odd").css("background-color", "rgba(235,235,235,0.9)");
		})
		
		function copy1() {
			var copy = document.getElementById("copyText1").innerText;
			var oInput = document.createElement('input');
			oInput.value = copy;
			document.body.appendChild(oInput);
			oInput.select(); // 选择对象
			document.execCommand("Copy"); // 执行浏览器复制命令
			oInput.className = 'oInput';
			oInput.style.display = 'none';
			alert('站点头像链接已复制到剪切板～');
		}
	</script>
	<script src="../static/js/ty.js"></script>
</body>
</html>