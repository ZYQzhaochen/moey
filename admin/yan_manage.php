<?php
header('Content-type:text/html; charset=utf-8');
require "auth.php";
require "../config/config.php";

$msg = '';
$edit_data = null;

// 分类名称
$type_names = array('a'=>'动画','b'=>'漫画','c'=>'游戏','d'=>'文学','e'=>'原创','f'=>'来自网络','g'=>'影视','h'=>'诗词','i'=>'哲学','j'=>'其他');

// ===== 处理 POST =====
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'add' || $action === 'edit') {
        $text = trim($_POST['text']);
        $from = trim($_POST['from']);
        $from_who = trim($_POST['from_who']);
        $creator = trim($_POST['creator']);
        $form_type = trim($_POST['form_type']);
        if ($from_who == '') $from_who = 'null';

        $target_file = __DIR__ . "/../yan/" . $form_type . ".txt";

        if (!file_exists($target_file)) {
            $msg = '<span style="color:#e74c3c;">数据文件 yan/' . $form_type . '.txt 不存在</span>';
        } elseif ($text == '' || $from == '' || $creator == '' || $form_type == '') {
            $msg = '<span style="color:#e74c3c;">请填写所有必填字段</span>';
        } else {
            if ($action === 'add') {
                // 新增：递增 ID 并追加
                $id = intval(file_get_contents(__DIR__ . "/../config/id.dat"));
                $id++;
                file_put_contents(__DIR__ . "/../config/id.dat", $id);

                $time = time();
                $length = mb_strlen($text, 'UTF-8');
                $new_line = "\n{id:" . $id . "}{text:" . $text . "}{type:" . $form_type . "}{from:" . $from . "}{from_who:" . $from_who . "}{creator:" . $creator . "}{created_at:" . $time . "}{length:" . $length . "}";
                $fp = fopen($target_file, "a");
                fwrite($fp, $new_line);
                fclose($fp);
                $msg = '<span style="color:#27ae60;">语句添加成功！ID: ' . $id . '</span>';
            } elseif ($action === 'edit') {
                // 编辑：找到行并替换
                $edit_id = $_POST['edit_id'];
                $lines = file($target_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $new_lines = array();
                $found = false;
                foreach ($lines as $line) {
                    if ($line[0] === '{' && strpos($line, "{id:" . $edit_id . "}") !== false) {
                        $time = time();
                        $length = mb_strlen($text, 'UTF-8');
                        $new_line = "{id:" . $edit_id . "}{text:" . $text . "}{type:" . $form_type . "}{from:" . $from . "}{from_who:" . $from_who . "}{creator:" . $creator . "}{created_at:" . $time . "}{length:" . $length . "}";
                        $new_lines[] = $new_line;
                        $found = true;
                    } else {
                        $new_lines[] = $line;
                    }
                }
                if ($found) {
                    file_put_contents($target_file, implode(PHP_EOL, $new_lines) . PHP_EOL);
                    $msg = '<span style="color:#27ae60;">语句已更新！ID: ' . $edit_id . '</span>';
                } else {
                    $msg = '<span style="color:#e74c3c;">未找到要编辑的语句</span>';
                }
            }
        }
    } elseif ($action === 'delete') {
        $delete_id = $_POST['delete_id'];
        $delete_form = $_POST['delete_form'];
        $target_file = __DIR__ . "/../yan/" . $delete_form . ".txt";
        if (file_exists($target_file)) {
            $lines = file($target_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $new_lines = array();
            foreach ($lines as $line) {
                if (!($line[0] === '{' && strpos($line, "{id:" . $delete_id . "}") !== false)) {
                    $new_lines[] = $line;
                }
            }
            file_put_contents($target_file, implode(PHP_EOL, $new_lines) . PHP_EOL);
            $msg = '<span style="color:#27ae60;">语句已删除！ID: ' . $delete_id . '</span>';
        }
    } elseif ($action === 'get_edit') {
        // 加载编辑数据
        $edit_id = $_POST['edit_id'];
        $edit_form = $_POST['edit_form'];
        $target_file = __DIR__ . "/../yan/" . $edit_form . ".txt";
        if (file_exists($target_file)) {
            $lines = file($target_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if ($line[0] === '{' && strpos($line, "{id:" . $edit_id . "}") !== false) {
                    preg_match_all("/{id:(.*?)}{text:(.*?)}{type:(.*?)}{from:(.*?)}{from_who:(.*?)}{creator:(.*?)}{created_at:(.*?)}{length:(.*?)}/", $line, $m);
                    $edit_data = array(
                        'id' => $m[1][0], 'text' => $m[2][0], 'type' => $m[3][0],
                        'from' => $m[4][0], 'from_who' => $m[5][0], 'creator' => $m[6][0]
                    );
                }
            }
        }
    }
}

// ===== 读取数据 =====
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$items = array();
$cat_stats = array();
foreach (range('a', 'j') as $cat) {
    $cat_stats[$cat] = 0;
    if ($filter !== 'all' && $filter !== $cat) continue;
    $f = __DIR__ . "/../yan/{$cat}.txt";
    if (file_exists($f)) {
        $lines = file($f, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if ($line[0] === '{') {
                preg_match_all("/{id:(.*?)}{text:(.*?)}{type:(.*?)}{from:(.*?)}{from_who:(.*?)}{creator:(.*?)}{created_at:(.*?)}{length:(.*?)}/", $line, $m);
                if ($m[1][0]) {
                    $items[] = array(
                        'id' => intval($m[1][0]), 'text' => $m[2][0], 'type' => $m[3][0],
                        'from' => $m[4][0], 'from_who' => $m[5][0], 'creator' => $m[6][0],
                        'created_at' => $m[7][0], 'length' => $m[8][0]
                    );
                }
            }
            if ($line[0] === '{') $cat_stats[$cat]++;
        }
    }
}
// 按 ID 倒序
usort($items, function($a, $b) { return $b['id'] - $a['id']; });

// 搜索过滤
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
if ($search !== '') {
    $items = array_filter($items, function($item) use ($search) {
        return stripos((string)$item['id'], $search) !== false
            || stripos($item['text'], $search) !== false
            || stripos($item['from'], $search) !== false
            || stripos($item['creator'], $search) !== false;
    });
}

// 限制显示数量
$total_count = count($items);
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$per_page = 50;
$offset = ($page - 1) * $per_page;
$items_page = array_slice($items, $offset, $per_page);
$total_pages = ceil($total_count / $per_page);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="robots" content="noindex,nofollow">
    <title>语句管理 | 萌言Moey</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:Arial,sans-serif; background:#f5f5f5; padding:16px; }
        .wrap { max-width:1100px; margin:0 auto; }
        h1 { color:#FF69B4; margin-bottom:12px; font-size:1.3rem; }
        .msg { display:block; margin-bottom:10px; font-size:0.9rem; }
        .box { background:#fff; border-radius:6px; padding:16px; margin-bottom:14px; box-shadow:0 1px 4px rgba(0,0,0,0.06); }
        .box h2 { font-size:1rem; color:#555; margin-bottom:10px; }
        label { display:inline-block; font-size:0.85rem; color:#555; margin-right:4px; }
        input[type="text"], textarea, select { padding:7px 9px; border:1px solid #ddd; border-radius:4px; font-size:0.9rem; }
        textarea { width:100%; min-height:50px; resize:vertical; }
        .form-row { display:flex; gap:8px; flex-wrap:wrap; margin-bottom:8px; align-items:flex-end; }
        .form-row .field { flex:1; min-width:120px; }
        .field label { display:block; margin-bottom:3px; }
        .field input, .field select { width:100%; }
        .btn { padding:7px 16px; border:none; border-radius:4px; font-size:0.85rem; cursor:pointer; text-decoration:none; display:inline-block; }
        .btn-pink { background:#FF69B4; color:#fff; }
        .btn-pink:hover { background:#FF1493; }
        .btn-green { background:#27ae60; color:#fff; }
        .btn-green:hover { background:#219a52; }
        .btn-red { background:#e74c3c; color:#fff; }
        .btn-red:hover { background:#c0392b; }
        .btn-gray { background:#95a5a6; color:#fff; }
        .filter-bar { margin-bottom:12px; }
        .filter-bar a { padding:5px 12px; border-radius:4px; text-decoration:none; color:#555; font-size:0.85rem; margin-right:4px; background:#e8e8e8; }
        .filter-bar a.active { background:#FF69B4; color:#fff; }
        .filter-bar a:hover { background:#ddd; }
        .filter-bar a.active:hover { background:#FF1493; }
        .search-row { display:flex; align-items:center; gap:8px; margin-bottom:12px; flex-wrap:wrap; }
        .search-row input { padding:5px 10px; border:1px solid #ddd; border-radius:4px; font-size:0.85rem; width:200px; }
        .search-row input:focus { outline:none; border-color:#FF69B4; }
        table { width:100%; border-collapse:collapse; font-size:0.85rem; }
        th { background:#f8f8f8; padding:8px 6px; text-align:left; border-bottom:2px solid #eee; font-weight:bold; color:#555; white-space:nowrap; }
        td { padding:8px 6px; border-bottom:1px solid #f0f0f0; vertical-align:top; }
        tr:hover { background:#fffafc; }
        .text-col { max-width:250px; word-break:break-all; }
        .page-nav { margin-top:10px; text-align:center; }
        .page-nav a, .page-nav span { display:inline-block; padding:5px 10px; margin:0 2px; border-radius:4px; text-decoration:none; color:#555; background:#e8e8e8; font-size:0.85rem; }
        .page-nav span { background:#FF69B4; color:#fff; }
        .inline-form { display:inline; }
        .back { text-align:center; margin-top:16px; }
        .back a { color:#999; text-decoration:none; font-size:0.85rem; }
        @media (max-width:768px) {
            .form-row { flex-direction:column; }
            table { font-size:0.75rem; }
            .text-col { max-width:120px; }
        }
    </style>
</head>
<body>
<div class="wrap">
    <h1>语句管理（共 <?php echo $total_count; ?> 条<?php echo $filter !== 'all' ? '，筛选: ' . $type_names[$filter] : ''; ?>）</h1>
    <?php if ($msg) echo '<p class="msg">' . $msg . '</p>'; ?>

    <!-- 分类筛选 + 搜索 -->
    <div class="search-row">
        <div class="filter-bar" style="margin-bottom:0;">
            <a href="?filter=all<?php echo $search ? '&search=' . urlencode($search) : ''; ?>" class="<?php echo $filter === 'all' ? 'active' : ''; ?>">全部</a>
            <?php foreach (range('a', 'j') as $cat): ?>
                <a href="?filter=<?php echo $cat . ($search ? '&search=' . urlencode($search) : ''); ?>" class="<?php echo $filter === $cat ? 'active' : ''; ?>">
                    <?php echo $type_names[$cat]; ?>(<?php echo $cat_stats[$cat]; ?>)
                </a>
            <?php endforeach; ?>
        </div>
        <form method="get" style="display:inline-flex;align-items:center;gap:6px;">
            <input type="hidden" name="filter" value="<?php echo $filter; ?>">
            <input type="text" name="search" placeholder="搜索 ID/句子/出处/提交者..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn btn-pink" style="padding:5px 14px;font-size:0.8rem;">搜索</button>
            <?php if ($search !== ''): ?><a href="?filter=<?php echo $filter; ?>" class="btn btn-gray" style="padding:5px 12px;font-size:0.8rem;">清除</a><?php endif; ?>
        </form>
    </div>

    <!-- 新增表单 -->
    <div class="box">
        <h2><?php echo $edit_data ? '编辑语句 ID:' . $edit_data['id'] : '新增语句'; ?></h2>
        <form method="post">
            <input type="hidden" name="action" value="<?php echo $edit_data ? 'edit' : 'add'; ?>">
            <?php if ($edit_data): ?>
                <input type="hidden" name="edit_id" value="<?php echo $edit_data['id']; ?>">
            <?php endif; ?>
            <div class="form-row">
                <div class="field" style="flex:2;">
                    <label>句子</label>
                    <textarea name="text" required><?php echo $edit_data ? htmlspecialchars($edit_data['text'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="field"><label>出处</label><input type="text" name="from" value="<?php echo $edit_data ? htmlspecialchars($edit_data['from'], ENT_QUOTES, 'UTF-8') : ''; ?>" required></div>
                <div class="field"><label>作者</label><input type="text" name="from_who" value="<?php echo ($edit_data && $edit_data['from_who'] !== 'null') ? htmlspecialchars($edit_data['from_who'], ENT_QUOTES, 'UTF-8') : ''; ?>" placeholder="选填"></div>
                <div class="field"><label>提交者</label><input type="text" name="creator" value="<?php echo $edit_data ? htmlspecialchars($edit_data['creator'], ENT_QUOTES, 'UTF-8') : ''; ?>" required></div>
                <div class="field" style="max-width:100px;"><label>类型</label>
                    <select name="form_type" required>
                        <?php foreach ($type_names as $k => $v): ?>
                            <option value="<?php echo $k; ?>" <?php echo ($edit_data && $edit_data['type'] === $k) ? 'selected' : ''; ?>><?php echo $v; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="field" style="max-width:fit-content;align-self:flex-end;">
                    <button type="submit" class="btn btn-pink"><?php echo $edit_data ? '保存修改' : '添加语句'; ?></button>
                    <?php if ($edit_data): ?>
                        <a href="yan_manage.php" class="btn btn-gray">取消</a>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>

    <!-- 列表 -->
    <div class="box" style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th>ID</th><th>句子</th><th>类型</th><th>出处</th><th>作者</th><th>提交者</th><th>字数</th><th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($items_page) > 0): ?>
                    <?php foreach ($items_page as $item): ?>
                        <tr>
                            <td><?php echo $item['id']; ?></td>
                            <td class="text-col"><?php echo htmlspecialchars($item['text'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo $type_names[$item['type']] ?? $item['type']; ?></td>
                            <td><?php echo htmlspecialchars($item['from'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo $item['from_who'] !== 'null' ? htmlspecialchars($item['from_who'], ENT_QUOTES, 'UTF-8') : '-'; ?></td>
                            <td><?php echo htmlspecialchars($item['creator'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo $item['length']; ?></td>
                            <td style="white-space:nowrap;">
                                <form method="post" class="inline-form">
                                    <input type="hidden" name="action" value="get_edit">
                                    <input type="hidden" name="edit_id" value="<?php echo $item['id']; ?>">
                                    <input type="hidden" name="edit_form" value="<?php echo $item['type']; ?>">
                                    <button type="submit" class="btn btn-green" style="padding:4px 10px;">编辑</button>
                                </form>
                                <form method="post" class="inline-form" onsubmit="return confirm('确定删除 ID:<?php echo $item['id']; ?> 的语句？此操作不可撤销。');">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="delete_id" value="<?php echo $item['id']; ?>">
                                    <input type="hidden" name="delete_form" value="<?php echo $item['type']; ?>">
                                    <button type="submit" class="btn btn-red" style="padding:4px 10px;">删除</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="8" style="text-align:center;color:#999;padding:30px;">暂无数据</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if ($total_pages > 1): ?>
            <div class="page-nav">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <?php if ($i === $page): ?>
                        <span><?php echo $i; ?></span>
                    <?php else: ?>
                        <a href="?filter=<?php echo $filter; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>

    <p class="back"><a href="index.php">← 返回管理面板</a> | <a href="logout.php">退出登录</a></p>
</div>
</body>
</html>
