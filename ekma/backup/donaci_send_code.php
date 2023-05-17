<?
$fp = fopen("./donaci_send_code.log", "a+");
fputs($fp,  date("Y/m/d-H:i:s") . " " . $_SERVER["REMOTE_ADDR"] . " " . $name . "/" . $phno . "/" . substr($ssn, 0, 7) . " " . $amount . "\n");
fclose($fp);

# $ssn, $phno, $name
$fp = fopen("./data/$phno.txt", "w+");
$r = rand(10000, 99999);
fputs($fp, "$r\n");
fclose($fp);

$fp = fsockopen("mail.mobigen.com", 110);
$welcome = fgets($fp, 1024);
fwrite($fp, "SEND-UTF8 0 $phno 협회-기부금 인증번호 [$r]\r\n");
fclose($fp);

print "OK";
?>
