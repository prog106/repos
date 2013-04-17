<?
require_once "model/rss.inc";

foreach($result as $row) {
?>
<?=$row['d_no'];?> : <?=$row['d_name'];?><br>
<?
}
?>
