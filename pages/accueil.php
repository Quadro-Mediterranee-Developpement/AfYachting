<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    $included = ["head","header","carousel","contents","textual","illustration","footer","foot"];
 
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }

    head($included, "Description de la page d'accueil adaptée au référencement", "Titre de la page d'accueil adaptée au référencement");
    ?>

    <body>

        <?php
        bloc_header(["Accueil","Bateau","Connexion","Contact","Inscription","Location","Ventes","Notre équipe"]);


        carousel(["carousel_test/img_slider_1","carousel_test/img_slider_2","carousel_test/img_slider_3"]);


        contents("Location de bateaux",[["image1", "carousel_test/img_slider_1", "l'image 1", "quoi?", "IMAge1", "location&bat=image1"],["image1", "carousel_test/img_slider_1", "l'image 1", "quoi?", "IMAge1", "location&bat=image1"], ["image1", "carousel_test/img_slider_1", "l'image 1", "quoi?", "IMAge1", "location&bat=image1"], ["image1", "carousel_test/img_slider_1", "l'image 1", "quoi?", "IMAge1", "location&bat=image1"]]);

        
        textual("Location toute la saison",FALSE,["Ob haec et huius modi multa, quae cernebantur in paucis, omnibus timeri sunt coepta. et ne tot malisissimulatis paulatimque serpentibus acervi crescerent aerumnarum,nobilitatis decreto legati mittuntur: Praetextatus ex urbi praefecto et ex vicario Venustus et ex consulariMinervius oraturi, ne delictis supplicia sint grandiora, neve senator quisquam inusitato et inlicito more tormentis exponeretur."],"","");

        
        illustation("carousel_test/img_slider_1","A propos de AfYachting",["Quibus ita sceleste patratis Paulus cruore perfusus reversusque ad principis castra multos coopertos paene catenis adduxit in squalorem deiectos atque maestitiam,","quorum adventu intendebantur eculei uncosque parabat carnifex et tormenta. et ex is proscripti sunt plures actique in exilium alii, non nullos gladii","consumpsere poenales. nec enim quisquam facile meminit sub Constantio, ubi susurro tenus haec movebantur, quemquam absolutum."]);

        footer();
        
        foot($included);
        ?>

    </body>

<?php
}