<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function mosaic_ellement($mosaic_ellement_photo, $mosaic_ellement_name, $mosaic_ellement_description, $mosaic_ellement_tags) {
        ?>

            <div class="img-fluid pictSizeVente mosaic_ellement <?php echo implode(" ", $mosaic_ellement_tags) ?>" style="background-image: URL('img/<?php echo $mosaic_ellement_photo ?>.png');">

                <div><h6><?php echo $mosaic_ellement_name . "</h6><p>" . $mosaic_ellement_description ?></p></div>

            </div>

        <?php
    }

}