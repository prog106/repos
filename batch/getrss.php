<?
$PATH = "/Users/prog106/Sites/repos/batch/log.xml";
$RURL = "http://issue15706.www.review.tmon.co.kr/rss/daOneday";
$RURL = "http://login.ticketmonster.co.kr/rss/daOneday";
$RURL = "http://login.ticketmonster.co.kr/rss/couponmoachart";

$xmlread = file_get_contents($RURL);
echo $xmlread;
//$fp = fopen($PATH, 'a');

//fputs($fp, $read);

//fclose($fp);
?>
