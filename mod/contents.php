<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    require_once 'mod/column.php';

    function contents($content_title, $content_col) {
        ?>

        <article class="content">

            <p1 class = "content_title"><?php echo $content_title ?></p1>

            <span class="content_sub">
                <?php
                foreach ($content_col as $i) {
                    column($i[0], $i[1], $i[2], $i[3], $i[4], $i[5]);
                }
                ?>
            </span>
        </article>
        <?php
    }

}