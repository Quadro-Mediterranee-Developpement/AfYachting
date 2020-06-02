<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    $included = ["head","header","textual","illustration","footer","foot"];
 
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }

    head($included, "Page bad occurence 500", "Page bad occurence 500");
    ?>

    <body>

        <?php
        bloc_header();

        
        illustation("",function(){textual("Erreur 500 : erreur serveur",TRUE,"Désolé, il semble que le serveur ait eu un problême. Veuillez réessayer plus tard.","","");});


        footer();
        foot($included);
        ?>

    </body>

<?php
}