<?php
$base_path = '../';
$home_url = '../';
$page_prefix = '';
$page_title = '语句接口使用文档 | 萌言Moey';
$page_heading = '语句接口使用说明';
$page_keywords = '萌言,萌言网,一言,一言网,萌云网络,一言api,moey,hitokoto,一言接口';
$page_description = '萌言Moey是一个创立于2023年的非盈利公益性项目，致力于提供稳定、免费的接口服务。此页面为萌言网一言接口使用文档。';
$extra_head_html = '<style>
tr {color:#606060;}
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
<div style="background:rgba(255,255,255,0.6);border:2px dashed #C0C0C0;min-height:50px;font-size:16px;line-height:1.5;margin: 5px auto;border-radius:0.8em;padding:10px;max-width:1000px;">
    <div class="bt"><font color="#FF69B4">#</font> 注意</div>
    <p>调用本站服务或在本站进行投稿，代表您已仔细阅读并同意<a href="tiaokuan.html">使用条款</a>。</p>
    <hr style="height:2px;border:none;border-top:2px dotted #FF69B4;" />
    <div class="bt"><font color="#FF69B4">#</font> 请求地址</div>
    <div style="background-color:rgba(255,255,255);color:#606060;padding:14px;border-left: 6px solid;border-color:rgba(100,149,237);word-wrap:break-word;">
        <b>请求地址：</b>https://<?php echo filter_input(INPUT_SERVER, "SERVER_NAME"); ?>/yan/<br>
        <b>访问协议：</b>HTTPS<br>
        <b>请求方式：</b>GET<br>
        <b>请求示例：</b>https://<?php echo filter_input(INPUT_SERVER, "SERVER_NAME"); ?>/yan/?type=json&form=all<br>
        <b>收录语句：</b><i><?php $s=file_get_contents("../config/id.dat");echo $s;?></i> 条
    </div>
    <div class="bt"><font color="#FF69B4">#</font> 请求参数</div>
    <table id="tab" align="center" border="1" width="100%" style="border-collapse:collapse;border-color:rgba(220,220,220);">
        <thead>
            <tr>
                <th>参数名称</th>
                <th>参数值</th>
                <th>参数说明</th>
                <th>参数类型</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>type</td>
                <td>text<br>json</td>
                <td>返回输出类型，不填默认为text(只返回正文和出处来源)</td>
                <td>可选</td>
            </tr>
            <tr>
                <td>form</td>
                <td>请见下方"句子类型"表单</td>
                <td>句子类型，不填默认为all(全部类型)；支持多类型组合，如 <b>a,c,f</b> 表示在动画+游戏+网络中随机抽取</td>
                <td>可选</td>
            </tr>
        </tbody>
    </table>
    <div style="background-color:rgba(255,255,255);color:#606060;padding:5px;border-left: 6px solid;border-color:rgba(144,238,144);">
        <b>备注：</b>有关"form"参数的提交参数值的详细说明烦请见下文"句子类型"<br>
    </div>
    <div class="bt"><font color="#FF69B4">#</font> 句子类型</div>
    <table id="tab" align="center" border="1" width="100%" style="border-collapse:collapse;border-color:rgba(220,220,220);">
        <thead>
            <tr>
                <th>参数值</th>
                <th>说明</th>
            </tr>
        </thead>
        <tbody style="text-align:center;">
            <tr><td>all</td><td>以下全部类型</td></tr>
            <tr><td>a</td><td>动画</td></tr>
            <tr><td>b</td><td>漫画</td></tr>
            <tr><td>c</td><td>游戏</td></tr>
            <tr><td>d</td><td>文学</td></tr>
            <tr><td>e</td><td>原创</td></tr>
            <tr><td>f</td><td>来自网络</td></tr>
            <tr><td>g</td><td>影视音乐</td></tr>
            <tr><td>h</td><td>诗词</td></tr>
            <tr><td>i</td><td>哲学</td></tr>
            <tr><td>j</td><td>其他</td></tr>
        </tbody>
    </table>
    <div style="background-color:rgba(255,255,255);color:#606060;padding:5px;border-left: 6px solid;border-color:rgba(144,238,144);"><b>备注：</b>form 支持用逗号 <b>,</b> 连接多个类型值实现多类型随机抽取，如 <b>a,c,f</b> 表示在动画、游戏、网络中随机。各类型句子的被抽取概率为全部所选类型中的等概率。</div>
    <div class="bt"><font color="#FF69B4">#</font> 返回参数（json格式时）</div>
    <table id="tab" align="center" border="1" width="100%" style="border-collapse:collapse;border-color:rgba(220,220,220);">
        <thead>
            <tr>
                <th>参数名称</th>
                <th>参数说明</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>code</td><td>状态码(值为200时成功)</td></tr>
            <tr><td>id</td><td>句子ID序号</td></tr>
            <tr><td>text</td><td>正文</td></tr>
            <tr><td>form</td><td>句子类型</td></tr>
            <tr><td>from</td><td>句子出处</td></tr>
            <tr><td>from_who</td><td>句子作者(该参数可能返回null，注意替换，建议优先使用from)</td></tr>
            <tr><td>creator</td><td>提交者</td></tr>
            <tr><td>created_at</td><td>提交时间(时间戳)</td></tr>
            <tr><td>length</td><td>句子长度</td></tr>
        </tbody>
    </table>
    <div class="bt"><font color="#FF69B4">#</font> 返回示例</div>
    <div style="background-color:rgba(255,255,255);padding:14px;border-left:6px solid;border-color:rgba(255,0,0);">
        <div style="word-wrap:break-word;"><?php
        $s=file_get_contents("http://".$_SERVER['HTTP_HOST']."/yan/index.php?type=json&form=a");
        echo $s;
        ?></div>
    </div>
    <font color="#606060">上方显示的是type值为json、form值为a时的输出结果</font>
    <div style="background-color:rgba(255,255,255);padding:14px;border-left:6px solid;border-color:rgba(255,0,0);">
        <div style="word-wrap:break-word;"><?php
        $s1=file_get_contents("http://".$_SERVER['HTTP_HOST']."/yan/index.php?type=text&form=all");
        echo $s1;
        ?></div>
    </div>
    <font color="#606060">上方显示的是type值为text、form值为all时的输出结果</font>
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
