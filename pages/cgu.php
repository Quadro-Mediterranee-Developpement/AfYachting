<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    $included = ["head","header","textual","footer","foot"];
 
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }
    //TEXT
    head($included, "Les CGU", "Les CGU d'AfYachting");
    ?>

    <body>

        <?php
        bloc_header($menu);

        //TEXT
        textual("Les conditions générales d'utilisation",FALSE,["Lorem ipsum sit dolor amet"],"","");


        footer();
        foot($included);
        ?>

    </body>

<?php
}