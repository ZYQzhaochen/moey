<?php
header('Content-type:text/html; charset=utf-8');
$form=$_GET['form']?:'level';
$type=$_GET['type']?:'img';
$file_path=$form.'.txt';
if(!file_exists($file_path)){
die('请求错误，图片种类不存在，请检索您提交的"form"参数是否输入正确，如有疑问请参考接口说明');
}
$data=file_get_contents($file_path);
$data=explode(PHP_EOL, $data);
$result=$data[array_rand($data)];
$you=preg_match_all("/『id:(.*?)』『link:(.*?)』『form:(.*?)』/",$result,$v);
if($you==0){
die($file_path." 数据缺失！请联系本站管理员报告此错误");
}else{
$id=$v[1][0];
$link=$v[2][0];
if($type=='img'){
header("Location:".$link);
}elseif($type=='json'){
echo json_encode(array("code"=>"200","id"=>$id,"link"=>$link,"form"=>$form),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
}else{
echo $link;
}
}
?>