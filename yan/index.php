<?php
require"../config/config.php";

$form=$_GET['form']?:'all';

// 判断多类型或全部类型 → 全局等概率随机
if($form=="all" || strpos($form,',')!==false){
	$types=($form=="all")?array("a","b","c","d","e","f","g","h","i","j"):explode(',',$form);
	$counts=array();
	$total=0;
	foreach($types as $t){
		$f=$t.'.txt';
		$c=file_exists($f)?count(file($f, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)):0;
		$counts[$t]=$c;
		$total+=$c;
	}
	if($total==0) die('指定类型无数据');
	$r=mt_rand(0,$total-1);
	foreach($counts as $t=>$c){
		if($r<$c){$form=$t;$line_index=$r;break;}
		$r-=$c;
	}
	$file_path=$form.'.txt';
	$lines=file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	$result=$lines[$line_index];
	goto parse_result;
}

// 单类型
$file_path=$form.'.txt';
if(!file_exists($file_path)){
	die($form.'句子分类不存在');
}
$data=file_get_contents($file_path);
$data=explode(PHP_EOL, $data);
$result=$data[array_rand($data)];

parse_result:
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
