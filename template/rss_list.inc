<?
require_once "model/rss.inc";

$totalcnt = RSS::rsscount();
$viewpage = ($_GET['page'])? : 1;
$countPerPage = 20;
$result = RSS::rsslist(($viewpage * $countPerPage) + 1, $countPerPage);
$page = Util::paging($viewpage, $totalcnt, $countPerPage, '10');
foreach($result as $row) {
?>
<img src="<?=$row['d_img1'];?>">
<img src="<?=$row['d_img2'];?>">
<img src="<?=$row['d_img3'];?>">
<?=$row['d_no'];?> : <?=$row['d_name'];?> : <?=$row['d_desc1'];?> : <?=$row['d_desc2'];?><br>
<?
}
echo Util::paging_view($page);
?>
