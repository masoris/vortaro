
function E(e) { return document.getElementById(e); }
function cxapelo(v) {
  if (v.length > 100) { return v.subtring(0, 100); }
  v = v.replace("cx", "ĉ").replace("gx", "ĝ").replace("hx", "ĥ");
  v = v.replace("jx", "ĵ").replace("sx", "ŝ").replace("ux", "ŭ");
  v = v.replace("Cx", "Ĉ").replace("Gx", "Ĝ").replace("Hx", "Ĥ");
  v = v.replace("Jx", "Ĵ").replace("Sx", "Ŝ").replace("Ux", "Ŭ");
  v = v.replace("ch", "ĉ").replace("gh", "ĝ").replace("hh", "ĥ");
  v = v.replace("jh", "ĵ").replace("sh", "ŝ").replace("uh", "ŭ");
  v = v.replace("Ch", "Ĉ").replace("Gh", "Ĝ").replace("Hh", "Ĥ");
  v = v.replace("Jh", "Ĵ").replace("Sh", "Ŝ").replace("Uh", "Ŭ");
  v = v.replace("c^", "ĉ").replace("g^", "ĝ").replace("h^", "ĥ");
  v = v.replace("j^", "ĵ").replace("s^", "ŝ").replace("u^", "ŭ");
  v = v.replace("C^", "Ĉ").replace("G^", "Ĝ").replace("H^", "Ĥ");
  v = v.replace("J^", "Ĵ").replace("S^", "Ŝ").replace("U^", "Ŭ");
  v = v.replace("au", "aŭ").replace("eu", "eŭ").replace("Au", "Aŭ").replace("Eu", "Eŭ");
  v = v.replace("ŭx", "ŭ").replace("Ŭx", "Ŭ").replace("w", "ŭ").replace("W", "Ŭ");
  return v;
}

var first = 1;

function klaku_vorto(v) {
  if (v == "") return;

  // 1
  var dic_json = localStorage['DIC_JSON_31'];
  if (dic_json != null) { dic = eval(dic_json); }
  if (dic == null) {
    alert("Vi ankoraŭ ne elŝutis datumon.\r\n아직 사전 데이타를 내려 받지 않았습니다. 내려받기를 누르세요.");
    return;
  }

  E("rezulto").innerHTML = "<br>Searching...";

  var result_lines = search(dic, v);
  if (result_lines.length == 0) {
    v = v.toLowerCase();
    result_lines = search(dic, v);
    if (result_lines.length == 0) {
      E("rezulto").innerHTML = "<br><br>Nenio troviĝas por tio.<br>단어를 찾을 수 없습니다.";
      return;
    }
  }

  var result = highlight(result_lines, v);

  var str = "";
  for (var i = 0; i < result.length; i++) {
    str += result[i] + "\n";
  }

  E("rezulto").innerHTML = str;

  first = 1;
}

function has_cxapelon(v) {
  var X = "xX^h";
  for (var i = 0; i < v.length; i++) {
    if (X.indexOf(v.charAt(i)) >= 0) {
      return true;
    }
  }
  return false;
}

function chapeligo() {
  var v1 = E("vorto").value;
  if (has_cxapelon(v1)) {
    // alert(v1);
    E("vorto").value = '';
    var v2 = cxapelo(v1);
    // alert(v2);
    E("vorto").style.display = '';
    E("vorto").value = v2;
  }
}

var dic = null;

function highlight(lines, vorto) {
  var new_lines = new Array();

  var suffix = vorto.substring(vorto.length - 1, vorto.length);
  if (vorto.length > 2 && "aeiou-/".indexOf(suffix) >= 0) {
    vorto = vorto.substring(0, vorto.length - 1);
  }

  for (var i = 0; i < lines.length; i++) {
    var x = new_lines.length;
    new_lines[x] = lines[i];
    new_lines[x] = new_lines[x].split(vorto).join("<font color=blue><b>" + vorto + "</b></font>");
    new_lines[x] = "<b>" + new_lines[x].replace("\t", "</b>&nbsp;&nbsp;") + "<hr>";
    if (new_lines[x].indexOf("<G_1>") >= 0) {
      new_lines[x] = new_lines[x].replace("<G_1>", "<B><font color=green size=-1>[G1]</font></B>");
    }
    if (new_lines[x].indexOf("<G_2>") >= 0) {
      new_lines[x] = new_lines[x].replace("<G_2>", "<B><font color=green size=-1>[G2]</font></B>");
    }
    if (new_lines[x].indexOf("<G_3>") >= 0) {
      new_lines[x] = new_lines[x].replace("<G_3>", "<B><font color=green size=-1>[G3]</font></B>");
    }
    if (new_lines[x].indexOf("<G_4>") >= 0) {
      new_lines[x] = new_lines[x].replace("<G_4>", "<B><font color=green size=-1>[G4]</font></B>");
    }
    if (new_lines[x].indexOf("<G_5>") >= 0) {
      new_lines[x] = new_lines[x].replace("<G_5>", "<B><font color=green size=-1>[G5]</font></B>");
    }
    if (new_lines[x].indexOf("<G_6>") >= 0) {
      new_lines[x] = new_lines[x].replace("<G_6>", "<B><font color=green size=-1>[G6]</font></B>");
    }
    if (new_lines[x].indexOf("<G_7>") >= 0) {
      new_lines[x] = new_lines[x].replace("<G_7>", "<B><font color=green size=-1>[G7]</font></B>");
    }
    if (new_lines[x].indexOf("<G_8>") >= 0) {
      new_lines[x] = new_lines[x].replace("<G_8>", "<B><font color=green size=-1>[G8]</font></B>");
    }
    if (new_lines[x].indexOf("<G_9>") >= 0) {
      new_lines[x] = new_lines[x].replace("<G_9>", "<B><font color=green size=-1>[G9]</font></B>");
    }
    if (new_lines[x].indexOf("<O_A>") >= 0) {
      new_lines[x] = new_lines[x].replace("<O_A>", "<B><font color=green size=-1>[OA]</font></B>");
    }
    if (new_lines[x].indexOf("<G_Y>") >= 0) {
      new_lines[x] = new_lines[x].replace("<G_Y>", "");
    }
  }

  return new_lines;
}

