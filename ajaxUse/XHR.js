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