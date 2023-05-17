<?
$fp = fopen("./donaci.log", "a+");
fputs($fp,  date("Y/m/d-H:i:s") . " " . $_SERVER["REMOTE_ADDR"] . "\n");
fclose($fp);
?>
<html>
<head>
<title>에스페란토 전자사전 - 기부하기</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body>

<script src="./ajax.js"></script>
<script>
function check_ssn(ssn1, ssn2)
{
  ssn1 = ssn1.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
  ssn2 = ssn2.replace(/^\s\s*/, '').replace(/\s\s*$/, '');

  if (ssn1.length != 6 || ssn2.length != 7) return "";

  var yy = ssn1.substring(0,2);   
  var mm = ssn1.substring(2,4);
  var dd = ssn1.substring(4,6);   
  var sex = ssn2.substring(0,1);

  if (mm < 1 || mm > 16 || dd < 1) return false;
  if (sex != 1 && sex != 2 && sex != 3 && sex != 4) return "";

  var tmp = 0;
  for (var i = 0; i <= 5; i++) {
    tmp = tmp + ((i%8+2) * parseInt(ssn1.substring(i,i+1)));
  }
  for (var i = 6; i <= 11; i++) {  
    tmp = tmp + ((i%8+2) * parseInt(ssn2.substring(i-6,i-5)));
  }
  tmp = (11 - (tmp %11)) % 10;

  if (tmp != ssn2.substring(6,7)) return "";

  return ssn1 + ssn2;
}

function check_phone(phno)
{
  phno = phno.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
  var p2 = "";
  for (var i = 0; i < phno.length; i++) {   
    var c = phno.charAt(i);   
    if ((c < '0' || c > '9') && (c != '-') && (c != ' ')) { return ""; }
    if (c == '-' || c == ' ') continue;
    p2 += c;
  }

  return p2;
}

function check_confirm_code(code)
{
    return code.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
}

function trim(str)
{
  return str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
}

function check_name(str)
{
    return trim(str);
}

window.onload = function()
{
    document.getElementById("submit").disabled = true;

    document.getElementById("getnum").onclick = function()
    {
        // alert("getnum");
        var ssn1 = document.getElementById("ssn1").value;
        var ssn2 = document.getElementById("ssn2").value;
        var phno = document.getElementById("phno").value;

        var select = document.getElementById("amount");
        var amount = select.options[select.selectedIndex].value;

        ssn1 = ssn1.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
        ssn2 = ssn2.replace(/^\s\s*/, '').replace(/\s\s*$/, '');

        var ssn = check_ssn(ssn1, ssn2);
        if (ssn == "") {
            alert("주민번호가 틀렸습니다.");
            return false;
        }

        var name = check_name(document.getElementById("name").value);
        if (name == "") {
            alert("기부자명이 틀렸습니다.");
            return false;
        }

        phno = check_phone(phno);
        if (phno == "") {
            alert("전화번호가 틀렸습니다.");
            return;
        }

        var parameters = "ssn=" + ssn + "&name=" + encodeURI(name) + "&phno=" + phno + "&amount=" + amount;

        call_ajax_text_post("./donaci_send_code.php", parameters,
          function(rezulto) {
            document.getElementById("sent").innerHTML="인증번호가 " + phno + "(으)로 전송되었습니다.";
            document.getElementById("submit").disabled = false;
          }
        );

        // send confirm code to phone via SMS
        // AJAX_CALL(donaci_send_code.php?phno=phno&ssn=ssn)
        // create random confirm_code value
        // save it to ./confirm/phno.code
        // save phno, ssn to ./confirm/phno.code
    }

    document.getElementById("submit").onclick = function()
    {
        var code = document.getElementById("confirm").value;
        var phno = document.getElementById("phno").value;
        var name = document.getElementById("name").value;

        var ssn1 = document.getElementById("ssn1").value;
        var ssn2 = document.getElementById("ssn2").value;

        var ssn = ssn1 + ssn2;

        var select = document.getElementById("amount");
        var amount = select.options[select.selectedIndex].value;

        code = check_confirm_code(code);
        if (code == "") {
            alert("인증번호가 틀렸습니다.");
            return;
        }

        var parameters = "phno=" + phno + "&code=" + code + "&ssn=" + ssn + "&name=" + encodeURI(name) + "&amount=" + amount;
        call_ajax_text_post("./donaci_confirm.php", parameters,
          function(rezulto) {
            var OK = false;
            if (rezulto.indexOf("OK") >= 0) OK = true;
           
            if (OK) {
                alert("감사합니다.\n" +
                  "알수없는 문제가 발생해서 승인이 거부되었습니다.\n" +
                  "입금되지 않았습니다. \n" +
                  "운영자에게 연락해 주시기 바랍니다.\n" +
                  "연락처: 016-238-6566");
                return;
            } else {
                alert("인증 번호가 틀립니다.");
                return;
            }
          }
        );
    }

    document.getElementById("close_button").onclick = function()
    {
         window.close();
         return;
    }
}

</script>

<table align=center>
 <tr>
  <td>휴대폰으로 협회에 기부금을 보내시겠습니까?</td>
 </tr>
</table>

<table style='border:solid 1px green;' align=center>
 <tr>
  <td>기부금액:</td>
  <td><select id=amount style='border:solid 1px green;'>
       <option value='1000'>1,000
       <option value='3000'>3,000
       <option value='5000' selected>5,000
       <option value='10000'>10,000
       <option value='30000'>30,000
       <option value='50000'>50,000
       <option value='100000'>100,000
       <option value='200000'>200,000
      </select> 원</td>
  <td></td>
 </tr>

 <tr>
  <td>주민번호:</td>
  <td><input type=input id=ssn1 size=6 maxlen=6 style='border:solid 1px green;'>-<input type=input id=ssn2 size=7 maxlen=7 style='border:solid 1px green;'></td>
  <td></td>
 </tr>

 <tr>
  <td>기부자명:</td>
  <td><input type=input id=name style='border:solid 1px green;'></td>
  <td></td>
 </tr>

 <tr>
  <td>전화번호:</td>
  <td><input type=input id=phno style='border:solid 1px green;'></td>
  <td><input type=button id=getnum value='휴대폰인증'></td>
 </tr>


 </tr>
</table>

<table align=center>
 <tr>
  <td>
<span id='sent' align=center><font color=white>인증번호가 전송되었습니다.</font></span>
  </td>
 </tr>
</table> 

<table style='border:solid 1px green;' align=center>
 <tr>
  <td>인증번호:</td>
  <td><input type=input id=confirm style='border:solid 1px green;'></td>
  <td><input type=button id='submit' value='기부금전송'></td>
 </tr>
</table>

<table align=center>
 <tr>
  <td><input type=button id='close_button' value='&nbsp; &nbsp; 닫기 &nbsp; &nbsp;'></td>
 </tr>
</table>

</body>
</html>
