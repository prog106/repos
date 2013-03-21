<?
// Predis 
require_once 'Predis/Autoloader.php';

Predis\Autoloader::register();

$redis = new Predis\Client();
$redis->set('foo', 'bar');
$value = $redis->get('foo');
echo $value;
?>
