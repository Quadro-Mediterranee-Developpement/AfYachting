<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else if (!isset($_SESSION['ID'])) {
    header('Location: ../index?p=500');
    exit();
} else {
    $included = ["head","illustration", "header", "textual", "identityCard", "displayer", "depliant", "compte_mise_a_jour", "footer", "foot"];
    $_SESSION['activeBackPage']['url'] = $p;
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }


    head($included, "Description de la page contact adaptée au référencement", "Titre de la page contact adaptée au référencement");
    ?>

    <body>

    <?php
    bloc_header($menu);

    illustation("carousel_test/img_slider_3",function(){
        
        echo "<div class = 'text-center col'><h3>Gestionaire de compte " . $_SESSION['ID']['ROLE']."</h3><br><br>";
        $info = compteMANAGER::recupINFORMATIONone($_SESSION['ID']);
    identityCard($info[0], $info[1], $info[2], $info[3]);

    depliant("Editer votre compte", function() {
            compte_mise_a_jour($_SESSION['ActiveAjax']);
    });
    });
    
    footer();
    foot($included);
    ?>

    </body>

    <?php
}