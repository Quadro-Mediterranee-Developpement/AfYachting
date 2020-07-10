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

function inscriptionAll(callback = log)
{
    var pseudo = document.getElementById('inputUserame').value;
    var mail = document.getElementById('inputEmail').value;
    var pass = document.getElementById('inputPassword').value;
    var passverif = document.getElementById('inputConfirmPassword').value;
    var phone = document.getElementById('inputPhone').value;
    var role = document.getElementById('inputRole').value;
    ajaxMethode(callback, [pseudo, mail, pass, passverif, phone, role, 'inscription'], ['userName', 'mail', 'password', 'passwordVerif', 'phone', 'table', 'type'], 'ajaxUse/traitement.php');
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

function modificationAll(callback = log)
{

    var pseudo = document.getElementById('inputUserameModif').value;
    var mail = document.getElementById('inputEmailModif').value;
    var pass = document.getElementById('inputPasswordModif').value;
    var passverif = document.getElementById('inputConfirmPasswordModif').value;
    var phone = document.getElementById('inputPhoneModif').value;
    var id = document.getElementById('inputIDModif').value;
    var table = document.getElementById('inputRoleModif').value;

    ajaxMethode(callback, [pseudo, mail, pass, passverif, phone, id, table, 'modification'], ['userName', 'mail', 'password', 'passwordVerif', 'phone', 'ID', 'table', 'type'], 'ajaxUse/traitement.php');
    return false;

}


function creatnewboat(callback = log)
{
    var nom = document.getElementById('nom').value;
    var description = document.getElementById('description').value;
    var nomModele = document.getElementById('nomModele').value;
    var moteur = document.getElementById('moteur').value;
    var longueur = document.getElementById('longueur').value;
    var nombrePassager = document.getElementById('nombrePassager').value;
    var Equipement = document.getElementById('Equipement').value;
    var divers = document.getElementById('divers').value;

    ajaxMethode(callback, [nom, description, nomModele, moteur, longueur, nombrePassager, Equipement, divers, 'addboat'], ['nom', 'description', 'nomModele', 'moteur', 'longueur', 'nombrePassager', 'Equipement', 'divers', 'type'], 'ajaxUse/traitement.php');
    return false;

}


function suprimer(id, table)
{
    ajaxMethode(function (data) {
        alert(data);
    }, [id, table, 'suprimer'], ['ID', 'table', 'type'], 'ajaxUse/traitement.php');
    return false;
}

function supprImage(id)
{
    ajaxMethode(function (data) {
        supprID("img" + id);
        console.log(data);
    }, [id, 'supprImage'], ['ID', 'type'], 'ajaxUse/traitement.php');
    return false;
}

function supprID(id)
{
    document.getElementById(id).remove();
}

function log(data) {
    if (data === "OK") {
        document.location.search = "?p=espace";
    } else {
        document.getElementById("errorform").innerHTML = data;
        document.getElementById("errorform").style.display = 'block';
    }
}

function logm(data) {
    if (data === "OK") {
        document.location.reload();
    } else {
        document.getElementById("errorform").innerHTML = data;
        document.getElementById("errorform").style.display = 'block';
    }
}

function completeInfo(data) {
    console.log(data);
    var tbl = JSON.parse(data);
    console.log(tbl);
    if (tbl["error"] >= 0)
    {
        document.getElementById('nom').innerHTML = tbl['nom'];
        document.getElementById('type').innerHTML = tbl['type'];
        document.getElementById('datage').innerHTML = tbl['datage'];
        document.getElementById('skip').innerHTML = tbl['skip'];
        document.getElementById('opt').innerHTML = tbl['opt'];
        document.getElementById('prixTotal').innerHTML = tbl['prixTotal'];
        document.getElementById('setLocation').style.display = "none";
        document.getElementById('getLocation').style.display = "block";
        document.getElementById('error').innerHTML = "";
        switch (tbl["error"])
        {
            case 0:
                document.getElementById('Nco').style.display = "none";
                document.getElementById('toutBon').style.display = "block";
                break;
            case 1:
                document.getElementById('toutBon').style.display = "none";
                document.getElementById('Nco').style.display = "block";
                break;
        }
        if(tbl['skip'] === "non")
        {
            document.getElementById('optionSansSkypper').style.display = "block";
        }
        else
        {
            document.getElementById('optionSansSkypper').style.display = "none";
        }
    } else
    {
        document.getElementById('error').innerHTML = tbl['type'];
    }
}

function loc(data) {
    if (data === "OK") {
        document.getElementById('Nco').style.display = "none";
        document.getElementById('toutBon').style.display = "block";
        document.getElementById('isco').style.display = "";
        document.getElementById('isnotco').style.display = "none";
    } else {
        document.getElementById("errorform").innerHTML = data;
        document.getElementById("errorform").style.display = 'block';
    }
}

function bateauLocation(callback = completeInfo)
{
    var id = document.getElementById('inputID').value;
    var dure = document.getElementById('reserveduraction').value;
    var date = document.getElementById('date').value;
    var skipper = document.getElementById('skipper').checked;
    var option = [];
    var all = document.getElementsByName('option[]');

    [...all].forEach(function (e) {
        if (e.checked)
        {
            option.push(e.value);
        }
    });

    ajaxMethode(callback, [id, dure, date, skipper, option, 'boatLoc'], ['ID', 'dure', 'date', 'skipper', 'option', 'type'], 'ajaxUse/bateauLocation.php');
    return false;

}