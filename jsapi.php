<?php 
header('Content-type:text/html;charset=utf-8');
require "config/config.php";
if($form=="all"){
$arr=array("a","a","a","b","c","c","d","d","d","e","e","f","f","g","h","i","j");
$sj=array_rand($arr);
$form=$arr[$sj];
}
$file_path='yan/'.$form.'.txt';
if(!file_exists($file_path)) {
die($file_path.'数据文件不存在');
}
do{
$data=file_get_contents($file_path);
$data=explode(PHP_EOL, $data);
$result=$data[array_rand($data)];
$you=preg_match_all("/{id:(.*?)}{text:(.*?)}{type:(.*?)}{from:(.*?)}{from_who:(.*?)}{creator:(.*?)}{created_at:(.*?)}{length:(.*?)}/",$result,$v);
if($you==0){
die($file_path."数据缺失");
}
$text=$v[2][0];
$from=$v[4][0];
$from_who=$v[5][0];
$length=$v[8][0];
}while($length>=44);
if($from_who=="null"){
$from_who="";
}
$result=$text.'<br><br><div style="text-align:right;font-family:sq;">——'.$from_who.'「'.$from.'」</div>';
echo json_encode(array("code"=>"200","text"=>$result),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
?>