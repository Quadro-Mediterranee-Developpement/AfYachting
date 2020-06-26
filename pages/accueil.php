<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    $included = ["head", "header", "popup", "carousel", "column", "contents", "textual", "illustration", "footer", "foot"];
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }
    $_SESSION['activeBackPage']['url'] = $p;
    //TEXT
    head($included, "Pages d'accueil", "AfYatching");
    ?>

    <body>

        <?php
        bloc_header($menu);

        popup();
        //TEXT
        carousel([['Url' => "carousel_test/img_slider_1", 'Alt_Description' => 'image 1'], ['Url' => "carousel_test/img_slider_2", 'Alt_Description' => 'image 2'], ['Url' => "carousel_test/img_slider_3", 'Alt_Description' => 'image 3']]);
        //TEXT
        contents("Nos services", [["Location", "boat2", null, "Vous souhaitez vous reposer et passer une journée calme dans une baie couleur lagon avec toute la famille ou vos amis ? Au contraire vous souhaitez prendre le contrôle et conduire un de nos bateaux ? Alors n'attendez plus et venez profiter du large choix parmi nos gammes de bateaux et leur nombreuses options !", "En savoir plus", "location"], ["Vente", "boat1", null, "Vous souhaitez faire l'acquisition d'un bateau ? Semi rigide, rigide ou prestige ? Ici nous faisons le recensement de l'ensemble des bateaux à vendre dont nous disposons. Vous trouverez, parmi un large choix de gammes le bateaux de vos rêves avec toutes les informations dont vous avez besoin !", "En savoir plus","vente"]]);
        //TEXT
        textual("Saison de location", FALSE, ["<b>La haute Saison</b> : Du <b><i>1er juillet au 31 Aout</b></i> inclus et pendant les voiles de saint Tropez du <b><i>28 septembre</b></i> au <b><i>15 octobre</b></i><br><br><b>La basse Saison :</b> du <b><i>1er mars</b></i> au <b><i>30 juin</b><i>, du <b><i>1er septembre</b></i> au <b><i>27 septembre</b></i> et du <b><i>16 octobre</b></i> au <b><i>31 octobre</b></i>.<br><br>Nous sommes en cale-sèche le reste de l'année,  du <b></i>1er novembre</i></b> au <b><i>dernier jour de février</b></i>."], null, null);
        //TEXT
        illustation("carousel_test/img_slider_1", (function() {
                    textual("A propos de AfYachting", FALSE, ["En raison de notre passion pour le yachting et la voile, chez AfYachting, nous maintenons une flotte de yachts nouvellement acquise qui répond à toutes les normes mondiales en matière de plaisance et de plaisance professionnelle, ainsi qu'un intérêt incessant à couvrir tous les besoins et exigences concernant divers services maritimes, destinations de voile et assistance technique.", "En ce qui concerne les chartes de yachts flexibles et haut de gamme et une gamme vraiment étendue de services et d'offres de yachting, il est temps de faire un choix pour la vie avec AfYachting! Vous pouvez maintenant profiter de toute la crédibilité et la qualité que vous et vos clients recherchez toujours. ", "Faites le tour et voyez par vous-même: la  plaisance à son meilleur commence avec AfYachting!"], null, null);
                }));
        footer();

        foot($included);
        ?>

    </body>

    <?php
}