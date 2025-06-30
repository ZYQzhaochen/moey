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
		<p>调用本站服务或在本站进行投稿，代表您已仔细阅读并同意<a href="tiaokuan.html">使用条款</a>。</p>
		<hr style="height:2px;border:none;border-top:2px dotted #FF69B4;" />
		<h2><font color="#FF69B4">#</font> <font color="#606060">请求地址</font></h2>
		<div style="background-color:rgba(255,255,255);color:#606060;padding:14px;border-left: 6px solid;border-color:rgba(100,149,237);word-wrap:break-word;">
			<b>请求地址：</b>https://<?php echo filter_input(INPUT_SERVER, "SERVER_NAME"); ?>/yan/<br>
			<b>访问协议：</b>HTTPS<br>
			<b>请求方式：</b>GET<br>
			<b>请求示例：</b>https://<?php echo filter_input(INPUT_SERVER, "SERVER_NAME"); ?>/yan/?type=json&form=all<br>
			<b>收录语句：</b><i><?php $s=file_get_contents("../config/id.dat");echo $s;?></i> 条
		</div>
		<h2><font color="#FF69B4">#</font> <font color="#606060">请求参数</font></h2>
		<table id="tab" align="center" border="1" width="100%" style="border-collapse:collapse;border-color:rgba(220,220,220);">
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
					<td>•text<br>•json</td>
					<td>返回输出类型，不填默认为text(只返回正文和出处来源)</td>
					<td>可选</td>
				</tr>
				<tr>
					<td>form</td>
					<td>请见下方“句子类型”表单</td>
					<td>句子类型，不填默认为all(全部类型)</td>
					<td>可选</td>
				</tr>
			</tbody>
		</table>
		<div style="background-color:rgba(255,255,255);color:#606060;padding:5px;border-left: 6px solid;border-color:rgba(144,238,144);">
			<b>备注：</b>有关“form”参数的提交参数值的详细说明烦请见下文“句子类型”<br>
		</div>
		<h2><font color="#FF69B4">#</font> <font color="#606060">句子类型</font></h2>
		<table id="tab" align="center" border="1" width="100%" style="border-collapse:collapse;border-color:rgba(220,220,220);">
			<thead>
				<tr>
					<th>参数值</th>
					<th>说明</th>
				</tr>
			</thead>
			<tbody style="text-align:center;">
				<tr>
					<td>all</td>
					<td>以下全部类型</td>
				</tr>
				<tr>
					<td>a</td>
					<td>动画</td>
				</tr>
				<tr>
					<td>b</td>
					<td>漫画</td>
				</tr>
				<tr>
					<td>c</td>
					<td>游戏</td>
				</tr>
				<tr>
					<td>d</td>
					<td>文学</td>
				</tr>
				<tr>
					<td>e</td>
					<td>原创</td>
				</tr>
				<tr>
					<td>f</td>
					<td>来自网络</td>
				</tr>
				<tr>
					<td>g</td>
					<td>影视音乐</td>
				</tr>
				<tr>
					<td>h</td>
					<td>诗词</td>
				</tr>
				<tr>
					<td>i</td>
					<td>哲学</td>
				</tr>
				<tr>
					<td>j</td>
					<td>其他</td>
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
					<td>句子ID序号</td>
				</tr>
				<tr>
					<td>text</td>
					<td>正文</td>
				</tr>
				<tr>
					<td>form</td>
					<td>句子类型</td>
				</tr>
				<tr>
					<td>from</td>
					<td>句子出处</td>
				</tr>
				<tr>
					<td>from_who</td>
					<td>句子作者(该参数可能返回null，注意替换，建议优先使用from)</td>
				</tr>
				<tr>
					<td>creator</td>
					<td>提交者</td>
				</tr>
				<tr>
					<td>created_at</td>
					<td>提交时间(时间戳)</td>
				</tr>
				<tr>
					<td>length</td>
					<td>句子长度</td>
				</tr>
			</tbody>
		</table>
		<h2><font color="#FF69B4">#</font> <font color="#606060">返回示例</font></h2>
		<div style="background-color:rgba(255,255,255);padding:14px;border-left:6px solid;border-color:rgba(255,0,0);">
			<div style="word-wrap:break-word;"><?php
			$s=file_get_contents("http://".$_SERVER['HTTP_HOST']."/yan/index.php?type=json&form=a");
			echo $s;
			?></div>
		</div>
		<font color="#606060">上方显示的是type值为json、form值为a时的输出结果</font>
		<div style="background-color:rgba(255,255,255);padding:14px;border-left:6px solid;border-color:rgba(255,0,0);">
			<div style="word-wrap:break-word;"><?php
			$s1=file_get_contents("http://".$_SERVER['HTTP_HOST']."/yan/index.php?type=text&form=all");
			echo $s1;
			?></div>
		</div>
		<font color="#606060">上方显示的是type值为text、form值为all时的输出结果</font>
	</div>
	<center><p style="animation: shake 1s;animation-iteration-count: infinite;">¯\_(ツ)_/¯</p></center>
	<center><p>萌言勉强运行了<span id="momk"></span></p></center>
	<div id="rin-bg"></div>
	<script src="../static/js/jquery-3.7.0.min.js" type="text/javascript" charset="UTF-8"></script>
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