<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function illustation($illustration_img, $illustration_input) {
        ?>
        <div class="boxContainer">
            <img class="illustration" src="img/<?php echo $illustration_img ?>.png">
            <div class="whiteBox posissioned">
                <div class="row mx-auto ">
                    <?php $illustration_input();?>
                </div>
            </div>
        </div>
        <?php
    }

}