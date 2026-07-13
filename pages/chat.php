<?php
header('Content-type:text/html; charset=utf-8');
require"../config/config.php";
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1,maximum-scale=1,maximum-scale=1, user-scalable=no" name="viewport">
	<title>留言板 | 萌言Moey</title>
	<meta name="robots" content="index,follow">
	<meta name="keywords" content="萌言,萌言网,moey,api,萌云网络,留言板">
	<meta name="description" content="有什么话想要告诉萌言？欢迎在这里留下自己的足记！">
	<link rel="stylesheet" href="../static/css/reset.css">
	<link rel="stylesheet" href="../static/css/lanren.css">
	<link rel="stylesheet" href="../static/css/ty.css">
	<link rel="Shortcut Icon"href="../favicon.ico">
	<style>
	body {
		font-family:Arial, sans-serif;
		margin:0;
		padding:0;
	}
	.container {
		max-width:900px;
		margin:0 auto;
		padding:10px;
	}
	h1 {
		text-align:center;
		font-size:2rem;
		margin-bottom:14px;
		font-family:sq;
	}
	form {
		display:flex;
		flex-direction:column;
		margin-bottom:12px;
	}
	label {
		font-family:dk;
		display: block;
		margin-bottom:5px;
		cursor:url('../images/default.cur'),default;
	}
	input[type="text"],
	textarea {
		padding:10px;
		border:1px solid #ccc;
		border-radius:4px;
		margin-bottom:12px;
		font-size:15px;
		cursor:url('../images/text.cur'),text;
	}
	textarea {
		resize:vertical;
		min-height:100px;
		cursor:url('../images/text.cur'),text;
	}
	input[type="submit"] {
		background-color:#FF69B4;
		color:#fff;
		border:none;
		padding:10px;
		border-radius:4px;
		cursor:pointer;
		font-size:15px;
	}
	input[type="submit"]:hover {
		background-color:#FF1493;
		cursor:url('../images/pointer.cur'),pointer;
	}
	select {
		display:block;
		width:100%;
		padding:5px;
		margin-bottom:10px;
		border:1px solid #ccc;
		border-radius:3px;
		cursor:url('../images/default.cur'),default;
	}
	.messages {
		list-style:none;
		margin:0;
		padding:0;
	}
	input[type="email"],
	  textarea {
		padding:10px;
		border:1px solid #ccc;
		border-radius:4px;
		margin-bottom:12px;
		font-size:15px;
		cursor:url('../images/text.cur'),text;
	}
	.message {
		border:1px dashed #FF69B4;
		border-radius:4px;
		padding:8px 10px;
		margin-bottom:14px;
	}
	.message:hover {
		border:1px solid #FF69B4;
	}
	.message__header {
		display:flex;
		justify-content:space-between;
		align-items:center;
		margin-bottom:6px;
	}
	.message__author {
		font-weight:bold;
		font-family:sq;
		font-size:16px;
	}
	.message__date {
		color:#777;
		font-family:sq;
		font-size:15px;
	}
	.message__content {
		white-space:pre-wrap;
		font-family:sq;
		font-size:16px;
		line-height:1.6;
	}
	.page-nav { text-align:center; margin-top:12px; }
	.page-nav a, .page-nav span { display:inline-block; padding:4px 10px; margin:0 2px; border-radius:4px; text-decoration:none; font-size:14px; }
	.page-nav span { background:#FF69B4; color:#fff; }
	.page-nav a { background:#eee; color:#555; }
	.captcha-row { display:flex; align-items:center; gap:8px; margin-bottom:12px; flex-wrap:wrap; }
	.captcha-row label { margin-bottom:0; white-space:nowrap; }
	.captcha-row input { width:110px; margin-bottom:0; }.captcha-img { height:36px; border:1px solid #ccc; border-radius:3px; cursor:pointer; }
	</style>
</head>
<body>
	<header class="header">
		<span class="btn-slide-bar"></span>
		<h1 class="page-title">留言板</h1>
	</header>
	<section class="wraper-page">
		<div class="container">
			<div style="background:rgba(255,255,255,0.7); border: 2px dashed #C0C0C0; min-height: 50px; font-size: 16px; line-height: 1.5; margin: 5px; border-radius: 0.8em;padding: 10px;">
				<div id="rin-bg"></div>
				<h1 style="font-size: 39px;font-weight:bold;">萌言萌语</h1>
				<form id="message-form" method="post" action="save_message.php">
					<label for="name">昵称：</label>
					<input type="text" id="name" name="name" required />
					<label for="email">邮箱：</label>
					<input type="email" id="email" name="email" required />
					<label for="message">留言：</label>
					<textarea id="message" name="message" required></textarea>
					<div class="captcha-row">
						<label>人机验证：</label>
						<img src="/captcha.php" class="captcha-img" onclick="this.src='/captcha.php?'+Math.random()" title="点击刷新验证码">
						<input type="text" name="captcha_input" required placeholder="请输入验证码" autocomplete="off">
					</div>
					<input type="submit" id="submit-btn" value="Biu～发射！" />
					<span id='rate-limit-msg' style='display:none; color:#FF1493; font-family:sq; margin-left:10px;'></span>
				</form>
				<!-- 留言列表 -->
				<ul id="messages" class="messages">
					<?php
					// 创建数据库连接
					require"../config/config.php";
					$conn = new mysqli($servername, $username, $password, $dbname);
					if ($conn->connect_error) {
						die("数据库连接失败: " . $conn->connect_error);
					}
					$conn->query("SET NAMES utf8mb4");

					// 分页查询
					$count_result = $conn->query("SELECT COUNT(*) as total FROM messages");
					$total = $count_result->fetch_assoc()["total"];
					$per_page = 10;
					$page = isset($_GET["page"]) ? max(1, intval($_GET["page"])) : 1;
					$total_pages = ceil($total / $per_page);
					$offset = ($page - 1) * $per_page;
					$result = $conn->query("SELECT * FROM messages ORDER BY date DESC LIMIT $offset, $per_page");

					if ($result !== false && $result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo '<li class="message">';
							echo '<div class="message__header">';
							echo '<span class="message__author">' . htmlspecialchars($row["name"], ENT_QUOTES, 'UTF-8') . '</span>';
							echo '<span class="message__date">' . $row["date"] . '</span>';
							echo '</div>';
							echo '<div class="message__content">' . htmlspecialchars($row["message"], ENT_QUOTES, 'UTF-8') . '</div>';
							echo '</li>';
						}
					} else {
						echo '<li class="message">暂无留言，快来抢占沙发叭</li>';
					}
					$conn->close();
					?>
				</ul>
				<?php if ($total_pages > 1): ?>
				<div class="page-nav">
					<?php for ($i = 1; $i <= $total_pages; $i++): ?>
						<?php if ($i === $page): ?>
							<span><?php echo $i; ?></span>
						<?php else: ?>
							<a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
						<?php endif; ?>
					<?php endfor; ?>
				</div>
				<?php endif; ?>
			</div>
			<center style="animation: shake 1s;animation-iteration-count: infinite;"><font color="#606060">¯\_(ツ)_/¯</font></center>
		</div>
		<script src="../static/js/ty.js"></script>
	</section>
	<footer class="footer"><?php echo $foot ?></footer>
	<section class="slide-bar">
		<ul>
			<li class="logo-li"><center><div class="ttf-kat">萌言Moey</div></center></li>
			<li><a href="../" target="_top" class="sa"><img style="width:15px;height:15px" src="../images/home.svg"> 首页</a></li>
			<li><a href="about.php" target="_top" class="sa"><img style="width:15px;height:15px" src="../images/about.svg"> 关于萌言</a></li>
			<li><a href="links.php" target="_top" class="sa"><img style="width:15px;height:15px" src="../images/link.svg"> 友情链接</a></li>
		<li class="sec-title">API接口：</li>
			<li><a href="yapi-help.php" target="_top" class="sa"><img style="width:15px;height:15px" src="../images/yan.svg"> 一言语句</a></li>
			<li><a href="wpapi-help.php" target="_top" class="sa"><img style="width:15px;height:15px" src="../images/wp.svg"> 二次元图片</a></li>
		<li class="sec-title">投稿：</li>
			<li><a href="submit_y.php" target="_top" class="sa"><img style="width:15px;height:15px" src="../images/submit.svg"> 一言语句</a></li>
			<li><a href="submit_wp.php" target="_top" class="sa"><img style="width:15px;height:15px" src="../images/submit.svg"> 二次元图片</a></li>
		<li class="sec-title">More：</li>
			<li><a href="chat.php" target="_top" class="sa"><img style="width:15px;height:15px" src="../images/chat.svg"> 留言板</a></li>
			<li><a href="support.php" target="_top" class="sa"><img style="width:15px;height:15px" src="../images/donate.svg"> 支持我们</a></li>
			<li><a href="infringment.php" target="_top" class="sa"><img style="width:15px;height:15px" src="../images/su.svg"> 侵权申诉</a></li>
			<li><a href="open.php" target="_top" class="sa"><img style="width:15px;height:15px" src="../images/ky.svg"> 开源</a></li>
		<li><a href="https://www.travellings.cn/go.html" target="_blank" rel="noopener" title="开往-友链接力" class="sa"><img style="width:15px;height:15px" src="../images/tl.svg"> 「开往」</a></li>
		</ul>
	</section>
	<script>
		document.addEventListener("DOMContentLoaded", function(){
			(function(){
				var _btn  = document.querySelector(".btn-slide-bar"),
					_body = document.querySelector("body");
					_btn.onclick = function(){
						_body.classList.toggle("active");
					}
			})(window)
		},false);
	</script>
	<script>
		// ===== 留言板3分钟冷却计时器 =====
		(function() {
			var submitBtn = document.getElementById('submit-btn');
			var rateMsg = document.getElementById('rate-limit-msg');
			var cooldownSeconds = 180;
			var countdownTimer = null;

			function getParam(name) {
				var match = location.search.match(new RegExp('[?&]' + name + '=([^&]*)'));
				return match ? decodeURIComponent(match[1]) : null;
			}

			function startCooldown(remainingSeconds) {
				submitBtn.disabled = true;
				submitBtn.style.backgroundColor = '#ccc';
				submitBtn.style.cursor = 'not-allowed';
				rateMsg.style.display = 'inline';

				function updateCountdown() {
					var min = Math.floor(remainingSeconds / 60);
					var sec = remainingSeconds % 60;
					rateMsg.textContent = '⏳ 请等待 ' + min + '分' + sec + '秒后再发送';
					if (remainingSeconds <= 0) {
						clearInterval(countdownTimer);
						submitBtn.disabled = false;
						submitBtn.style.backgroundColor = '#FF69B4';
						submitBtn.style.cursor = 'pointer';
						rateMsg.style.display = 'none';
					}
					remainingSeconds--;
				}

				updateCountdown();
				countdownTimer = setInterval(updateCountdown, 1000);
			}

			// 页面加载时检查是否被限流
			var rateLimited = getParam('rate_limited');
			var remaining = parseInt(getParam('remaining')) || cooldownSeconds;
			if (rateLimited === '1') {
				startCooldown(Math.min(remaining, cooldownSeconds));
			}

			// 表单提交成功后开始冷却
			if (getParam('sent') === '1') {
				startCooldown(cooldownSeconds);
				if (window.history && window.history.replaceState) {
					window.history.replaceState({}, document.title, location.pathname);
				}
			}
		})();
	</script>
</body>
</html>
