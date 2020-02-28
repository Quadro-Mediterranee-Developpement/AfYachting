<?php

$required = ["column","contents","footer","header"];
$description = "Description de la page de location adaptée au référencement";
$Title = "Titre de la page de location adaptée au référencement";
require 'mod/head.php'; ?>

<body>
    
    <?php
    
    require 'mod/header.php';

    
    $content_title = "";
    $content_index = 3;
    $content_col = [["","","","","",""],["","","","","",""],["","","","","",""]] ;
    require 'mod/contents.php';
    
    
    require 'mod/footer.php'; ?>

</body>