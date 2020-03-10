<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function illustation($illustration_img, $illustration_input) {
        ?>
        <article class="illustration">

            <img src="<?php echo $illustration_img ?>">

            <span class="illustration_sub">

                <?php $illustration_input(); ?>
            </span>
        </article>
        <?php
    }

}