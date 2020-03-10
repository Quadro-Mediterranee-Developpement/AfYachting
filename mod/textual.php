<?php

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function textual($textual_title,$textual_bar,$textual_data,$textual_button,$textual_button_link) {
        ?>
        <span class="textual">
            <?php echo $textual_title,$textual_bar,$textual_data,$textual_button,$textual_button_link ?>
        </span>
    <?php

    }

}