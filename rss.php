<?
$rss_url = "rss_simple.php";

function object2array($object) {
    return @json_decode(@json_encode($object),1);
}

$xmlread = file_get_contents($rss_url);
$xmls = object2array(simplexml_load_string($xmlread, 'SimpleXMLElement', LIBXML_NOCDATA));

print_r($xmls);
?>
