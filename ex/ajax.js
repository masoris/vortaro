function call_ajax_text_post(url, parameters, callback)
{
 var req = false;
 try {
  req = new XMLHttpRequest();
 } catch(e) {
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

 if (! req) { return; }

 req.onreadystatechange = function() {
  if (req.readyState == 4 && req.status == 200) {
   callback(req.responseText);
  }
 };

 req.open("POST", encodeURI(url), true);
 req.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset='UTF-8'");
 req.setRequestHeader('Ajax', 'true');

 req.send(parameters);
}

function call_ajax_text_get(url, parameters, callback)
{
 var req = false;
 try {
  req = new XMLHttpRequest();
 } catch(e) {
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

 if (! req) { return; }

 req.onreadystatechange = function() {
  if (req.readyState == 4 && req.status == 200) {
   callback(req.responseText);
  }
 };

 req.open("GET", encodeURI(url), true);
 req.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset='UTF-8'");
 req.setRequestHeader('Ajax', 'true');

 req.send(parameters);
}
