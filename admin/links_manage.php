<?php
header('Content-type:text/html; charset=utf-8');
require "auth.php";
require "../config/config.php";

$msg = '';
$edit_data = null;
$links_file = __DIR__ . "/../config/links.txt";

// ===== 处理 POST =====
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'add' || $action === 'edit') {
        $name = trim($_POST['name']);
        $link = trim($_POST['link']);
        $about = trim($_POST['about']);
        $logo = trim($_POST['logo']);

        if ($name == '' || $link == '' || $about == '' || $logo == '') {
            $msg = '<span style="color:#e74c3c;">请填写所有字段</span>';
        } else {
            if ($action === 'add') {
                $fp = fopen($links_file, "a");
                fwrite($fp, "\n{name:" . $name . "}{link:" . $link . "}{about:" . $about . "}{logo:" . $logo . "}");
                fclose($fp);
                $msg = '<span style="color:#27ae60;">友链添加成功！</span>';
            } elseif ($action === 'edit') {
                $old_name = $_POST['old_name'];
                $lines = file($links_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $new_lines = array();
                $found = false;
                foreach ($lines as $line) {
                    if ($line[0] === '{' && strpos($line, "{name:" . $old_name . "}") !== false) {
                        $new_lines[] = "{name:" . $name . "}{link:" . $link . "}{about:" . $about . "}{logo:" . $logo . "}";
                        $found = true;
                    } else {
                        $new_lines[] = $line;
                    }
                }
                if ($found) {
                    file_put_contents($links_file, implode(PHP_EOL, $new_lines) . PHP_EOL);
                    $msg = '<span style="color:#27ae60;">友链已更新！</span>';
                } else {
                    $msg = '<span style="color:#e74c3c;">未找到要编辑的友链</span>';
                }
            }
        }
    } elseif ($action === 'delete') {
        $delete_name = $_POST['delete_name'];
        $lines = file($links_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $new_lines = array();
        foreach ($lines as $line) {
            if (!($line[0] === '{' && strpos($line, "{name:" . $delete_name . "}") !== false)) {
                $new_lines[] = $line;
            }
        }
        file_put_contents($links_file, implode(PHP_EOL, $new_lines) . PHP_EOL);
        $msg = '<span style="color:#27ae60;">友链已删除！</span>';
    } elseif ($action === 'get_edit') {
        $edit_name = $_POST['edit_name'];
        $lines = file($links_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if ($line[0] === '{' && strpos($line, "{name:" . $edit_name . "}") !== false) {
                preg_match_all("/{name:(.*?)}{link:(.*?)}{about:(.*?)}{logo:(.*?)}/", $line, $m);
                $edit_data = array('name' => $m[1][0], 'link' => $m[2][0], 'about' => $m[3][0], 'logo' => $m[4][0]);
            }
        }
    }
}

// ===== 读取友链列表 =====
$items = array();
if (file_exists($links_file)) {
    $lines = file($links_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if ($line[0] === '{') {
            preg_match_all("/{name:(.*?)}{link:(.*?)}{about:(.*?)}{logo:(.*?)}/", $line, $m);
            if ($m[1][0]) {
                $items[] = array('name'=>$m[1][0], 'link'=>$m[2][0], 'about'=>$m[3][0], 'logo'=>$m[4][0]);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="robots" content="noindex,nofollow">
    <title>友链管理 | 萌言Moey</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:Arial,sans-serif; background:#f5f5f5; padding:16px; }
        .wrap { max-width:900px; margin:0 auto; }
        h1 { color:#FF69B4; margin-bottom:12px; font-size:1.3rem; }
        .msg { margin-bottom:10px; font-size:0.9rem; }
        .box { background:#fff; border-radius:6px; padding:16px; margin-bottom:14px; box-shadow:0 1px 4px rgba(0,0,0,0.06); }
        .box h2 { font-size:1rem; color:#555; margin-bottom:10px; }
        label { display:block; margin-bottom:3px; font-size:0.85rem; color:#555; }
        input[type="text"] { width:100%; padding:7px 9px; border:1px solid #ddd; border-radius:4px; font-size:0.9rem; margin-bottom:8px; }
        .form-row { display:flex; gap:8px; flex-wrap:wrap; }
        .form-row .field { flex:1; min-width:150px; }
        .btn { padding:7px 16px; border:none; border-radius:4px; font-size:0.85rem; cursor:pointer; }
        .btn-pink { background:#FF69B4; color:#fff; }
        .btn-pink:hover { background:#FF1493; }
        .btn-green { background:#27ae60; color:#fff; }
        .btn-red { background:#e74c3c; color:#fff; }
        .btn-gray { background:#95a5a6; color:#fff; }
        table { width:100%; border-collapse:collapse; font-size:0.85rem; }
        th { background:#f8f8f8; padding:8px 6px; text-align:left; border-bottom:2px solid #eee; color:#555; }
        td { padding:8px 6px; border-bottom:1px solid #f0f0f0; vertical-align:middle; }
        tr:hover { background:#fffafc; }
        .logo-img { width:24px; height:24px; border-radius:2px; object-fit:cover; }
        .inline-form { display:inline; }
        .back { text-align:center; margin-top:16px; }
        .back a { color:#999; text-decoration:none; font-size:0.85rem; }
    </style>
</head>
<body>
<div class="wrap">
    <h1>友链管理（共 <?php echo count($items); ?> 条）</h1>
    <?php if ($msg) echo '<p class="msg">' . $msg . '</p>'; ?>

    <!-- 新增/编辑表单 -->
    <div class="box">
        <h2><?php echo $edit_data ? '编辑友链: ' . htmlspecialchars($edit_data['name']) : '新增友链'; ?></h2>
        <form method="post">
            <input type="hidden" name="action" value="<?php echo $edit_data ? 'edit' : 'add'; ?>">
            <?php if ($edit_data): ?>
                <input type="hidden" name="old_name" value="<?php echo htmlspecialchars($edit_data['name']); ?>">
            <?php endif; ?>
            <div class="form-row">
                <div class="field"><label>站点名</label><input type="text" name="name" value="<?php echo $edit_data ? htmlspecialchars($edit_data['name']) : ''; ?>" required></div>
                <div class="field"><label>链接</label><input type="text" name="link" value="<?php echo $edit_data ? htmlspecialchars($edit_data['link']) : ''; ?>" required></div>
                <div class="field"><label>简介</label><input type="text" name="about" value="<?php echo $edit_data ? htmlspecialchars($edit_data['about']) : ''; ?>" required></div>
                <div class="field"><label>Logo URL</label><input type="text" name="logo" value="<?php echo $edit_data ? htmlspecialchars($edit_data['logo']) : ''; ?>" required></div>
            </div>
            <div style="margin-top:8px;">
                <button type="submit" class="btn btn-pink"><?php echo $edit_data ? '保存修改' : '添加友链'; ?></button>
                <?php if ($edit_data): ?>
                    <a href="links_manage.php" class="btn btn-gray" style="text-decoration:none;">取消</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- 列表 -->
    <div class="box" style="overflow-x:auto;">
        <table>
            <thead><tr><th>Logo</th><th>站点名</th><th>链接</th><th>简介</th><th>操作</th></tr></thead>
            <tbody>
                <?php if (count($items) > 0): ?>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><img src="<?php echo htmlspecialchars($item['logo']); ?>" class="logo-img" onerror="this.style.display='none'" alt=""></td>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td><a href="<?php echo htmlspecialchars($item['link']); ?>" target="_blank" style="color:#3498db;"><?php echo htmlspecialchars($item['link']); ?></a></td>
                            <td><?php echo htmlspecialchars($item['about']); ?></td>
                            <td style="white-space:nowrap;">
                                <form method="post" class="inline-form">
                                    <input type="hidden" name="action" value="get_edit">
                                    <input type="hidden" name="edit_name" value="<?php echo htmlspecialchars($item['name']); ?>">
                                    <button type="submit" class="btn btn-green" style="padding:4px 10px;">编辑</button>
                                </form>
                                <form method="post" class="inline-form" onsubmit="return confirm('确定删除友链「<?php echo htmlspecialchars($item['name']); ?>」？');">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="delete_name" value="<?php echo htmlspecialchars($item['name']); ?>">
                                    <button type="submit" class="btn btn-red" style="padding:4px 10px;">删除</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" style="text-align:center;color:#999;padding:30px;">暂无友链</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <p class="back"><a href="index.php">← 返回管理面板</a> | <a href="logout.php">退出登录</a></p>
</div>
</body>
</html>
