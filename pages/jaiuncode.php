<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    $included = ["head", "displayer", "recup_form", "foot"];

    foreach ($included as $i) {
        require_once "mod/$i.php";
    }
    //TEXT
    head($included, "Page de recuperation du site Afyachting", "Page de récupération");
    ?>

    <body>

        <?php
        displayer("img_slider_2", "boat1", function() {
            recup_form($_SESSION['ActiveAjax']);
        });

        foot($included);
        ?>

    </body>

    <?php
}