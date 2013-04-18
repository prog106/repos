<?
require_once "db.inc";

class RSS {
    function rsslist() {
        $db = new MySQL();
        $result = $db->Select('rss_data');
        return $result;
    }
}
?>
