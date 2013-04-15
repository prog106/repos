<?
$rss_url = "rss_simple.php";
$rss_url = "http://www.ticketmonster.co.kr/rss/daily/?scode=9889";

function object2array($object) {
    return @json_decode(@json_encode($object),1);
}

$xmlread = file_get_contents($rss_url);
$xmls = object2array(simplexml_load_string($xmlread, 'SimpleXMLElement', LIBXML_NOCDATA));
$rows = $xmls['Items']['Item'];
foreach($rows as $row) {
    print_r($row);
    if($i > 10) break; else $i++;
}
?>
