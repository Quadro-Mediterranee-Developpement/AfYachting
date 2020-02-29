<?php

$required = ["displayer","connexion_form"];
$description = "Description de la page de connexion adaptée au référencement";
$Title = "Titre de la page de connexion adaptée au référencement";
require 'mod/head.php'; ?>

<body>
    
    <?php

    
    $displayer_img = "";
    $displayer_img_2 = "";
    $displayer_input = function(){ require 'mod/connexion_form.php'; };
    require 'mod/displayer.php';
    
    ?>

</body>