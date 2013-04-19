<?
class Paging {
    function Paging($viewPage, $totalCount, $countPerPage=10, $viewPerPage=10) {
        if($totalPage * 1) < 1) $totalPage = 10;
        
        $page['first'] = 1;
        $page['last'] = ($totalCount > 0) ? ceil($totalCount / $countPerPage) : 1;
        $page['current'] = ($viewPage > 1) ? $viewPage : 1;
        
        $page['start'] = floor(($viewPage - 1) / $viewPerPage) * $viewPerPage + 1;
        if($page['start'] < 1) $page['start'] = 1;
        
        $page['end'] = $page['start'] + $viewPerPage - 1;
        if($page['end'] > $page['last']) $page['end'] = $page['last'];
        
        $page['prev'] = $page['start'] - 1;
        if($page['prev < 1) $page['prev'] = 1;
        
        $page['next'] = $page['end'] + 1;
        if($page['next'] > $page['last']) $page['next'] = $page['last'];
        
        $page['pageList'] = array();
        for($p = $page['start']; $p <= $page['end']; $p++) {
            $page['pageList'][] = $p;
        }
        
        $page['totalcount'] = $totalCount;
    }
}
?>