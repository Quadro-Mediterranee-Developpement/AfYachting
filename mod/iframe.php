<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function iframe($src) {
        ?>

        <iframe src="<?php echo $src ?>" class="concated" frameborder="0" style="border:0; margin: auto;" allowfullscreen="TRUE" aria-hidden="false" tabindex="0"></iframe>

        <?php
    }

}