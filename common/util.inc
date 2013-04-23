<?
class Util {
    function paging($viewPage, $totalCount, $countPerPage=10, $viewPerPage=10) {
        if(($totalCount * 1) < 1) $totalCount = 10;
        
        $page['first'] = 1;
        $page['last'] = ($totalCount > 0) ? ceil($totalCount / $countPerPage) : 1;
        $page['current'] = ($viewPage > 1) ? $viewPage : 1;
        
        $page['start'] = floor(($viewPage - 1) / $viewPerPage) * $viewPerPage + 1;
        if($page['start'] < 1) $page['start'] = 1;
        
        $page['end'] = $page['start'] + $viewPerPage - 1;
        if($page['end'] > $page['last']) $page['end'] = $page['last'];
        
        $page['prev'] = $page['start'] - 1;
        if($page['prev'] < 1) $page['prev'] = 1;
        
        $page['next'] = $page['end'] + 1;
        if($page['next'] > $page['last']) $page['next'] = $page['last'];
        
        $page['pageList'] = array();
        for($p = $page['start']; $p <= $page['end']; $p++) {
            $page['pageList'][] = $p;
        }
        
        $page['totalcount'] = $totalCount;
        return $page;
    }

    function paging_view($page) {
        $html = $page['first']." | ";
        $html .= $page['prev']." | ";
        foreach($page['pageList'] as $row) {
            if($page['current'] == $row) $html .= "<b>";
            $html .= $row." | ";
            if($page['current'] == $row) $html .= "</b>";
        }
        $html .= $page['next']." | ";
        $html .= $page['last'];
        return $html;
    }

    function cookie($name, $value, $expire='0', $path='/', $domain='', $secure='false', $httponly='false') {
        $result = true;
        setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
        if($_COOKIE[$name] != $value) $result = false;
        return $result;
    }
}

?>
