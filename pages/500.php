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
    head($included, "Il semble que le serveur ait un problème pour charger cette page. Pour continuer cliquer sur un des liens situé dans la barre de navigation.", "Error 500");
    ?>

    <body>

        <?php
        bloc_header($menu);

        //TEXT
        illustation("carousel_test/img_slider_1",function(){textual("Erreur 500 : erreur serveur",FALSE,["Désolé, il semble que le serveur ait eu un problême.", "Veuillez réessayer plus tard."],"","");});


        footer();
        foot($included);
        ?>

    </body>

<?php
}