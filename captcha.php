<?php
session_start();

// 生成随机验证码（排除易混淆字符）
$chars = 'ABCDEFGHJKMNPQRSTUVWXYZ23456789';
$code = '';
for ($i = 0; $i < 4; $i++) {
    $code .= $chars[mt_rand(0, strlen($chars) - 1)];
}
$_SESSION['captcha_code'] = $code;

// 创建图片
$w = 110; $h = 36;
$img = imagecreatetruecolor($w, $h);
$bg  = imagecolorallocate($img, 255, 255, 255);
imagefilledrectangle($img, 0, 0, $w, $h, $bg);

// 跨平台字体检测
$fonts = array(
    'C:/Windows/Fonts/arial.ttf',
    '/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf',
    '/usr/share/fonts/truetype/liberation/LiberationSans-Regular.ttf',
    '/usr/share/fonts/truetype/freefont/FreeSans.ttf',
    '/usr/share/fonts/truetype/ubuntu/Ubuntu-R.ttf',
);
$font = '';
foreach ($fonts as $f) { if (file_exists($f)) { $font = $f; break; } }

// 绘制字符
$useTTF = ($font !== '');
for ($i = 0; $i < 4; $i++) {
    $color = imagecolorallocate($img, mt_rand(0,60), mt_rand(0,100), mt_rand(150,220));
    if ($useTTF) {
        $angle = mt_rand(-25, 25);
        imagettftext($img, 18, $angle, 12 + $i * 24, 28, $color, $font, $code[$i]);
    } else {
        $x = 8 + $i * 25 + mt_rand(-2, 2);
        $y = mt_rand(8, 14);
        imagestring($img, 5, $x, $y, $code[$i], $color);
    }
}

// 干扰线
for ($i = 0; $i < 4; $i++) {
    $color = imagecolorallocate($img, mt_rand(160,210), mt_rand(160,210), mt_rand(160,210));
    imageline($img, mt_rand(0,20), mt_rand(0,$h), mt_rand(70,$w), mt_rand(0,$h), $color);
}

// 噪点
for ($i = 0; $i < 90; $i++) {
    $color = imagecolorallocate($img, mt_rand(160,230), mt_rand(160,230), mt_rand(160,230));
    imagesetpixel($img, mt_rand(0,$w), mt_rand(0,$h), $color);
}

header('Content-Type: image/png');
header('Cache-Control: no-store, no-cache, must-revalidate');
imagepng($img);
imagedestroy($img);
