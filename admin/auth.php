<?php
// 管理后台登录守卫 - 所有 admin 页面引入此文件
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
