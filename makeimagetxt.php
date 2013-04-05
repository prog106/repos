<?
$fontsize = 12;
$font = "./font/arial.ttf";
$text = "4567";

$size = imagettfbbox($fontsize, 0, $font, $text);
$xsize = abs($size[0]) + abs($size[2]) + 20;
$ysize = abs($size[5]) + abs($size[1]) + 20;

$image = imagecreate($xsize, $ysize);

$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);
imagefilledrectangle($image, 0, 0, $xsize, $ysize, $white);

imagettftext($image, $font, 0, 20, $fsize+20, $black, $font, $text);
imagejpeg($image, "./img/".$text.".jpg", 85);

die;

$text = "1234";
$font = "./font/arial.ttf";

imagettftext($im, 36, 0, 0, 35, $color, $font, $text);
imagepng($im, "./img/".$text.".png", 100);

//imagedestroy($im);
die;
// make png image from text
class makePng {
/*
* 1. text check
* 2. image info check
* 3. make png image
* 4. save png image
* 5. return png image url
*/
    function check_text($txt) {
    // 
        return true;
    }

    function image_info($param) {
        return true;
    }
    
    
}

$param['text'] = "";

makepngimage($param);
?>
