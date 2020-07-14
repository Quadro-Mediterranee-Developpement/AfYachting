<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    $included = ["head", "header", "mosaic", 'textual', "footer", "foot"];
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }
    //TEXT
    head($included, "", "Page de gestion'ajout d'option");
    ?>

    <body>

        <?php
        bloc_header($menu);

        if (isset($_SESSION['ID'])) {
            if ($_SESSION['ID']['ROLE'] == 'admin' || ($_SESSION['ID']['ROLE'] == 'entreprise')) {
                if (isset($_GET['id']) && ($_SESSION['ID']['ROLE'] == 'admin' || bateauMANAGER::confirmeDonneeImage($_GET['id']) == $_SESSION['ID']['ID'])) {
                    ?>
                    <form action="traitementPOST/index.php?p=AddOption" method="post">
                        <br><br><br>
                        <input type="hidden" value="<?= $_GET['id'] ?>" name="id" id="id">
                        
                        <div class="form-label-group">
                            <label for="alt">Nom:</label>
                            <input type="text" value="" name="Nom" id="Nom" required>
                        </div>
                        <div class="form-label-group">
                            <label for="alt">description:</label>
                            <input type="text" value="" name="Description" id="Description" required>
                        </div>
                        <div class="form-label-group">
                            <label for="alt">Prix:</label>
                            <input type="number" value="" name="Prix" id="Prix" required>
                        </div>
                        <input type="submit" value="Ajouter l'option" name="Ajouter l'option">
                    </form>
                    <?php
                    require_once 'mod/carousel.php';
                    $option = bateauMANAGER::recupOPTION($_GET['id']);
                    foreach ($option as $i) {
                        ?>
                        <div id='option<?= $i['ID'] ?>'>
                            <br>
                            <br>
                            <br>
                            <p><strong>Nom:</strong><?= $i['name'] ?></p>
                            <p><strong>Description:</strong><?= $i['description'] ?></p>
                            <p><strong>Prix:</strong><?= $i['prix'] ?></p>
                            <a onClick='return supprOption(<?= $i['ID'] ?>);' href='#'>supprimer</a>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if (isset($_SESSION['erreur'])) {
                        echo $_SESSION['erreur']['desc'];
                    }
                    ?>
                    <script src="ajaxUse/XHR.js" type="text/javascript"></script>
                    <?php
                } else {
                    textual("accès illegale", true, ["cette page est apparue car vous êtes tomber sur une page qui nécessite l'accès par un lien dedié"]);
                }
            } else {
                //TEXT
                textual("Veuiller vous connecter avec un compte admin", true, ["cette page est apparue car vous êtes tombé sur une page où une connexion est exigée"]);
            }
        } else {
            //TEXT
            textual("Veuillez vous connecter", true, ["cette page est apparue car vous êtes tombé sur une page où une connexion est exigée"]);
        }
        ?>
                    <br><br><a <?= "href='index?p=lastpage'"; ?>"><img class="closer CloserWidth" src="img/close.png" alt=""/></a><br><br>
            <?php
            footer();

            foot($included);
            ?>

    </body>

    <?php
}