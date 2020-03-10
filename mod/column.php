<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function column($col_title, $col_img, $col_subtitle, $col_data, $col_button, $col_button_link) {
        ?>

        <span class="column">


        <?php echo $col_title, $col_img, $col_subtitle, $col_data, $col_button, $col_button_link; ?>


        </span>
        <?php
    }

}