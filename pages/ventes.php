<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    require_once 'mod/head.php';
    require_once 'mod/header.php';
    require_once 'mod/vente_form.php';
    require_once 'mod/mosaic.php';
    require_once 'mod/footer.php';

    foreach ($included = get_included_files() as $i) {
        $buffer = explode(".", $i)[0];
        $next_buff = explode("/",$buffer);
        $i = end($next_buff);
    }

    head($included, "Vente de bateau Afyachting", "Page de vente");
    ?>

    <body>

        <?php
        bloc_header();
        
        
        ?> <article class="ventes"><?php

        
            mosaic([["source_photo.jpg", "Informations", "Lorem ipsum sit dolor amet", "tags mis en classe pour le tri JS"], ["", "", "", ""], ["", "", "", ""], ["", "", "", ""], ["", "", "", ""]]);
            
            
            vente_form();
        
        
        ?> </article> <?php


        footer();
        ?>

    </body>

<?php
}