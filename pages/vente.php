<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    $included = ["head", "header", "vente_form", "textual", "mosaic", "footer", "foot"];

    foreach ($included as $i) {
        require_once "mod/$i.php";
    }

    $_SESSION['activeBackPage']['url'] = $p;
    //TEXT
    head($included, "Bateau disponible à la vente pour une qualité imbatable", "Vente de bateau");
    ?>

    <body>

        <?php
        bloc_header($menu);
        //TEXT
        textual("Achetez un bateau", FALSE, ["Vous trouverez sur cette page une sélection parmis un large choix de tous les bateaux disponibles à la vente chez AfYachting."]);
        //TEXT 

        $bat = bateauMANAGER::recupINFORMATIONall();

        $returner = array();
        $buffout = array();
        $options = array();

        for ($i = 0; $i < count($bat); $i++) {

            if ($bat[$i]["Prix"] != 0 && $bat[$i]["Prix"] != null) {

                $img = loaderBDD::image($bat[$i]["ID_images"]);

                foreach (explode(";", trim($bat[0]["Equipement"], ";")) as $key => $value) {
                    if (!in_array($value, $options)) {
                        $options[] = $value;
                    }
                }

                $buffout = [$img[0]["Url"], number_format($bat[0]["Prix"], 0, ',', ' ') . " €", "<b>" . $bat[$i]["Nom"] . "</b><br>" . $bat[$i]["Description"] . "<br><br>Mis en circulation en " . $bat[$i]["Age"] . "<br>" . number_format($bat[$i]["Longueur"], 0, '.', ',') . " m / " . number_format($bat[$i]["Largeur"], 0, '.', ',') . " m", array_merge([$bat[$i]["Modele"]], explode(";", trim($bat[0]["Equipement"], ";"))), strval($bat[$i]["Option"])];

                array_push($returner, $buffout);
            }
        }
        
        sort($options);

        vente_form($options, (function($returner) {
                    mosaic($returner);
                }), $returner);

        footer();
        foot($included);
        ?>

    </body>

    <?php
}