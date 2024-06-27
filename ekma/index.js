function E(e) { return document.getElementById(e); }

function compress(original_string) {
    // 문자열 압축
    const encoder = new TextEncoder();
    const data = encoder.encode(original_string);
    const compressedData = pako.deflate(data);
    // 압축된 데이터를 바이너리 형태로 출력
    const binaryData = Array.from(compressedData, byte => String.fromCharCode(byte)).join('');
    return binaryData;
}

function uncompress(binaryData) {
    // 바이너리 데이터를 압축 해제하여 원래 문자열로 복원
    const decodedData = binaryData.split('').map(char => char.charCodeAt(0));
    const inflatedData = pako.inflate(new Uint8Array(decodedData));
    const decoder = new TextDecoder();
    const originalStringRestored = decoder.decode(inflatedData);
    return originalStringRestored;
}



function call_ajax_text_get(url, parameters, callback) {
    var req = false;
    try {
        req = new XMLHttpRequest();
    } catch (e) {
        try {
            req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
                req = false;
            }
        }
    }

    if (!req) { return; }

    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            callback(req.responseText);
        }
    };

    req.open("GET", encodeURI(url), true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset='UTF-8'");
    req.setRequestHeader('Ajax', 'true');

    req.send(parameters);
}

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

var DIC = null;
var DIC_ENG_ESP = null;
var first = 1;

function klaku_vorto(v) {
    if (v == "") return;

    if (DIC == null) {
        alert("Vi ankoraŭ ne elŝutis vortaron.\r\n아직 사전 데이타를 내려 받지 않았습니다. 내려받기를 누르세요.");
        return;
    }

    E("rezulto").innerHTML = "<br>Searching...";

    var result_lines = search(DIC, v);
    if (result_lines.length == 0) {
        v = v.toLowerCase();
        result_lines = search(DIC, v);
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

function click_word(v) {
    if (v == "") return;

    if (DIC_ENG_ESP == null) {
        alert("Vi ankoraŭ ne elŝutis vortaron.\r\n아직 사전 데이타를 내려 받지 않았습니다. 내려받기를 누르세요.");
        return;
    }

    E("rezulto").innerHTML = "<br>Searching...";

    var result_lines = search(DIC_ENG_ESP, v);
    if (result_lines.length == 0) {
        v = v.toLowerCase();
        result_lines = search(DIC_ENG_ESP, v);
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
        score += 150;
    }

    next_char = entry.substring(word.length, word.length + 1)
    if ("- \t?!.,[]()/12345".indexOf(next_char) >= 0) { //정확히 한글자가 매칭될때만 허용 
        score += 150;
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
    var found = new Array();

    for (var i = 0; i < dic.length; i++) {
        if (word.length == 0) { //한글자 단어 이면, 맨 처음에 매칭 되는 것만 허용
            if (dic[i].indexOf(word) == 0) {
                next_char = dic[i].substring(word.length, word.length + 1)
                if ("- \t?!.,[]()/12345".indexOf(next_char) >= 0) { //정확히 한글자가 매칭될때만 허용 
                    result[result.length] = score(word, dic[i]);
                    found[found.length] = i;
                }
            }
        } else { // 두 글자 이상일 때
            if (dic[i].indexOf(word) >= 0) {
                result[result.length] = score(word, dic[i]);
                found[found.length] = i;
            }
        }
    }
    console.log("a");

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
    console.log("b");

    result.sort();
    result.reverse();

    for (var i = 0; i < result.length; i++) {
        result[i] = result[i].substring(7);
    }
    console.log("c");
    console.log(result.length);
    if (result.length > 100) {
        var new_result = new Array();
        for (i = 0; i < 100; i++) {
            new_result[i] = result[i];
        }
        result = new_result;
    }
    console.log(result.length);
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

    E("word").onkeyup = function (e) {
        // chapeligo();
        if (e.key == "Enter") {
            click_word(E("word").value);
        }
    }

    E("vorto").onclick = function () { // 왜 입력창에서 마우스 클릭을 처리하는지 이해 못함. 
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

    E("Search").onclick = function () {
        // chapeligo();
        click_word(E("word").value);
        first = 1;
    }

    if (localStorage['DIC_JSON_EKMA'] != null) {
        DIC = uncompress(localStorage.DIC_JSON_EKMA).split('\n');
    }
    if (localStorage['DIC_JSON_ENG_ESP'] != null) {
        DIC_ENG_ESP = uncompress(localStorage.DIC_JSON_ENG_ESP).split('\n');
    }

    if (DIC != null) {
        E("load").value = "Vortaro Preta. 사전검색 가능함.";
        load_status = "DONE";
    }

    E("Reset").onclick = function () {
        delete localStorage.DIC_JSON_EKMA;
        DIC = null;
        delete localStorage.DIC_JSON_ENG_ESP;
        DIC_ENG_ESP = null;
        load_status = "INIT";
        E("load").value = "Elŝutu Vortaron. 사전 내려받기.";
        E("Reset").disabled = true;
    };

    E("load").onclick = function () {
        if (load_status == "PROGRESS") {
            alert("Elŝutanta ... 다운로드 진행중.");
            return;
        }

        // alert("내려받기에 시간이 걸릴 수 있으므로, OK/예 버튼을 누른 후, 잠시 기다려 주시기 바랍니다.\r\n내려 받는 동안 인터넷이 연결되어 있어야 합니다.");
        DIC = null;
        delete localStorage.DIC_JSON_EKMA;
        E("load").value = "Elŝutanta ... 다운로드 진행중.";
        load_status = "PROGRESS";
        call_ajax_text_get("./dic.tsv", "time=" + new Date(),
            function (resp) {
                // localStorage.clear();
                compressed = compress(resp);
                // alert(compressed.length);
                // alert(resp.length);
                localStorage['DIC_JSON_EKMA'] = compressed;
                DIC = resp.split('\n');
                call_ajax_text_get("./eng-esp.tsv", "time=" + new Date(),
                    function (resp) {
                        // localStorage.clear();
                        compressed = compress(resp);
                        // alert(compressed.length);
                        // alert(resp.length);
                        localStorage['DIC_JSON_ENG_ESP'] = compressed;

                        DIC_ENG_ESP = resp.split('\n');
                        E("load").value = "Vortaro Preta. 사전검색 가능함.";
                        load_status = "DONE";
                        E("Reset").disabled = false;
                    }
                );
                E("load").value = "Vortaro Preta. 사전검색 가능함.";
                load_status = "DONE";
                E("Reset").disabled = false;

            }
        );
    };
};
