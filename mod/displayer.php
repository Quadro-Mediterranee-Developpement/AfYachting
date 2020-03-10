<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function displayer($displayer_img_1, $displayer_img_2, $displayer_input) {
        ?>
        <article class="displayer">

            <span class="displayer_sub">
                <img src="<?php echo $displayer_img_1 ?>">

                <img src="<?php echo $displayer_img_2 ?>">

                <?php $displayer_input(); ?>

            </span>


        </article>
    <?php
    }

}