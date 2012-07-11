<?php

/**
 * Micoolcoder
 *
 * An open source application development framework for PHP 5.2.1 or newer
 *
 * @package	    sadecode	 
 * @author	    micool	
 * @copyright	    micool.cn
 * @license	    http://app.micool.cn/php/guide/license.html
 * @link	    http://app.micool.cn/php
 * @filesource    ValidationCode.class.php
 * *********************************************************************************
 */
function Gen_Point($x1, $y1, $x2, $y2, $interval) {
    $w = 3;
    $arrPoint = array();
    $arrPoint[0] = $x1;
    $arrPoint[1] = $y1;
    $k = 0;
    $len = $x2 - $x1;
    for ($i = $interval; $i < $len; $i+=$interval) {
        $t = ($x2 - $x1 - $i) / (-$i);
        $arrPoint[2 + $k * 2] = $x1 + $i;
        $arrPoint[2 + $k * 2 + 1] = ($t * $y1 - $y2) / ($t - 1) + rand(1, $w);
        $k++;
    }
    return $arrPoint;
}

function SineDeform($srcIM, $bXDir, $dMultValue, $dPhase) {

    $width = imagesx($srcIM);
    $height = imagesy($srcIM);
    $destIM = $srcIM;
    $destIM = imagecreate($width, $height);
    $white = ImageColorAllocate($destIM, 255, 255, 255);
    imagefill($destIM, 0, 0, $white);
    $dBaseAxisLen = $bXDir ? $height : $width;
    $PI2 = 6.283185307179586476925286766559;
    $PI = 3.14;
    for ($i = 0; $i < $width; $i++) {
        for ($j = 0; $j < $height; $j++) {
            $dx = 0;
            $dx = $bXDir ? (double) ($PI2 * $j) / $dBaseAxisLen : (double) ($PI2 * $i) / $dBaseAxisLen;
            $dx += $dPhase;
            $dy = Sin($dx);

            $nOldX = 0;
            $nOldY = 0;
            $nOldX = $bXDir ? $i + (int) ($dy * $dMultValue) : $i;
            $nOldY = $bXDir ? $j : $j + (int) ($dy * $dMultValue);

            $color = imagecolorat($srcIM, $i, $j);
            if ($nOldX >= 0 && $nOldX < $width
                    && $nOldY >= 0 && $nOldY < $height) {
                imagesetpixel($destIM, $nOldX, $nOldY, $color);
            }
        }
    }

    imagecopy($srcIM, $destIM, 0, 0, 0, 0, $width, $height);
    imagedestroy($destIM);
}

Header("Content-type:image/png");
session_start();
$authnum_session = '';
$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$l = strlen($str);

for ($i = 1; $i <= 4; $i++) {
    $num = rand(0, $l - 1);
    $authnum_session.= $str[$num];
}
session_register("login_check_number");
$_SESSION["login_check_number"] = strtolower($authnum_session);


srand((double) microtime() * 1000000);
$img_height = 120;
$img_width = 40;
$im = imagecreate($img_height, $img_width);

$black = ImageColorAllocate($im, 0, 0, 0);
$white = ImageColorAllocate($im, 255, 255, 255);
$gray = ImageColorAllocate($im, 200, 200, 200);

imagefill($im, 0, 0, $black);
$font = "arial.ttf";
for ($i = 0; $i < strlen($authnum_session); $i++) {
    @imagettftext($im, 15.0, 0.0, $i * $img_height / 4 + 5, mt_rand(18, 18 + $img_width / 3), $white, $font, $authnum_session[$i]);
}

SineDeform($im, TRUE, 3, 2);

for ($i = 0; $i < 3; $i++) {
    $x1 = rand(0, 80);
    $y1 = rand(0, 21);
    $x2 = rand(80, 119);
    $y2 = rand(0, 40);

    $arrPoint = Gen_Point($x1, $y1, $x2, $y2, 5);
    if (count($arrPoint) / 2 >= 3) {
        imagefilledpolygon($im, $arrPoint, count($arrPoint) / 2, $gray);
    }
}


for ($i = 0; $i < 90; $i++) {
    imagesetpixel($im, rand() % 140, rand() % 35, $gray);
}
ImageRectangle($im, 0, 0, $img_height - 1, $img_width - 1, $black);
ImagePNG($im);
ImageDestroy($im);
?> 