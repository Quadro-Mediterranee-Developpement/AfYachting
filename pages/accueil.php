<?php

$required = ["column","contents","footer","header","illustration", "panoramique","textual"];
$description = "Description de la page d'acceuil adaptée au référencement";
$Title = "Titre de la page d'acceuil adaptée au référencement";
require 'mod/head.php'; ?>

<body>
    
    <?php
    
    require 'mod/header.php';
    
    
    $panoramique_img = "";
    require 'mod/panoramique.php';

    
    $content_title = "";
    $content_col = [["","","","","",""],["","","","","",""],["","","","","",""]] ;
    require 'mod/contents.php';
    
    
    $textual_title = "";
    $textual_bar = FALSE;
    $textual_data = "";
    $textual_button = "";
    $textual_button_link = "";
    require 'mod/textual.php';
    
    
    $illustration_img = "";
    $illustration_input = function(){
        $textual_title = "";
        $textual_bar = TRUE;
        $textual_data = "";
        $textual_button = "";
        $textual_button_link = "";
        require 'mod/textual.php'; 
    };
    require 'mod/illustration.php';
    
    
    require 'mod/footer.php'; ?>

</body>