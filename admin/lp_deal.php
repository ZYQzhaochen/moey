<?php
header('Content-type:text/html; charset=utf-8');
require"../config/config.php";//获取配置文件中设置的密钥
// 处理提交信息
if (isset($_POST['lp'])) {
// 接收信息
$name = trim($_POST['name']);
$link = trim($_POST['link']);
$about = trim($_POST['about']);
$tx = trim($_POST['tx']);
$key = trim($_POST['key']);
$file_path = "../config/links.txt";
// 判断提交的信息
if (($name == '') || ($link == '') || ($about == '') || ($tx == '') || ($key == '')) {
// 若为空,视为未填写,提示错误,并3秒后返回登录界面
header('refresh:5; url=lp.php');
echo "提交信息不能为空,系统将在5秒后跳转到提交界面,请重新填写提交信息!";
exit;
} elseif ($key != $pw) {
// 密钥错误,同空的处理方式
header('refresh:5; url=lp.php');
echo "密钥错误,系统将在5秒后跳转到提交界面,请重新填写提交信息!";
exit;
} elseif (!file_exists($file_path)) {
// 检查数据文件是否存在
header('refresh:5; url=lp.php');
die($file_path . ' 数据文件不存在，系统将在5秒后跳转到提交界面');
} elseif ($key = $pw) {
// 密钥正确,开始执行写入
$fp = fopen($file_path,"a");
fwrite($fp,"\n{name:".$name."}{link:".$link."}{about:".$about."}{logo:".$tx."}");
fclose($fp);
header('refresh:2; url=lp.php');
echo "🎉提交成功，系统将在2秒后跳转回提交页面";
}
}
?>