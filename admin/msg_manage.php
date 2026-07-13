<?php
header('Content-type:text/html; charset=utf-8');
require "auth.php";
require "../config/config.php";

$msg = '';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die('数据库连接失败: ' . $conn->connect_error);
$conn->query("SET NAMES utf8mb4");

// ===== 处理 POST =====
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'edit') {
        $id = intval($_POST['edit_id']);
        $name = $conn->real_escape_string(trim($_POST['name']));
        $email = $conn->real_escape_string(trim($_POST['email']));
        $message = $conn->real_escape_string(trim($_POST['message']));
        $date = $conn->real_escape_string(trim($_POST['date']));
        $conn->query("UPDATE messages SET name='$name', email='$email', message='$message', date='$date' WHERE id=$id");
        $msg = '<span style="color:#27ae60;">留言 ID:' . $id . ' 已更新</span>';
    } elseif ($action === 'delete') {
        $id = intval($_POST['delete_id']);
        $conn->query("DELETE FROM messages WHERE id=$id");
        $msg = '<span style="color:#27ae60;">留言 ID:' . $id . ' 已删除</span>';
    } elseif ($action === 'ban') {
        $ip = trim($_POST['ban_ip']);
        if ($ip !== '') {
            $ban_path = __DIR__ . "/../config/ban.txt";
            $banned = file_exists($ban_path) ? file($ban_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : array();
            if (!in_array($ip, $banned)) {
                file_put_contents($ban_path, implode(PHP_EOL, $banned) . (count($banned) > 0 ? PHP_EOL : '') . $ip . PHP_EOL);
            }
            $msg = '<span style="color:#27ae60;">IP ' . $ip . ' 已加入封禁列表</span>';
        }
    }
}

// ===== 搜索 + 分页 =====
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$where = '';
if ($search !== '') {
    $safe_search = $conn->real_escape_string($search);
    $where = "WHERE name LIKE '%$safe_search%' OR message LIKE '%$safe_search%' OR ip_address LIKE '%$safe_search%' OR id LIKE '%$safe_search%'";
}

$count_result = $conn->query("SELECT COUNT(*) as total FROM messages $where");
$total = $count_result->fetch_assoc()['total'];
$per_page = 20;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$total_pages = ceil($total / $per_page);
$offset = ($page - 1) * $per_page;

$result = $conn->query("SELECT * FROM messages $where ORDER BY date DESC LIMIT $offset, $per_page");

