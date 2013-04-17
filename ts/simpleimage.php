<?
require_once "debug.php";
class SimpleImage {
    var $image;
    var $image_type;
    
    function load($filename) { // image_info
        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2]; // type
        
        if($this->image_type == '2') { // jpeg
            $this->image = imagecreatefromjpeg($filename);
            $this->ext = ".jpg";
        } else if($this->image_type == '1') { // gif
            $this->image = imagecreatefromgif($filename);
            $this->ext = ".gif";
        } else if($this->image_type == '3') { // png
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

    function crop($thumb_width, $thumb_height) {
        $width = $this->getWidth();
        $height = $this->getHeight();

        $thumb = imagecreatetruecolor($thumb_width, $thumb_height);
        imagecopyresampled($thumb, $this->image, 0, 0, 0, 0, $width, $height, $width, $height);
        $this->image = $thumb;
    }
   
    function output($image_type = 2) { // image
        if($image_type == '2') { // jpeg
            imagejpeg($this->image);
        } else if($this->image_type == '1') { // gif
            imagegif($this->image);
        } else if($this->image_type == '3') { // png
            imagepng($this->image);
        }
    }
    
    function save($filename, $image_type=2, $compression=80, $permissions=null) {
        if($image_type == '2') { // jpeg
            imagejpeg($this->image, $filename, $compression);
        } else if($this->image_type == '1') { // gif
            imagegif($this->image, $filename);
        } else if($this->image_type == '3') { // png
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
* $image->crop($width, $height);
* $image->save($name.$this->ext);
*/
?>
