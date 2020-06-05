<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    if (isset($_SESSION['ID'])) {
        if ($_SESSION['ID']['ROLE'] !== 'admin') {
            header('Location: index?p=404');
            exit();
        }
    } else {
        header('Location: index?p=404');
        exit();
    }


    $included = ["head", "header", "vente_creat_form", "location_creat_form", "skippeur_creat_form", "footer", "foot"];
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }

    head($included, "Description de la page d'accueil adaptée au référencement", "Titre de la page d'accueil adaptée au référencement");
    ?>

    <body>

        <?php
        bloc_header($menu);

        //vente_creat_form();

        location_creat_form();
        
        //skippeur_creat_form();
        
        footer();

        foot($included);
        ?>

    </body>

    <?php
}