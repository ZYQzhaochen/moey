<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1,maximum-scale=1,maximum-scale=1, user-scalable=no" name="viewport">
	<title>萌言</title>
	<meta name="robots" content="noindex">
	<link rel="stylesheet" href="../static/css/ty.css">
	<link rel="stylesheet" href="../static/css/load.css">
	<style>
	p {
		color: #606060;
		font-family:dk;
	}
	hr {
		height:3px;
		border:none;
		border-top:3px dotted #FF69B4;
	}
	h2 {
		color: #606060;
	}
	a {
		color: #FF69B4;
		text-decoration:none;
		-webkit-tap-highlight-color: transparent;
	}
	a:hover {
		text-decoration:underline;
		text-decoration-style:dashed;
	}
	.tou{
		float:left;
		height:60px;
		width:60px;
		margin-right:8px;
		-webkit-transition: 0.4s;
        -webkit-transition: -webkit-transform 0.4s ease-out;
        transition: transform 0.4s ease-out;
        -moz-transition: -moz-transform 0.4s ease-out;
	}
	.tou:hover{
        -webkit-transform: rotateZ(360deg);
        transform:rotate(360deg);
    }
	.box{
		height: 60px;
		background:repeating-linear-gradient(to left,#FFC0CB,white);
		transition: all 0.25s;/*上浮过程需要的时间*/
		border: 0px solid #C0C0C0;
		font-size: 15px;
		line-height: 1.5;
		margin: 5px;
		border-radius: 0.5em;
		padding: 10px;
		cursor:url('../images/pointer.cur'),pointer;
	}
	@media all and (orientation : landscape){
	.box{
		float:left;
		height: 60px;
		width: 40%;
		background:repeating-linear-gradient(to left,#FFC0CB,white);
		transition: all 0.25s;/*上浮过程需要的时间*/
		border: 0px solid #C0C0C0;
		font-size: 15px;
		line-height: 1.5;
		margin: 5px;
		border-radius: 0.5em;
		padding: 10px;
		cursor:url('../images/pointer.cur'),pointer;
	}}
	.box:hover {
		box-shadow: 0 10px 10px 0 rgba(48, 55, 66, 0.4);/*鼠标悬浮时盒子出现的阴影*/
		transform: translate(0, -2px);/*鼠标悬浮时盒子上移的px*/
		cursor:url('../images/pointer.cur'),pointer;
	}
	.links {
		color:#666666;
		text-decoration:none;
		font-family:sq;
	}
	.links:hover {
		color:#FF69B4;
		text-decoration:none;
		font-family:sq;
	}
	</style>
	<script src='../static/js/jquery-3.7.0.min.js'></script>
	<script src='../static/js/load.js'></script>
</head>
<body>
	<div class="loaderbg">
		<div class="loading"></div>
		<p class="loadp">Loading</p>
	</div>
	<noscript>
		<style>
		.loaderbg {
			display: none;
		}
		</style>
	</noscript>
	<script src="../static/js/yinghua.js"></script>
	<div style="background:rgba(255,255,255,0.6);border:2px dashed #C0C0C0;min-height:50px;font-size:16px;line-height:1.5;margin: 5px auto;border-radius:0.8em;padding:10px;max-width:1000px;">
		<center><h2>支持我们</h2></center>
		<p>十分感谢您打开这个页面。(๑´∀`๑)本页分为两个部分，您可以点击下方书签快速跳转：</p>
		<ul style="color:#606060;font-family:dk;">
			<li><a href="#dt">赞赏萌言</a></li>
			<li><a href="#tk">特别鸣谢</a></li>
		</ul>
		<hr/>
		<center><h2 id="dt">赞赏萌言</h2></center>
		<p>萌言在建设中得到了许多小伙伴的帮助，但本站目前仅由朝尘个人独立开发建设、维护运营，包括服务器、图床、域名、CDN等所有开销全部由个人承担。</p>
		<h2><font color="#FF69B4">#</font> <font color="#606060">前言</font></h2>
		<p>目前本站站长朝尘仍是一个高中在读的学牲党，同时也是二次元和IT的狂热爱好者ヾ(✿ﾟ▽ﾟ)ノ，凭借着热爱发电并用自己的绵薄之力维持着本站的服务。<br>但由于学业繁忙，时间精力还是相对有限，且本站及其子服务目前每年仍需负担400元左右的运行开支，虽然不多但也是朝尘省吃俭用下来的生活费QwQ。<br>因此，我们恳请您如果赞赏萌言，并且仍有余力，请慷慨地给与我们一些帮助，我们将感激不尽！！(இωஇ)<br>但如果你的囊中和朝尘一样并不富裕，请先务必照顾好自己！萌言会收到心意哒，动力Max！<br>♡(*´∀｀*)人(*´∀｀*)♡</p>
		<h2><font color="#FF69B4">#</font> <font color="#606060">帮助我们</font></h2>
		<p>如果您愿意提供<b>金钱帮助</b>，欢迎前往我们的<a href="https://afdian.net/a/moeyun" target="_blank">爱发电主页</a>赞助我们。我们目前接受每月5元/10元的赞助方案，您的每一份赞助都将被用作本站的一砖一瓦，对于您的赞助，我们感激不尽！并且会将您或您的组织的名称或徽标置于鸣谢名单。</p>
		<p>您也可以提供<b>资源帮助</b>。我们需要大量的优质语句和二次元图片以丰富我们的资源库，欢迎您进行投稿。详情请戳这里查看：<a href="submit_y.php" target="_blank">句子投稿</a> / <a href="submit_wp.php" target="_blank">二次元图片投稿</a>。如您通过投稿对本站做出一定数量的贡献，我们会将您或您的组织的名称或徽标置于鸣谢名单。</p>
		<p>您也可以提供<b>硬件资源帮助</b>，例如服务器、CDN、图床等。如果您有意向合作请发送邮件至<a href="mailto:zc@moey.cn">zc@moey.cn</a>，我们会将您或您的组织的名称或徽标置于鸣谢名单。</p>
		<p>您也可以提供<b>流量帮助</b>。相逢即是缘，您可以把我们介绍给您的同好/朋友。如果您是网站开发者，十分欢迎您与我们互链，详情请戳这里查看：<a href="links.php" target="_blank">友情链接</a>。</p>
		<hr/>
		<center><h2 id="tk">特别鸣谢</h2></center>
		<p>感谢如下的个人、团体、开源项目向萌言网直接/间接提供的帮助。</p>
		<h2><font color="#FF69B4">#</font> <font color="#606060">团体</font></h2>
		<p>感谢以下向萌言网提供帮助的团体：</p>
		<?php
		$mu = file_get_contents("../config/thanks_team.txt");
		$you = preg_match_all("/{name:(.*?)}{link:(.*?)}{about:(.*?)}{logo:(.*?)}/",$mu,$v);
		if($you== 0){
		echo "";
		}else{
		for( $i = 0 ; $i < $you && $i < $you ; $i ++ ){
		$name=$v[1][$i];
		$link=$v[2][$i];
		$about=$v[3][$i];
		$tx=$v[4][$i];
		echo '<a href="'.$link.'" class="links" target="_blank"><div class="box"><div class="tou"><img onerror="this.src=\'../images/fail.gif\'" src="'.$tx.'" width="60" height="60" alt="头像被外星人劫走啦" style="border-radius: 50%;"></div><div class="limit"><b style="font-size:1.1rem;">'.$name.'</b></div><div class="limit">'.$about.'</div></div></a>';
		}}?>
		<div style="clear:left;">
			<h2><font color="#FF69B4">#</font> <font color="#606060">个人</font></h2>
			<p>感谢以下向萌言网提供帮助的个人：</p>
		</div>
		<?php
		$mu = file_get_contents("../config/thanks_per.txt");
		$you = preg_match_all("/{name:(.*?)}{link:(.*?)}{about:(.*?)}{logo:(.*?)}/",$mu,$v);
		if($you== 0){
		echo "";
		}else{
		for( $i = 0 ; $i < $you && $i < $you ; $i ++ ){
		$name1=$v[1][$i];
		$link1=$v[2][$i];
		$about1=$v[3][$i];
		$tx1=$v[4][$i];
		echo '<a href="'.$link1.'" class="links" target="_blank"><div class="box"><div class="tou"><img onerror="this.src=\'../images/fail.gif\'" src="'.$tx1.'" width="60" height="60" alt="头像被外星人劫走啦" style="border-radius: 50%;"></div><div class="limit"><b style="font-size:1.1rem;">'.$name1.'</b></div><div class="limit">'.$about1.'</div></div></a>';
		}}?>
		<div style="clear:left;">
			<h2><font color="#FF69B4">#</font> <font color="#606060">开源项目</font></h2>
			<p>感谢Moey直接使用到的部分开源项目（排名不分先后）：</p>
			<p><a href="https://github.com/hitokoto-osc/sentences-bundle" target="_blank">sentences-bundle</a>(一言语句库)</p>
		</div>
	</div>
	<center><p style="animation: shake 1s;animation-iteration-count: infinite;">¯\_(ツ)_/¯</p></center>
	<center><p>萌言勉强运行了<span id="momk"></span></p></center>
	<div id="rin-bg"></div>
	<script src="../static/js/ty.js"></script>
</body>
</html>