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
	.container {
		width:100%
		max-width:500px;
		margin:0 auto;
		padding:12px;
	}
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
	.t {
		color:#808080;
		font-family:dk;
		font-size:0.85rem;
	}
	label{
		color:#606060;
		font-family:dk;
	}
	ul{
		color:#606060;
		font-family:dk;
	}
	textarea {
		resize:vertical;
		min-height:60px;
		width:100%;
		padding:6px;
		border:1px solid #ccc;
		border-radius:4px;
		margin-bottom:6px;
		cursor:url('../images/text.cur'),text;
	}
	input {
		resize:vertical;
		width:100%;
		padding:6px;
		border:1px solid #ccc;
		border-radius:4px;
		margin-bottom:6px;
		cursor:url('../images/text.cur'),text;
	}
	input[type="submit"] {
		background-color:#FF69B4;
		color:#fff;
		border:none;
		padding:6px;
		border-radius:4px;
		font-size:1rem;
		width:100%;
	}
	input[type="submit"]:hover {
		background-color:#FF1493;
		cursor:url('../images/pointer.cur'),pointer;
	}
	select {
		display:block;
		background-color:white;
		width:100%;
		padding:6px;
		margin-bottom:8px;
		border:1px solid #ccc;
		border-radius:4px;
		cursor:url('../images/default.cur'),default;
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
		<h2><font color="#FF69B4">#</font> <font color="#606060">欢迎</font></h2>
		<p>欢迎您进行台词投稿。<br>您可以投稿各种生活或者网上冲浪中感动您的、让您产生思考的语句，也可以投稿您自己写的一段话，中、英、日文均可，字数上限50。<br>投稿成功后，您的稿件将在人工审核后上线。通常，稿件上线后无法删除、修改，如果您执意删除、修改，请将您的投稿证明(如提交者id)及相应句子发送邮件至<a href="mailto:zc@moey.cn">zc@moey.cn</a>，我们尊重您的一切权利</p>
		<h2><font color="#FF69B4">#</font> <font color="#606060">投稿</font></h2>
		<form action="sub_y.php" method="post">
			<fieldset style="background:rgba(255,255,255,0.5);border:2px double #606060;border-radius:10px;">
				<legend><div style="font-family:dk;color:#606060;">在线投稿</div></legend>
				<div class="container">
						<label>句子:</label><br>
						<textarea name="text" placeholder="必填，输入您想提交的句子，句尾请注意添加标点符号" required></textarea>
						<label>出处:</label>
						<input type="text" name="from" placeholder="必填，输入句子的来源/出处，如:紫罗兰永恒花园" required />
						<label>作者:</label>
						<input type="text" name="from_who" placeholder="选填，输入句子的作者，如:薇尔莉特">
						<div class="t">(此项选填，如无法考证句子作者可留空)</div>
						<label>提交者:</label>
						<input type="text" name="creator" placeholder="必填，输入您的昵称，作为提交凭证"required />
						<label>句子类型:</label>
						<select name="form">
							<option value="a">a 动画 (Anime)</option>
							<option value="b">b 漫画 (Comic)</option>
							<option value="c">c 游戏 (Game)</option>
							<option value="d">d 文学 (literature)</option>
							<option value="e">e 原创 (Myself)</option>
							<option value="f">f 来自网络 (Internet)</option>
							<option value="g">g 影视 (Movies)</option>
							<option value="h">h 诗词 (Poem)</option>
							<option value="i">i 哲学 (Philosophy)</option>
							<option value="j">j 其他 (Other)</option>
						</select>
						<div class="t">☟填写完毕？点此提交☟</div>
					<input type="submit" name="upyan" value="Biu～发射！">
				</ul>
				</div>
			</fieldset>
		</form>
		
		<p>➥想要其他投稿方式？您可以给我们<a href="mailto:zc@moey.cn">发送邮件</a>进行批量投稿。</p>
		<p>请您在邮件中包含以下内容：</p>
		<ul>
			<li>正文</li>
			<li>句子出处(也可以为“原创”/“网络”等……)</li>
			<li>句子作者(可选填)</li>
			<li>您的昵称(我们会将您的昵称记录在这条语句的“提交者”中，也可选择匿名)</li>
		</ul>
		<p>萌言因你更美好！＼＼\\٩( 'ω' )و //／／</p>
		<hr style="height:2px;border:none;border-top:2px dotted #FF69B4;" />
		<h2><font color="#FF69B4">#</font> <font color="#606060">注意</font></h2>
		<p>调用本站服务或在本站进行投稿，代表您已仔细阅读并同意<a href="tiaokuan.html">使用条款</a>。</p>
	</div>
	<center><p style="animation: shake 1s;animation-iteration-count: infinite;">¯\_(ツ)_/¯</p></center>
	<center><p>萌言勉强运行了<span id="momk"></span></p></center>
	<div id="rin-bg"></div>
	<script src="../static/js/ty.js"></script>
</body>
</html>