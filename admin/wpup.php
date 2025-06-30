<?php
header('Content-type:text/html; charset=utf-8');
?>
<!--此页面仅供网站管理员进行快捷添加图片使用，请勿暴露给用户-->
<!--在config.php中定义密钥-->
<!DOCTYPE html>
<html lang="zh-CN">
<html>
	<head>
		<title>萌言网 - 快速添加图片</title>
		<meta name="robots" content="noindex,nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		<meta http-equiv="cache-control" content="no-cache">
		<meta charset="utf-8">
	</head>
	<body>
		<form action="datup_wp.php" method="post">
			<fieldset>
				<legend>添加图片</legend>
				<ul>
					<li>
						<label>链接:</label>
						<input type="text" name="link">
					</li>
					<li>
						<label>类型:</label>
						<input type="text" name="form">
						<p><b>level：</b>横屏； <b>vertical：</b>竖屏</p>
					</li>
					<li>
						<label>密钥:</label>
						<input type="text" name="key">
					</li>
					<li>
						<label> </label>
						<input type="submit" name="upwp" value="提交">
					</li>
				</ul>
			</fieldset>
		</form>
	</body>
</html>