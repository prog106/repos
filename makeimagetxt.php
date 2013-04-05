<?
// make jpeg image from text
function makeimagejpeg($type, $param) {
    $now = time();
    $image = imagecreate($param['width'], $param['height']);
    $white = imagecolorallocate($image, 255, 255, 255); // white color rgb
    $black = imagecolorallocate($image, 0, 0, 0); // black color rgb
    imagefilledrectangle($image, 0, 0, $param['width'], $param['height'], $$param['bgcolor']); // make background

    imagettftext($image, $param['fontsize'], 0, 10, $param['fontsize'] + 10, $$param['color'], $param['font'], $param['text']); // make text
    // imagettftext : image, fontsize, angle(0~90), x position, y position, color, font, text
    if($type == 'png') {
        $imgsrc = "./img/".$param['text']."_".$now.".png";
        imagepng($image, $imgsrc, 85);
    } else {
        $imgsrc = "./img/".$param['text']."_".$now.".jpg";
        imagejpeg($image, $imgsrc, 85);
    }
    return $imgsrc;
}

$param['font'] = "./font/arial.ttf";
$param['fontsize'] = "10";
$param['bgcolor'] = "white";
$param['color'] = "black";
$param['width'] = "100";
$param['height'] = "30";
$param['text'] = "welcome";
$type = ($_GET['type'])?:'jpeg';
echo makeimagejpeg($type, $param); 
?>
