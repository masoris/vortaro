<?
# echo "vorto: $vorto";

$fp = fopen("./tiru-vortojn.log", "a+");
fputs($fp,  date("Y/m/d-H:i:s") . " " . $_SERVER["REMOTE_ADDR"] . " " . $vorto . "\n");
fclose($fp);

$vorto = str_replace("'", "", $vorto);
$vorto = str_replace("\"", "", $vorto);
$vorto = str_replace("`", "", $vorto);

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

$t0 = time();
# print "$t0: $vorto<br>\n";

$fp = fopen("./vortoj.txt.utf8", "r");
if ($fp) {
    $count = 0;
    $begin = 0;
    while (! feof($fp)) {
        $word = trim(fgets($fp, 1024));
        $cmp = strncmp($word, $vorto, strlen($vorto));
        if ($cmp < 0) {
            $prev_word = $word;
            continue;
        } else if ($cmp == 0) {
            if (! $begin) {
                $begin = 1;
                # print $prev_word;
            }

            /*
              $word = cxapeligo($word);
            */
            print "$word|^|";
            if ($count++ > 10) { break; }
        } else if ($cmp > 0) {
            if (! $begin) {
                $begin = 1;
                print $prev_word;
            }

            /*
              $word = cxapeligo($word);
            */
            print "$word|^|";
            if ($count++ > 10) { break; }
        }
    }
    fclose($fp);
}

$t1 = time();
?>
