<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {


    $_SESSION['activeBackPage']['url'] = $p;
    $included = ["head", "header", "displayer", "location_creat_form", 'textual', 'afficheAllbateau', 'bateau_creat_form', 'iframe', 'modif_compte_form', 'depliant', 'afficheAllcompte', "new_compte_form", "footer", "foot"];
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }
    //TEXT
    head($included, "", "Page de gestion");
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
                //TEXT
                depliant("ajouter un compte", function($lien) {
                    displayer(null, null, function() {
                        new_compte_form($_SESSION['ActiveAjax']);
                    }, $lien);
                });
                //TEXT
                depliant("modifier un compte", function($lien) {
                    displayer(null, null, function() {
                        modif_compte_form($_SESSION['ActiveAjax']);
                    }, $lien);
                });
                //TEXT
                depliant("ajouter un bateau", function($lien) {
                    displayer(null, null, function() {
                        bateau_creat_form($_SESSION['ActiveAjax']);
                    }, $lien);
                });
            } else {
                //TEXT
                textual("Veuiller vous connectez avec un compte admin", true, ["cette page est apparue car vous êtes tomber sur une page où une connexion est exigé"]);
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