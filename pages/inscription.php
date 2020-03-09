<?php
require 'mod/head.php'; 
require 'mod/displayer.php';
require 'mod/inscription_form.php';
$required = ["displayer","inscription_form"];
$description = "Description de la page d'inscription adaptée au référencement";
$Title = "Titre de la page d'inscription adaptée au référencement";

head($required, $description, $Title);
?>

<body>
    
    <?php

    
    $displayer_img = "";
    $displayer_img_2 = "";
    $displayer_input = function() {inscription_form();};
    displayer($displayer_img,$displayer_img_2,$displayer_input);
    ?>

</body>