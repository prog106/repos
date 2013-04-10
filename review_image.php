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
    <form id="form1" runat="server">
        <input type='file' onchange="readURL(this);" />
        <img id="review" src="#" alt="your image" />
    </form>
</body>