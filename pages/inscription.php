<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    
    $included = ["head","displayer","inscription_form","foot"];
 
    foreach ($included as $i) {
        require_once "mod/$i.php";
    }

    head($included, "Page d'inscription du site Afyachting", "Page d'inscription");
    ?>

    <body>

        <?php
        
            displayer("img_slider_1", "boat2", function(){inscription_form();});
            
            foot($included);
        
        ?>

    </body>

<?php
}