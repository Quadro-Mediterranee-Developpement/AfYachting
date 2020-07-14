<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    $included = ["head", "header", "mosaic", 'textual', "footer", "identityCardBoat", "foot"];
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }
    //TEXT
    head($included, "", "Page de gestion de vente");
    ?>

    <body>

        <?php
        bloc_header($menu);

        if (isset($_SESSION['ID'])) {
            if ($_SESSION['ID']['ROLE'] == 'admin') {
                if (isset($_GET['id']) && ($_SESSION['ID']['ROLE'] == 'admin')) {
                    ?>
                    <form action="traitementPOST/index.php?p=SetVente" method="post">

                        <input type="hidden" value="<?= $_GET['id'] ?>" name="id" id="id">
                        <p>Si un des champs reste vide, le mode vente sera supprimé</p>
                        <div class="form-label-group">
                            <label for="alt">Age:</label>
                            <input type="number" value="" name="Age" id="Age" >
                        </div>
                        <div class="form-label-group">
                            <label for="alt">état:</label>
                            <input type="text" value="" name="State" id="State" >
                        </div>
                        <div class="form-label-group">
                            <label for="alt">Largeur:</label>
                            <input type="number" value="" name="Largeur" id="Largeur" >
                        </div>
                        <div class="form-label-group">
                            <label for="alt">Prix:</label>
                            <input type="number" value="" name="Prix" id="Prix" >
                        </div>
                        <input type="submit" value="ajouter/modifier" name="ajouter/modifier">
                    </form>
                    <?php
                    $info = bateauMANAGER::recupINFORMATIONone($_GET['id']);
                    identityCardBoat($info[0]);
                    ?>
                    <?php
                    if (isset($_SESSION['erreur'])) {
                        echo $_SESSION['erreur']['desc'];
                    }
                    ?>
                    <script src="ajaxUse/XHR.js" type="text/javascript"></script>
                    <?php
                } else {
                    textual("accès illegale", true, ["cette page est apparue car vous êtes tomber sur une page qui nécessite l'accès par un lien dedier"]);
                }
            } else {
                //TEXT
                textual("Veuiller vous connectez avec un compte admin", true, ["cette page est apparue car vous êtes tomber sur une page où une connexion est exigé"]);
            }
        } else {
            //TEXT
            textual("Veuiller vous connectez", true, ["cette page est apparue car vous êtes tomber sur une page où une connexion est exigée"]);
        }
        ?>
        <a <?= "href='index?p=lastpage'"; ?>"><img class="closer" src="img/close.png" alt=""/></a>
            <?php
            footer();

            foot($included);
            ?>

    </body>

    <?php
}