<?php
header('Content-type:text/html; charset=utf-8');
require "auth.php";
require "../config/config.php";

$msg = '';
$ban_path = __DIR__ . "/../config/ban.txt";

// 添加 IP
if (isset($_POST['add_ip'])) {
    $new_ip = trim($_POST['ip']);
    if (!filter_var($new_ip, FILTER_VALIDATE_IP)) {
        $msg = '<span style="color:#e74c3c;">IP 格式无效，请重新输入</span>';
    } else {
        $banned = file_exists($ban_path) ? file($ban_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : array();
        if (in_array($new_ip, $banned)) {
            $msg = '<span style="color:#e67e22;">该 IP 已在封禁列表中</span>';
        } else {
            $fp = fopen($ban_path, "a");
            fwrite($fp, $new_ip . PHP_EOL);
            fclose($fp);
            $msg = '<span style="color:#27ae60;">已封禁 IP: ' . htmlspecialchars($new_ip) . '</span>';
        }
    }
}

// 解除封禁
if (isset($_POST['remove_ip'])) {
    $remove_ip = trim($_POST['remove_ip']);
    if (file_exists($ban_path)) {
        $banned = file($ban_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $new_list = array();
        foreach ($banned as $ip) {
            if (trim($ip) !== $remove_ip) $new_list[] = trim($ip);
        }
        file_put_contents($ban_path, implode(PHP_EOL, $new_list) . (count($new_list) > 0 ? PHP_EOL : ''));
        $msg = '<span style="color:#27ae60;">已解除封禁 IP: ' . htmlspecialchars($remove_ip) . '</span>';
    }
}

// 读取封禁列表
$banned_ips = array();
if (file_exists($ban_path)) {
    $banned_ips = file($ban_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

// 搜索过滤
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
if ($search !== '') {
    $banned_ips = array_values(array_filter($banned_ips, function($ip) use ($search) {
        return stripos(trim($ip), $search) !== false;
    }));
}

$total = count($banned_ips);
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$per_page = 50;
$offset = ($page - 1) * $per_page;
$ips_page = array_slice($banned_ips, $offset, $per_page);
$total_pages = ceil($total / $per_page);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="robots" content="noindex,nofollow">
    <title>IP 封禁管理 | 萌言Moey</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:Arial,sans-serif; background:#f5f5f5; padding:16px; }
        .wrap { max-width:800px; margin:0 auto; }
        h1 { color:#FF69B4; margin-bottom:12px; font-size:1.3rem; }
        .msg { margin-bottom:10px; font-size:0.9rem; }
        .box { background:#fff; border-radius:6px; padding:16px; margin-bottom:14px; box-shadow:0 1px 4px rgba(0,0,0,0.06); }
        .box h2 { font-size:1rem; color:#555; margin-bottom:10px; }
        label { display:block; margin-bottom:6px; color:#555; font-size:0.9rem; }
        input[type="text"] { width:100%; padding:10px; border:1px solid #ddd; border-radius:4px; margin-bottom:12px; font-size:1rem; }
        .btn { padding:7px 16px; border:none; border-radius:4px; font-size:0.85rem; cursor:pointer; text-decoration:none; display:inline-block; }
        .btn-pink { background:#FF69B4; color:#fff; }
        .btn-pink:hover { background:#FF1493; }
        .btn-red { background:#e74c3c; color:#fff; padding:4px 10px; font-size:0.8rem; }
        .btn-red:hover { background:#c0392b; }
        .btn-gray { background:#95a5a6; color:#fff; }
        .search-box { display:flex; align-items:center; gap:6px; margin-bottom:12px; }
        .search-box input[type="text"] { width:200px; padding:5px 10px; border:1px solid #ddd; border-radius:4px; font-size:0.85rem; margin-bottom:0; }
        .search-box input[type="text"]:focus { outline:none; border-color:#FF69B4; }
        .inline-form { display:inline; }
        table { width:100%; border-collapse:collapse; font-size:0.85rem; }
        th { background:#f8f8f8; padding:8px 6px; text-align:left; border-bottom:2px solid #eee; color:#555; }
        td { padding:8px 6px; border-bottom:1px solid #f0f0f0; vertical-align:middle; }
        tr:hover { background:#fffafc; }
        .mono { font-family:monospace; }
        .page-nav { margin-top:10px; text-align:center; }
        .page-nav a, .page-nav span { display:inline-block; padding:5px 10px; margin:0 2px; border-radius:4px; text-decoration:none; color:#555; background:#e8e8e8; font-size:0.85rem; }
        .page-nav span { background:#FF69B4; color:#fff; }
        .empty { color:#999; text-align:center; padding:30px; }
        .back { text-align:center; margin-top:16px; }
        .back a { color:#999; text-decoration:none; font-size:0.85rem; }
    </style>
</head>
<body>
<div class="wrap">
    <h1>IP 封禁管理（共 <?php echo $total; ?> 个）</h1>
    <?php if ($msg) echo '<p class="msg">' . $msg . '</p>'; ?>

    <div class="box">
        <form method="post">
            <label>添加封禁 IP</label>
            <input type="text" name="ip" placeholder="输入 IP 地址，如 192.168.1.1" required>
            <input type="submit" name="add_ip" value="封禁此 IP" class="btn btn-pink">
        </form>
    </div>

    <div class="box" style="overflow-x:auto;">
        <form class="search-box" method="get">
            <input type="text" name="search" placeholder="搜索 IP..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn btn-pink" style="padding:5px 14px;font-size:0.8rem;">搜索</button>
            <?php if ($search !== ''): ?><a href="ban.php" class="btn btn-gray" style="padding:5px 12px;font-size:0.8rem;">清除</a><?php endif; ?>
        </form>
        <table>
            <thead><tr><th>序号</th><th>IP 地址</th><th>操作</th></tr></thead>
            <tbody>
                <?php if (count($ips_page) > 0): ?>
                    <?php foreach ($ips_page as $i => $ip): ?>
                        <tr>
                            <td><?php echo $offset + $i + 1; ?></td>
                            <td class="mono"><?php echo htmlspecialchars(trim($ip)); ?></td>
                            <td>
                                <form method="post" class="inline-form" onsubmit="return confirm('确定解除对 <?php echo htmlspecialchars(trim($ip)); ?> 的封禁？');">
                                    <input type="hidden" name="remove_ip" value="<?php echo htmlspecialchars(trim($ip)); ?>">
                                    <button type="submit" class="btn btn-red">解除封禁</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="3" class="empty">暂无封禁 IP</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if ($total_pages > 1): ?>
            <div class="page-nav">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <?php if ($i === $page): ?><span><?php echo $i; ?></span>
                    <?php else: ?><a href="?search=<?php echo urlencode($search); ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a><?php endif; ?>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>

    <p class="back"><a href="index.php">← 返回管理面板</a> | <a href="logout.php">退出登录</a></p>
</div>
</body>
</html>
