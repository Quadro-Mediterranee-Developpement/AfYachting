<?php
require 'mod/head.php';
require 'mod/header.php';
require 'mod/contents.php';
require 'mod/footer.php';
$required = ["column", "contents", "footer", "header"];
$description = "Description de la page de location adaptée au référencement";
$Title = "Titre de la page de location adaptée au référencement";

head($required, $description, $Title);
?>

<body>

    <?php
    header();
    $content_title = "";
    $content_col = [["", "", "", "", "", ""], ["", "", "", "", "", ""], ["", "", "", "", "", ""]];
    contents($content_title, $content_col);
    footer();
    ?>

</body>