<?php

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function mosaic_ellement($mosaic_ellement_photo, $mosaic_ellement_name, $mosaic_ellement_description, $mosaic_ellement_tags) {
        echo $mosaic_ellement_photo, $mosaic_ellement_name, $mosaic_ellement_description, $mosaic_ellement_tags;
    }

}
