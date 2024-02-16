<?
$vorto = $_POST["vorto"];
if ($vorto == "") {
    $vorto = $_REQUEST["vorto"];
}

# echo "vorto: $vorto";

$vorto = str_replace("'", "", $vorto);
$vorto = str_replace("\"", "", $vorto);
$vorto = str_replace("`", "", $vorto);


$fp = fopen("./tiru-enhavon.log", "a+");
fputs($fp,  date("Y/m/d-G:i:s") . " " . $_SERVER["REMOTE_ADDR"] . " [J] " . $vorto . "\n");
fclose($fp);

if (strlen($vorto) == 3 && ord(substr($vorto, 0, 1)) > 128) {
    $vorto = " " . $vorto;
}

if ($vorto == "") {
    print "결과가 없습니다. Nenio troviĝis por tio.";
    exit(0);
}


# $t0 = time();
# print "$t0: $vorto<br>\n";

$result = trim(`./sercxu.exe '$vorto' 'esp-jap.ext'`);

if ($result == "") {
    if (substr($vorto, 0, 1) == " ") {
        $vorto = substr($vorto, 1);
        $result = trim(`./sercxu.exe '$vorto' 'esp-jap.ext'`);
        if ($result == "") {
            print "Nenio troviĝis por tio. Bonvolu provu mallongan parton de vorto: 'mal', 'grand', sen finaĵo. Provu 日本語 單語.";
            exit(0);
        }
    } else {
        $result = trim(`./sercxu.exe '$vorto' 'esp-chi.ext'`);
        if ($result == "") {
            print "Nenio troviĝis por tio. Bonvolu provu mallongan parton de vorto: 'mal', 'grand', sen finaĵo. Provu 日本語 單語.";
            exit(0);
        } else {
            $result = "<hr><b>Ĉina vortaro diras:</b><hr>$result";
        }
    }
}

print $result;
?>
