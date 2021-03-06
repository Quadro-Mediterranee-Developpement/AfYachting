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


    head($included, "Retrouvez l'ensemble des informations du bateau", "Page bateau");
    ?>

    <body>

        <?php
        bloc_header($menu);

        if (isset($_GET["vente"])) {
            ?>

        <div class="formBox mt-4 text-center"><h3><a class="text-white" href="index?p=contact">Vous êtes intéressés ?<br><br>Contactez nous !</a></h3></div>

            <?php
        } else {
            bateau_form($_GET['ID'],true);
        }



        $bat = bateauMANAGER::recupINFORMATIONone($_GET['ID']);

        $img = loaderBDD::image($bat[0]["ID_images"]);

        $str = str_replace(";", "</li><li>", $bat[0]["Equipement"]);

        $str = "<b>Equipements :</b></p><ul class='text-center' style='list-style-type:none;'><i><li>" . $str . "</li></ul></i>";
        
        if (isset($_GET["vente"])) {
            column([[$bat[0]["Nom"], $img, number_format($bat[0]["Prix"], 0, ',', ' ')." &euro;", "<b>".$bat[0]["Description"]."</b><br>".$bat[0]["Moteur"] . "<br><br>Mis en circulation en <i class='font-weight-bold'>". strval($bat[0]["Age"])."<br>" . $bat[0]["State"] ."<br>" . $bat[0]["Passagers"] . " personnes<br>" . number_format($bat[0]["Longueur"], 0, '.', ',')." m / ".number_format($bat[0]["Largeur"], 0, '.', ',')." m</i><br><br>" . $bat[0]["Divers"] . "<br><br>" . $str, "GigahBigah", "GigahBigah"]]);

        }
        else {
            column([[$bat[0]["Nom"], $img, $bat[0]["Description"], $bat[0]["Moteur"] . "<br><i class='font-weight-bold'>" . $bat[0]["Passagers"] . " personnes<br>" . number_format($bat[0]["Longueur"], 0, '.', ',')." m / ".number_format($bat[0]["Largeur"], 0, '.', ',')." m</i><br><br>" . $bat[0]["Divers"] . "<br><br>" . $str, "GigahBigah", "GigahBigah"]]);
        }

        echo '<div class="blank5"></div>';
        echo '<div id="Centragegauche">';
        textual("Saison de location", FALSE, ["<b>La haute Saison</b> : Du <b><i>1er juillet au 31 Aout</b></i> inclus et pendant les voiles de saint Tropez du <b><i>28 septembre</b></i> au <b><i>15 octobre</b></i><br><br><b>La basse Saison :</b> du <b><i>1er mars</b></i> au <b><i>30 juin</b><i>, du <b><i>1er septembre</b></i> au <b><i>27 septembre</b></i> et du <b><i>16 octobre</b></i> au <b><i>31 octobre</b></i>.<br><br>Nous sommes en cale-sèche le reste de l'année,  du <b></i>1er novembre</i></b> au <b><i>dernier jour de février</b></i>."], null, null);
        //TEXT
        
        echo '</div>';
        
        footer();
        foot($included);
        ?>

    </body>

    <?php
}