<html>
<head>
<title>에스페란토 전자사전 (이재현)</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>

<script src="./ajax.js"></script>
<script language=JavaScript>
function convert_cxapelo(vorto)
{
  {
    vorto = vorto.replace("cx", "ĉ");
    vorto = vorto.replace("gx", "ĝ");
    vorto = vorto.replace("hx", "ĥ");
    vorto = vorto.replace("jx", "ĵ");
    vorto = vorto.replace("sx", "ŝ");
    vorto = vorto.replace("ux", "ŭ");

    vorto = vorto.replace("Cx", "Ĉ");
    vorto = vorto.replace("Gx", "Ĝ");
    vorto = vorto.replace("Hx", "Ĥ");
    vorto = vorto.replace("Jx", "Ĵ");
    vorto = vorto.replace("Sx", "Ŝ");
    vorto = vorto.replace("Ux", "Ŭ");
  }

  {
    vorto = vorto.replace("ch", "ĉ");
    vorto = vorto.replace("gh", "ĝ");
    vorto = vorto.replace("hh", "ĥ");
    vorto = vorto.replace("jh", "ĵ");
    vorto = vorto.replace("sh", "ŝ");
    vorto = vorto.replace("uh", "ŭ");

    vorto = vorto.replace("Ch", "Ĉ");
    vorto = vorto.replace("Gh", "Ĝ");
    vorto = vorto.replace("Hh", "Ĥ");
    vorto = vorto.replace("Jh", "Ĵ");
    vorto = vorto.replace("Sh", "Ŝ");
    vorto = vorto.replace("Uh", "Ŭ");
  }

  {
    vorto = vorto.replace("c^", "ĉ");
    vorto = vorto.replace("g^", "ĝ");
    vorto = vorto.replace("h^", "ĥ");
    vorto = vorto.replace("j^", "ĵ");
    vorto = vorto.replace("s^", "ŝ");
    vorto = vorto.replace("u^", "ŭ");

    vorto = vorto.replace("C^", "Ĉ");
    vorto = vorto.replace("G^", "Ĝ");
    vorto = vorto.replace("H^", "Ĥ");
    vorto = vorto.replace("J^", "Ĵ");
    vorto = vorto.replace("S^", "Ŝ");
    vorto = vorto.replace("U^", "Ŭ");
  }

  {
    vorto = vorto.replace("au", "aŭ");
    vorto = vorto.replace("eu", "eŭ");

    vorto = vorto.replace("Au", "Aŭ");
    vorto = vorto.replace("Eu", "Eŭ");

    vorto = vorto.replace("ŭx", "ŭ"); // ux 로 타이핑하면 'x'가 남게 됨
    vorto = vorto.replace("Ŭx", "Ŭ");
  }

    vorto = vorto.replace("x", "ks"); // 에스페란토에는 'x' 가 없음.
    vorto = vorto.replace("X", "Ks"); // 에스페란토에는 'x' 가 없음.
    vorto = vorto.replace("w", "ŭ"); // 에스페란토에는 'w' 가 없음.
    vorto = vorto.replace("W", "Ŭ"); // 에스페란토에는 'w' 가 없음.

    return vorto;
}

function klak_vorto(vorto)
{
    if (vorto == "") { return; }

    var parameters = "vorto=" + vorto;
    var t0 = (new Date()).getTime();

    call_ajax_text_post("./tiru-enhavon.php", parameters,
        function(rezulto) {
            document.getElementById("rezulto").innerHTML = rezulto;
            var t1 = (new Date()).getTime();
            document.getElementById("rezulto").innerHTML += "<br><font size=-2 color=#EEEEEE>" + (t1-t0)/1000 + " sekundoj.</font>"
        }
    );
}

function click_vorto(vorto)
{
    if (vorto == "") { return; }

    var parameters = "vorto=" + vorto;
    var t0 = (new Date()).getTime();

    call_ajax_text_post("./tiru-enhavon-2.php", parameters,
        function(rezulto) {
            document.getElementById("rezulto").innerHTML = rezulto;
            var t1 = (new Date()).getTime();
            document.getElementById("rezulto").innerHTML += "<br><font size=-2 color=#EEEEEE>" + (t1-t0)/1000 + " sekundoj.</font>"
        }
    );
}


function montru_vorton(vorto)
{
    if (vorto == "") { return; }

    var parameters = "vorto=" + encodeURI( vorto );

    var t0 = (new Date()).getTime();
    call_ajax_text_post("./tiru-vortojn.php", parameters,
        function(rezulto) {
            
            rezultoj = rezulto.split("|^|");

            rezulto = "";
            for (i = 0; i < rezultoj.length; i++) {
                rezultoj[i] = rezultoj[i].replace(/^\s+|\s+$/g,"");
                if (rezultoj[i] != "") {
                    rezulto += "<LI><a href=# onClick=\"javascript:klak_vorto('" + rezultoj[i] + "')\">" + rezultoj[i] + "</a><br>\n";
                }
            }

            document.getElementById("rezulto").innerHTML = rezulto;
            var t1 = (new Date()).getTime();
            document.getElementById("rezulto").innerHTML += "<br><font size=-2 color=#EEEEEE>" + (t1-t0)/1000 + " sekundoj.</font>"
        }
    );
}

