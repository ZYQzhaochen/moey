<?php
$base_path = '../';
$home_url = '../';
$page_prefix = '';
$page_title = '二次元图片投稿 | 萌言Moey';
$page_heading = '二次元图片投稿';
$page_keywords = '萌言,萌言网,moey,图片投稿,api,萌云网络';
$page_description = '欢迎投稿二次元壁纸/插画/图片。目前仅支持邮件投稿，投稿成功后将在人工审核后上线！';
require '../includes/init.php';
require '../includes/head.php';
?>
<body>
<?php require '../includes/header.php'; ?>
<section class="wraper-page">
<script src="../static/js/yinghua.js"></script>
<div style="background:rgba(255,255,255,0.6);border:2px dashed #C0C0C0;min-height:50px;font-size:16px;line-height:1.5;margin: 5px auto;border-radius:0.8em;padding:10px;max-width:1000px;">
    <div class="bt"><font color="#FF69B4">#</font> 欢迎</div>
    <p>欢迎您进行二次元图片投稿～<br>很抱歉，目前图片在线投稿功能正在夜以继日开发中，目前仅支持邮件投稿（ΩДΩ）<br></p>
    <div class="bt"><font color="#FF69B4">#</font> 投稿</div>
    <p>请您将您喜欢的二次元图片发送原图至<a href="mailto:zc@moey.cn">zc@moey.cn</a>。看到后我们将在第一时间进行人工审核回复！<br>另外请注意保留图片上的作者信息及版权信息（如果有的话）。<br>最后感谢您为Moey做贡献！</p>
    <p>萌言因你更美好！＼＼\\٩( 'ω' )و //／／</p>
    <hr style="height:2px;border:none;border-top:2px dotted #FF69B4;" />
    <div class="bt"><font color="#FF69B4">#</font> 注意</div>
    <p>调用本站服务或在本站进行投稿，代表您已仔细阅读并同意<a href="tiaokuan.html">使用条款</a>。</p>
</div>
<center><p style="animation: shake 1s;animation-iteration-count: infinite;">¯\_(ツ)_/¯</p></center>
<center><p>萌言勉强运行了<span id="momk"></span></p></center>
<div id="rin-bg"></div>
<script src="../static/js/ty.js"></script>
</section>
<?php require '../includes/footer.php'; ?>
<?php require '../includes/sidebar.php'; ?>
</body>
</html>
