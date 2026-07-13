<?php
header('Content-type:text/html; charset=utf-8');
require "auth.php";
require "../config/config.php";

$msg = '';

// 读取待审核语句
$audit_file = __DIR__ . "/audit.txt";
$pending = array();
if (file_exists($audit_file)) {
    $lines = file($audit_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if ($line[0] === '{') {
            preg_match_all("/{id:(.*?)}{text:(.*?)}{type:(.*?)}{from:(.*?)}{from_who:(.*?)}{creator:(.*?)}{created_at:(.*?)}{length:(.*?)}/", $line, $m);
            if ($m[1][0]) {
                $pending[] = array(
                    'line' => $line,
                    'id' => $m[1][0],
                    'text' => $m[2][0],
                    'type' => $m[3][0],
                    'from' => $m[4][0],
                    'from_who' => $m[5][0],
                    'creator' => $m[6][0],
                    'created_at' => $m[7][0],
                    'length' => $m[8][0],
                );
            }
        }
    }
}

// 类型名称映射
$type_names = array(
    'a'=>'动画','b'=>'漫画','c'=>'游戏','d'=>'文学','e'=>'原创',
    'f'=>'来自网络','g'=>'影视','h'=>'诗词','i'=>'哲学','j'=>'其他'
);

// 消息处理
if (isset($_GET['msg'])) {
    if ($_GET['msg'] === 'approved') $msg = '已通过审核，语句已发布上线。';
    if ($_GET['msg'] === 'rejected') $msg = '已拒绝该语句。';
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="robots" content="noindex,nofollow">
    <title>语句审核 | 萌言Moey</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:Arial,sans-serif; background:#f5f5f5; padding:20px; }
        .wrap { max-width:700px; margin:0 auto; }
        h1 { color:#FF69B4; margin-bottom:16px; font-size:1.3rem; }
        .msg { background:#eafaf1; color:#27ae60; padding:10px 14px; border-radius:4px; margin-bottom:14px; font-size:0.9rem; }
        .item { background:#fff; border-radius:6px; padding:18px; margin-bottom:14px; box-shadow:0 1px 4px rgba(0,0,0,0.06); }
        .item .text { font-size:1.1rem; line-height:1.6; color:#333; margin-bottom:10px; word-break:break-all; }
        .item .meta { font-size:0.85rem; color:#888; margin-bottom:8px; }
        .item .meta span { margin-right:14px; }
        .item .meta .tag { background:#f0f0f0; padding:2px 8px; border-radius:3px; font-size:0.8rem; }
        .item .actions { margin-top:12px; }
        .item .actions form { display:inline; margin-right:8px; }
        .btn { padding:7px 18px; border:none; border-radius:4px; font-size:0.9rem; cursor:pointer; }
        .btn-approve { background:#27ae60; color:#fff; }
        .btn-approve:hover { background:#219a52; }
        .btn-reject { background:#e74c3c; color:#fff; }
        .btn-reject:hover { background:#c0392b; }
        .empty { text-align:center; padding:40px; color:#999; background:#fff; border-radius:6px; }
        .back { text-align:center; margin-top:20px; }
        .back a { color:#999; text-decoration:none; font-size:0.85rem; }
    </style>
</head>
<body>
    <div class="wrap">
        <h1>语句审核（共 <?php echo count($pending); ?> 条待审核）</h1>
        <?php if ($msg) echo '<p class="msg">' . $msg . '</p>'; ?>

        <?php if (count($pending) > 0): ?>
            <?php foreach ($pending as $p): ?>
                <div class="item">
                    <div class="text"><?php echo htmlspecialchars($p['text'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="meta">
                        <span>ID: <?php echo $p['id']; ?></span>
                        <span class="tag"><?php echo isset($type_names[$p['type']]) ? $type_names[$p['type']] . ' (' . $p['type'] . ')' : $p['type']; ?></span>
                        <span>出处: <?php echo htmlspecialchars($p['from'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <?php if ($p['from_who'] !== 'null' && $p['from_who'] !== ''): ?>
                            <span>作者: <?php echo htmlspecialchars($p['from_who'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="meta">
                        <span>提交者: <?php echo htmlspecialchars($p['creator'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <span>字数: <?php echo $p['length']; ?></span>
                        <span>提交时间: <?php echo date('Y-m-d H:i:s', intval($p['created_at'])); ?></span>
                    </div>
                    <div class="actions">
                        <form method="post" action="audit_action.php" style="display:inline;" onsubmit="return confirm('确认通过该语句？通过后将立即上线。');">
                            <input type="hidden" name="action" value="approve">
                            <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
                            <input type="hidden" name="form" value="<?php echo $p['type']; ?>">
                            <button type="submit" class="btn btn-approve">通过审核</button>
                        </form>
                        <form method="post" action="audit_action.php" style="display:inline;" onsubmit="return confirm('确认拒绝该语句？拒绝后将从审核列表移除。');">
                            <input type="hidden" name="action" value="reject">
                            <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
                            <button type="submit" class="btn btn-reject">拒绝</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty">暂无待审核语句 🎉</div>
        <?php endif; ?>

        <p class="back"><a href="index.php">← 返回管理面板</a> | <a href="logout.php">退出登录</a></p>
    </div>
</body>
</html>
