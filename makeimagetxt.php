<?
$im = imagecreatetruecolor(130, 36);

$white = imagecolorallocate($im, 255, 255, 255);
$color = imagecolorallocate($im, 204, 210, 228);
$black = imagecolorallocate($im, 0, 0, 0);
imagefilledrectangle($im, 0, 0, 129, 35, $white);

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
