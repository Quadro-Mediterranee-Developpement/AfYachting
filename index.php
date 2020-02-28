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

    if (isset($_GET["p"])){
        $p = filter_input(INPUT_GET, "p");
    }

    else { $p = "accueil";}

    $page = "pages/".$p.".php";

    if(is_file($page)){
        require $page;
    }

    else {
        require "pages/404.php";
    }

    ?>
</html>