<?
require_once "db.inc";

$db = new MySQL('test1', 'test1', 'test123', 'localhost');
$result = $db->Select('rss_data');
?>
