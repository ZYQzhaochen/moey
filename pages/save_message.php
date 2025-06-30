<?php
// 获取数据库信息
require"../config/config.php";
// 获取表单字段的值
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$emoji = $_POST['emoji'];
$date = date('Y-m-d H:i:s');
// 判断提交的信息
if (($name == '') || ($email == '') || ($message == '')) {
// 若为空,视为未填写,提示错误,并3秒后返回登录界面
header('refresh:3; url=chat-subpage.php');
echo "留言提交信息不能为空哦～3秒钟后将返回留言板，请重新发送";
exit;
} else {
// 创建数据库连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检查连接是否成功
if ($conn->connect_error) {
    die('数据库连接失败: ' . $conn->connect_error);
}
// 创建插入留言的SQL语句
$sql = "INSERT INTO messages (name, email, message, emoji, date) VALUES ('$name', '$email', '$message', '$emoji', '$date')";
// 执行插入操作
if ($conn->query($sql) === TRUE) {
    // 留言保存成功后，返回首页
    header("Location: chat-subpage.php");
    exit();
} else {
    echo '留言保存失败: ' . $conn->error;
}
// 关闭数据库连接
$conn->close();
}
?>