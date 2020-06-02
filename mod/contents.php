<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    require_once 'mod/column.php';

    function contents($content_title, $content_col) {
        ?>

            <h1 class="text-center mt-5 titleLocation"><?php echo $content_title ?></h1>
            <hr>

            
                <?php
                    column($content_col);
                ?>
            
        
        <?php
    }

}