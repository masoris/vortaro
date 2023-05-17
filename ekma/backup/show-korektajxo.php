<?
$fp = fopen("korektajxo.log", "r");
while ($line = fgets($fp, 1024)) {
    if (preg_match("/ ([0-9]+\\.[0-9]+\\.[0-9]+\\.[0-9]+)/", $line, $m)) {
        $ip = $m[1];
        $line = str_replace($ip, "<font color=white>" . $ip . "</font>", $line);
    }
    print $line . "<br>";
}
fclose($fp);
?>
