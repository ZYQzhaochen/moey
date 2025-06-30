<?php
$form=$_GET['form']?:'auto';
$type=$_GET['type']?:'img';
if($form=='auto'){
$dfolder='level.txt';
$mfolder='vertical.txt';
function isMobileDevice(){
$user_agent=$_SERVER['HTTP_USER_AGENT'];
$mobile_agents=array('android','iphone','ipad','ipod','blackberry','windowsce','opera mini','webos','symbian','windows phone','iemobile','mobile','palm','palmos','pocket','psp','series','playstation','nintendo','gameboy','macintosh');
foreach($mobile_agents as $agent){
if(stripos($user_agent, $agent)!==false){
return true;
}}
return false;
}
$ifolder = isMobileDevice() ? $mfolder : $dfolder;
$data=file_get_contents($ifolder);
$data=explode(PHP_EOL, $data);
$result=$data[array_rand($data)];
$you=preg_match_all("/{id:(.*?)}{link:(.*?)}{form:(.*?)}/",$result,$v);
if($you==0){
http_response_code(404);
die($file_path."数据缺失");
}else{
$id=$v[1][0];
$link=$v[2][0];
if($type=='img'){
header("Location:".$link);
}elseif($type=='json'){
echo json_encode(array("code"=>"200","id"=>$id,"link"=>$link,"form"=>$form),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
}else{
echo $link;
}}}else{
$file_path=$form.'.txt';
if(!file_exists($file_path)){
http_response_code(404);
die('图片分类不存在');
}
$data=file_get_contents($file_path);
$data=explode(PHP_EOL, $data);
$result=$data[array_rand($data)];
$you=preg_match_all("/{id:(.*?)}{link:(.*?)}{form:(.*?)}/",$result,$v);
if($you==0){
http_response_code(404);
die($file_path."数据缺失");
}else{
$id=$v[1][0];
$link=$v[2][0];
if($type=='img'){
header("Location:".$link);
}elseif($type=='json'){
echo json_encode(array("code"=>"200","id"=>$id,"link"=>$link,"form"=>$form),  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
}else{
echo $link;
}}}
?>