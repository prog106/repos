<?
if(!function_exists('debug_log')) {
    function debug_log($var, $tps='debug') {
        ob_start();
        print_r($var);
        $str = ob_get_clean();
        $str = "\n".$str."\n".date('Y-m-d H:i:s');
        
        $log_path = "debuglog";
        if($tps == 'batch') $log_path = "batchlog";
        
        $fp = fopen('/home/prog106/logs/'.$log_path, 'a');
        fputs($fp, $str);
        fclose($fp);
    }
}

if(!function_exists('debug')) {
    function debug($var) {
        echo '<div style="border:1px solid #FFCC00;padding:5px;"><pre>';
        print_r($var);
        echo '</pre></div>';
    }
}
?>
