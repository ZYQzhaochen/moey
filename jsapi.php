<?php
header('Content-type:text/html;charset=utf-8');
require "config/config.php";

do{
	if($form=="all"){
		$types=array("a","b","c","d","e","f","g","h","i","j");
		$counts=array();
		$total=0;
		foreach($types as $t){
			$f='yan/'.$t.'.txt';
			$c=file_exists($f)?count(file($f, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)):0;
			$counts[$t]=$c;
			$total+=$c;
		}
		$r=mt_rand(0,$total-1);
		foreach($counts as $t=>$c){
			if($r<$c){$form=$t;$line_index=$r;break;}
			$r-=$c;
		}
		$file_path='yan/'.$form.'.txt';
		$lines=file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$result=$lines[$line_index];
	}else{
		$file_path='yan/'.$form.'.txt';
		if(!file_exists($file_path)) die($file_path.'数据文件不存在');
		$data=file_get_contents($file_path);
		$data=explode(PHP_EOL, $data);
		$result=$data[array_rand($data)];
	}

	$you=preg_match_all("/{id:(.*?)}{text:(.*?)}{type:(.*?)}{from:(.*?)}{from_who:(.*?)}{creator:(.*?)}{created_at:(.*?)}{length:(.*?)}/",$result,$v);
	if($you==0) die($file_path."数据缺失");
	$text=$v[2][0];
	$from=$v[4][0];
	$from_who=$v[5][0];
	$length=$v[8][0];
}while($length>=45);

if($from_who=="null") $from_who="";
$result=$text.'<br><div style="text-align:right;font-family:sq;margin-top:6px;font-weight:normal;">——'.$from_who.'「'.$from.'」</div>';
echo json_encode(array("code"=>"200","text"=>$result), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
