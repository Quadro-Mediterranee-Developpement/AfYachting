<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    require_once 'mod/head.php';
    require_once 'mod/displayer.php';
    require_once 'mod/inscription_form.php';

    foreach ($included = get_included_files() as $i) {
        $i = end(explode("/",explode(".", $i)[0]));
    }

    head($included, "Page d'inscription du site Afyachting", "Page d'inscription");
    ?>

    <body>

        <?php
        
            display("", "", function(){inscription_form();});
        
        ?>

    </body>

<?php
}