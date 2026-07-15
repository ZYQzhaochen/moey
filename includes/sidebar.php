<?php
/**
 * 公共侧栏 + 切换 JS
 * 需要的变量：
 *   $base_path   - 图片路径前缀
 *   $home_url    - 首页链接
 *   $page_prefix - 子页路径前缀
 */
?>
<section class="slide-bar">
    <ul>
        <li class="logo-li"><center><div class="ttf-kat">萌言Moey</div></center></li>
        <li><a href="<?php echo $home_url; ?>" target="_top" class="sa"><img style="width:15px;height:15px" src="<?php echo $base_path; ?>images/home.svg"> 首页</a></li>
        <li><a href="<?php echo $page_prefix; ?>about.php" target="_top" class="sa"><img style="width:15px;height:15px" src="<?php echo $base_path; ?>images/about.svg"> 关于萌言</a></li>
        <li><a href="<?php echo $page_prefix; ?>links.php" target="_top" class="sa"><img style="width:15px;height:15px" src="<?php echo $base_path; ?>images/link.svg"> 友情链接</a></li>
        <li class="sec-title">API接口：</li>
        <li><a href="<?php echo $page_prefix; ?>yapi-help.php" target="_top" class="sa"><img style="width:15px;height:15px" src="<?php echo $base_path; ?>images/yan.svg"> 一言语句</a></li>
        <li><a href="<?php echo $page_prefix; ?>wpapi-help.php" target="_top" class="sa"><img style="width:15px;height:15px" src="<?php echo $base_path; ?>images/wp.svg"> 二次元图片</a></li>
        <li class="sec-title">投稿：</li>
        <li><a href="<?php echo $page_prefix; ?>submit_y.php" target="_top" class="sa"><img style="width:15px;height:15px" src="<?php echo $base_path; ?>images/submit.svg"> 一言语句</a></li>
        <li><a href="<?php echo $page_prefix; ?>submit_wp.php" target="_top" class="sa"><img style="width:15px;height:15px" src="<?php echo $base_path; ?>images/submit.svg"> 二次元图片</a></li>
        <li class="sec-title">More：</li>
        <li><a href="<?php echo $page_prefix; ?>chat.php" target="_top" class="sa"><img style="width:15px;height:15px" src="<?php echo $base_path; ?>images/chat.svg"> 留言板</a></li>
        <li><a href="<?php echo $page_prefix; ?>support.php" target="_top" class="sa"><img style="width:15px;height:15px" src="<?php echo $base_path; ?>images/donate.svg"> 支持我们</a></li>
        <li><a href="<?php echo $page_prefix; ?>infringment.php" target="_top" class="sa"><img style="width:15px;height:15px" src="<?php echo $base_path; ?>images/su.svg"> 侵权申诉</a></li>
        <li><a href="<?php echo $page_prefix; ?>open.php" target="_top" class="sa"><img style="width:15px;height:15px" src="<?php echo $base_path; ?>images/ky.svg"> 开源</a></li>
        <li><a href="https://www.travellings.cn/go.html" target="_blank" rel="noopener" title="开往-友链接力" class="sa"><img style="width:15px;height:15px" src="<?php echo $base_path; ?>images/tl.svg"> 「开往」</a></li>
    </ul>
</section>
<script>
    document.addEventListener("DOMContentLoaded", function(){
        (function(){
            var _btn  = document.querySelector(".btn-slide-bar"),
                _body = document.querySelector("body");
                _btn.onclick = function(){
                    _body.classList.toggle("active");
                }
        })(window)
    },false);
</script>
