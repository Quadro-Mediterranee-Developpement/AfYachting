<?php


if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) || !isset($_SESSION['ID'])) {
    header('Location: ../index?p=404');
    exit();
} else {
    $included = ["head","header","compte_info","footer","foot"];
    $_SESSION['activeBackPage']['url'] = $p;
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }
 

    head($included, "Description de la page contact adaptée au référencement", "Titre de la page contact adaptée au référencement");
    ?>

    <body>

        <?php
        bloc_header($menu);
        
        compte_info();
        
        footer();
        foot($included);
        ?>

    </body>

<?php
}