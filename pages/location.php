<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    $included = ["head","header","column","textual","footer","foot"];
 
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }


    head($included, "Description de la page bateau adaptée au référencement", "Titre de la page bateau adaptée au référencement");
    ?>

    <body>

        <?php
        bloc_header($menu);

        textual("Louez un bateau",FALSE,["Ob haec et huius modi multa, quae cernebantur in paucis, omnibus timeri sunt coepta. et ne tot malisissimulatis paulatimque serpentibus acervi crescerent aerumnarum,nobilitatis decreto legati mittuntur: Praetextatus ex urbi praefecto et ex vicario Venustus et ex consulariMinervius oraturi, ne delictis supplicia sint grandiora, neve senator quisquam inusitato et inlicito more tormentis exponeretur."],"","");

        column([["image1", "carousel_test/img_slider_1", "l'image 1", "quoi?", "IMAge1", "location&bat=image1"],["image1", "carousel_test/img_slider_1", "l'image 1", "quoi?", "IMAge1", "location&bat=image1"], ["image1", "carousel_test/img_slider_1", "l'image 1", "quoi?", "IMAge1", "location&bat=image1"], ["image1", "carousel_test/img_slider_1", "l'image 1", "quoi?", "IMAge1", "location&bat=image1"]]);
        
        footer();
        
        foot($included);
        ?>

    </body>

<?php
}