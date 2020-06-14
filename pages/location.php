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

    //TEXT
    head($included, "Bateau disponible à la location pour une qualité imbatable", "Location de bateau");
    ?>

    <body>

        <?php
        bloc_header($menu);

        //TEXT
        textual("Louez un bateau", FALSE, ["Réservez directement en ligne de manière sécurisée et louez le bateau ou voilier de vos rêves en quelques clics. Vous ne serez débité qu’en cas d’acceptation de votre demande de location par le propriétaire du bateau. Paiement 100% sécurisé."], "", "");
        //TEXT
        column([["Bi-coque", "carousel_test/img_slider_1", "Libéré vos pensés", "Plus qu'une semaine avant les vacances, sa se fête", "Je réserve!", creatLienLocation(1)], ["Semi-coque", "carousel_test/img_slider_2", "Surfer sur la mer tel un dauphin", "Ce bateau à la capacité d'être rapide, efficace et silencieux", "Je réserve!", creatLienLocation(2)], ["tri-coque", "carousel_test/img_slider_3", "Chantez!", "Seul au large, chantez aussi que la bateau vous est agréable (personne vous dira d'arréter", "Je réserve!", creatLienLocation(3)], ["quadri-coque", "boat1", "Il n'y a pas de mot", "Avançons seul, à deux ou à plusieurs mais jamais sans l'envie de prendre le large", "Je réserve!", creatLienLocation(4)]]);

        footer();

        foot($included);
        ?>

    </body>

    <?php
}

function creatLienLocation($id) {
    return 'bateau&batID=' . $id;
}
