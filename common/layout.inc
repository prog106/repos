<?
require_once "script.inc";
function head($title='couponeda') {
    $v = time();
?>
<!DOCTYPE html>
<html lang="kr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title><?=$title?></title>
<link href="css/layout.css?v=<?=$v?>" rel="stylesheet" type="text/css" charset="utf-8"/>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" charset="utf-8"/>
<script src="js/layout.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/jquery.uploadify.min.js"></script>
<script src="js/jquery.countdown.js"></script>
</head>
<body>
<?
}

function footer() {
?>
</body>
</html>
<?
}
?>
