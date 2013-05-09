<?
require_once "model/rss.inc";
class IndexController {

    function index_list() {
        $cron_id = RSS::cronid();
        $totalcnt = RSS::rsscount($cron_id);
        $viewpage = ($_GET['page'])? : 1;
        $countPerPage = 100;
        $result = RSS::rsslist(($viewpage * $countPerPage) + 1, $countPerPage, $cron_id);
        $page = Util::paging($viewpage, $totalcnt, $countPerPage, '10');
        $param['result'] = $result;
        $param['paging'] = Util::paging_view($page);
        include "template/index.html";
    }

}
?>
