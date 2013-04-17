<?
require_once "script.inc";
function head($title='couponeda') {
    $v = time();
?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title><?=$title?></title>
<link href="css/layout.css?v=<?=$v?>" rel="stylesheet" type="text/css" charset="utf-8"/>
<script src="js/layout.js"></script>
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
