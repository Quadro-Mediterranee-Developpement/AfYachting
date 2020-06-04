<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    $included = ["head", "header", "contact_form", "illustration", "footer", "foot", "iframe"];

    foreach ($included as $i) {
        require_once "mod/$i.php";
    }

    head($included, "Description de la page contact adaptée au référencement", "Titre de la page contact adaptée au référencement");
    ?>

    <body>

        <?php
        bloc_header($menu);

        illustation("carousel_test/img_slider_1", (function() {
                    contact_form();
                }));

        iframe("https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3114.3478159461197!2d6.58702339757288!3d43.26438646082901!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12cec7d037455f45%3A0x4d5a6299726f4b7b!2sLocation%20Bateau%20Cogolin!5e1!3m2!1sfr!2sfr!4v1591187837820!5m2!1sfr!2sfr");

        footer();
        foot($included);
        ?>

    </body>

    <?php
}