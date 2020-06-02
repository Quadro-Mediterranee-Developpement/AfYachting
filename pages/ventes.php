<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
$included = ["head","header","vente_form","mosaic","textual","footer","foot"];
 
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }
 

    head($included, "Description de la page contact adaptée au référencement", "Titre de la page contact adaptée au référencement");
    ?>

    <body>

        <?php
        bloc_header(["Accueil","Bateau","Connexion","Contact","Inscription","Location","Ventes"]);
        
        textual("Achetez un bateau",FALSE,["Ob haec et huius modi multa, quae cernebantur in paucis, omnibus timeri sunt coepta. et ne tot malisissimulatis paulatimque serpentibus acervi crescerent aerumnarum,nobilitatis decreto legati mittuntur: Praetextatus ex urbi praefecto et ex vicario Venustus et ex consulariMinervius oraturi, ne delictis supplicia sint grandiora, neve senator quisquam inusitato et inlicito more tormentis exponeretur."],"","");            
            
        vente_form(["cheval","vache"],["renaux","autrechose"],(function() {mosaic([["img_slider_1", "Informations", "Lorem ipsum sit dolor amet", ["vache","renaux","150"]], ["img_slider_1", "Informations", "Lorem ipsum sit dolor amet", ["vache","renaux","150"]], ["img_slider_1", "Informations", "Lorem ipsum sit dolor amet", ["vache","renaux","150"]], ["img_slider_1", "Informations", "Lorem ipsum sit dolor amet", ["vache","renaux","150"]], ["img_slider_1", "Informations", "Lorem ipsum sit dolor amet", ["vache","renaux","150"]]]);}));

        footer();
        foot($included);
        ?>

    </body>

<?php
}