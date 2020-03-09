<?php
require 'mod/vente_form.php';
require 'mod/mosaic.php';
require 'mod/header.php';
require 'mod/head.php';
require 'mod/footer.php';
$required = ["footer", "header", "ventes", "mosaic", "mosaic_ellement", "vente_form"];
$description = "Description de la page ventes adaptée au référencement";
$Title = "Titre de la page ventes adaptée au référencement";
head($required, $description, $Title);
?>
<body>

    <?php
    header()
    ?> <article class="ventes"><?php
    $mosaic = [["source_photo.jpg", "Informations", "Lorem ipsum sit dolor amet", "tags mis en classe pour le tri JS"], ["", "", "", ""], ["", "", "", ""], ["", "", "", ""], ["", "", "", ""]];

    mosaic($mosaic);
    vente_form();
    ?> </article> <?php
        footer();
        ?>

</body>