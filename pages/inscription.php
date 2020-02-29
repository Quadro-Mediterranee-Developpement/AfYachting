<?php

$required = ["displayer","inscription_form"];
$description = "Description de la page d'inscription adaptée au référencement";
$Title = "Titre de la page d'inscription adaptée au référencement";
require 'mod/head.php'; ?>

<body>
    
    <?php

    
    $displayer_img = "";
    $displayer_img_2 = "";
    $displayer_input = function(){ require 'mod/inscription_form.php'; };
    require 'mod/displayer.php';
    
    ?>

</body>