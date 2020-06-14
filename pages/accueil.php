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
    head($included, "Pages d'accueil AfYatching présentation information", "AfYatching");
    ?>

    <body>

        <?php
        bloc_header($menu);

        popup();
        //TEXT
        carousel([['Url' => "carousel_test/img_slider_1", 'Alt_Description' => 'image 1'], ['Url' => "carousel_test/img_slider_2", 'Alt_Description' => 'image 2'], ['Url' => "carousel_test/img_slider_3", 'Alt_Description' => 'image 3']]);
        //TEXT
        contents("Location de bateaux", [["Grand bateau", [['Url' => "carousel_test/img_slider_1", 'Alt_Description' => 'image'], ['Url' => "carousel_test/img_slider_2", 'Alt_Description' => 'image'], ['Url' => "carousel_test/img_slider_3", 'Alt_Description' => 'image']],null ,"Grand de taille", "Je vais voir", "location&bat=big"], ["Moyen bateau", "boat2", null, "Des bateaux de taille moyenne", "Je vais voir", "location&bat=midle"], ["Petit bateau", "boat1", null, "Indisponible", null,null]]);
        //TEXT
        textual("Location toute la saison", FALSE, ["Notre objectif est d'être une référence en matière de location de yachts, et c'est pourquoi nous sommes vraiment impatients de développer une relation personnelle avec tous nos clients. De toute évidence, c'est la seule façon de satisfaire tous les besoins et exigences et c'est pourquoi nous tenons à nous rapprocher de vos véritables désirs en matière de plaisance."], null, null);
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