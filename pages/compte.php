<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    $included = ["head", "header", "compte_info", "textual", "identityCard", "displayer", "depliant", "compte_mise_a_jour", "footer", "foot"];
    $_SESSION['activeBackPage']['url'] = $p;
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }


    head($included, "Description de la page contact adaptée au référencement", "Titre de la page contact adaptée au référencement");
    ?>

    <body>

        <?php
        bloc_header($menu);
        if (isset($_SESSION['ID'])) {
            textual("espace du compte " . $_SESSION['ID']['ROLE'], true, [compte_info()]);
            $info = compteMANAGER::recupINFORMATIONone($_SESSION['ID']);
            identityCard($info[0], $info[1], $info[2], $info[3]);

            depliant("faire des modifications", function($lien) {
                displayer(null, null, function() {
                    compte_mise_a_jour($_SESSION['ActiveAjax']);
                }, $lien);
            });
        } else {
            textual("Veuiller vous connectez", true, ["cette page est apparue car vous êtes tomber sur une page où une connexion est exigé"]);
        }
        footer();
        foot($included);
        ?>

    </body>

    <?php
}