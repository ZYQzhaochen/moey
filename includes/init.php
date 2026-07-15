<?php
/**
 * 公共初始化 - 所有页面引用
 * 使用前需设置：
 *   $base_path   - 资源路径前缀: 首页 '', 子页 '../'
 *   $home_url    - 侧栏"首页"链接: 首页 './', 子页 '../'
 *   $page_prefix - 侧栏子页路径前缀: 首页 'pages/', 子页 ''
 *   $page_title  - 页面标题
 *   $page_heading - 页面 heading
 */
header('Content-type:text/html; charset=utf-8');
require __DIR__ . '/../config/config.php';
