<?
require_once "model/rss.inc";
class IndexController {

    function index_list() {
        $totalcnt = RSS::rsscount();
        $viewpage = ($_GET['page'])? : 1;
        $countPerPage = 18;
        $result = RSS::rsslist(($viewpage * $countPerPage) + 1, $countPerPage);
        $page = Util::paging($viewpage, $totalcnt, $countPerPage, '10');
        $param['result'] = $result;
        $param['paging'] = Util::paging_view($page);
        include "template/index.html";
    }

}
?>
