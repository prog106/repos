<?
require_once "dbconn.php";

$rss_url = "rss_simple.php";
$rss_url = "http://www.ticketmonster.co.kr/rss/daily/?scode=9889";

function object2array($object) {
    return @json_decode(@json_encode($object),1);
}

$xmlread = file_get_contents($rss_url);
$xmls = object2array(simplexml_load_string($xmlread, 'SimpleXMLElement', LIBXML_NOCDATA));
$rows = $xmls['Items']['Item'];

if($rows) {
    $db = new MySQL('test1', 'test1', 'test123', 'localhost');
    $i=0;
    foreach($rows as $row) {
        $params = array(
            'd_no' => $row['ItemID'],
            'd_name' => $row['ItemName'],
            'd_desc1' => $row['ItemDesc'],
            'd_desc2' => $row['ItemDesc2'],
            'd_url' => $row['ItemURL']
        );
        $db->Insert($params, 'rss_data');
        print_r($params);
        if($i > 2) break; else $i++;
    }
    
    $result = $db->Select('rss_data');
    print_r($result);
}
?>
