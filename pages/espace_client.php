<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) || !isset($_SESSION['ID'])) {
    header('Location: ../index?p=404');
    exit();
} else {


    $_SESSION['activeBackPage']['url'] = $p;
    $included = ["head", "header", "textual", "illustration",'iframe', "footer", "foot"];
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }

    head($included, "Description de la page d'accueil adaptée au référencement", "Titre de la page d'accueil adaptée au référencement");
    ?>

    <body>

        <?php
        bloc_header($menu);

        if (isset($_SESSION['ID'])) {
            if ($_SESSION['ID']['ROLE'] == 'client') {
                iframe("./mod/calendar","takeplace",true);
                illustation("carousel_test/img_slider_1", function() {
                    textual("Espace client", FALSE, ["En construction"], "", "");
                });
            } else {
                textual("Veuiller vous connectez avec un compte client", true, ["cette page est apparue car vous êtes tomber sur une page où une connexion est exigé"]);
            }
        } else {
            textual("Veuiller vous connectez", true, ["cette page est apparue car vous êtes tomber sur une page où une connexion est exigé"]);
        }



        footer();
        foot($included);
        ?>

    </body>

    <?php
}