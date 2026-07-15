<?php
header('Content-type:text/html; charset=utf-8');
require "auth.php";
require "../config/config.php";

$msg = '';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die('数据库连接失败: ' . $conn->connect_error);
$conn->query("SET NAMES utf8mb4");

// ===== 敏感词设置 =====
$sw_file = __DIR__ . '/sensitive_words.txt';
$sw_flag = __DIR__ . '/sensitive_filter_on.txt';

if (isset($_POST['save_sw'])) {
	$enabled = isset($_POST['sw_enabled']) ? '1' : '0';
	file_put_contents($sw_flag, $enabled);
	$raw = str_replace("\r", "\n", trim($_POST['sw_words']));
	$lines = array_values(array_filter(array_map('trim', explode("\n", $raw)), function($l){return $l!=='';}));
	file_put_contents($sw_file, implode(PHP_EOL, $lines) . (count($lines) > 0 ? PHP_EOL : ''));
	$msg = '<span style="color:#27ae60;">敏感词设置已保存（' . count($lines) . ' 个词）</span>';
}
$sw_enabled = file_exists($sw_flag) && file_get_contents($sw_flag) === '1';
$sw_words_content = file_exists($sw_file) ? file_get_contents($sw_file) : '';

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
    } elseif ($action === 'batch_delete') {
        $ids = json_decode($_POST['batch_ids'], true);
        $ids = array_filter(array_map('intval', $ids), function($v){return $v>0;});
        if (!empty($ids)) {
            $conn->query("DELETE FROM messages WHERE id IN (" . implode(',', $ids) . ")");
            $msg = '<span style="color:#27ae60;">已批量删除 ' . $conn->affected_rows . ' 条留言</span>';
        }
    } elseif ($action === 'batch_ban_ip') {
        $ids = json_decode($_POST['batch_ids'], true);
        $ids = array_filter(array_map('intval', $ids), function($v){return $v>0;});
        $ips = array();
        if (!empty($ids)) {
            $r2 = $conn->query("SELECT DISTINCT ip_address FROM messages WHERE id IN (" . implode(',', $ids) . ")");
            while ($row2 = $r2->fetch_assoc()) $ips[] = $row2['ip_address'];
        }
        $ban_path = __DIR__ . "/../config/ban.txt";
        $banned = file_exists($ban_path) ? file($ban_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : array();
        $added = 0;
        foreach ($ips as $ip2) {
            if ($ip2 !== '' && !in_array($ip2, $banned)) { $banned[] = $ip2; $added++; }
        }
        if ($added > 0) file_put_contents($ban_path, implode(PHP_EOL, $banned) . PHP_EOL);
        $msg = '<span style="color:#27ae60;">已封禁 ' . $added . ' 个IP（共 ' . count($ips) . ' 个）</span>';
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
        /* Toggle switch */
        .switch { position:relative; display:inline-block; width:44px; height:24px; vertical-align:middle; margin:0 8px; }
        .switch input { opacity:0; width:0; height:0; }
        .switch .slider { position:absolute; cursor:pointer; top:0; left:0; right:0; bottom:0; background:#ccc; border-radius:24px; transition:.3s; }
        .switch .slider:before { content:""; position:absolute; height:18px; width:18px; left:3px; bottom:3px; background:#fff; border-radius:50%; transition:.3s; }
        .switch input:checked + .slider { background:#FF69B4; }
        .switch input:checked + .slider:before { transform:translateX(20px); }
        .sw-status { font-size:0.85rem; vertical-align:middle; }
        .sw-status.on { color:#27ae60; }
        .sw-status.off { color:#999; }
        /* Batch ops */
        #select-all,.cb-item{appearance:none;-webkit-appearance:none;width:16px;height:16px;border:2px solid #ccc;border-radius:3px;background:#fff;cursor:pointer;vertical-align:middle;position:relative;margin:0;}
        #select-all:checked,.cb-item:checked{background-color:#FF69B4;border-color:#FF69B4;background-image:url("data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 16 16%27%3E%3Cpath fill=%27%23fff%27 d=%27M6 11L2.5 7.5 3.9 6.1 6 8.2 12.1 2.1 13.5 3.5z%27/%3E%3C/svg%3E");background-size:contain;}
        .batch-bar { display:flex; align-items:center; justify-content:space-between; margin-bottom:8px; }
    </style>
</head>
<body>
<div class="wrap">
    <h1>留言管理（共 <?php echo $total; ?> 条）</h1>
    <?php if ($msg) echo '<p class="msg">' . $msg . '</p>'; ?>

    <!-- 敏感词过滤 -->
    <div class="box">
        <form method="post">
        <input type="hidden" name="save_sw" value="1">
        <div style="display:flex;align-items:center;justify-content:space-between;">
            <h2 style="margin-bottom:0;">敏感词过滤</h2>
            <div>
                <label class="switch"><input type="checkbox" name="sw_enabled" <?php echo $sw_enabled?'checked':''; ?> onchange="this.form.submit()"><span class="slider"></span></label>
                <span class="sw-status<?php echo $sw_enabled?' on':' off'; ?>"><?php echo $sw_enabled?'已开启':'已关闭'; ?></span>
            </div>
        </div>
        <div style="margin-top:10px;<?php echo $sw_enabled?'':'display:none;'; ?>"><textarea name="sw_words" rows="6" style="width:100%;min-height:100px;resize:vertical;padding:8px;border:1px solid #ddd;border-radius:4px;font-size:0.85rem;font-family:monospace;" placeholder="每行一个敏感词"><?php echo htmlspecialchars($sw_words_content); ?></textarea></div>
        <button type="submit" class="btn btn-pink" style="margin-top:6px;<?php echo $sw_enabled?'':'display:none;'; ?>">保存设置</button>
        </form>
    </div>

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
        <div class="batch-bar">
            <span id="selected-count" style="color:#FF69B4;font-weight:bold;font-size:0.9rem;"></span>
            <form id="batch-form" method="post" onsubmit="return submitBatch()">
                <input type="hidden" name="action" id="batch-action" value="">
                <input type="hidden" name="batch_ids" id="batch-ids-input" value="">
                <button type="submit" data-action="batch_delete" class="btn btn-red" style="display:none;">批量删除</button>
                <button type="submit" data-action="batch_ban_ip" class="btn btn-orange" style="display:none;">批量封禁IP</button>
            </form>
        </div>
        <table>
            <thead><tr><th style="width:30px;"><input type="checkbox" id="select-all" title="全选"></th><th>ID</th><th>昵称</th><th>邮箱</th><th>内容</th><th>IP</th><th>日期</th><th>操作</th></tr></thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><input type="checkbox" class="cb-item" value="<?php echo $row['id']; ?>"></td>
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
                                    <button type="submit" class="btn btn-green btn-edit" style="padding:4px 8px;font-size:0.75rem;">编辑</button>
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
                    <tr><td colspan="8" style="text-align:center;color:#999;padding:30px;">暂无留言</td></tr>
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
<script>
(function(){
var master=document.getElementById('select-all');
var items=document.querySelectorAll('.cb-item');
var cnt=document.getElementById('selected-count');
var form=document.getElementById('batch-form');
var actionInput=document.getElementById('batch-action');
var idsInput=document.getElementById('batch-ids-input');
var editBtns=document.querySelectorAll('.btn-edit');
function getChecked(){return document.querySelectorAll('.cb-item:checked');}
function updateUI(){
var checked=getChecked(),n=checked.length;
cnt.textContent=n>0?'已选择 '+n+' 项':'';
var btns=form.querySelectorAll('button[type="submit"]');
btns.forEach(function(b){b.style.display=n>0?'':'none';});
editBtns.forEach(function(b){b.style.display=n>0?'none':'';});
}
master.addEventListener('change',function(){
items.forEach(function(cb){cb.checked=master.checked;});
updateUI();
});
items.forEach(function(cb){cb.addEventListener('change',updateUI);});
window.submitBatch=function(){
var checked=getChecked();
if(checked.length===0){alert('请先选择要操作的项');return false;}
var clicked=document.activeElement;
var action=clicked.getAttribute('data-action')||'batch_delete';
var label=action==='batch_delete'?'删除':'封禁IP';
if(!confirm('确定批量'+label+' '+checked.length+' 项？此操作不可撤销。'))return false;
actionInput.value=action;
var vals=[];
checked.forEach(function(cb){vals.push(cb.value);});
idsInput.value=JSON.stringify(vals);
return true;
};
})();
</script>
</body>
</html>
<?php $conn->close(); ?>
