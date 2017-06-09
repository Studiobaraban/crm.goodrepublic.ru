function xmlHttp() {
  var tran;
  //Для оперы, firefox'a, хрома
  if (window.XMLHttpRequest) {
    tran = new XMLHttpRequest();
  //Для ie
  } else if (window.ActiveXObject) {
    try {
      //Для новых версий
      tran = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      //Для cтарых
      tran = new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
  return tran;
}
function sendGetRequest(tran, url, params, callback) {
  if(tran.readyState == 4 || tran.readyState == 0) {
    tran.open('GET', url + '?' + urlEncodeData(params), true);
    tran.send('');
    if(callback) {
      tran.onreadystatechange = function () {
        if(tran.readyState == 4 && tran.status >= 200 && tran.status < 300)
          callback(tran.responseText);
      }
    }
  }
}
function sendPostRequest(tran, url, params, callback) {
  if(tran.readyState == 4 || tran.readyState == 0) {
    tran.open('POST', url, true);
    tran.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    tran.setRequestHeader("Host", "kudago.com");
    //tran.setRequestHeader("Access-Control-Allow-Origin"," http://pro.kudago.com");
    //tran.setRequestHeader("Access-Control-Allow-Methods"," POST, GET, OPTIONS");
    //tran.setRequestHeader("Access-Control-Allow-Headers"," X-PINGOTHER");
    //tran.setRequestHeader("Access-Control-Max-Age"," 1728000");
    tran.setRequestHeader("Origin","http://pro.kudago.com");
    tran.send(urlEncodeData(params));
    if(callback) {
      tran.onreadystatechange = function () {
        if(tran.readyState == 4 && tran.status >= 200 && tran.status < 300)
          callback(tran.responseText);
      }
    }
  }
}
function urlEncodeData(data) {
  var arr = [];
  for(var p in data)
    arr.push(encodeURIComponent(p) + '=' + encodeURIComponent(data[p]));
  return arr.join('&');
}
function getRequestBody(form) {
  var par = {}, el;
  for(var i = 0; i < form.elements.length; ++i) {
    el = form.elements[i];
    par[el.name] = el.value;
  }
  return par;
}

function sendForm( form, callback) {
   var body=getRequestBody(form);
   var aditional='utm_campaign: "'+body.utm_campaign+'"\n\r'+'utm_content "'+body.utm_content+'"\n\r'+
				  'utm_medium: "'+body.utm_medium+'"\n\r'+'utm_source: "'+body.utm_source+'"\n\r'+'utm_term: "'+body.utm_term+'"\n\r';

   var kudaGo={region:body.region, name:body.name, phone_number:body.phone_number, email:body.email, message:aditional};
   var CRM={key:'06E204C2134D4DA4B878D36D87879BDF',form_freshoffice:1,company:'',site:'',lname:body.name, phone:body.phone_number, email:body.email, note:aditional,form_id:1,categ:234};

   sendPostRequest(xmlHttp(), 'http://kudago.com/landings/feedback/', kudaGo, callback);
  return false; // Ставим false чтобы не переходило на action, в случае если нужен переход, нужно вернуть значение true;
}
function set(key) { // Устанавливаем значение формы из GET
		var s = window.location.search; s = s.match(new RegExp(key + '=([^&=]+)'));
		document.getElementsByName(key)[0].value=s ? s[1] : false;
}
/*Устанавливаем в первую очередь hidden поля, в случае если в процессе работы сторонних javascript они в любом случае прописались в форму для отправки в основной адресат*/
set('utm_source');
set('utm_medium');
set('utm_campaign');
set('utm_content');
set('utm_term');