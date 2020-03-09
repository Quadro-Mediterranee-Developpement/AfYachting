<?php
require 'mod/mosaic_ellement.php';

function mosaic($mosaic) {
    ?>

    <span class="mosaic">

        <?php
        foreach ($mosaic as $i) {
            $mosaic_ellement_photo = $i[0];
            $mosaic_ellement_name = $i[1];
            $mosaic_ellement_description = $i[2];
            $mosaic_ellement_tags = $i[3];
        }
        mosaic_ellement($mosaic_ellement_photo, $mosaic_ellement_name, $mosaic_ellement_description, $mosaic_ellement_tags);
        ?>
    </span>
    <?php
}
