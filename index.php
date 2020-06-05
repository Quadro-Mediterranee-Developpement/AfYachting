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
 
    $menu = ["Accueil" => "Accueil", "Connexion" => "Connexion", "Contact" => "Contact", "Inscription" => "Inscription", "Location" => "Location", "Ventes" => "Ventes"];
    if (isset($_SESSION['ID'])) {
        unset($menu["Connexion"]);
        unset($menu["Inscription"]);
        $menu['Compte'] = 'Compte';
        if ($_SESSION['ID']['ROLE'] === 'admin') {
            $menu['Gestion'] = 'gestion';
        }
    }

    $page = "pages/" . $p . ".php";

    if (is_file($page)) {
        require $page;
    } else {
        require "pages/404.php";
    }
    ?>
</html>