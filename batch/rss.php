<?
require_once "../common/common.inc";
require_once "../model/db.inc";

// $rss_url = "rss_simple.php";
$rss_url = "http://www.ticketmonster.co.kr/rss/daily/?scode=9889";

function object2array($object) {
    return @json_decode(@json_encode($object),1);
}

$xmlread = file_get_contents($rss_url);
$xmls = object2array(simplexml_load_string($xmlread, 'SimpleXMLElement', LIBXML_NOCDATA));
$rows = $xmls['Items']['Item'];

$msg = "batch start ".$now_date."\n";

if($rows) {
    $db = new MySQL();
    $cnt = 0;
    foreach($rows as $row) {
        $params = array(
            'd_no' => $row['ItemID'],
            'd_name' => $row['ItemName'],
            'd_desc1' => $row['ItemDesc'],
            'd_desc2' => $row['ItemDesc2'],
            'd_url' => $row['ItemURL']
//            'd_murl' => $row['Item'],
            'd_img1' => $row['ItemImageURL'],
            'd_img2' => $row['ItemImageURL2'],
            'd_img3' => $row['ItemImageURL3'],
            'd_st_date' => $row['ItemSaleSrtDT'],
            'd_ed_date' => $row['ItemSaleEndDT'],
            'd_use_st_date' => $row['ItemUseSrtDT'],
            'd_use_ed_date' => $row['ItemUseEndDT'],
            'd_origin_price' => $row['ItemOriginalPrice'],
            'd_sale_price' => $row['ItemSalePrice'],
            'd_discount_rate' => $row['ItemDiscountRate'],
            'd_max_sell_cnt' => $row['ItemMaxBuyCnt'],
            'd_now_sell_cnt' => $row['ItemCurBuyCnt'],
            'd_min_buy_cnt' => $row['ItemMinTakeCnt'],
            'd_max_buy_cnt' => $row['ItemMaxTakeCnt'],
            'd_area1' => $row['ItemAreaName'],
            'd_area2' => $row['ItemAreaName2'],
            'd_cate1' => $row['ItemCategoryName'],
            'd_cate2' => $row['ItemCategoryName2'],
            'd_vendor_name' => $row['ShopName'],
            'd_vendor_phone1' => $row['ShopPhone'],
            'd_vendor_phone2' => $row['ShopPhone2'],
            'd_vendor_addr' => $row['ShopAddr'],
            'd_vendor_lat' => $row['ShopLat'],
            'd_vendor_lng' => $row['ShopLng'],
        );
        $db->Insert($params, 'rss_data');
//        print_r($params);
//        if($i > 2) break; else $i++;
        $cnt++;
    }
    
    $result = $db->Select('rss_data');
//    print_r($result);
}

$msg .= "batch end | cnt : ".$cnt.";
debug_log($msg, 'batch');
?>
