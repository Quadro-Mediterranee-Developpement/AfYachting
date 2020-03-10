<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    require_once 'mod/head.php';
    require_once 'mod/displayer.php';
    require_once 'mod/connexion_form.php';

    foreach ($included = get_included_files() as $i) {
        $i = end(explode("/",explode(".", $i)[0]));
    }

    head($included, "Description de la page connexion adaptée au référencement", "Titre de la page connexion adaptée au référencement");
    ?>

    <body>

        <?php
        
            display("", "", function(){connexion_form();});
        
        ?>

    </body>

<?php
}