<?
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

$fp1 = fopen("$file", "r");
$fp2 = fopen("$file.x", "w+");
while ($buf = fgets($fp1, 40960)) {
    $buf = cxapeligo($buf);
    fputs($fp2, $buf);
}
fclose($fp1);
fclose($fp2);

?>
