<?
$run = " --dry-run ";
$exclude = " --exclude-from=exclude.list";
$command = "rsync -avrz ".$run." --delete -e -progress /home/prog106/www/batch/ /home/prog106/www/__batch/".$exclude;

$command = "df -h";

$result = shell_exec($command);
echo "<pre>".$result."</pre>";
?>
