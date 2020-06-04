<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    $included = ["head","header","column","bateau_form","textual","footer","foot"];
 
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }


    head($included, "Description de la page bateau adaptée au référencement", "Titre de la page bateau adaptée au référencement");
    ?>

    <body>

        <?php
        bloc_header(["Accueil","Bateau","Connexion","Contact","Inscription","Location","Ventes"]);
        
        bateau_form();
        
       column([["image1", ["carousel_test/img_slider_1","carousel_test/img_slider_1","carousel_test/img_slider_1","carousel_test/img_slider_1"], "l'image 1", "quoi?", "GigahBigah", "GigahBigah"]]);

        
        footer();
        foot($included);
        ?>

    </body>

<?php
}