// 加载编辑数据
$edit_data = null;
if (isset($_POST['action']) && $_POST['action'] === 'get_edit') {
    $edit_id = intval($_POST['edit_id']);
    $r = $conn->query("SELECT * FROM messages WHERE id=$edit_id");
    if ($r && $r->num_rows > 0) $edit_data = $r->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="robots" content="noindex,nofollow">
    <title>留言管理 | 萌言Moey</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:Arial,sans-serif; background:#f5f5f5; padding:16px; }
        .wrap { max-width:1200px; margin:0 auto; }
        h1 { color:#FF69B4; margin-bottom:12px; font-size:1.3rem; }
        .msg { margin-bottom:10px; font-size:0.9rem; }
        .box { background:#fff; border-radius:6px; padding:16px; margin-bottom:14px; box-shadow:0 1px 4px rgba(0,0,0,0.06); }
        .box h2 { font-size:1rem; color:#555; margin-bottom:10px; }
        label { display:block; margin-bottom:3px; font-size:0.85rem; color:#555; }
        input[type="text"], textarea { width:100%; padding:7px 9px; border:1px solid #ddd; border-radius:4px; font-size:0.9rem; margin-bottom:8px; }
        textarea { min-height:60px; resize:vertical; }
        .form-row { display:flex; gap:8px; flex-wrap:wrap; margin-bottom:8px; }
        .form-row .field { flex:1; min-width:120px; }
        .btn { padding:7px 16px; border:none; border-radius:4px; font-size:0.85rem; cursor:pointer; text-decoration:none; display:inline-block; }
        .btn-pink { background:#FF69B4; color:#fff; }
        .btn-pink:hover { background:#FF1493; }
        .btn-green { background:#27ae60; color:#fff; }
        .btn-red { background:#e74c3c; color:#fff; }
        .btn-orange { background:#e67e22; color:#fff; }
        .btn-gray { background:#95a5a6; color:#fff; }
        .search-row { display:flex; align-items:center; gap:8px; margin-bottom:12px; }
        .search-row input { padding:5px 10px; border:1px solid #ddd; border-radius:4px; font-size:0.85rem; width:200px; }
        .search-row input:focus { outline:none; border-color:#FF69B4; }
        .inline-form { display:inline; }
        table { width:100%; border-collapse:collapse; font-size:0.85rem; }
        th { background:#f8f8f8; padding:8px 6px; text-align:left; border-bottom:2px solid #eee; color:#555; white-space:nowrap; }
        td { padding:8px 6px; border-bottom:1px solid #f0f0f0; vertical-align:middle; }
        tr:hover { background:#fffafc; }
        .text-col { max-width:200px; word-break:break-all; }
        .mono { font-family:monospace; font-size:0.8rem; }
        .page-nav { margin-top:10px; text-align:center; }
        .page-nav a, .page-nav span { display:inline-block; padding:5px 10px; margin:0 2px; border-radius:4px; text-decoration:none; color:#555; background:#e8e8e8; font-size:0.85rem; }
        .page-nav span { background:#FF69B4; color:#fff; }
        .back { text-align:center; margin-top:16px; }
        .back a { color:#999; text-decoration:none; font-size:0.85rem; }
        @media (max-width:768px) { table { font-size:0.75rem; } .text-col { max-width:100px; } }
    </style>
</head>
<body>
<div class="wrap">
    <h1>留言管理（共 <?php echo $total; ?> 条）</h1>
    <?php if ($msg) echo '<p class="msg">' . $msg . '</p>'; ?>

    <!-- 编辑表单 -->
    <?php if ($edit_data): ?>
    <div class="box">
        <h2>编辑留言 ID: <?php echo $edit_data['id']; ?></h2>
        <form method="post">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="edit_id" value="<?php echo $edit_data['id']; ?>">
            <div class="form-row">
                <div class="field"><label>昵称</label><input type="text" name="name" value="<?php echo htmlspecialchars($edit_data['name'], ENT_QUOTES, 'UTF-8'); ?>" required></div>
                <div class="field"><label>邮箱</label><input type="text" name="email" value="<?php echo htmlspecialchars($edit_data['email'], ENT_QUOTES, 'UTF-8'); ?>"></div>
                <div class="field"><label>日期</label><input type="text" name="date" value="<?php echo $edit_data['date']; ?>" required></div>
            </div>
            <label>内容</label>
            <textarea name="message" required><?php echo htmlspecialchars($edit_data['message'], ENT_QUOTES, 'UTF-8'); ?></textarea>
            <button type="submit" class="btn btn-pink">保存修改</button>
            <a href="msg_manage.php" class="btn btn-gray">取消</a>
        </form>
    </div>
    <?php endif; ?>

    <!-- 搜索 + 列表 -->
    <div class="box" style="overflow-x:auto;">
        <form class="search-row" method="get">
            <input type="text" name="search" placeholder="搜索 ID/昵称/内容/IP..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn btn-pink" style="padding:5px 14px;font-size:0.8rem;">搜索</button>
            <?php if ($search !== ''): ?><a href="msg_manage.php" class="btn btn-gray" style="padding:5px 12px;font-size:0.8rem;">清除</a><?php endif; ?>
        </form>
        <table>
            <thead><tr><th>ID</th><th>昵称</th><th>邮箱</th><th>内容</th><th>IP</th><th>日期</th><th>操作</th></tr></thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="mono"><?php echo htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="text-col"><?php echo htmlspecialchars(mb_substr($row['message'], 0, 40, 'UTF-8') . (mb_strlen($row['message'], 'UTF-8') > 40 ? '...' : ''), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="mono"><?php echo htmlspecialchars($row['ip_address']); ?></td>
                            <td style="white-space:nowrap;"><?php echo substr($row['date'], 0, 16); ?></td>
                            <td style="white-space:nowrap;">
                                <form method="post" class="inline-form">
                                    <input type="hidden" name="action" value="get_edit">
                                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); ?>">
                                    <input type="hidden" name="page" value="<?php echo $page; ?>">
                                    <button type="submit" class="btn btn-green" style="padding:4px 8px;font-size:0.75rem;">编辑</button>
                                </form>
                                <form method="post" class="inline-form" onsubmit="return confirm('确定删除 ID:<?php echo $row['id']; ?> 的留言？');">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-red" style="padding:4px 8px;font-size:0.75rem;">删除</button>
                                </form>
                                <form method="post" class="inline-form" onsubmit="return confirm('确定封禁 IP: <?php echo $row['ip_address']; ?>？');">
                                    <input type="hidden" name="action" value="ban">
                                    <input type="hidden" name="ban_ip" value="<?php echo $row['ip_address']; ?>">
                                    <button type="submit" class="btn btn-orange" style="padding:4px 8px;font-size:0.75rem;">封禁IP</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="7" style="text-align:center;color:#999;padding:30px;">暂无留言</td></tr>
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
<?php $conn->close(); ?>
