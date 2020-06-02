<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function textual($textual_title, $textual_bar, $textual_data, $textual_button, $textual_button_link) {
        ?>
        <div class="center size"><p><h3 class="text-center locationSaison"><?php echo $textual_title ?></h3></p>  
        <?php foreach ($textual_data as $i) { ?>
            <p class="text-center infoLocation mt-3 "><?php echo $i ?>
            </p>

        <?php } ?>
        </div>
        <?php
    }

}