<?php
require"../config/config.php";
header('Content-type:text/html; charset=utf-8');
// 处理提交信息
if (isset($_POST['upyan'])) {
// 接收信息
$text = trim($_POST['text']);
$from = trim($_POST['from']);
$from_who = trim($_POST['from_who']);
$creator = trim($_POST['creator']);
$form = trim($_POST['form']);
$file_path = "../admin/audit.txt";
if ($from_who == '') {
$from_who = "null";
}
// 判断提交的信息
if (($text == '') || ($from == '') || ($creator == '') || ($form == '')) {
// 若为空,视为未填写,提示错误,并返回登录界面
header('refresh:1; url=submit_y.php');
echo "<script language=javascript>alert('缺少必填信息,请重新填写句子信息(｡í _ ì｡)')</script>";
exit;
} elseif (!file_exists($file_path)) {
// 检查数据文件是否存在
header('refresh:1; url=submit_y-subpage.php');
die($file_path . "<script language=javascript>alert('系统数据文件不存在,请向网站管理员报告此系统级故障!')</script>");
} else {
// 开始执行写入
$id=file_get_contents("../config/id.dat");
$id++;
$fp = fopen("../config/id.dat","w");
fwrite($fp,$id);
fclose($fp);

$time = time();
$length = mb_strlen($text, 'UTF-8')."";
$fp = fopen($file_path,"a");
fwrite($fp,"{id:".$id."}{text:".$text."}{type:".$form."}{from:".$from."}{from_who:".$from_who."}{creator:".$creator."}{created_at:".$time."}{length:".$length."}\n");
fclose($fp);
header('refresh:1; url=submit_y.php');
echo "<script language=javascript>alert('🎉您的句子已提交成功，萌言酱将尽快处理并收录～')</script>";
}
}
?>