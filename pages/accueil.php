<?php

$required = ["column","contents","footer","header","illustration", "panoramique","textual"];
$description = "Description de la page d'acceuil adaptée au référencement";
<<<<<<< HEAD
$Title = "Titre de la page d'acceuil adaptée au référencement";
=======
>>>>>>> 8ea563ad6ef5bb0535b7045bce3421e659b8a1c6
require 'mod/head.php'; ?>

<body>
    
    <?php
    
    require 'mod/header.php';
    
    
    $panoramique_img = "";
    require 'mod/panoramique.php';

    
    $content_title = "";
<<<<<<< HEAD
=======
    $content_index = 3;
>>>>>>> 8ea563ad6ef5bb0535b7045bce3421e659b8a1c6
    $content_col = [["","","","","",""],["","","","","",""],["","","","","",""]] ;
    require 'mod/contents.php';
    
    
    $textual_title = "";
<<<<<<< HEAD
    $textual_bar = FALSE;
=======
    $tectual_bar = FALSE;
>>>>>>> 8ea563ad6ef5bb0535b7045bce3421e659b8a1c6
    $textual_data = "";
    $textual_button = "";
    $textual_button_link = "";
    require 'mod/textual.php';
    
    
    $illustration_img = "";
<<<<<<< HEAD
    $illustration_input = function(){
        $textual_title = "";
        $textual_bar = TRUE;
        $textual_data = "";
        $textual_button = "";
        $textual_button_link = "";
        require 'mod/textual.php'; 
    };
=======
    $illustration_textual_title = "";
    $illustration_tectual_bar = TRUE;
    $illustration_textual_data = "";
    $illustration_textual_button = "";
    $illustration_textual_button_link = "";
>>>>>>> 8ea563ad6ef5bb0535b7045bce3421e659b8a1c6
    require 'mod/illustration.php';
    
    
    require 'mod/footer.php'; ?>

</body>