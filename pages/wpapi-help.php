<?php
$base_path = '../';
$home_url = '../';
$page_prefix = '';
$page_title = '二次元图片接口使用文档 | 萌言Moey';
$page_heading = '二次元图片接口使用说明';
$page_keywords = '萌言,萌言网,萌云,api,moey,二次元图片,接口';
$page_description = '萌言Moey是一个创立于2023年的非盈利公益性项目，致力于提供稳定、免费的接口服务。此页面为二次元图片接口使用文档。';
$extra_head_html = '<style>
tr {color:#606060;}
td {text-align:left;}
th {text-align:center;}
</style>
<script src=\'../static/js/jquery-3.7.0.min.js\'></script>
<script src=\'../static/js/table-stripe.js\'></script>';
require '../includes/init.php';
require '../includes/head.php';
?>
<body>
<?php require '../includes/header.php'; ?>
<section class="wraper-page">
<script src="../static/js/yinghua.js"></script>
<script src="../static/js/ty.js"></script>
<div style="background:rgba(255,255,255,0.6);border:2px dashed #C0C0C0;min-height:50px;font-size:16px;line-height:1.5;margin: 5px auto;border-radius:0.8em;padding:10px;max-width:1000px;">
    <div class="bt"><font color="#FF69B4">#</font> 注意</div>
    <p>调用本站服务或在本站进行投稿，代表您已仔细阅读并同意<a href="tiaokuan.html">使用条款</a>。<br>本接口二次元图片资源均来源于网络，如果侵害了您的权益，请点击这里<a href="infringment.php" target="_blank">侵权申诉</a>。</p>
    <hr style="height:2px;border:none;border-top:2px dotted #FF69B4;" />
    <div class="bt"><font color="#FF69B4">#</font> 请求地址</div>
    <div style="background-color:rgba(255,255,255);color: #606060;padding:14px;border-left: 6px solid;border-color:rgba(100,149,237);word-wrap:break-word;">
        <b>请求地址：</b>https://<?php echo filter_input(INPUT_SERVER, "SERVER_NAME"); ?>/pic/<br>
        <b>访问协议：</b>HTTPS<br>
        <b>请求方式：</b>GET<br>
        <b>请求示例：</b>https://<?php echo filter_input(INPUT_SERVER, "SERVER_NAME"); ?>/pic/?type=img&form=auto
    </div>
    <div class="bt"><font color="#FF69B4">#</font> 请求参数</div>
    <table id="tab" align="center" border="1" width="100%" style="border-collapse:collapse;border-color:rgba(220,220,220)">
        <thead><tr><th>参数名称</th><th>参数值</th><th>参数说明</th><th>参数类型</th></tr></thead>
        <tbody>
            <tr><td>type</td><td>img(图片)<br>json(json)<br>text(图片链接)</td><td>返回输出类型，不填默认为img</td><td>可选</td></tr>
            <tr><td>form</td><td>auto(自适应)<br>level(横屏图片)<br>vertical(竖屏图片)</td><td>图片类型，不填默认为auto</td><td>可选</td></tr>
        </tbody>
    </table>
    <div class="bt"><font color="#FF69B4">#</font> 返回参数（json格式时）</div>
    <table id="tab" align="center" border="1" width="100%" style="border-collapse:collapse;border-color:rgba(220,220,220);">
        <thead><tr><th>参数名称</th><th>参数说明</th></tr></thead>
        <tbody>
            <tr><td>code</td><td>状态码(值为200时成功)</td></tr>
            <tr><td>id</td><td>图片ID序号</td></tr>
            <tr><td>link</td><td>图片文件直链</td></tr>
            <tr><td>form</td><td>图片类型(值为level或vertical)</td></tr>
        </tbody>
    </table>
    <div class="bt"><font color="#FF69B4">#</font> <font color="#606060">返回示例</font></div>
    <div style="background-color:rgba(255,255,255);padding:14px;border-left:6px solid;border-color:rgba(255,0,0);">
        <div style="word-wrap:break-word;">
        <?php
        $s = file_get_contents("http://".$_SERVER['HTTP_HOST']."/pic/index.php?type=json&form=level");
        echo $s;
        ?>
        </div>
    </div>
    <font color="#606060">上方显示的是type值为json、form值为level时的输出结果</font>
    <div style="background-color:rgba(255,255,255);padding:5px;border-left:6px solid;border-color:rgba(255,0,0);">
    <center><iframe src="../pic/index.php" style="width:98%;height:180px;background:white"></iframe></center>
    </div>
    <font color="#606060">上方显示的是type值为img、form值为auto时的输出结果，您也可以<a href="../pic/index.php" target="_blank">戳这里</a>查看实际效果</font>
</div>
<center><p style="animation: shake 1s;animation-iteration-count: infinite;">¯\_(ツ)_/¯</p></center>
<center><p>萌言勉强运行了<span id="momk"></span></p></center>
<div id="rin-bg"></div>
</section>
<?php require '../includes/footer.php'; ?>
<?php require '../includes/sidebar.php'; ?>
</body>
</html>
