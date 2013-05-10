<?
require_once "model/rss.inc";
class IndexController {

    function index_list($search=1) {
        $cron_id = RSS::cronid();
        $totalcnt = RSS::rsscount($cron_id);
        $viewpage = ($_GET['page'])? : 1;
        $countPerPage = 200;
        $slimit = ($viewpage == 1)? 0 : ($viewpage * $countPerPage) + 1;
        $where = ($search == 'area') ? " and d_cate2 = 'Array' " : (($search == 'store') ? " and d_cate2 != 'Array' " : "");
        $result = RSS::rsslist($slimit, $countPerPage, $cron_id, $where);
        $page = Util::paging($viewpage, $totalcnt, $countPerPage, '10');
        $param['result'] = $result;
        $param['paging'] = Util::paging_view($page);
        include "template/index.html";
    }

}
?>
