﻿<?
// make jpeg image from text
class makeJpeg {
    
    //static $font = "./font/NanumGothic.ttf";
    static $font = "./font/arial.ttf";
    
    function param_check($param) {
        $param_array = array(fontsize, bgcolor, color, width, height, text);
        foreach($param_array as $row) {
            if(!$param[$row]) {
                return false;
                break;
            }
        }
        return true;
    }
    
    function makeimagejpeg($param) {
        if(!param_check($param)) {
            $msg = "params error : fontsize, bgcolor, color[white, black], width, height, text";
            json_encode($msg);
            die;
        }
        $image = imagecreate($param['width'], $param['height']);
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);
        imagefilledrectangle($image, 0, 0, $param['width'], $param['height'], $$param['bgcolor']); // make angle

        imagettftext($image, $param['fontsize'], 0, 0, 0, $$param['color'], $font, $param['text']); // make text
        $imgsrc = "./img/".$param['text'].".jpg";
        imagejpeg($image, $imgsrc, 85);
        return $imgsrc;
    }

}
$param['fontsize'] = 12px;
$param['bgcolor'] = "white";
$param['color'] = "black";
$param['width'] = "100";
$param['height'] = "30";
$param['text'] = "welcome";
echo makeJpeg::makeimagejpeg($param);
die;

makepngimage($param);

die;
$fontsize = 12;
$font = "./font/arial.ttf";
$text = "4567";

$size = imagettfbbox($fontsize, 0, $font, $text);
$xsize = abs($size[0]) + abs($size[2]) + 20;
$ysize = abs($size[5]) + abs($size[1]) + 20;

$image = imagecreate($xsize, $ysize);

$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);
imagefilledrectangle($image, 0, 0, $xsize, $ysize, $white);

imagettftext($image, $fontsize, 0, 20, $fontsize+20, $black, $font, $text);
imagejpeg($image, "./img/".$text.".jpg", 85);

die;
?>
