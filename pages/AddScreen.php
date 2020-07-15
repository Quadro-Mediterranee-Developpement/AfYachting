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
    head($included, "", "Page d'ajout d'image");
    ?>

    <body>

        <?php
        bloc_header($menu);

        if (isset($_SESSION['ID'])) {
            if ($_SESSION['ID']['ROLE'] == 'admin' || ($_SESSION['ID']['ROLE'] == 'entreprise')) {
                if (isset($_GET['id']) && isset($_GET['destination']) && ($_SESSION['ID']['ROLE'] == 'admin' || bateauMANAGER::confirmeDonneeImage($_GET['id']) == $_SESSION['ID']['ID'])) {
                    ?>
                    <form action="traitementPOST/index.php?p=AddScreen" method="post" enctype="multipart/form-data">

                        <input type="hidden" value="<?= $_GET['id'] ?>" name="id" id="id">
                        <input type="hidden" value="<?= $_GET['destination'] ?>" name="location" id="location">
                        <div class="form-label-group">
                            <label for="alt">description:</label>
                            <input type="text" value="" name="alt" id="alt">
                        </div>
                        <div class="form-label-group">
                            <label for="fileToUpload">l'image à ajouté</label>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <input type="submit" value="Upload Image" name="submit">
                        </div>
                    </form>
                    <?php
                    if (isset($_SESSION['erreur'])) {
                        echo $_SESSION['erreur']['desc'];
                    }
                    $images = loaderBDD::image($_GET['id']);
                    $all = [];
                    foreach ($images as $i) {
                        $all[] = [$i[0], "<a onClick='return supprImage($i[2]);' href='#'>supprimer</a>", $i[1], [], "$i[2]"];
                    }
                    mosaic($all);
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