<?
//$run = " --dry-run ";
//$command = "rsync -avrz ".$run." --delete -e -progress /home/prog106/www/batch/ /home/prog106/www/__batch/";
$command = "df -h";
$result = shell_exec($command);
echo "<pre>".$result."</pre>";
?>
