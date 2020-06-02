<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function illustation($illustration_img, $illustration_title, $illustration_text) {
        ?>
        <div class="boxContainer mt-1">

            <img src="img/<?php echo $illustration_img ?>.png">

            <div class="whiteBox top-left">
                <div class="row ml-3 textBox ">
                    <h4 class="mt-4 titleTextBox"><?php echo $illustration_title ?></h4>
                    <?php foreach ($illustration_text as $i) { ?>
                        <p class="animationText">
                            <?php echo $i; ?>
                        </p>

                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
    }

}