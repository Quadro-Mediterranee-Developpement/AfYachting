<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    require_once 'mod/head.php';
    require_once 'mod/header.php';
    require_once 'mod/contact_form.php';
    require_once 'mod/illustration.php';
    require_once 'mod/footer.php';

    foreach ($included = get_included_files() as $i) {
        $buffer = explode(".", $i)[0];
        $next_buff = explode("/",$buffer);
        $i = end($next_buff);
    }

    head($included, "Page de contact du site Afyachting", "Page de contact");
    ?>

    <body>

        <?php
        bloc_header();

        
        illustation("",function(){contact_form();});


        footer();
        ?>

    </body>

<?php
}