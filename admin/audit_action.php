<?php
header('Content-type:text/html; charset=utf-8');
require "../config/config.php";
require "auth.php";

$audit_file = __DIR__ . "/audit.txt";

if (!isset($_POST['action']) || !isset($_POST['id'])) {
    header('Location: audit_y.php');
    exit;
}

$action = $_POST['action'];
$id = $_POST['id'];

// 读取 audit.txt 所有行
$lines = file_exists($audit_file) ? file($audit_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : array();

$target_line = null;
$new_lines = array();

foreach ($lines as $line) {
    // 查找匹配 ID 的数据行（以 { 开头）
    if ($line[0] === '{' && strpos($line, "{id:" . $id . "}") !== false) {
        $target_line = $line; // 找到目标行，不加入新数组
    } else {
        $new_lines[] = $line; // 保留其他所有行
    }
}

if ($target_line === null) {
    header('refresh:2; url=audit_y.php');
    echo '未找到该语句，可能已被处理。2秒后返回...';
    exit;
}

if ($action === 'approve') {
    // 从目标行中解析 type（form）
    preg_match("/{type:(.*?)}/", $target_line, $type_match);
    $form = isset($type_match[1]) ? $type_match[1] : 'j';
    $yan_file = __DIR__ . "/../yan/" . $form . ".txt";

    if (!file_exists($yan_file)) {
        header('refresh:2; url=audit_y.php');
        echo '数据文件 yan/' . $form . '.txt 不存在。2秒后返回...';
        exit;
    }

    // 追加到句库（前加 \n，与 datup_y.php 格式一致）
    $fp = fopen($yan_file, "a");
    fwrite($fp, "\n" . $target_line);
    fclose($fp);

    // 从 audit.txt 移除
    file_put_contents($audit_file, implode(PHP_EOL, $new_lines) . PHP_EOL);

    header('Location: audit_y.php?msg=approved');
    exit;

} elseif ($action === 'reject') {
    // 从 audit.txt 移除
    file_put_contents($audit_file, implode(PHP_EOL, $new_lines) . PHP_EOL);

    header('Location: audit_y.php?msg=rejected');
    exit;

} else {
    header('Location: audit_y.php');
    exit;
}
