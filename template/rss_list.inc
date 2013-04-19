<?
require_once "model/rss.inc";

$result = RSS::rsslist();

foreach($result as $row) {
?>
<?=$row['d_no'];?> : <?=$row['d_name'];?> : <?=$row['d_desc1'];?> : <?=$row['d_desc2'];?><br>
<?
}
?>
