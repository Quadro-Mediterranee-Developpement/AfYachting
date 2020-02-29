<span class="mosaic">

<?php

foreach ($mosaic as $i){
    $mosaic_ellement_photo = $i[0];
    $mosaic_ellement_name = $i[1];
    $mosaic_ellement_description = $i[2];
    $mosaic_ellement_tags = $i[3];
    
    require 'mod/mosaic_ellement.php';
}

?>
</span>