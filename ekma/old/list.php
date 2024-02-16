<?
$fp = fopen("./log-login.log", "r");
while ($line = fgets($fp, 1024)) {
    echo $line . "<br>";
}
fclose($fp);
?>
