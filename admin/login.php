<?php
session_start();
header('Content-type:text/html; charset=utf-8');
require "../config/config.php";

// 已登录则跳转仪表盘
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: index.php');
    exit;
}

$error = '';
// 处理登录
if (isset($_POST['login'])) {
    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);
    if ($user === $admin_user && $pass === $admin_pw) {
        session_regenerate_id(true);
        $_SESSION['admin_logged_in'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error = '用户名或密码错误';
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="robots" content="noindex,nofollow">
    <title>管理登录 | 萌言Moey</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:Arial,sans-serif; background:#f5f5f5; display:flex; justify-content:center; align-items:center; min-height:100vh; }
        .login-box { background:#fff; border-radius:8px; box-shadow:0 2px 12px rgba(0,0,0,0.1); padding:30px; width:100%; max-width:360px; }
        h1 { text-align:center; color:#FF69B4; margin-bottom:24px; font-size:1.5rem; }
        label { display:block; margin-bottom:6px; color:#555; font-size:0.9rem; }
        input[type="text"], input[type="password"] { width:100%; padding:10px; border:1px solid #ddd; border-radius:4px; margin-bottom:16px; font-size:1rem; }
        input[type="submit"] { width:100%; padding:10px; background:#FF69B4; color:#fff; border:none; border-radius:4px; font-size:1rem; cursor:pointer; }
        input[type="submit"]:hover { background:#FF1493; }
        .error { color:#e74c3c; text-align:center; margin-bottom:12px; font-size:0.9rem; }
        .back { text-align:center; margin-top:16px; }
        .back a { color:#999; text-decoration:none; font-size:0.85rem; }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>萌言管理后台</h1>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="post">
            <label>用户名</label>
            <input type="text" name="username" required autofocus>
            <label>密码</label>
            <input type="password" name="password" required>
            <input type="submit" name="login" value="登 录">
        </form>
        <p class="back"><a href="../">← 返回首页</a></p>
    </div>
</body>
</html>
