<?
require_once "db.inc";

class RSS {
    function cronid() {
        $db = new MySQL();
        $sql = "SELECT max(id) as id FROM cron_data WHERE status = 'Y'";
        $result = $db->ExecuteSQL($sql);
        return $result['id'];
    }
    function rsscount($cron_id=1) {
        $db = new MySQL();
        $sql = "SELECT count(id) as cnt FROM rss_data WHERE cron_id = '".$cron_id."'";
        $result = $db->ExecuteSQL($sql);
        return $result['cnt'];
    }
    function rsslist($slimit=0, $limit=20, $cron_id=1, $where=1) {
        $db = new MySQL();
        $sql = "SELECT *, (d_now_sell_cnt/d_max_sell_cnt)*100 as per FROM rss_data WHERE cron_id = '".$cron_id."'";
        $sql .= $where;
        $sql .= " ORDER BY d_ed_date ASC, per DESC, d_now_sell_cnt DESC, d_discount_rate DESC LIMIT ".$slimit.", ".$limit;
        $result = $db->ExecuteSQL($sql);
        return $result;
    }
}
?>
