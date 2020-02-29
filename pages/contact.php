<?php

$required = ["illustration","contact_form","footer","header"];
$description = "Description de la page de contact adaptée au référencement";
$Title = "Titre de la page de contact adaptée au référencement";
require 'mod/head.php'; ?>

<body>
    
    <?php
    
    require 'mod/header.php';

    
    $illustration_img = "";
    $illustration_input = function(){ require 'mod/contact_form.php'; };
    require 'mod/illustration.php';
    
    
    require 'mod/footer.php'; ?>

</body>