<?php 
$form=$_GET['form']?:'all';
if($form=="all"){
$arr=array("a","b","c","d","e","f","g","h","i","j");
$sj=array_rand($arr);
$form=$arr[$sj];
}
$file_path=$form.'.txt';
if(!file_exists($file_path)){
die($form.'句子分类不存在');
}
$data=file_get_contents($file_path);
$data=explode(PHP_EOL, $data);
$result=$data[array_rand($data)];
$result=str_replace(array("\r","\n","\r\n"), '', $result);
$you=preg_match_all("/{id:(.*?)}{text:(.*?)}{type:(.*?)}{from:(.*?)}{from_who:(.*?)}{creator:(.*?)}{created_at:(.*?)}{length:(.*?)}/",$result,$v);
if($you==0){
die($file_path."数据缺失");
}else{
$id=$v[1][0];
$text=$v[2][0];
$type=$v[3][0];
$from=$v[4][0];
$from_who=$v[5][0];
$creator=$v[6][0];
$created_at=$v[7][0];
$length=$v[8][0];
if($_REQUEST['type']=='json'){
echo json_encode(array("code"=>"200","id"=>$id,"text"=>$text,"form"=>$type,"from"=>$from,"from_who"=>$from_who,"creator"=>$creator,"created_at"=>$created_at,"length"=>$length),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
}else{
if($from_who=="null"){
$from_who="";
}
echo $text.'——'.$from_who.'「'.$from.'」';
}
}
?>