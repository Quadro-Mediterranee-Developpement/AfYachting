<?php

$required = ["column","contents","footer","header","illustration", "panoramique","textual"];
$description = "Description de la page d'acceuil adaptée au référencement";
require 'mod/head.php'; ?>

<body>
    
    <?php
    
    require 'mod/header.php';
    
    
    $panoramique_img = "";
    require 'mod/panoramique.php';

    
    $content_title = "";
    $content_index = 3;
    $content_col = [["","","","","",""],["","","","","",""],["","","","","",""]] ;
    require 'mod/contents.php';
    
    
    $textual_title = "";
    $tectual_bar = FALSE;
    $textual_data = "";
    $textual_button = "";
    $textual_button_link = "";
    require 'mod/textual.php';
    
    
    $illustration_img = "";
    $illustration_textual_title = "";
    $illustration_tectual_bar = TRUE;
    $illustration_textual_data = "";
    $illustration_textual_button = "";
    $illustration_textual_button_link = "";
    require 'mod/illustration.php';
    
    
    require 'mod/footer.php'; ?>

</body>