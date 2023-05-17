<?
# $phno, $code, $amount, $name, $ssn

$fp = fopen("./donaci_confirm.log", "a+");
fputs($fp,  date("Y/m/d-H:i:s") . " " . $_SERVER["REMOTE_ADDR"] . " " . $name . " " . $phno . " " . substr($ssn, 0, 7) . " " . "$amount\n");
fclose($fp);

sleep(1);

if (! file_exists("./data/$phno.txt")) {
    print "ERROR: data not found.";
} else {
    $fp = fopen("./data/$phno.txt", "r");
    if ($fp) {
        $rand = fgets($fp, 1024);
        $rand = trim($rand);

        if ($rand == $code) {
            print "OK.";
            unlink("./data/$phno.txt");
        } else {
            print "FAIL";
        }
    } else {
        print "FAIL";
    }
}
?>
