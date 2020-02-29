<?php

$required = ["column","footer","header","bateau", "bateau_form"];
$description = "Description de la page bateau adaptée au référencement";
$Title = "Titre de la page bateau adaptée au référencement";
require 'mod/head.php'; ?>

<body>
    
    <?php
    
    require 'mod/header.php';
    
    
    ?> <article class="bateau"><?php
    
        $col_title = "";
        $col_img = "";
        $col_subtitle = "";
        $col_data = "";
        $col_button = "";
        $col_button_link = "";
        require 'mod/column.php';

        require 'mod/bateau_form.php';
    
    ?> </article> <?php
    
    
    require 'mod/footer.php'; ?>

</body>