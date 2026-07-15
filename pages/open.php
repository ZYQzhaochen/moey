<?php
$base_path = '../';
$home_url = '../';
$page_prefix = '';
$page_title = '开源 | 萌言Moey';
$page_heading = '人人为我，我为人人';
$page_keywords = '萌言,萌言网,moey,开源,github,AGPL,MIT';
$page_description = '萌言网开源页面。本站除敏感部分源码外均开源，API及语句库采用AGPL-3.0协议，其它采用MIT协议。';
require '../includes/init.php';
require '../includes/head.php';
?>
<body>
<?php require '../includes/header.php'; ?>
<section class="wraper-page">
<script src="../static/js/yinghua.js"></script>
<div style="background:rgba(255,255,255,0.6);border:2px dashed #C0C0C0;min-height:50px;font-size:16px;line-height:1.5;margin: 5px auto;border-radius:0.8em;padding:10px;max-width:1000px;">
    <div class="bt"><font color="#FF69B4">#</font> 开源地址</div>
    <p><img style="width:15px;height:15px" src="../images/github.png"> Moey的github主页：<a href="https://github.com/ZYQzhaochen/moey" target="_blank">https://github.com/ZYQzhaochen/moey</a></p>
    <div class="bt"><font color="#FF69B4">#</font> 开源情况</div>
    <p>除了后台不便暴露的接口/页面等敏感部分，其他全部开源。敏感部分在版本迭代后，旧版本将开源。</p>
    <div class="bt"><font color="#FF69B4">#</font> 开源协议</div>
    <p>API及语句库采用AGPL-3.0协议(语句库需要遵循AGPL协议为第三方开源项目的要求)，其它采用MIT协议。</p>
    <div class="bt"><font color="#FF69B4">#</font> 注意</div>
    <p>本项目代码开源不代表您可以随意使用本站包括语句和图片在内的网络资源以及图标。站内资源严禁商用。本站图标版权归中山市域方网络科技有限公司所有，本站拥有图标使用权，点此<a href="../images/sqed.png" target="_blank">查看详情</a>。本站图标严禁盗用、修改、转载。</p>
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
