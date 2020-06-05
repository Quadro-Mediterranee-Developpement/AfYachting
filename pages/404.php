<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    $included = ["head","header","textual","illustration","footer","foot"];
 
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }

    head($included, "Description de la page 404 adaptée au référencement", "Titre de la page 404 adaptée au référencement");
    ?>

    <body>

        <?php
        bloc_header($menu);

        
        illustation("carousel_test/img_slider_1",function(){textual("Erreur 404",FALSE,["La page que vous cherchez semble introuvable."],"","");});


        footer();
        foot($included);
        ?>

    </body>

<?php
}