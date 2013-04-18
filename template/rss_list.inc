<?
require_once "model/rss.inc";

$result = RSS::rsslist();

foreach($result as $row) {
?>
<?=$row['d_no'];?> : <?=$row['d_name'];?><br>
<?
}
?>
