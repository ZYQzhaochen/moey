<?php
header('Content-type:text/html; charset=utf-8');
require "auth.php";
require "../config/config.php";

// 统计数据
$audit_count = 0;
$audit_file = __DIR__ . "/audit.txt";
if (file_exists($audit_file)) {
    $audit_lines = file($audit_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    // 跳过表头行（以 === 开头）
    foreach ($audit_lines as $line) {
        if ($line[0] === '{') $audit_count++;
    }
}

$yan_total = 0;
foreach (range('a', 'j') as $cat) {
    $f = __DIR__ . "/../yan/{$cat}.txt";
    if (file_exists($f)) {
        $yan_total += count(file($f, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
    }
}

$links_count = 0;
$links_file = __DIR__ . "/../config/links.txt";
if (file_exists($links_file)) {
    $links_count = count(file($links_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
}

$ban_count = 0;
$ban_file = __DIR__ . "/../config/ban.txt";
if (file_exists($ban_file)) {
    $ban_count = count(file($ban_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
}

// 图片统计（pic/ 目录）
$pic_total = 0;
foreach (['level', 'vertical'] as $orientation) {
    $f = __DIR__ . "/../pic/{$orientation}.txt";
    if (file_exists($f)) {
        $pic_total += count(file($f, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="robots" content="noindex,nofollow">
    <title>管理面板 | 萌言Moey</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:Arial,sans-serif; background:#f5f5f5; padding:20px; }
        .wrap { max-width:700px; margin:0 auto; }
        h1 { color:#FF69B4; margin-bottom:20px; font-size:1.4rem; }
        .stats { display:grid; grid-template-columns:repeat(auto-fill,minmax(140px,1fr)); gap:12px; margin-bottom:24px; }
        .stat-card { background:#fff; border-radius:6px; padding:16px; text-align:center; box-shadow:0 1px 4px rgba(0,0,0,0.06); }
        .stat-card .num { font-size:2rem; color:#FF69B4; font-weight:bold; }
        .stat-card .label { color:#888; font-size:0.85rem; margin-top:4px; }
        .nav { background:#fff; border-radius:6px; box-shadow:0 1px 4px rgba(0,0,0,0.06); overflow:hidden; }
        .nav a { display:block; padding:14px 18px; text-decoration:none; color:#333; border-bottom:1px solid #f0f0f0; font-size:1rem; }
        .nav a:hover { background:#fff5f8; }
        .nav a:last-child { border-bottom:none; }
        .nav .badge { float:right; background:#FF69B4; color:#fff; border-radius:10px; padding:2px 8px; font-size:0.75rem; }
        .nav .section-title { padding:12px 18px; color:#999; font-size:0.8rem; background:#fafafa; border-bottom:1px solid #f0f0f0; }
        .logout { text-align:center; margin-top:20px; }
        .logout a { color:#999; text-decoration:none; font-size:0.85rem; }
    </style>
</head>
<body>
    <div class="wrap">
        <h1>萌言管理面板</h1>

        <div class="stats">
            <div class="stat-card">
                <div class="num"><?php echo $audit_count; ?></div>
                <div class="label">待审核语句</div>
            </div>
            <div class="stat-card">
                <div class="num"><?php echo $yan_total; ?></div>
                <div class="label">语句总数</div>
            </div>
            <div class="stat-card">
                <div class="num"><?php echo $pic_total; ?></div>
                <div class="label">图片总数</div>
            </div>
            <div class="stat-card">
                <div class="num"><?php echo $links_count; ?></div>
                <div class="label">友链总数</div>
            </div>
            <div class="stat-card">
                <div class="num"><?php echo $ban_count; ?></div>
                <div class="label">封禁IP数</div>
            </div>
        </div>

        <div class="nav">
            <div class="section-title">审核管理</div>
            <a href="audit_y.php">语句审核 <?php if ($audit_count > 0): ?><span class="badge"><?php echo $audit_count; ?></span><?php endif; ?></a>

            <div class="section-title">内容管理</div>
            <a href="yan_manage.php">语句管理</a>
            <a href="wp_manage.php">图片管理</a>
            <a href="links_manage.php">友链管理</a>
            <a href="msg_manage.php">留言管理</a>

            <div class="section-title">系统管理</div>
            <a href="ban.php">IP 封禁管理</a>
        </div>

        <p class="logout"><a href="../">← 返回首页</a> | <a href="logout.php">退出登录</a></p>
    </div>
</body>
</html>
