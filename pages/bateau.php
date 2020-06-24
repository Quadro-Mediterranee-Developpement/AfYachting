<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index.php?p=404');
    exit();
} else if (!isset($_GET['ID'])) {
    header('Location: index.php?p=bateau&ID=1');
    exit();
} else {
    $included = ["head", "header", "column", "bateau_form", "textual", "footer", "foot"];
    $_SESSION['activeBackPage']['url'] = $p;
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }
    
    unset($i);


    head($included, "Description de la page bateau adaptée au référencement", "Titre de la page bateau adaptée au référencement");
    ?>

    <body>

        <?php
        bloc_header($menu);

        bateau_form();
        
        $bat = bateauMANAGER::recupINFORMATIONone($_GET['ID']);
        
        $img = loaderBDD::image($bat[0]["ID_images"]);
        
        $str = str_replace(";", "</li><li>", $bat[0]["Equipement"]);
        
        $str = "<b>Equipements :</b></p><ul class='text-center' style='list-style-type:none;'><i><li>".$str."</li></ul></i>";
        
        column([[$bat[0]["Nom"], $img ,$bat[0]["Description"],$bat[0]["Moteur"]."<br><i class='font-weight-bold'>".$bat[0]["Passagers"]." personnes<br>".number_format($bat[0]["Longueur"], 0, '.', ',')." mètres</i><br><br>".$bat[0]["Divers"]."<br><br>".$str,"GigahBigah", "GigahBigah"]]);

        footer();
        foot($included);
        ?>

    </body>

    <?php
}