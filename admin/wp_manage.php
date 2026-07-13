<?php
header('Content-type:text/html; charset=utf-8');
require "auth.php";
require "../config/config.php";

$msg = '';
$edit_data = null;
$pic_dir = __DIR__ . "/../pic/";
$orientations = array('level' => '横屏', 'vertical' => '竖屏');

// ===== 处理 POST =====
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'add' || $action === 'edit') {
        $link = trim($_POST['link']);
        $form_type = trim($_POST['form_type']);
        $target_file = $pic_dir . $form_type . ".txt";

        if (!file_exists($target_file)) {
            $msg = '<span style="color:#e74c3c;">数据文件 pic/' . $form_type . '.txt 不存在</span>';
        } elseif ($link == '') {
            $msg = '<span style="color:#e74c3c;">请输入图片链接</span>';
        } else {
            if ($action === 'add') {
                $id = intval(file_get_contents(__DIR__ . "/../config/id_wp.dat"));
                $id++;
                file_put_contents(__DIR__ . "/../config/id_wp.dat", $id);
                $new_line = "\n{id:" . $id . "}{link:" . $link . "}{form:" . $form_type . "}";
                $fp = fopen($target_file, "a");
                fwrite($fp, $new_line);
                fclose($fp);
                $msg = '<span style="color:#27ae60;">图片添加成功！ID: ' . $id . '</span>';
            } elseif ($action === 'edit') {
                $edit_id = $_POST['edit_id'];
                $old_form = $_POST['old_form'];
                // 如果方向改变，需要从旧文件删除，写入新文件
                if ($form_type !== $old_form) {
                    $old_file = $pic_dir . $old_form . ".txt";
                    // 从旧文件删除
                    $lines = file($old_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    $new_lines = array(); $found = false;
                    foreach ($lines as $l) {
                        if (!($l[0] === '{' && strpos($l, "{id:" . $edit_id . "}") !== false)) {
                            $new_lines[] = $l;
                        } else { $found = true; }
                    }
                    if ($found) file_put_contents($old_file, implode(PHP_EOL, $new_lines) . PHP_EOL);
                    // 写入新文件
                    $fp = fopen($target_file, "a");
                    fwrite($fp, "\n{id:" . $edit_id . "}{link:" . $link . "}{form:" . $form_type . "}");
                    fclose($fp);
                } else {
                    // 同文件内替换
                    $lines = file($target_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    $new_lines = array(); $found = false;
                    foreach ($lines as $l) {
                        if ($l[0] === '{' && strpos($l, "{id:" . $edit_id . "}") !== false) {
                            $new_lines[] = "{id:" . $edit_id . "}{link:" . $link . "}{form:" . $form_type . "}";
                            $found = true;
                        } else { $new_lines[] = $l; }
                    }
                    if ($found) file_put_contents($target_file, implode(PHP_EOL, $new_lines) . PHP_EOL);
                }
                $msg = '<span style="color:#27ae60;">图片已更新！ID: ' . $edit_id . '</span>';
            }
        }
    } elseif ($action === 'delete') {
        $delete_id = $_POST['delete_id'];
        $delete_form = $_POST['delete_form'];
        $target_file = $pic_dir . $delete_form . ".txt";
        if (file_exists($target_file)) {
            $lines = file($target_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $new_lines = array();
            foreach ($lines as $l) {
                if (!($l[0] === '{' && strpos($l, "{id:" . $delete_id . "}") !== false)) {
                    $new_lines[] = $l;
                }
            }
            file_put_contents($target_file, implode(PHP_EOL, $new_lines) . PHP_EOL);
            $msg = '<span style="color:#27ae60;">图片已删除！ID: ' . $delete_id . '</span>';
        }
    } elseif ($action === 'get_edit') {
        $edit_id = $_POST['edit_id'];
        $edit_form = $_POST['edit_form'];
        $target_file = $pic_dir . $edit_form . ".txt";
        if (file_exists($target_file)) {
            $lines = file($target_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $l) {
                if ($l[0] === '{' && strpos($l, "{id:" . $edit_id . "}") !== false) {
                    preg_match_all("/{id:(.*?)}{link:(.*?)}{form:(.*?)}/", $l, $m);
                    $edit_data = array('id' => $m[1][0], 'link' => $m[2][0], 'form' => $m[3][0]);
                }
            }
        }
    }
}

// ===== 读取数据 =====
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$items = array();
$cat_stats = array('level' => 0, 'vertical' => 0);
foreach (array('level', 'vertical') as $form) {
    if ($filter !== 'all' && $filter !== $form) continue;
    $f = $pic_dir . $form . ".txt";
    if (file_exists($f)) {
        $lines = file($f, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $l) {
            if ($l[0] === '{') {
                preg_match_all("/{id:(.*?)}{link:(.*?)}{form:(.*?)}/", $l, $m);
                if ($m[1][0]) {
                    $items[] = array('id' => intval($m[1][0]), 'link' => $m[2][0], 'form' => $m[3][0]);
                    $cat_stats[$form]++;
                }
            }
        }
    }
}
usort($items, function($a, $b) { return $b['id'] - $a['id']; });

// 搜索过滤
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
if ($search !== '') {
    $items = array_filter($items, function($item) use ($search) {
        return stripos((string)$item['id'], $search) !== false
            || stripos($item['link'], $search) !== false;
    });
}

$total = count($items);
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$per_page = 50;
$offset = ($page - 1) * $per_page;
$items = array_slice($items, $offset, $per_page);
$total_pages = ceil($total / $per_page);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="robots" content="noindex,nofollow">
    <title>图片管理 | 萌言Moey</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:Arial,sans-serif; background:#f5f5f5; padding:16px; }
        .wrap { max-width:1000px; margin:0 auto; }
        h1 { color:#FF69B4; margin-bottom:12px; font-size:1.3rem; }
        .msg { margin-bottom:10px; font-size:0.9rem; }
        .box { background:#fff; border-radius:6px; padding:16px; margin-bottom:14px; box-shadow:0 1px 4px rgba(0,0,0,0.06); }
        .box h2 { font-size:1rem; color:#555; margin-bottom:10px; }
        label { display:block; margin-bottom:3px; font-size:0.85rem; color:#555; }
        input[type="text"], select { width:100%; padding:7px 9px; border:1px solid #ddd; border-radius:4px; font-size:0.9rem; margin-bottom:8px; }
        .form-row { display:flex; gap:8px; flex-wrap:wrap; }
        .form-row .field { flex:1; min-width:120px; }
        .btn { padding:7px 16px; border:none; border-radius:4px; font-size:0.85rem; cursor:pointer; text-decoration:none; display:inline-block; }
        .btn-pink { background:#FF69B4; color:#fff; }
        .btn-pink:hover { background:#FF1493; }
        .btn-green { background:#27ae60; color:#fff; }
        .btn-red { background:#e74c3c; color:#fff; }
        .btn-gray { background:#95a5a6; color:#fff; }
        .search-row { display:flex; align-items:center; gap:8px; margin-bottom:12px; flex-wrap:wrap; }
        .search-row input { padding:5px 10px; border:1px solid #ddd; border-radius:4px; font-size:0.85rem; width:200px; }
        .search-row input:focus { outline:none; border-color:#FF69B4; }
        .filter-bar { margin-bottom:12px; }
        .filter-bar a { padding:5px 12px; border-radius:4px; text-decoration:none; color:#555; font-size:0.85rem; margin-right:4px; background:#e8e8e8; }
        .filter-bar a.active { background:#FF69B4; color:#fff; }
        table { width:100%; border-collapse:collapse; font-size:0.85rem; }
        th { background:#f8f8f8; padding:8px 6px; text-align:left; border-bottom:2px solid #eee; color:#555; }
        td { padding:8px 6px; border-bottom:1px solid #f0f0f0; vertical-align:middle; }
        tr:hover { background:#fffafc; }
        .link-cell { max-width:400px; word-break:break-all; position:relative; }
        .link-cell a { color:#3498db; text-decoration:none; }
        .link-cell:hover .preview-img { display:block; }
        .preview-img { display:none; position:absolute; bottom:100%; left:0; z-index:99; max-width:300px; max-height:200px; border-radius:6px; box-shadow:0 4px 16px rgba(0,0,0,0.2); border:2px solid #fff; }
        .page-nav { margin-top:10px; text-align:center; }
        .page-nav a, .page-nav span { display:inline-block; padding:5px 10px; margin:0 2px; border-radius:4px; text-decoration:none; color:#555; background:#e8e8e8; font-size:0.85rem; }
        .page-nav span { background:#FF69B4; color:#fff; }
        .inline-form { display:inline; }
        .back { text-align:center; margin-top:16px; }
        .back a { color:#999; text-decoration:none; font-size:0.85rem; }
    </style>
</head>
<body>
<div class="wrap">
    <h1>图片管理（共 <?php echo $total; ?> 张<?php echo $filter !== 'all' ? '，筛选: ' . $orientations[$filter] : ''; ?>）</h1>
    <?php if ($msg) echo '<p class="msg">' . $msg . '</p>'; ?>

    <div class="search-row">
        <div class="filter-bar" style="margin-bottom:0;">
            <a href="?filter=all<?php echo $search ? '&search=' . urlencode($search) : ''; ?>" class="<?php echo $filter === 'all' ? 'active' : ''; ?>">全部</a>
            <a href="?filter=level<?php echo $search ? '&search=' . urlencode($search) : ''; ?>" class="<?php echo $filter === 'level' ? 'active' : ''; ?>">横屏(<?php echo $cat_stats['level']; ?>)</a>
            <a href="?filter=vertical<?php echo $search ? '&search=' . urlencode($search) : ''; ?>" class="<?php echo $filter === 'vertical' ? 'active' : ''; ?>">竖屏(<?php echo $cat_stats['vertical']; ?>)</a>
        </div>
        <form method="get" style="display:inline-flex;align-items:center;gap:6px;">
            <input type="hidden" name="filter" value="<?php echo $filter; ?>">
            <input type="text" name="search" placeholder="搜索 ID/图片链接..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn btn-pink" style="padding:5px 14px;font-size:0.8rem;">搜索</button>
            <?php if ($search !== ''): ?><a href="?filter=<?php echo $filter; ?>" class="btn btn-gray" style="padding:5px 12px;font-size:0.8rem;">清除</a><?php endif; ?>
        </form>
    </div>

    <div class="box">
        <h2><?php echo $edit_data ? '编辑图片 ID:' . $edit_data['id'] : '新增图片'; ?></h2>
        <form method="post">
            <input type="hidden" name="action" value="<?php echo $edit_data ? 'edit' : 'add'; ?>">
            <?php if ($edit_data): ?>
                <input type="hidden" name="edit_id" value="<?php echo $edit_data['id']; ?>">
                <input type="hidden" name="old_form" value="<?php echo $edit_data['form']; ?>">
            <?php endif; ?>
            <div class="form-row">
                <div class="field" style="flex:3;"><label>图片链接</label><input type="text" name="link" value="<?php echo $edit_data ? htmlspecialchars($edit_data['link']) : ''; ?>" required></div>
                <div class="field" style="max-width:140px;"><label>方向</label>
                    <select name="form_type" required>
                        <option value="level" <?php echo ($edit_data && $edit_data['form'] === 'level') ? 'selected' : ''; ?>>横屏</option>
                        <option value="vertical" <?php echo ($edit_data && $edit_data['form'] === 'vertical') ? 'selected' : ''; ?>>竖屏</option>
                    </select>
                </div>
                <div class="field" style="max-width:fit-content;align-self:flex-end;">
                    <button type="submit" class="btn btn-pink"><?php echo $edit_data ? '保存修改' : '添加图片'; ?></button>
                    <?php if ($edit_data): ?><a href="wp_manage.php" class="btn btn-gray">取消</a><?php endif; ?>
                </div>
            </div>
        </form>
    </div>

    <div class="box" style="overflow-x:auto;">
        <table>
            <thead><tr><th>ID</th><th>链接</th><th>方向</th><th>操作</th></tr></thead>
            <tbody>
                <?php if (count($items) > 0): ?>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?php echo $item['id']; ?></td>
                            <td class="link-cell">
                                <a href="<?php echo htmlspecialchars($item['link']); ?>" target="_blank"><?php echo htmlspecialchars($item['link']); ?></a>
                                <img src="<?php echo htmlspecialchars($item['link']); ?>" class="preview-img" onerror="this.style.display='none'" alt="">
                            </td>
                            <td><?php echo $orientations[$item['form']]; ?></td>
                            <td style="white-space:nowrap;">
                                <form method="post" class="inline-form">
                                    <input type="hidden" name="action" value="get_edit">
                                    <input type="hidden" name="edit_id" value="<?php echo $item['id']; ?>">
                                    <input type="hidden" name="edit_form" value="<?php echo $item['form']; ?>">
                                    <button type="submit" class="btn btn-green" style="padding:4px 10px;">编辑</button>
                                </form>
                                <form method="post" class="inline-form" onsubmit="return confirm('确定删除图片 ID:<?php echo $item['id']; ?>？');">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="delete_id" value="<?php echo $item['id']; ?>">
                                    <input type="hidden" name="delete_form" value="<?php echo $item['form']; ?>">
                                    <button type="submit" class="btn btn-red" style="padding:4px 10px;">删除</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4" style="text-align:center;color:#999;padding:30px;">暂无图片</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if ($total_pages > 1): ?>
            <div class="page-nav">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <?php if ($i === $page): ?><span><?php echo $i; ?></span>
                    <?php else: ?><a href="?filter=<?php echo $filter; ?>&search=<?php echo urlencode($search); ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a><?php endif; ?>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>

    <p class="back"><a href="index.php">← 返回管理面板</a> | <a href="logout.php">退出登录</a></p>
</div>
</body>
</html>
