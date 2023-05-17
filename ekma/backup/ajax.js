function mymd5(str)
{
    return str;
}

var global_req = false;

function abortSendMessage()
{
    if (global_req) {
        try {
            if (global_req.readyState < 4) {
                global_req.abort();
            }
        } catch (e) {

        }
    }
}

function call_ajax_text(url, callback)
{
    url = encodeURI(url);

    var req = false;
    if(window.XMLHttpRequest && !(window.ActiveXObject)) {
        try {
            req = new XMLHttpRequest();
        } catch(e) {
            req = false;
        }
    } else if(window.ActiveXObject) {
        try {
            req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch(e) {
            try {
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(e) {
                req = false;
            }
        }
    }

    if (req) {
        global_req = req;
        req.onreadystatechange = function()
        {
            if(req.readyState == 4 && req.status == 200) {
                // alert("ajax_call failed: req.status=" + req.status + ", req.readyState=" + req.readyState);
                callback(req.responseText);
            } else {
                // alert("ajax_call failed: req.status=" + req.status + ", req.readyState=" + req.readyState);
            }
        };

        req.open("GET", url, true);
        req.send("");
    }

    // window.setTimeout(abortSendMessage, 3000);
}

function call_ajax_text_post(url, parameters, callback)
{
    url = encodeURI(url);

    // alert("parameters=" + parameters);

    var req = false;
    if(window.XMLHttpRequest && !(window.ActiveXObject)) {
        try {
      req = new XMLHttpRequest();
        } catch(e) {
      req = false;
        }
    } else if(window.ActiveXObject) {
        try {
            req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch(e) {
            try {
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(e) {
                req = false;
            }
        }
    }
    if (req) {
        global_req = req;
        req.onreadystatechange = function()
        {
            if(req.readyState == 4 && req.status == 200) {
                // alert("ajax_call failed: req.status=" + req.status + ", req.readyState=" + req.readyState);
                callback(req.responseText);
            } else {
                // alert("ajax_call failed: req.status=" + req.status + ", req.readyState=" + req.readyState);
            }
        };

        req.open("POST", url, true);
        req.setRequestHeader("Content-type",
            "application/x-www-form-urlencoded");
        // req.setRequestHeader("Content-length", parameters.length);
        // req.setRequestHeader("Connection", "close");
        req.send(parameters);
    }

    // window.setTimeout(abortSendMessage, 3000);
}

