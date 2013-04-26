<?
require_once "common/common.inc";
require_once "common/layout.inc";
head('welcome');
$view_main = ($_GET['m'] == 'rss')? "rss" : "index";

switch($view_main) {
    case "rss":
        require_once "controller/rss.php";
        RssController::rss_list();
    break;
    default;
        require_once "controller/index.php";
        IndexController::index_list();
    break;
}
javascript();
footer();
?>
