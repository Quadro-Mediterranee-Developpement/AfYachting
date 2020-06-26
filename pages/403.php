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
    head($included, "Il vous est interdit d'accéder à cette page", "Error 403");
    ?>

    <body>

        <?php
        bloc_header($menu);

        //TEXT
        illustation("carousel_test/img_slider_1",function(){textual("Erreur 403 : accès refusé",FALSE,["Désolé, mais vous n'avez pas les droits pour accéder à cette page ou ce contenu.", "Il se peut que votre session ait expiré, et vous êtes donc invité à vous reconnecter."],"","");});


        footer();
        foot($included);
        ?>

    </body>

<?php
}