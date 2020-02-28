<?php

$required = ["footer","header","illustration","textual"];
$description = "Description de la page 500 adaptée au référencement";
$Title = "Titre de la page 500 adaptée au référencement";
require 'mod/head.php'; ?>

<body>
    
    <?php
    
    require 'mod/header.php';
    
    
    $illustration_img = "";
    $illustration_textual_title = "";
    $illustration_textual_bar = TRUE;
    $illustration_textual_data = "";
    $illustration_textual_button = "";
    $illustration_textual_button_link = "";
    require 'mod/illustration.php';
    
    
    require 'mod/footer.php'; ?>

</body>