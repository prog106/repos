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
    ajax file upload : fail<br>
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
                    success: function (result) {
                        alert("Data Uploaded: " + result);
                    }
                });
            });
        });
    </script>
</body>
