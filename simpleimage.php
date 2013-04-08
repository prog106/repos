<!DOCTYPE html>
<html lang="utf8">
<?
require_once "debug.php";
class SimpleImage {
    var $image;
    var $image_type;
    
    function load($filename) { // image_info
        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2]; // type
        //if($this->image_type == 'IMAGETYPE_JPEG') { // jpeg
        if($this->image_type == '2') { // jpeg
            $this->image = imagecreatefromjpeg($filename);
            $this->ext = ".jpg";
        } else if($this->image_type == 'IMAGETYPE_GIF') { // gif
            $this->image = imagecreatefromgif($filename);
            $this->ext = ".gif";
        } else if($this->image_type == 'IMAGETYPE_PNG') { // png
            $this->image = imagecreatefrompng($filename);
            $this->ext = ".png";
        } else { // etc
            $this->image = 'error';
            $this->ext = '.error';
        }
    }
    
    function getWidth() { // width
        return imagesx($this->image);
    }
    
    function getHeight() { // height
        return imagesy($this->image);
    }
    
    function resizeToWidth($width) { // width size image size (x,y)
        $ratio = $width / $this->getWidth();
        $height = $this->getHeight() * $ratio;
        $this->resize($width, $height);
    }
    
    function resizeToHeight($height) { // height size image size (x,y)
        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);
    }
    
    function resize($width, $height) { // image size (x,y)
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;
    }

    function scale($scale) { // %로 image size (x,y)
        $ratio = $scale / 100;
        $this->resize($this->getWidth() * $ratio, $this->getHeight * $ratio);
    }
    
    function output($image_type = IMAGETYPE_JPEG) { // image
        if($image_type == 'IMAGETYPE_JPEG') { // jpeg
            imagejpeg($this->image);
        } else if($this->image_type == 'IMAGETYPE_GIF') { // gif
            imagegif($this->image);
        } else if($this->image_type == 'IMAGETYPE_PNG') { // png
            imagepng($this->image);
        }
    }
    
    function save($filename, $image_type = 'IMAGETYPE_JPEG', $compression=75, $permissions=null) {
        if($image_type == 'IMAGETYPE_JPEG') { // jpeg
            imagejpeg($this->image, $filename, $compression);
        } else if($this->image_type == 'IMAGETYPE_GIF') { // gif
            imagegif($this->image, $filename);
        } else if($this->image_type == 'IMAGETYPE_PNG') { // png
            imagepng($this->image, $filename);
        }
        if($permissions != null) {
            chmod($filename, $permissions);
        }
    }
}
/*
* $image = new SimpleImage();
* $image->load($_FILES['uploaded_image']['tmp_name']);
* $image->resize($width, $height);
* $image->resizeToWidth($width);
* $image->scale($percent);
* $name = $_POST['name']; or time();
* $image->save($name.$this->ext);
*/
?>

<?
if(isset($_POST['submit']) && isset($_POST['widthsize'])) {
    $image = new SimpleImage();
    $image->load($_FILES['uploaded_image']['tmp_name']);
    $image->resizeToWidth($_POST['widthsize']);
    $name = ($_POST['name'])? $_POST['name'] : time() ;
    $image->save("./img/".$name.$image->ext);
    header("Location:./img/".$name.$image->ext);
} else {
?>
image resize<br>
<form action="simpleimage.php" method=post enctype="multipart/form-data">
    image (only jpg image) : <input type="file" name="uploaded_image" /><br>
    image resize width(px) : <input type="text" name="widthsize" /><br>
    image name(only english & number) : <input type="text" name="name" /><br>
    <input type="submit" name="submit" value="upload" />
<form>
<?
}
?>
