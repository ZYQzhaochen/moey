<?php
session_start();

// 获取数据库信息
require"../config/config.php";

// 获取用户IP
$ip = $_SERVER['REMOTE_ADDR'];

// ===== 频率限制：每3分钟只能发送一条留言 =====
$cooldown_seconds = 180; // 3分钟

// 第一层：Session 快速检查（无需查询数据库）
if (isset($_SESSION['last_message_time'])) {
    $elapsed = time() - $_SESSION['last_message_time'];
    if ($elapsed < $cooldown_seconds) {
        $remaining = $cooldown_seconds - $elapsed;
        header('refresh:3; url=chat.php?rate_limited=1&remaining=' . $remaining);
        echo '发送太频繁啦～请等待 ' . $remaining . ' 秒后再发送留言！3秒钟后将返回留言板。';
        exit;
    }
}

// 第二层：数据库IP检查（防止清除Session绕过）
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('数据库连接失败: ' . $conn->connect_error);
}
$conn->query("SET NAMES utf8mb4");
// 一次性修复旧表列字符集（如果列不是 utf8mb4 则转换）
@$conn->query("ALTER TABLE messages MODIFY name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL");
@$conn->query("ALTER TABLE messages MODIFY email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL");
@$conn->query("ALTER TABLE messages MODIFY message TEXT CHARACTER SET utf8mb4 NOT NULL");


// 自动建表（如果表不存在）
$create_table_sql = "CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    date DATETIME NOT NULL,
    ip_address VARCHAR(45) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4";
$conn->query($create_table_sql);



$safe_ip = $conn->real_escape_string($ip);
$sql_check = "SELECT date FROM messages WHERE ip_address = '$safe_ip' ORDER BY date DESC LIMIT 1";
$result = $conn->query($sql_check);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $elapsed = time() - strtotime($row['date']);
    if ($elapsed < $cooldown_seconds) {
        $remaining = $cooldown_seconds - $elapsed;
        $conn->close();
        header('refresh:3; url=chat.php?rate_limited=1&remaining=' . $remaining);
        echo '发送太频繁啦～请等待 ' . $remaining . ' 秒后再发送留言！3秒钟后将返回留言板。';
        exit;
    }
}

// 获取表单字段的值
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$date = date('Y-m-d H:i:s');

// 人机验证
$captcha_input = isset($_POST['captcha_input']) ? strtoupper(trim($_POST['captcha_input'])) : '';
if ($captcha_input === '' || $captcha_input !== $_SESSION['captcha_code']) {
    unset($_SESSION['captcha_code']);
    $conn->close();
    header('refresh:3; url=chat.php');
    echo '验证码错误，请重新填写！3秒钟后将返回留言板。';
    exit;
}
unset($_SESSION['captcha_code']); // 验证后清除，防重用

// 判断提交的信息
if (($name == '') || ($email == '') || ($message == '')) {
    // 若为空,视为未填写,提示错误,并3秒后返回登录界面
    header('refresh:3; url=chat.php');
    echo "留言提交信息不能为空哦～3秒钟后将返回留言板，请重新发送";
    exit;
} else {
    // 转义输入防止SQL注入
    $safe_name = $conn->real_escape_string($name);
    $safe_email = $conn->real_escape_string($email);
    $safe_message = $conn->real_escape_string($message);

    // 创建插入留言的SQL语句
    $sql = "INSERT INTO messages (name, email, message, date, ip_address) VALUES ('$safe_name', '$safe_email', '$safe_message', '$date', '$safe_ip')";

    // 执行插入操作
    if ($conn->query($sql) === TRUE) {
        // 记录发送时间到Session
        $_SESSION['last_message_time'] = time();

        // 留言保存成功后，返回首页
        header("Location: chat.php?sent=1");
        exit();
    } else {
        echo '留言保存失败: ' . $conn->error;
    }
}

// 关闭数据库连接
$conn->close();
