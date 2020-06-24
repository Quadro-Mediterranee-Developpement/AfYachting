<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index.php?p=404');
    exit();
} else if (!isset($_GET['ID'])) {
    header('Location: index.php?p=bateau&ID=1');
    exit();
} else {
    $included = ["head", "header", "column", "bateau_form", "textual", "footer", "foot"];
    $_SESSION['activeBackPage']['url'] = $p;
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }


    head($included, "Description de la page bateau adaptée au référencement", "Titre de la page bateau adaptée au référencement");
    ?>

    <body>

        <?php
        bloc_header($menu);

        bateau_form();

        column([["image1", [["Url"=>"carousel_test/img_slider_1",'Alt_Description'=>"c'est le alt"], ["Url"=>"carousel_test/img_slider_1",'Alt_Description'=>"c'est le alt"],["Url"=>"carousel_test/img_slider_1",'Alt_Description'=>"c'est le alt"],["Url"=>"carousel_test/img_slider_1",'Alt_Description'=>"c'est le alt"]], "l'image 1", "quoi?", "GigahBigah", "GigahBigah"]]);


        footer();
        foot($included);
        ?>

    </body>

    <?php
}