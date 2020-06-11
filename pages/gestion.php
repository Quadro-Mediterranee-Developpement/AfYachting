<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"]) || !isset($_SESSION['ID'])) {
    header('Location: ../index?p=404');
    exit();
} else {


    $_SESSION['activeBackPage']['url'] = $p;
    $included = ["head", "header", "displayer", "location_creat_form", 'afficheAllbateau', 'bateau_creat_form','iframe', 'modif_compte_form', 'depliant', 'afficheAllcompte', "new_compte_form", "footer", "foot"];
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }

    head($included, "Description de la page d'accueil adaptée au référencement", "Titre de la page d'accueil adaptée au référencement");
    ?>

    <body>

        <?php
        bloc_header($menu);

        if (isset($_SESSION['ID'])) {
            if ($_SESSION['ID']['ROLE'] == 'admin') {

                iframe("./mod/calendar", "takeplace", true);

                foreach (['admin' => 'admin', 'client' => 'client', 'skipper' => 'skipper'] as $k => $i) {
                    $info[$k] = compteMANAGER::recupINFORMATIONall($i);
                }

                afficheAllcompte($info);


                $infobat = bateauMANAGER::recupINFORMATIONall();

                afficheAllbateau($infobat);

                depliant("ajouter un compte", function($lien) {
                    displayer(null, null, function() {
                        new_compte_form($_SESSION['ActiveAjax']);
                    }, $lien);
                });

                depliant("modifier un compte", function($lien) {
                    displayer(null, null, function() {
                        modif_compte_form($_SESSION['ActiveAjax']);
                    }, $lien);
                });
                
                depliant("ajouter un bateau", function($lien) {
                    displayer(null, null, function() {
                        bateau_creat_form($_SESSION['ActiveAjax']);
                    }, $lien);
                });
            } else {
                textual("Veuiller vous connectez avec un compte admin", true, ["cette page est apparue car vous êtes tomber sur une page où une connexion est exigé"]);
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