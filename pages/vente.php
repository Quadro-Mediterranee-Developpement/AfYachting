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

        $bat = bateauMANAGER::recupINFORMATIONallVente();

        $returner = array();
        $buffout = array();
		$options = array();
		
        for ($i = 0; $i < count($bat); $i++) {
		    foreach (explode(";", trim($bat[0]["Equipement"], ";")) as $key => $value) {
                if (!in_array($value, $options)) {
                        $options[] = $value;
                }
            }
            $img = loaderBDD::image($bat[$i]["ID_images"]);
            $retour = "";
            if(isset($img[0]))
            {
                $retour = $img[0]["Url"];
            }
            $buffout = [$retour, number_format($bat[0]["Prix"], 0, ',', ' ') . " €", "<b>" . $bat[$i]["Nom"] . "</b><br>" . $bat[$i]["Description"] . "<br><br>Mis en circulation en " . $bat[$i]["Age"] . "<br>" . number_format($bat[$i]["Longueur"], 0, '.', ',') . " m / " . number_format($bat[$i]["Largeur"], 0, '.', ',') . " m", array_merge([$bat[$i]["Modele"]], explode(";", trim($bat[0]["Equipement"], ";"))), strval($bat[$i]["Option"])];

            array_push($returner, $buffout);
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