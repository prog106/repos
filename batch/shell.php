<?
$run = " --dry-run ";
$exclude = " --exclude-from=exclude.list";
//$command = "rsync -avrz ".$run." --delete -e -progress /home/prog106/www/batch/ /home/prog106/www/__batch/".$exclude;
$command = "rsync -avrz ".$run." --delete -e -progress /home/prog106/Sites/_ci/ /home/prog106/Sites/ci/".$exclude;
//$command = "rsync -avrz ".$run." --delete -e -progress /home/prog106/www/batch/ prog106@prog106.phps.kr:/_www/".$exclude;

//$command = "scp -rpC -P 22 /Users/prog106/Sites/ci/ prog106@prog106.phps.kr:/www/";
$command = "df -h";

$result = shell_exec($command);
echo "<pre>".$result."</pre>";
//echo $command;
?>
