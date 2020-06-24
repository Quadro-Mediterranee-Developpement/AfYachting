<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    require_once 'mod/mosaic_ellement.php';

    function mosaic($mosaic) {
        ?>

        <div class="mosaic">
            
            <?php
            foreach ($mosaic as $i) {
                if(isset($i[4]))
                {
                    mosaic_ellement($i[0], $i[1], $i[2], $i[3],$i[4]);
                }
                else
                {
                    mosaic_ellement($i[0], $i[1], $i[2], $i[3]);
                }
            }
        
            ?>

        </div>

    <?php
}}
