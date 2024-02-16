<?
# email, nomo, naskigxo, lando

function _unescape($string)
{
    $string = preg_replace("/\%u([0-9a-f]{4})/i", "&#x$1;", $string);
    return $string;
}

$email = _unescape($email);
$nomo = _unescape($nomo);
$naskigxo = _unescape($naskigxo);
$lando = _unescape($lando);

$fp = fopen("./log-login.log", "a+");
fputs($fp,  date("Y/m/d-H:i:s") . " " . $_SERVER["REMOTE_ADDR"] . " " . $email . "\t" . $nomo . "\t" . $naskigxo . "\t" . $lando . "\n");
fclose($fp);
?>
