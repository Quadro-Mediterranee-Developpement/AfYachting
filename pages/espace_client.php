<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {


    $_SESSION['activeBackPage']['url'] = $p;
    $included = ["head", "header", "textual", "illustration", 'iframe', "footer", "foot"];
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }
    //TEXT
    head($included, "", "Espace client");
    ?>

    <body>

        <?php
        bloc_header($menu);

        if (isset($_SESSION['ID'])) {
            if ($_SESSION['ID']['ROLE'] == 'client') {
                //iframe("./mod/calendar","takeplace",true);
                //TEXT
                illustation("carousel_test/img_slider_1", function() {
                    textual("Espace client", FALSE, ["En construction"], "", "");
                });
            } else {
                //TEXT
                textual("Veuiller vous connectez avec un compte client", true, ["cette page est apparue car vous êtes tomber sur une page où une connexion est exigé"]);
            }
        } else {
            //TEXT
            textual("Veuiller vous connectez", true, ["cette page est apparue car vous êtes tomber sur une page où une connexion est exigée"]);
        }



        footer();
        foot($included);
        ?>

    </body>

    <?php
}