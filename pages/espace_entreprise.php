<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {


    $_SESSION['activeBackPage']['url'] = $p;
    $included = ["head", "header", "textual", 'depliant', "bateau_creat_form","afficheAllbateau", "displayer", "illustration", 'iframe', "footer", "foot"];
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }
    //TEXT
    head($included, "Retrouvez ici votre espace de gestion", "Espace skipper");
    ?>

    <body>

        <?php
        bloc_header($menu);

        if (isset($_SESSION['ID'])) {
            if ($_SESSION['ID']['ROLE'] == 'entreprise') {

                iframe("./mod/calendar", "takeplace", true);
                $infobat = bateauMANAGER::recupINFORMATIONallbyEntreprise($_SESSION['ID']['ID']);

                afficheAllbateau($infobat);
                depliant("ajouter un bateau", function($lien) {
                    displayer(null, null, function() {
                        bateau_creat_form($_SESSION['ActiveAjax']);
                    }, $lien);
                });
            } else {
                //TEXT
                textual("Veuiller vous connectez avec un compte entreprise", true, ["cette page est apparue car vous êtes tomber sur une page où une connexion est exigé"]);
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