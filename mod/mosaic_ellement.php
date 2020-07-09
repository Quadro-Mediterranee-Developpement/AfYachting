<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function mosaic_ellement($mosaic_ellement_photo, $mosaic_ellement_name, $mosaic_ellement_description, $mosaic_ellement_tags, $mosaic_ellement_id) {
        ?>

            <div class="img-fluid mosaic_ellement <?php echo implode(" ", $mosaic_ellement_tags) ?>" style="background-image: URL('img/<?php echo $mosaic_ellement_photo ?>');" <?= ($mosaic_ellement_id != null)?"id='bateau".$mosaic_ellement_id."'":'' ?>>

                <a class="mosalien" href="index?p=bateau&ID=<?php echo $mosaic_ellement_id ?>&vente"><div><h4><?php echo $mosaic_ellement_name . "</h4><p>" . $mosaic_ellement_description ?></p></div></a>

            </div>

        <?php
    }

}