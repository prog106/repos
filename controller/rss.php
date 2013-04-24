<?
require_once "model/rss.inc";
class RssController {

    function rss_list() {
        $totalcnt = RSS::rsscount();
        $viewpage = ($_GET['page'])? : 1;
        $countPerPage = 20;
        $result = RSS::rsslist(($viewpage * $countPerPage) + 1, $countPerPage);
        $page = Util::paging($viewpage, $totalcnt, $countPerPage, '10');
        $param['result'] = $result;
        $param['paging'] = Util::paging_view($page);
        include "template/rss_list.inc";
    }

}
?>
