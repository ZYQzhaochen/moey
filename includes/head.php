<?php
/**
 * 公共 <head> - 输出 DOCTYPE 到 </head>
 * 需要的变量：
 *   $base_path       - 资源路径前缀
 *   $page_title      - 页面标题
 *   $page_robots     - (可选) robots meta, 默认 'index,follow'
 *   $page_keywords   - (可选) keywords meta
 *   $page_description- (可选) description meta
 *   $page_copyright  - (可选) copyright meta, 默认 '萌云网络'
 *   $page_author     - (可选) author meta, 默认 'moey'
 *   $extra_head_html - (可选) 注入 </head> 之前的内容
 */
if (!isset($page_robots)) $page_robots = 'index,follow';
if (!isset($page_copyright)) $page_copyright = '萌云网络';
if (!isset($page_author)) $page_author = 'moey';
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1,maximum-scale=1,maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $page_title; ?></title>
    <meta name="robots" content="<?php echo $page_robots; ?>">
    <meta name="copyright" content="<?php echo $page_copyright; ?>">
<?php if (!empty($page_keywords)): ?>
    <meta name="keywords" content="<?php echo $page_keywords; ?>">
<?php endif; ?>
<?php if (!empty($page_description)): ?>
    <meta name="description" content="<?php echo $page_description; ?>">
<?php endif; ?>
    <meta name="author" content="<?php echo $page_author; ?>">
    <link rel="stylesheet" href="<?php echo $base_path; ?>static/css/reset.css">
    <link rel="stylesheet" href="<?php echo $base_path; ?>static/css/lanren.css">
    <link rel="stylesheet" href="<?php echo $base_path; ?>static/css/ty.css">
    <link rel="Shortcut Icon"href="<?php echo $base_path; ?>favicon.ico">
<?php echo isset($extra_head_html) ? $extra_head_html : ''; ?>
</head>
