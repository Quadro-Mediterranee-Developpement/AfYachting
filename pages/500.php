<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    require_once 'mod/head.php';
    require_once 'mod/header.php';
    require_once 'mod/textual.php';
    require_once 'mod/illustration.php';
    require_once 'mod/footer.php';

    foreach ($included = get_included_files() as $i) {
        $buffer = explode(".", $i)[0];
        $next_buff = explode("/",$buffer);
        $i = end($next_buff);
    }

    head($included, "Page bad occurence 500", "Page bad occurence 500");
    ?>

    <body>

        <?php
        bloc_header();

        
        illustation("",function(){textual("Erreur 500 : erreur serveur",TRUE,"Désolé, il semble que le serveur ait eu un problême. Veuillez réessayer plus tard.","","");});


        footer();
        ?>

    </body>

<?php
}