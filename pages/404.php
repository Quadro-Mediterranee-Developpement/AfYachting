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

    head($included, "Description de la page 404 adaptée au référencement", "Titre de la page 404 adaptée au référencement");
    ?>

    <body>

        <?php
        bloc_header(["Accueil","Bateau","Connexion","Contact","Inscription","Location","Ventes"]);

        
        illustation("",function(){textual("Erreur 404",TRUE,"La page que vous cherchez semble introuvable.","","");});


        footer();
        ?>

    </body>

<?php
}