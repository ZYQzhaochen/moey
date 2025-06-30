<?php
header('Content-type:text/html; charset=utf-8');
?>
<!--此页面仅供网站管理员进行快捷添加友链使用，请勿暴露给用户-->
<!--在config.php中定义密钥-->
<!DOCTYPE html>
<html lang="zh-CN">
<html>
	<head>
		<title>萌言网 - 添加友链</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		<meta http-equiv="cache-control" content="no-cache">
		<meta charset="utf-8">
	</head>
	<body>
		<form action="lp_deal.php" method="post">
			<fieldset>
				<legend>添加友链</legend>
				<ul>
					<li>
						<label>站点名:</label>
						<input type="text" name="name">
					</li>
					<li>
						<label>链接:</label>
						<input type="text" name="link">
					</li>
					<li>
						<label>头像url:</label>
						<input type="text" name="tx">
					</li>
					<li>
						<label>简介:</label>
						<input type="text" name="about">
					</li>
					<li>
						<label>密钥:</label>
						<input type="text" name="key">
					</li>
					<li>
						<label> </label>
						<input type="submit" name="lp" value="提交">
					</li>
				</ul>
			</fieldset>
		</form>
	</body>
</html>