<?
require_once "db.inc";

class RSS {
    function cronid() {
        $db = new MySQL();
        $sql = "SELECT max(id) as id FROM cron_data";
        $result = $db->ExecuteSQL($sql);
        return $result['id'];
    }
    function rsscount($cron_id=1) {
        $db = new MySQL();
        $sql = "SELECT count(id) as cnt FROM rss_data WHERE cron_id = '".$cron_id."'";
        $result = $db->ExecuteSQL($sql);
        return $result['cnt'];
    }
    function rsslist($slimit=0, $limit=20, $cron_id=1) {
        $db = new MySQL();
        $sql = "SELECT * FROM rss_data WHERE cron_id = '".$cron_id."' ORDER BY id DESC LIMIT ".$slimit.", ".$limit;
        $result = $db->ExecuteSQL($sql);
        return $result;
    }
}
?>
