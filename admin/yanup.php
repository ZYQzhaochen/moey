<?php
header('Content-type:text/html; charset=utf-8');
?>
<!--此页面仅供网站管理员进行快捷添加句库使用，请勿暴露给用户-->
<!--在config.php中定义密钥-->
<!DOCTYPE html>
<html lang="cn">
<html>
	<head>
		<title>萌言网 - 快速添加句子</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		<meta http-equiv="cache-control" content="no-cache">
		<meta charset="utf-8">
	</head>
	<body>
		<form action="datup_y.php" method="post">
			<fieldset>
				<legend>添加句子</legend>
				<ul>
					<li>
						<label>句子:</label>
						<input type="text" name="text">
					</li>
					<li>
						<label>出处:</label>
						<input type="text" name="from">
					</li>
					<li>
						<label>作者:</label>
						<input type="text" name="from_who">
					</li>
					<li>
						<label>句子类型:</label>
						<input type="text" name="form">
						<p><b>a：</b>动画； <b>b：</b>漫画； <b>c：</b>游戏； <b>d：</b>文学； <b>e：</b>原创； <b>f：</b>来自网络； <b>g：</b>其他； <b>h：</b>影视； <b>i：</b>诗词； <b>j：</b>网抑云； <b>k：</b>哲学； <b>l：</b>抖机灵</p>
					</li>
					<li>
						<label>密钥:</label>
						<input type="text" name="key">
					</li>
					<li>
						<label> </label>
						<input type="submit" name="upyan" value="提交">
					</li>
				</ul>
			</fieldset>
		</form>
	</body>
</html>