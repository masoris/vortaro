<?
$korektajxo = $_POST["korektajxo"];
if ($korektajxo == "") {
    $korektajxo = $_REQUEST["korektajxo"];
}

$fp = fopen("./korektajxo.log", "a+");
fputs($fp, "\n----------\n");
fputs($fp, date("Y/m/d-G:i:s") . " " . $_SERVER["REMOTE_ADDR"] . "\n");
fputs($fp, $korektajxo . "\n");
fclose($fp);
print "감사합니다. 입력된 요청은 가까운 시일 내에 적용하겠습니다.";
?>
