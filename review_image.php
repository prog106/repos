<?
if($_POST) {
    print_r($_POST);
    print_r($_FILE);
    die;
}
if(isset($_POST['submit']) && isset($_POST['widthsize'])) {
    require_once "simpleimage.php";
    $image = new SimpleImage();
    $image->load($_FILES['uploaded_image']['tmp_name']);
    $image->resizeToWidth($_POST['widthsize']);
    $name = ($_POST['name'])? $_POST['name'] : time() ;
    $image->save("./img/".$name.$image->ext);
    header("Location:./img/".$name.$image->ext);
}
?>
<!-- view image before image upload -->
<script src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#review').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<body>
    review image <br>
    <form id="form1" runat="server">
        <input type='file' onchange="readURL(this);" />
        <img id="review" src="#" alt="your image" />
    </form>
    <br><br>
    ajax file upload <br>
    <form>
    <input type="file" id="file" name="file" size="10"/>
    <input id="uploadbutton" type="button" value="Upload"/>
    </form>
    <script>
        $(document).ready(function () {
            $("#uploadbutton").click(function () {
                var filename = $("#file").val();
                $.ajax({
                    type: "POST",
                    url: "review_image.php",
                    enctype: 'multipart/form-data',
                    data: {
                        file: filename
                    },
                    success: function () {
                        alert("Data Uploaded: ");
                    }
                });
            });
        });
    </script>
</body>