function submit_correct()
{
    // alert("korektajxo: " + document.getElementById("korektajxo").value);
    var parameters = "korektajxo=" + encodeURI( document.getElementById("korektajxo").value );
   
    var t0 = (new Date()).getTime();
    call_ajax_text_post("./submit-korektajxo.php", parameters,
        function(rezulto) {
            document.getElementById("rezulto").innerHTML = rezulto;
            var t1 = (new Date()).getTime();
            document.getElementById("rezulto").innerHTML += "<br><font size=-2 color=#EEEEEE>" + (t1-t0)/1000 + " sekundoj.</font>";
        }
    );
}

function show_korektajxojn()
{
    // alert("korektajxo: " + document.getElementById("korektajxo").value);
    var parameters = "korektajxo=" + encodeURI( document.getElementById("korektajxo").value );

    var t0 = (new Date()).getTime();
    call_ajax_text_post("./show-korektajxo.php", parameters,
        function(rezulto) {
            document.getElementById("rezulto").innerHTML = rezulto;
            var t1 = (new Date()).getTime();
            document.getElementById("rezulto").innerHTML += "<br><font size=-2 color=#EEEEEE>" + (t1-t0)/1000 + " sekundoj.</font>";
        }
    );
}

window.onload = function()
{
/*
    document.getElementById("sercxu").onclick = function()
    {
        var vorto = document.getElementById("vorto").value;
        klak_vorto(vorto);
    }

    document.getElementById("sercxu2").onclick = function()
    {
        var vorto = document.getElementById("vorto2").value;
        click_vorto(vorto);
    }

    document.getElementById("vorto").onkeyup = function(event)
    {
        var vorto = document.getElementById("vorto").value;
        var cxapelitaj = "ĉĝĥĵŝŭĈĜĤĴŜŬ";
        // alert("vorto:" + vorto);

        if (vorto.length == 0) {
            document.getElementById("vorto2").value = "";
        } else if (vorto.charCodeAt(0) < 127) {
            document.getElementById("vorto").value = convert_cxapelo(vorto);
            document.getElementById("vorto2").value = document.getElementById("vorto").value;
        } else if (cxapelitaj.indexOf(vorto.substring(0, 1), 0) >= 0) {
            document.getElementById("vorto").value = convert_cxapelo(vorto);
            document.getElementById("vorto2").value = document.getElementById("vorto").value;
        }
    }

    document.getElementById("vorto").onkeydown = function(event)
    {
        var keycode = '0';
        if (window.event) keycode = window.event.keyCode;
        else if (event) keycode = event.which;
        if (keycode == 13) {
            var vorto = document.getElementById("vorto").value;
            klak_vorto(vorto);
            return false;
        }

        montru_vorton( document.getElementById("vorto").value );
    }

    document.getElementById("vorto2").onkeydown = function(event)
    {
        var keycode = '0';
        if (window.event) keycode = window.event.keyCode;
        else if (event) keycode = event.which;
        if (keycode == 13) {
            var vorto = document.getElementById("vorto2").value;
            click_vorto(vorto);
            return false;
        }
    }

    document.getElementById("korektu").onmouseover = function()
    {
        document.getElementById("korektu").style.cursor='pointer';
    }

    document.getElementById("korektu").onclick = function()
    {
        document.getElementById("rezulto").innerHTML = 
          "<textarea id=korektajxo style='width:100%;height:50' style='border:solid 1px gray;'>신고자:\n" +
          "오타나 수정할 내용 또는 개선할 요청사항을 여기에 입력해 주세요.</textarea><br>" +
          "<input type=button id=korektu_petu value='보내기' onClick='javascript:submit_correct()'>" +
          "        " +
          "<input type=button id=montru_korektajxon value='기존 요청사항 보기' onClick='javascript:show_korektajxojn()'><br>";
    }
*/
}
</script>

<script language=JavaScript>
function addToFavorites(url, title)
{
    if (window.external) {
        window.external.AddFavorite(url, title);
    }
}
</script>

<body>

<table>
 <tr>
  <td width=100%>
   <font face="Times" size=+2><b>에스페란토 사전</b></font>
  </td>
 </tr>
</table>

<table>
 <tr>
  <td>에+한 <input value="" type=text id=vorto style="border:solid 2px green;" size=10 onClick="javascript:alert('abc');"></td>
  <td><input value="serĉu" type=button id=sercxu onClick="javascript:alert('abc');"></td>
 </tr>
</table>

<table border=1>
 <tr width=100% align=left>
  <td width=100% align=left>
   <span id=rezulto>
    해평 이재현 선생님 사전의 인터넷판입니다.<br>
    영어판은 인터넷에서 공개된 사전을 사용했습니다.<br><br>
    우리말/에스페란토 다 받아들입니다.<br>
    단어 일부만 입력해도 최대한 찾아줍니다.<br>
    <br>
    종이로 된 에스페란토 사전 구입은 <br>
    협회 대표전화 02-717-6974 또는 <br>
    kea(골뱅이)esperanto.or.kr로<br>
    연락 하시면 구매하실 수 있습니다.
    <br>
    <p align=right>
    <input type=button value=" 이 페이지를 즐겨찾기에 추가 "
           onClick="javascript:addToFavorites('http://www.mobigen.com/~hiongun/ek', '에스페란토 사전')"><br>
    <input type=button value=" 협회 홈페이지를 즐겨찾기에 추가 "
           onClick="javascript:addToFavorites('http://www.esperanto.or.kr/', '에스페란토 협회')">
    </p>
   </span>
  </td>
 </td>
</table>

</body>
</html>
