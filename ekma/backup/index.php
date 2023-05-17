<? header('Content-Type: text/html; charset=utf-8'); ?>
<!DOCTYPE HTML>
<html>
<head>
<title>에스페란토 사전 (마영태) ... 에스페란토사전</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width">
<!meta http-equiv="X-UA-Compatible" content="IE=7" />
</head>
<script>
function $(x)
{
    return document.getElementById(x);
}

function setCookie(c_name,value,exdays)
{
  var exdate=new Date();
  exdate.setDate(exdate.getDate() + exdays);
  var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
  document.cookie=c_name + "=" + c_value;
}

function getCookie(c_name)
{
  var c_value = document.cookie;
  var c_start = c_value.indexOf(" " + c_name + "=");
  if (c_start == -1) {
    c_start = c_value.indexOf(c_name + "=");
  }
  if (c_start == -1) {
    c_value = null;
  } else {
    c_start = c_value.indexOf("=", c_start) + 1;
    var c_end = c_value.indexOf(";", c_start);
    if (c_end == -1) {
      c_end = c_value.length;
    }
    c_value = unescape(c_value.substring(c_start,c_end));
  }
  return c_value;
}

function login_server_first(email, nomo, naskigxo, lando)
{
    var parameters = "email=" + escape(email) +
                     "&nomo=" + escape(nomo) +
                     "&naskigxo=" + escape(naskigxo) +
                     "&lando=" + escape(lando);

    var t0 = (new Date()).getTime();

    call_ajax_text_post("./log-login.php", parameters,
        function(rezulto) {
            // alert(rezulto);
        }
    );
}

function login_server_cookie(email)
{
    var parameters = "email=" + escape(email);

    var t0 = (new Date()).getTime();

    call_ajax_text_post("./log-login.php", parameters,
        function(rezulto) {
            // alert(rezulto);
        }
    );
}


function try_login()
{
    var email1 = $("email1").value;
    var email2 = $("email2").value;
    var nomo = $("nomo").value;
    var naskigxo = $("naskigxo").value;
    var lando = $("lando").value;

    if (email1.indexOf("@") < 0) {
        alert("Konkreta ret-adreso estas necesa.\n이메일 주소가 잘못되었습니다.");
        return;
    }

    if (nomo == "") {
        alert("Nomo ne estis skribita.\n이름을 입력해 주시기 바랍니다.");
        return;
    }

    if (lando == "") {
        alert("No Lando estis skribita.\n나라 도시가 입력되지 않았습니다.");
        return;
    }

    if (naskigxo == "") {
        alert("Naskigx-jaro estas ne skribita.\n생년을 입력해 주세요.");
        return;
    }

    if (email1 != email2) {
        alert("Ret-adresoj devas esti samaj.\n이메일 주소가 똑같이 두번 입력되어야 합니다.");
        return;
    }

    setCookie("X_05", email1, 1);
    $("login_div").style.visibility = "hidden";
    $("result_div").style.visibility = "visible";
    login_server_first(email1, nomo, naskigxo, lando);
}

function check_login()
{
    if (getCookie("X_05") && getCookie("X_05") != "") {
        return true;
    }

    return false;
}


</script>

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

/*
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
*/

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

// alert("1:" + vorto);

    call_ajax_text_post("./tiru-enhavon.php", parameters,
        function(rezulto) {
// alert(rezulto);
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

// alert("2:" + vorto);

    call_ajax_text_post("./tiru-enhavon-2.php", parameters,
        function(rezulto) {
            document.getElementById("rezulto").innerHTML = rezulto;
            var t1 = (new Date()).getTime();
            document.getElementById("rezulto").innerHTML += "<br><font size=-2 color=#EEEEEE>" + (t1-t0)/1000 + " sekundoj.</font>"
        }
    );
}

// var keyFix = new beta.fix('input_search_all');

function show_words(vorto)
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

var prev = "";
var focus = false;

function checkText()
{
  if (! focus) { return; }

  if (prev != document.getElementById("vorto").value) {
    prev = document.getElementById("vorto").value;
    show_words(document.getElementById("vorto").value);
  }

  setTimeout('checkText()', 100);
}

var login_email = null;

window.onload = function()
{
  document.getElementById("vorto").onfocus = function()
  {
    focus = true;
    checkText();
  }

  document.getElementById("vorto").onblur = function()
  {
    focus = false;
  }

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

    // show_words( document.getElementById("vorto").value );
  }

/*
  document.getElementById("vorto").onkeypress = function(event)
  {
    var keycode = '0';
    if (window.event) keycode = window.event.keyCode;
    else if (event) keycode = event.which;
    if (keycode == 13) {
      var vorto = document.getElementById("vorto").value;
      klak_vorto(vorto);
      return false;
    }

    show_words( document.getElementById("vorto").value );
  }
*/

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
      "</textarea><br>" +
      "오타나 수정할 내용 또는 개선할 요청사항을 입력해 주세요.<br>"+
      "<input type=button id=korektu_petu value='보내기' onClick='javascript:submit_correct()'>" +
      "        " +
      "<input type=button id=montru_korektajxon value='기존 요청사항 보기' onClick='javascript:show_korektajxojn()'><br>";
  }
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

