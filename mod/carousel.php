<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function carousel($images) {
        ?>
        <article class="carousel">
           
        </article>
        <?php
    }

}