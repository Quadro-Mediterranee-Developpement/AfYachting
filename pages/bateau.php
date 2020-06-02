<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    require_once 'mod/head.php';
    require_once 'mod/header.php';
    require_once 'mod/column.php';
    require_once 'mod/bateau_form.php';
    require_once 'mod/footer.php';

    foreach ($included = get_included_files() as $i) {
        $buffer = explode(".", $i)[0];
        $next_buff = explode("/",$buffer);
        $i = end($next_buff);
    }

    head($included, "Page bateau du site Afyachting", "Page Bateau");
    ?>

    <body>

        <?php
        bloc_header();

        
        ?> <article class="bateau"><?php
        
        column("","","","","","");
        
        bateau_form();
        
        ?> </article> <?php


        footer();
        ?>

    </body>

<?php
}