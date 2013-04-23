<?
require_once "db.inc";

class RSS {
    function rsscount() {
        $db = new MySQL();
        $sql = "SELECT count(id) as cnt FROM rss_data";
        $result = $db->ExecuteSQL($sql);
        return $result['cnt'];
    }
    function rsslist($slimit=0, $limit=20) {
        $db = new MySQL();
        $sql = "SELECT * FROM rss_data ORDER BY id DESC LIMIT ".$slimit.", ".$limit;
        $result = $db->ExecuteSQL($sql);
        return $result;
    }
}
?>
