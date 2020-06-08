function getXMLHttpRequest() {
    var xhr = null;
    if (window.XMLHttpRequest || window.ActiveXObject) {
        if (window.ActiveXObject) {
            try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        } else {
            xhr = new XMLHttpRequest();
        }
    } else {

    }
    return xhr;
}

function ajaxMethode(callback, donnee, name, goto) {
    var xhr = getXMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0)) {
            callback(xhr.responseText);
        } else if (xhr.status === 404)
        {
            document.location.href += "&ajax=false";
        }
    };

    var retour = "";
    for (var x = 0; x < name.length; x++)
    {
        retour += name[x] + "=" + donnee[x] + "&";
    }
    xhr.open("POST", goto, true); // POST
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var yo = null;
    yo = xhr.send(retour);
}

function connexion(callback = log)
{
    var pseudo = document.getElementById('inputNameEmail').value;
    var pass = document.getElementById('inputPassword').value;
    ajaxMethode(callback, [pseudo, pass, 'connexion'], ['userName', 'password', 'type'], 'ajaxUse/traitement.php');
    return false;
}

function inscription(callback = log)
{
    var pseudo = document.getElementById('inputUserame').value;
    var mail = document.getElementById('inputEmail').value;
    var pass = document.getElementById('inputPassword').value;
    var passverif = document.getElementById('inputConfirmPassword').value;
    ajaxMethode(callback, [pseudo, mail, pass, passverif, 'inscription'], ['userName', 'mail', 'password', 'passwordVerif', 'type'], 'ajaxUse/traitement.php');
    return false;
}

function modification(callback = log)
{
    
    var pseudo = document.getElementById('inputUserame').value;
    var mail = document.getElementById('inputEmail').value;
    var pass = document.getElementById('inputPassword').value;
    var passverif = document.getElementById('inputConfirmPassword').value;
    var phone = document.getElementById('inputTelephone').value;
    ajaxMethode(callback, [pseudo, mail, pass, passverif, phone, 'modification'], ['userName', 'mail', 'password', 'passwordVerif', 'phone', 'type'], 'ajaxUse/traitement.php');
    return false;
    
}

function log(data) {
    if (data === "OK") {
        document.location.search = "?p=lastpage";
    } else {
        document.getElementById("errorform").innerHTML = data;
        document.getElementById("errorform").style.display = 'block';
    }
}