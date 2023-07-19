<?php
header('Content-type:text/html; charset=utf-8');
require"../config/config.php";//获取配置文件中设置的密钥
// 处理提交信息
if (isset($_POST['upwp'])) {
// 接收信息
$link = trim($_POST['link']);
$form = trim($_POST['form']);
$key = trim($_POST['key']);
$file_path = "../wallpaper/".$form.".txt";
// 判断提交的信息
if (($link == '') || ($key == '') || ($form == '')) {
// 若为空,视为未填写,提示错误,并3秒后返回登录界面
header('refresh:5; url=wpup.php');
echo "提交信息不能为空,系统将在5秒后跳转到提交界面,请重新填写提交信息!";
exit;
} elseif ($key != $pw) {
// 密钥错误,同空的处理方式
header('refresh:5; url=wpup.php');
echo "密钥错误,系统将在5秒后跳转到提交界面,请重新填写提交信息!";
exit;
} elseif (!file_exists($file_path)) {
// 检查数据文件是否存在
header('refresh:5; url=wpup.php');
die($file_path . ' 数据文件不存在，系统将在5秒后跳转到提交界面,请重新填写提交信息!');
} elseif ($key = $pw) {
// 密钥正确,开始执行写入

$id=file_get_contents("../config/id_wp.dat");
$id++;
$fp = fopen("../config/id_wp.dat","w");
fwrite($fp,$id);
fclose($fp);

$fp = fopen($file_path,"a");
fwrite($fp,"\n『id:".$id."』『link:".$link."』『form:".$form."』");
fclose($fp);
header('refresh:2; url=wpup.php');
echo "🎉提交成功，系统将在2秒后跳转回提交页面";
}
}
?>