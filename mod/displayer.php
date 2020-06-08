<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function displayer($displayer_img_1, $displayer_img_2, $displayer_input) {
        ?>

        <style>body {background-image: URL("img/<?php echo $displayer_img_1 ?>.png");}</style>
        
        <div class="card flex-row ">
            <a href="index?p=<?= $_SESSION['activeBackPage']['url'] ?>"><img class="closer" src="img/close.png" alt=""/></a>
            <div class="card-img-left d-none d-md-flex" style="background-image: URL('img/<?php echo $displayer_img_2 ?>.png');"></div>
            <div class="card-body">
                <?php $displayer_input(); ?>
            </div>
        </div>
        
        <?php
    }

}