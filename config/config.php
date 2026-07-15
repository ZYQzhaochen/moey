<?php
// 防直接访问
if (basename($_SERVER['SCRIPT_FILENAME']) === 'config.php') { http_response_code(403); die('Forbidden'); }
$form="all";//网站首页句子类型，可选项可参考接口说明
$foot="Copyright © <i>2023-2026</i> <font color='#FF69B4'>萌云</font><br><a href='https://beian.miit.gov.cn/' target='_blank' class='sa'><img style='width:16px;height:16px;margin-bottom:4px;color: #FF69B4;' src='../images/ba.png'>沪ICP备2025112667号</a> | <a href='https://icp.gov.moe/?keyword=20230885' target='_blank' class='sa'><img style='width:16px;height:16px;margin-bottom:4px;color: #FF69B4;' src='../images/moeicp.png'>萌ICP备20230885号</a>";// 网站底部版权信息
$admin_user = "admin";//管理员用户名
$admin_pw = "123456";//管理员密码
$servername = 'localhost';//数据库服务器地址
$username = 'your_db_user';//数据库用户名
$password = 'your_db_password';//数据库密码
$dbname = 'your_db_name';//数据库名

// IP封禁检查
$visitor_ip = $_SERVER['REMOTE_ADDR'];
$ban_file_path = __DIR__ . "/ban.txt";
if (file_exists($ban_file_path)) {
    $banned_ips = file($ban_file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (in_array($visitor_ip, $banned_ips)) {
        header('HTTP/1.1 403 Forbidden');
        die('您的IP地址已被本站封禁。如有疑问请联系管理员。<br>Your IP address has been banned from this site.');
    }
}
?>