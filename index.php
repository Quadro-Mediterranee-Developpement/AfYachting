<?php
//gestion des variables de session

session_start();
if (isset($_GET['destroy'])) {
    if (isset($_SESSION['ID'])) {
        $_SESSION['news']['deconnexion'] = ['desc' => 'Vous êtes déconnecter', 'code' => false];
        unset($_SESSION['ID']);
    }
}
if (!isset($_SESSION['ActiveAjax'])) {
    $_SESSION['ActiveAjax'] = true;
}
if (!isset($_SESSION['activeBackPage'])) {
    $_SESSION['activeBackPage']['url'] = 'Accueil';
}

if (isset($_GET['ajax'])) {
    if ($_GET['ajax'] == 'false') {
        $_SESSION['ActiveAjax'] = false;
    } else if ($_GET['ajax'] == 'true') {
        $_SESSION['ActiveAjax'] = true;
    }
}

if (isset($_GET["validationEmail"])) {
    $code = filter_input(INPUT_GET, "validationEmail");
    if (compteMANAGER::validedation($code)) {
        $_SESSION['news']['email'] = ['desc' => 'email valider', 'code' => true];
    } else {
        $_SESSION['news']['email'] = ['desc' => 'code de validation invalide', 'code' => false];
    }
    $p = "accueil";
}

if (isset($_SESSION['ID'])) {
    switch ($_SESSION['ID']['ROLE']) {
        case 'admin':
            $menu = ["Accueil" => "Accueil", "Gestion" => "Gestion"];
            break;

        case 'skipper':
            $menu = ["Accueil" => "Accueil", "Espace" => "espace_skipper"];
            break;

        case 'client':
            $menu = ["Accueil" => "Accueil", "Location" => "Location", "Ventes" => "Ventes", "Contact" => "Contact", "Espace" => "espace_client"];
            break;

        case 'client_ponctuel':
            $menu = ["Accueil" => "Accueil", "Location" => "Location", "Ventes" => "Ventes", "Contact" => "Contact"];
            break;

        default:
            $menu = ["Accueil" => "Accueil", "Location" => "Location", "Ventes" => "Ventes", "Contact" => "Contact"];
            break;
    }
} else {
    $menu = ["Accueil" => "Accueil", "Location" => "Location", "Ventes" => "Ventes", "Contact" => "Contact"];
}

?>
<!DOCTYPE html>
<!--
Site officiel de la société AfYachting
Créé par QMD : Quadro Méditerranée Développement


Administration : Ange CAESARI
Architecture : Adrien ROUPIE
Front : Paul-Emile NEU
Back : Hugo MUSOLES
-->
<html lang="fr">
<?php
require 'BDDMANAGER/loaderBDD.php';

if (isset($_GET["p"])) {
    $p = filter_input(INPUT_GET, "p");
    if ($p == 'lastpage') {
        $p = $_SESSION['activeBackPage']['url'];
    }
} else {
    $p = "accueil";
}

$page = "pages/" . $p . ".php";

if (is_file($page)) {
    require $page;
} else {
    require "pages/404.php";
}


unset($_SESSION['news']);

unset($_SESSION['erreur']);
?>
</html>