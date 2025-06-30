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
	tr {
		color:#606060;
	}
	td {
		text-align:left;
	}
	th {
		text-align:center;
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
		<h2><font color="#FF69B4">#</font> <font color="#606060">注意</font></h2>
		<p>调用本站服务或在本站进行投稿，代表您已仔细阅读并同意<a href="tiaokuan.html">使用条款</a>。<br>本接口二次元图片资源均来源于网络，如果侵害了您的权益，请点击这里<a href="infringment.php" target="_blank">侵权申诉</a>。</p>
		<hr style="height:2px;border:none;border-top:2px dotted #FF69B4;" />
		<h2><font color="#FF69B4">#</font> <font color="#606060">请求地址</font></h2>
		<div style="background-color:rgba(255,255,255);color: #606060;padding:14px;border-left: 6px solid;border-color:rgba(100,149,237);word-wrap:break-word;">
			<b>请求地址：</b>https://<?php echo filter_input(INPUT_SERVER, "SERVER_NAME"); ?>/pic/<br>
			<b>访问协议：</b>HTTPS<br>
			<b>请求方式：</b>GET<br>
			<b>请求示例：</b>https://<?php echo filter_input(INPUT_SERVER, "SERVER_NAME"); ?>/pic/?type=img&form=auto
		</div>
		<h2><font color="#FF69B4">#</font> <font color="#606060">请求参数</font></h2>
		<table id="tab" align="center" border="1" width="100%" style="border-collapse:collapse;border-color:rgba(220,220,220)">
			<thead>
				<tr>
					<th>参数名称</th>
					<th>参数值</th>
					<th>参数说明</th>
					<th>参数类型</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>type</td>
					<td>•img(图片)<br>•json(json)<br>•text(图片链接)</td>
					<td>返回输出类型，不填默认为img</td>
					<td>可选</td>
				</tr>
				<tr>
					<td>form</td>
					<td>•auto(自适应)<br>•level(横屏图片)<br>•vertical(竖屏图片)</td>
					<td>图片类型，不填默认为auto</td>
					<td>可选</td>
				</tr>
			</tbody>
		</table>
		<h2><font color="#FF69B4">#</font> <font color="#606060">返回参数（json格式时）</font></h2>
		<table id="tab" align="center" border="1" width="100%" style="border-collapse:collapse;border-color:rgba(220,220,220);">
			<thead>
				<tr>
					<th>参数名称</th>
					<th>参数说明</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>code</td>
					<td>状态码(值为200时成功)</td>
				</tr>
				<tr>
					<td>id</td>
					<td>图片ID序号</td>
				</tr>
				<tr>
					<td>link</td>
					<td>图片文件直链</td>
				</tr>
				<tr>
					<td>form</td>
					<td>图片类型(值为level或vertical)</td>
				</tr>
			</tbody>
		</table>
		<h2><font color="#FF69B4">#</font> <font color="#606060">返回示例</font></h2>
		<div style="background-color:rgba(255,255,255);padding:14px;border-left:6px solid;border-color:rgba(255,0,0);">
			<div style="word-wrap:break-word;">
			<?php
			$s = file_get_contents("http://".$_SERVER['HTTP_HOST']."/pic/index.php?type=json&form=level");
			echo $s;
			?>
			</div>
		</div>
		<font color="#606060">上方显示的是type值为json、form值为level时的输出结果</font>
		<div style="background-color:rgba(255,255,255);padding:5px;border-left:6px solid;border-color:rgba(255,0,0);">
		<center><iframe src="../pic/index.php" style="width:98%;height:180px;background:white"></iframe></center>
		</div>
		<font color="#606060">上方显示的是type值为img、form值为auto时的输出结果，您也可以<a href="../pic/index.php" target="_blank">戳这里</a>查看实际效果</font>
	</div>
	<center><p style="animation: shake 1s;animation-iteration-count: infinite;">¯\_(ツ)_/¯</p></center>
	<center><p>萌言勉强运行了<span id="momk"></span></p></center>
	<div id="rin-bg"></div>
    <script type="text/javascript">
        $(function () {
            $("thead tr").css("background-color", "rgba(235,235,235)");
            $("tbody tr:even").css("background-color", "rgba(255,255,255)");
            $("tbody tr:odd").css("background-color", "rgba(235,235,235)");
        })
    </script>
	<script src="../static/js/ty.js"></script>
</body>
</html>