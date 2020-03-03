<?php

$required = ["footer","header","illustration","textual"];
$description = "Description de la page 500 adaptée au référencement";
$Title = "Titre de la page 500 adaptée au référencement";
require 'mod/head.php'; ?>

<body>
    
    <?php
    
    require 'mod/header.php';
    
    
    $illustration_img = "";
    $illustration_input = function() {};
    require 'mod/illustration.php';
    
    
    require 'mod/footer.php'; ?>

</body>