<?php
header('Content-type:text/html; charset=utf-8');
require"../config/config.php";//获取配置文件中设置的密钥
// 处理提交信息
if (isset($_POST['upyan'])) {
// 接收信息
$text = trim($_POST['text']);
$from = trim($_POST['from']);
$from_who = trim($_POST['from_who']);
$form = trim($_POST['form']);
$key = trim($_POST['key']);
$file_path = "../yan/".$form.".txt";
// 判断提交的信息
if (($text == '') || ($key == '') || ($from == '') || ($from_who == '') || ($form == '')) {
// 若为空,视为未填写,提示错误,并3秒后返回登录界面
header('refresh:5; url=yanup.php');
echo "提交信息不能为空,系统将在5秒后跳转到提交界面,请重新填写提交信息!";
exit;
} elseif ($key != $pw) {
// 密钥错误,同空的处理方式
header('refresh:5; url=yanup.php');
echo "密钥错误,系统将在5秒后跳转到提交界面,请重新填写提交信息!";
exit;
} elseif (!file_exists($file_path)) {
// 检查数据文件是否存在
header('refresh:5; url=yanup.php');
die($file_path . ' 数据文件不存在，系统将在5秒后跳转到提交界面,请重新填写提交信息!');
} elseif ($key = $pw) {
// 密钥正确,开始执行写入

$id=file_get_contents("../config/id.dat");
$id++;
$fp = fopen("../config/id.dat","w");
fwrite($fp,$id);
fclose($fp);

$time = time();
$length = mb_strlen($text, 'UTF-8')."";
$fp = fopen($file_path,"a");
fwrite($fp,"\n『id:".$id."』『text:".$text."』『type:".$form."』『from:".$from."』『from_who:".$from_who."』『creator:朝尘』『creator_uid:10001』『created_at:".$time."』『length:".$length."』");
fclose($fp);
header('refresh:2; url=yanup.php');
echo "🎉提交成功，系统将在2秒后跳转回提交页面";
}
}
?>