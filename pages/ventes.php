<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    $included = ["head","header","vente_form","textual","mosaic","footer","foot"];
    
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
        textual("Achetez un bateau",FALSE,["Le coup de coeur que l'on peut avoir à la vue d'un bateau sur un site de petites annonces ou amarré dans un port de plaisance, peut vite virer au calvaire s'il ne correspond finalement pas à son programme de navigation. Moteur, voile ou mixte voile-moteur, navigation côtière, petite croisière, course et régate : la première chose à bien définir est ce que l'on veut faire avec son bateau. Un bon conseil : les coups de coeur différents du programme de navigation mûrement réfléchi... sont à proscrire !"]);            
        //TEXT 
        vente_form(["cat1","cat2"],["marque1","marque2"],(function() {mosaic([["img_slider_1", "Informations", "Lorem ipsum sit dolor ametLorem ipsum sit dolor ametLorem ipsum sit dolor ametLorem ipsum sit dolor ametLorem ipsum sit dolor ametLorem ipsum sit dolor amet", ["vache","renaux","150"]], ["img_slider_1", "Informations", "Lorem ipsum sit dolor amet", ["vache","renaux","150"]], ["img_slider_1", "Informations", "Lorem ipsum sit dolor amet", ["vache","renaux","150"]], ["img_slider_1", "Informations", "Lorem ipsum sit dolor amet", ["vache","renaux","150"]],["img_slider_1", "Informations", "Lorem ipsum sit dolor ametLorem ipsum sit dolor ametLorem ipsum sit dolor ametLorem ipsum sit dolor ametLorem ipsum sit dolor ametLorem ipsum sit dolor amet", ["vache","renaux","150"]], ["img_slider_1", "Informations", "Lorem ipsum sit dolor amet", ["vache","renaux","150"]], ["img_slider_1", "Informations", "Lorem ipsum sit dolor amet", ["vache","renaux","150"]], ["img_slider_1", "Informations", "Lorem ipsum sit dolor amet", ["vache","renaux","150"]], ["img_slider_1", "Informations", "Lorem ipsum sit dolor amet", ["vache","renaux","150"]],["img_slider_1", "Informations", "Lorem ipsum sit dolor amet", ["vache","renaux","150"]],["img_slider_1", "Informations", "Lorem ipsum sit dolor ametLorem ipsum sit dolor ametLorem ipsum sit dolor ametLorem ipsum sit dolor ametLorem ipsum sit dolor ametLorem ipsum sit dolor amet", ["vache","renaux","150"]], ["img_slider_1", "Informations", "Lorem ipsum sit dolor amet", ["vache","renaux","150"]], ["img_slider_1", "Informations", "Lorem ipsum sit dolor amet", ["vache","renaux","150"]], ["img_slider_1", "Informations", "Lorem ipsum sit dolor amet", ["vache","renaux","150"]], ["img_slider_1", "Informations", "Lorem ipsum sit dolor amet", ["vache","renaux","150"]]]);}));

        footer();
        foot($included);
        ?>

    </body>

<?php
}