<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function displayer($displayer_img_1, $displayer_img_2, $displayer_input,$backbutton = null) {
        if($displayer_img_1 != null):
        ?>

        <style>body {background-image: URL("img/<?php echo $displayer_img_1; ?>.png");}</style>
        <?php endif; ?>
        <div class="<?= ($displayer_img_1 != null)?'card':''; ?> flex-row ">
            <a <?= ($backbutton) ? $backbutton : "href='index?p=" . $_SESSION['activeBackPage']['url']."'"; ?>"><img class="closer" src="img/close.png" alt=""/></a>
            <?php if($displayer_img_2 != null): ?>
            <div id="CloserWidth" class="card-img-left d-none d-md-flex" style="background-image: URL('img/<?php echo $displayer_img_2 ?>.png');"></div>
            <?php endif; ?>
            <div class="card-body">
                <?php $displayer_input(); ?>
            </div>
        </div>
        
        <?php
    }

}