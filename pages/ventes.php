<?php

$required = ["footer","header","ventes", "mosaic", "mosaic_ellement", "vente_form"];
$description = "Description de la page ventes adaptée au référencement";
$Title = "Titre de la page ventes adaptée au référencement";
require 'mod/head.php'; ?>

<body>
    
    <?php
    
    require 'mod/header.php';
    
    
    ?> <article class="ventes"><?php
    
        $mosaic = [["source_photo.jpg","Informations","Lorem ipsum sit dolor amet","tags mis en classe pour le tri JS"], ["","","",""], ["","","",""], ["","","",""], ["","","",""]];
        require 'mod/mosaic.php';

        require 'mod/vente_form.php';
    
    ?> </article> <?php
    
    
    require 'mod/footer.php'; ?>

</body>