<?
require_once "common/common.inc";
require_once "common/layout.inc";
require_once "controller/rss.php";
head('welcome');

RssController::rss_list();

javascript();
footer();
?>
