<?php
require"../config/config.php";
$form=$_GET['form']?:'auto';
$type=$_GET['type']?:'img';

// 选择数据文件
if($form=='auto'){
	function isMobile(){
		$ua=$_SERVER['HTTP_USER_AGENT'];
		$m=array('android','iphone','ipad','ipod','blackberry','windows phone','iemobile','mobile','symbian','webos');
		foreach($m as $a){if(stripos($ua,$a)!==false)return true;}
		return false;
	}
	$form=isMobile()?'vertical':'level';
}
$file_path=$form.'.txt';
if(!file_exists($file_path)){http_response_code(404);die('图片分类不存在');}

// 随机选取一条
$data=file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$result=$data[array_rand($data)];
preg_match_all("/{id:(.*?)}{link:(.*?)}{form:(.*?)}/",$result,$v);
if(!$v[1][0]){http_response_code(404);die($file_path.'数据缺失');}

$id=$v[1][0];$link=$v[2][0];$data_form=$v[3][0];

// 输出
if($type=='img'){
	header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
	header('Expires: Thu, 01 Jan 1970 00:00:00 GMT');
	header('Pragma: no-cache');
	// 随机参数防浏览器/代理缓存重定向
	header("Location:".$link.(strpos($link,'?')===false?'?':'&').'r='.mt_rand());
}elseif($type=='json'){
	echo json_encode(array("code"=>"200","id"=>$id,"link"=>$link,"form"=>$data_form),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_NUMERIC_CHECK);
}else{
	echo $link;
}