<H3>에-한/한-에 양방향 에스페란토 사전</H3>
Esperanto/Korea Vortaro
<input type=button id='korektu' name='korektu' value='오타/정정 요청'>
<br>
<nobr>
<font>에-한 <input value="" type=text id=vorto style="border:solid GREEN;" autocomplete=off autocapitalize=off size=10></font>
<input value="serĉu" type=button id=sercxu name=sercxu>
</nobr>

<nobr>
<font>에-영 <input value="" type=text id=vorto2 style="border:solid GREEN;" size=10></font>
<input value="search" type=button id=sercxu2 name=sercxu2>
</nobr>


<table width=100%>
 <tr>
  <td>

<div id=result_div style="visibility:visible">
<table width=100% border=0 align=left style="border:solid 1px GREEN;">
 <tr width=100% align=left>
  <td width=100% align=left>
   <span id=rezulto>

    삿갓문자는 'x' 또는 '^'를 이용해서 입력합니다.<br>
    <br>

마영태 저 (세계에스페란토학술원 회원; 단국대 · 한국외대 에스페란토 강사; 중국 남경대 에스페란토 초빙교수)<br>

<H3>저서:</H3>
<UL>
<LI> I. 마영태에스페란토총서(전7권 10책), 한국에스페란토협회 출간<br>
<LI> 1권: ①에스페란토의 기초 ; ②에스페란토의 회화<br>
<LI> 2권: ③에스페란토의 작문 ; ④에스페란토의 숙어 · 속담<br>
<LI> 3권: ⑤즐거운 에스페란토나라 ; ⑥영어-에스페란토-한국어 회화<br>
<LI> 4권: ⑦에스페란토의 편람<br>
<LI> 5권: ⑧성서로 배우는 에스페란토<br>
<LI> 6권: ⑨(에스페란토-한국어 대역) 영혼의 양식<br>
<LI> 7권: ⑩이상한 언어, 행복한 50년 (회고록)<br>
<LI> II. 사전 : 에스페란토-한국어 사전 / 한국어-에스페란토 사전<br>
<LI> III. (한국어-에스페란토대조) 신약전서<br>
<LI> VI. 네이버 카페: <A href=https://cafe.naver.com/leono>https://cafe.naver.com/leono</A>  <br>
</UL>

종이로 된 에스페란토 사전은  (사)한국에스페란토협회에서 구매할 수 있습니다.<br>

<UL>
<LI> 전화 : 02-717-6974<br>
<LI> 이메일 : kea@esperanto.or.kr<br>
<LI> 최종수정: 2020-3-1<br>
</UL>

<hr>

    <br>
    <br>
    [G1] ... [G9]는 Akademio에서 발표한 레벨 구분입니다.<br>
    "Baza Radikaro Oficiala(BRO)"의 레벨 구분<br> 
    <br>
    <br>
    <p>
    이 사전의 저작권은 마영태 선생님에게 있습니다.<br>
    사전의 저작물에 대한 활용을 하고 싶으신 분들은 마영태 선생님에게 전화 또는 메일로 문의를 하시기 바랍니다.
    </p>
    <br>
   </span>
  </td>
 </td>
</table>
</div>

  </td>
 </tr>
</table>

<H3>다른 사전 보기</H3>
<UL>
<LI><a href=/e/?<?echo time()?>>마영태 선생님(Leono Ma)의 사전</a>
<LI><a href=/m/?<?echo time()?>>이재현 선생님(Hajpin Li)의 사전</a>
<LI><a href=/ex/?<?echo time()?>>다운로드후 인터넷 없이 쓰는 사전</a>
<LI><a href=/c/?<?echo time()?>>Vortaro por Ĉinoj</a>
<LI><a href=/j/?<?echo time()?>>Vortaro por Japanoj</a>
<LI><a href=http://www.reta-vortaro.de/revo/>Reta Vortaro</a>
<br>
<LI><a href=/ek/?<?echo time()?>>이재현 선생님(Hajpin Li)의 PC판</a>
<LI><a href=/ekma/?<?echo time()?>>마영태 선생님(Leono Ma)의 PC판</a>
<LI><a href=/b/?<?echo time()?>>시각장애인을 위한 사전</a>
</UL>


</body>

</html>
