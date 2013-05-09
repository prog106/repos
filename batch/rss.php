<?
$PATH = "/home/prog106/www/";
require_once $PATH."common/common.inc";
require_once $PATH."model/db.inc";

// $rss_url = "rss_simple.php";
$rss_url = "http://www.ticketmonster.co.kr/rss/daily/?scode=9889";

function object2array($object) {
    return @json_decode(@json_encode($object),1);
}

$xmlread = file_get_contents($rss_url);
$xmls = object2array(simplexml_load_string($xmlread, 'SimpleXMLElement', LIBXML_NOCDATA));
$rows = $xmls['Items']['Item'];

$msg = "batch start : ".$now_date."\n";

$db = new MySQL();

$params = array(
    'site_code' => 'tmon',
    'site' => $rss_url,
    'status' => 'S', // start
    'read_date' => date('Y-m-d H:i:s'),
);
$db->Insert($params, 'cron_data');
$srl = $db->LastInsertId();

if($rows) {
    $cnt = 0;
    foreach($rows as $row) {
        $params = array(
            'cron_id' => $srl,
            'd_no' => $row['ItemID'],
            'd_name' => $row['ItemName'],
            'd_desc1' => $row['ItemDesc'],
            'd_desc2' => $row['ItemDesc2'],
            'd_url' => $row['ItemURL'],
//            'd_murl' => $row['Item'],
            'd_img1' => $row['ItemImageURL'],
            'd_img2' => $row['ItemImageURL4'],
            'd_img3' => $row['ItemImageURL7'],
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
            'd_vendor_lng' => $row['ShopLng']
        );
        $db->Insert($params, 'rss_data');
        $cnt++;
        $param[] = $row['ItemID'];
    }
}
if($param) {
        $pchart_root = $PATH."pChart2.1.3/";
        $graph_root = $PATH."img/graph/";
        require_once $pchart_root."class/pData.class.php";
        require_once $pchart_root."class/pDraw.class.php";
        require_once $pchart_root."class/pImage.class.php";
        foreach($param as $k) {
            $r = array();
            $v = array();
            $sql = "SELECT d_now_sell_cnt as cnt FROM rss_data WHERE d_no = '".$k."' ORDER BY id ASC LIMIT 7";
            $result = $db->ExecuteSQL($sql);
            foreach($result as $s => $v) {
                foreach($v as $m => $n) {
                    $r[] = $n;
                }
            }
            if(count($r) < 7) {
                $merge = array_fill(0, (7 - count($r)), 0);
                $v = array_merge($merge, $r);
            } else {
                $v = $r;
            }
            $usedata = ($v)? : array(0,0,0,0,0,0,0);
            $xdata = array(6,5,4,3,2,1,0);
            $pdata = new pData();
            $pdata->setAxisName(0, "Sell Count"); // y label
            $pdata->addPoints($xdata, "Labels");
            $pdata->setSerieDescription("Labels", "Befor Hour");
            $pdata->setAbscissa("Labels"); // x label

            $pdata->addPoints($usedata, "line1");
            $pdata->setPalette("line1", array("R"=>229, "G"=>11, "B"=>11, "Alpha"=>80));

            $x = 170;
            $y = 120;
            $xstart = 25;
            $xend = $x;
            $ystart = 5;
            $yend = $y - 15;

            $chart = new pImage($x, $y, $pdata);
            $chart->setFontProperties(array("FontName"=>$pchart_root."fonts/verdana.ttf", "FontSize"=>6));
            $chart->setGraphArea($xstart, $ystart, $xend, $yend);
            $chart->drawScale();
            $chart->drawSplineChart();
            $graph_name = $graph_root.$k;
            $chart->Render($graph_name);
            //$chart->autoOutput();
        }
}

$status_param = ($cnt>0) ? array('status' => 'Y', 'count' => $cnt) : array('status' => 'N');
$db->Update('cron_data', $status_param, array('id' => $srl));

$msg .= "batch end | cnt : ".$cnt;
debug_log($msg, 'batch');
?>
