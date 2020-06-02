<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function illustation($illustration_img, $illustration_input) {
        ?>
        <div class="boxContainer mt-1">
            <img src="img/<?php echo $illustration_img ?>.png">
            <div class="whiteBox top-left">
                <div class="row ml-3 textBox ">
                    <?php $illustration_input();?>
                </div>
            </div>
        </div>
        <?php
    }

}