function is_separator(c) {
  if (c == ' ' || c == ',' || c == '.' || c == '[' ||
    c == ']' || c == ')' || c == '(' || c == '<' ||
    c == '>' || c == '-' || c == '=') {
    return 1;
  }

  return 0;
}

function score(word, entry) {
  var score = 0;

  var suffix = word.substring(word.length - 1, word.length);
  if (word.length > 2 && "aeiou-/".indexOf(suffix) >= 0) {
    word = word.substring(0, word.length - 1);
  }

  var idx = entry.indexOf(word);
  if (idx == 0) {
    score += 30;
  }

  if (idx > 0 && is_separator(entry.charAt(idx - 1))) {
    score += 20;
  }

  if (idx + word.length + 1 < entry.length) {
    if (is_separator(entry.charAt(idx + word.length))) {
      if (idx == 0) {
        score += 50;
      } else {
        score += 3;
      }
    }
  }

  var splitted = entry.split(word);
  score += splitted.length;

  score = score + 10000;

  return "{" + score + "}" + entry;
}

function search(dic, word) {
  var result = new Array();
  var found = new Object;

  if (word.length < 2) {
    return result;
  }

  for (var i = 0; i < dic.length; i++) {
    if (word.length == 1) {
      if (dic[i].indexOf(word) == 0) {
        result[result.length] = score(word, dic[i]);
        found[i] = 1;
      }
    } else {
      if (dic[i].indexOf(word) >= 0) {
        result[result.length] = score(word, dic[i]);
        found[i] = 1;
      }
    }
  }

  var suffix = word.substring(word.length - 1, word.length);
  if (word.length > 2 && "aeiou-/".indexOf(suffix) >= 0) {
    var word2 = word.substring(0, word.length - 1);
    for (var i = 0; i < dic.length; i++) {
      if (!(i in found)) {
        if (dic[i].indexOf(word2) >= 0) {
          result[result.length] = score(word, dic[i]);
        }
      }
    }
  }

  result.sort();
  result.reverse();

  for (var i = 0; i < result.length; i++) {
    result[i] = result[i].substring(7);
  }

  return result;
}

var load_status = "INIT";

window.onload = function () {
  E("vorto").onkeyup = function (e) {
    chapeligo();
    if (e.key == "Enter") {
      klaku_vorto(E("vorto").value);
    }
  }

  E("vorto").onclick = function () {
    if (first) {
      E("vorto").select();
      first = 0;
    }
  }

  E("Serchu").onclick = function () {
    chapeligo();
    klaku_vorto(E("vorto").value);
    first = 1;
  }

  // 2
  var dic_json = localStorage['DIC_JSON_31'];
  if (dic_json != null) {
    dic = eval(dic_json);
    // E("load").style.visibility = "hidden";
    E("load").value = "Datumo preta. 사전검색 가능함.";
    load_status = "DONE";
  }

  E("Reset").onclick = function () {
    localStorage.clear();
    load_status = "INIT";
    E("load").value = "Elŝutu datumon. 사전 내려받기.";
    E("Reset").disabled = true;
  }

  E("load").onclick = function () {
    if (load_status == "PROGRESS") {
      alert("Elŝutanta ... 다운로드 진행중.");
      return;
    }

    // 3
    var dic_json = localStorage['DIC_JSON_31'];
    if (dic_json != null) {
      dic = eval(dic_json);
      E("load").value = "Datumo preta. 사전검색 가능함.";
      load_status = "DONE";
      return;
    }

    // alert("내려받기에 시간이 걸릴 수 있으므로, OK/예 버튼을 누른 후, 잠시 기다려 주시기 바랍니다.\r\n내려 받는 동안 인터넷이 연결되어 있어야 합니다.");

    E("load").value = "Elŝutanta ... 다운로드 진행중.";
    load_status = "PROGRESS";
    call_ajax_text_get("./dic.json", "time=" + new Date(),
      function (r) {
        localStorage.clear();
        localStorage['DIC_JSON_31'] = r;

        E("load").value = "Datumo preta. 사전검색 가능함.";
        load_status = "DONE";
        E("Reset").disabled = false;
      }
    );
  }
}
