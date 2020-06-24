<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    $included = ["head", "header", "column", "textual", "footer", "foot"];
    $_SESSION['activeBackPage']['url'] = $p;
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }

    require_once 'BDDMANAGER/bateauMANAGER.php';
    require_once 'BDDMANAGER/loaderBDD.php';

    //TEXT
    head($included, "Bateau disponible à la location pour une qualité imbatable", "Location de bateau");
    ?>

    <body>

        <?php
        bloc_header($menu);

        if (!isset($_GET["type"])) {

            textual("Louez un bateau", FALSE, ["Réservez directement en ligne de manière sécurisée et louez le bateau ou voilier de vos rêves en quelques clics. Vous ne serez débité qu’en cas d’acceptation de votre demande de location par le propriétaire du bateau. Paiement 100% sécurisé."], "", "");

            column([["Coque rigide", "carousel_test/img_slider_1", "Un large choix de bateaux à coques rigides.", " ", "En savoir plus", "location&type=rigide"], ["Coque semi-rigide", "carousel_test/img_slider_2", "Un large choix de bateaux à coques semi-rigides.", " ", "En savoir plus", "location&type=semi"], ["Gamme prestige", "carousel_test/img_slider_3", "Un large choix de bateaux prestigieux.", " ", "En savoir plus", "location&type=prestige"]]);
        } else if ($_GET["type"] == "rigide" || $_GET["type"] == "semi" || $_GET["type"] == "prestige") {
            
            $batmanager = new bateauMANAGER();
            $imgmanager = new loaderBDD();

            $bat = $batmanager->recupINFORMATIONall();

            $returner = array();
            $buffout = array();

            for ($i = 0; $i < count($bat); $i++) {

                if ($bat[$i]["Modele"] == $_GET["type"]) {

                    $img = $imgmanager->image($bat[$i]["ID_images"]);

                    $buffout = [$bat[$i]["Nom"], $img ,$bat[$i]["Description"],$bat[$i]["Moteur"]."<br><i class='font-weight-bold'>".$bat[$i]["Passagers"]." personnes</i><br><br><b class='text-primary'>".number_format($bat[$i]["HS"], 0, '.', ',')." €</b> en haute saison<br><b class='text-primary'>".number_format($bat[$i]["MS"], 0, '.', ',')." €</b> le reste de la saison<br><i class='font-weight-light'>Caution : ".number_format($bat[$i]["Caution"], 0, '.', ',')." €</i>","Réserver","bateau&ID=".strval($bat[$i]["Option"])];

                    array_push($returner, $buffout);
                }
            }
            
            column($returner);
            
        } else {

            textual("Louez un bateau", FALSE, ["Réservez directement en ligne de manière sécurisée et louez le bateau ou voilier de vos rêves en quelques clics. Vous ne serez débité qu’en cas d’acceptation de votre demande de location par le propriétaire du bateau. Paiement 100% sécurisé."], "", "");

            column([["Coque rigide", "carousel_test/img_slider_1", "Un large choix de bateaux à coques rigides.", " ", "En savoir plus", "location&type=rigide"], ["Coque semi-rigide", "carousel_test/img_slider_2", "Un large choix de bateaux à coques semi-rigides.", " ", "En savoir plus", "location&type=semi"], ["Gamme prestige", "carousel_test/img_slider_3", "Un large choix de bateaux prestigieux.", " ", "En savoir plus", "location&type=prestige"]]);
        }

        footer();

        foot($included);
        ?>

    </body>

        <?php
    }
