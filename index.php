<?
require_once "common/common.inc";
require_once "common/layout.inc";
head('welcome');

$search = ($_GET['list']) ? : 1;

require_once "controller/index.php";
IndexController::index_list($search);
javascript();
footer();
?>
