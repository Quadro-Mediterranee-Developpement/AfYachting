<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) || !isset($_SESSION['ID'])) {
    header('Location: ../index?p=404');
    exit();
} else if ($_SESSION['ID']['ROLE'] !== 'skipper') {
    header('Location: ../index?p=404');
    exit();
} else {



    $included = ["head", "header" ,"textual","illustration", "footer", "foot"];
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }

    head($included, "Description de la page d'accueil adaptée au référencement", "Titre de la page d'accueil adaptée au référencement");
    ?>

    <body>

        <?php
        bloc_header($menu);

        
        illustation("carousel_test/img_slider_1",function(){textual("Espace skipper",FALSE,["En construction"],"","");});


        footer();
        foot($included);
        ?>

    </body>

    <?php
}