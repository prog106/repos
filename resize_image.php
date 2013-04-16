<!DOCTYPE html>
<html lang="utf8">
<?
if(isset($_POST['submit'])) {
    require_once "simpleimage.php";
    $image = new SimpleImage();
    $image->load($_FILES['uploaded_image']['tmp_name']);
    $name = ($_POST['name'])? : time() ;
    $image->crop('100', '100');
    //$image->resizeToWidth($_POST['widthsize']);
    $image->save("./img/".$name.$image->ext);
    header("Location:./img/".$name.$image->ext);
} else {
?>
image resize<br>
<form action="resize_image.php" method=post enctype="multipart/form-data">
    image (only jpg image) : <input type="file" name="uploaded_image" /><br>
    image resize width(px) : <input type="text" name="widthsize" /><br>
    image name(only english & number) : <input type="text" name="name" /><br>
    <input type="submit" name="submit" value="upload" />
<form>
<?
}
?>
