<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    require_once 'mod/head.php';
    require_once 'mod/header.php';
    require_once 'mod/carousel.php';
    require_once 'mod/contents.php';
    require_once 'mod/textual.php';
    require_once 'mod/illustration.php';
    require_once 'mod/footer.php';

    foreach ($included = get_included_files() as $i) {
        $buffer = explode(".", $i)[0];
        $next_buff = explode("/",$buffer);
        $i = end($next_buff);
    }

    head($included, "Page d'accueil du site Afyachting", "Page d'accueil");
    ?>

    <body>

        <?php
        bloc_header();

        carousel(["img/img_slider_1.png","img/img_slider_2.png","img/img_slider_3.png"]);


        contents("Louez un bateau",[["", "", "", "", "", ""], ["", "", "", "", "", ""], ["", "", "", "", "", ""]]);


        textual("",FALSE,"","","");

        
        illustation("",function(){textual("",TRUE,"","","");});


        footer();
        ?>

    </body>

<?php
}