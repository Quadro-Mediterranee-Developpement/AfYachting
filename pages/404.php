<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    $included = ["head","header","textual","illustration","footer","foot"];
 
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }
    //TEXT
    head($included, "La page à laquelle vous tentez d'accéder n'existe pas. Pour continuer cliquer sur un des liens situé dans la barre de navigation.", "Error 404");
    ?>

    <body>

        <?php
        bloc_header($menu);

        //TEXT
        illustation("carousel_test/img_slider_1",function(){textual("Erreur 404",FALSE,["La page que vous cherchez semble introuvable."],"","");});


        footer();
        foot($included);
        ?>

    </body>

<?php
}