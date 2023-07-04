<?php 
header('Content-type:text/html; charset=utf-8');
$form = $_GET['form']?:'all';
if($form=="all"){
$arr = array("a","b","c","d","e","f","g","h","i","j","k","l");
$sj = array_rand($arr);
$form = $arr[$sj];
}

//获取储存的文件
$file_path = $form.'.txt';
if(!file_exists($file_path)) {
	die($file_path.' 数据文件不存在，请检索您提交的"form"参数是否输入正确，如有疑问请参考接口说明');
}
//读取整个数据文件
$data = file_get_contents($file_path);
//按换行符分割成数组
$data = explode(PHP_EOL, $data);
//随机获取一行索引
$result = $data[array_rand($data)];
//去除多余的换行符（保险起见）
$result = str_replace(array("\r","\n","\r\n"), '', $result);

$you = preg_match_all("/『id:(.*?)』『text:(.*?)』『type:(.*?)』『from:(.*?)』『from_who:(.*?)』『creator:(.*?)』『creator_uid:(.*?)』『created_at:(.*?)』『length:(.*?)』/",$result,$v);
if($you== 0){
	die($file_path." 数据缺失！请联系本站管理员报告此错误");
}else{
$id=$v[1][0];
$text=$v[2][0];
$type=$v[3][0];
$from=$v[4][0];
$from_who=$v[5][0];
$creator=$v[6][0];
$creator_uid=$v[7][0];
$created_at=$v[8][0];
$length=$v[9][0];
if($from_who=="null"){
$from_who = "";
}

//判断输出类型并输出
if($_REQUEST['type']=='json'){
    echo json_encode(array("code"=>"200","id"=>$id,"text"=>$text,"form"=>$type,"from"=>$from,"from_who"=>$from_who,"creator"=>$creator,"length"=>$length),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
}else{
    echo $text.'——'.$from_who.'「'.$from.'」';
}
}
?> 

