<?php
session_start();
if (isset($_GET['destroy'])) {
    unset($_SESSION['ID']);
    session_destroy();
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
    } else {
        $p = "accueil";
    }
    $erreur = "Tous les champs doivent être  complétés !";

    if (isset($_SESSION['ID'])) {
        switch ($_SESSION['ID']['ROLE']) {
            case 'admin':
                $menu = ["Gestion" => "Gestion", "Compte" => "Compte"];
                break;

            case 'skipper':
                $menu = ["Espace" => "espace_skipper", "Compte" => "Compte"];
                break;

            case 'client':
                $menu = ["Accueil" => "Accueil", "Location" => "Location", "Ventes" => "Ventes", "Contact" => "Contact", "Compte" => "Compte"];
                break;

            default:
                $menu = ["Accueil" => "Accueil", "Location" => "Location", "Ventes" => "Ventes", "Contact" => "Contact", "Connexion" => "Connexion", "Inscription" => "Inscription"];
                break;
        }
    } else {
        $menu = ["Accueil" => "Accueil", "Location" => "Location", "Ventes" => "Ventes", "Contact" => "Contact", "Connexion" => "Connexion", "Inscription" => "Inscription"];

        if ($p == "Bateau" || $p == "bateau") {
            unset($menu['Connexion']);
            unset($menu['Inscription']);
        }
    }



    $page = "pages/" . $p . ".php";

    if (is_file($page)) {
        require $page;
    } else {
        require "pages/404.php";
    }
    unset($_SESSION['erreur']);
    ?>
</html>