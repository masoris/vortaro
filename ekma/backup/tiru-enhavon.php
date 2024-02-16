<?
$vorto = $_POST["vorto"];
if ($vorto == "") {
    $vorto = $_REQUEST["vorto"];
}
# echo "vorto: $vorto";

$vorto = str_replace("'", "", $vorto);
$vorto = str_replace("\"", "", $vorto);
$vorto = str_replace("`", "", $vorto);

#$fp = fopen("./tiru-enhavon.log", "a+");
#fputs($fp,  date("Y/m/d-H:i:s") . " " . $_SERVER["REMOTE_ADDR"] . " " . $vorto . "\n");
#fclose($fp);


# UTF-8 한글 한글자가 오면, " 한" 과 같이 찾아야 한다.
if (strlen($vorto) == 3 &&
    ord(substr($vorto, 0, 1)) >= 128 &&
    ord(substr($vorto, 1, 1)) >= 128 &&
    ord(substr($vorto, 2, 1)) >= 128)
{
    $vorto = " " . $vorto;
}

function malcxapeligo($vorto)
{
    $vorto = str_replace("ĉ", "cx", $vorto);
    $vorto = str_replace("ĝ", "gx", $vorto);
    $vorto = str_replace("ĥ", "hx", $vorto);
    $vorto = str_replace("ĵ", "jx", $vorto);
    $vorto = str_replace("ŝ", "sx", $vorto);
    $vorto = str_replace("ŭ", "ux", $vorto);
    $vorto = str_replace("aŭ", "aux", $vorto);
    $vorto = str_replace("eŭ", "eux", $vorto);

    $vorto = str_replace("Ĉ", "Cx", $vorto);
    $vorto = str_replace("Ĝ", "Gx", $vorto);
    $vorto = str_replace("Ĥ", "Hx", $vorto);
    $vorto = str_replace("Ĵ", "Jx", $vorto);
    $vorto = str_replace("Ŝ", "Sx", $vorto);
    $vorto = str_replace("Ŭ", "Ux", $vorto);
    $vorto = str_replace("Aŭ", "Aux", $vorto);
    $vorto = str_replace("Eŭ", "Eux", $vorto);

    return $vorto;
}

function cxapeligo($vorto)
{
    $vorto = str_replace("cx", "ĉ", $vorto);
    $vorto = str_replace("gx", "ĝ", $vorto);
    $vorto = str_replace("hx", "ĥ", $vorto);
    $vorto = str_replace("jx", "ĵ", $vorto);
    $vorto = str_replace("sx", "ŝ", $vorto);
    $vorto = str_replace("ux", "ŭ", $vorto);
    $vorto = str_replace("aux", "aŭ", $vorto);
    $vorto = str_replace("eux", "eŭ", $vorto);

    $vorto = str_replace("Cx", "Ĉ", $vorto);
    $vorto = str_replace("Gx", "Ĝ", $vorto);
    $vorto = str_replace("Hx", "Ĥ", $vorto);
    $vorto = str_replace("Jx", "Ĵ", $vorto);
    $vorto = str_replace("Sx", "Ŝ", $vorto);
    $vorto = str_replace("Ux", "Ŭ", $vorto);
    $vorto = str_replace("Aux", "Aŭ", $vorto);
    $vorto = str_replace("Eux", "Eŭ", $vorto);

    return $vorto;
}

/*
$vorto = malcxapeligo($vorto);
*/

if ($vorto == "") {
    print "결과가 없습니다. Nenio troviĝis por tio.";
    exit(0);
}


# $t0 = time();
# print "$t0: $vorto<br>\n";

$result = trim(`./sercxu.exe '$vorto' ./ma-hanes-utf8.txt.tab.all`);

if ($result == "") {
    print "결과가 없습니다. Nenio troviĝis por tio. <hr>";
    print "단어를 바꿔서 찾아 보세요. (예: <b>아름답다</b> -> <b><u>아름다운</u></b>, <b>느리다</b> -> <b><u>느린</u></b>, <b>방문했다</b> -> <b><u>방문</u></b>) 좀더 짧게 입력해 보세요. 에스페란토/우리말 다 가능합니다. 에스페란토 입력할 때는, 어미를 제외한 어근만 입력하시면 됩니다.<br>";
    print "혹은 에-영 칸에 영어단어를 입력해서 찾아 보세요. 마찬가지로, 어근만 입력하면 더 잘 찾아집니다.<hr>";

/*
    # $vorto2 = trim(`java Spelling $vorto`);
    $vorto2 = trim(`gawk -v word='$vorto' -f Spelling.awk vortoj.txt`);
    # print "vorto2: [$vorto2]<br>\n";
    if ($vorto2 != "" && $vorto2 != $vorto) {
        $vorto2 = cxapeligo($vorto2);
        print "이것을 찾으셨나요? <a href=# onClick=\"javascript:klak_vorto('$vorto2')\">$vorto2</a><hr>\n";
    } else {
        $vorto = substr($vorto, 0, -1);
        $vorto2 = trim(`gawk -v word='$vorto' -f Spelling.awk vortoj.txt`);
        if ($vorto2 != "" && $vorto2 != $vorto) {
            $vorto2 = cxapeligo($vorto2);
            print "이것을 찾으셨나요? <a href=# onClick=\"javascript:klak_vorto('$vorto2')\">$vorto2</a><hr>\n";
        } else {
            $vorto = substr($vorto, 0, -1);
            $vorto2 = trim(`gawk -v word='$vorto' -f Spelling.awk vortoj.txt`);
            if ($vorto2 != "" && $vorto2 != $vorto) {
                $vorto2 = cxapeligo($vorto2);
                print "이것을 찾으셨나요? <a href=# onClick=\"javascript:klak_vorto('$vorto2')\">$vorto2</a><hr>\n";
            } 
        }
    }
*/

    exit(0);
}

print $result;
?>
