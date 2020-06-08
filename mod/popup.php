<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function popup() {
        if (isset($_SESSION['news'])) {
            echo "<span id='popup'>";
            foreach ($_SESSION['news'] as $k => $i) {
                ?>
                <p class="<?= ($i['code']) ? "green" : "red" ?>"><h5><?= $k ?></h5><?= $i['desc'] ?></p>
                <?php
            }
            echo "</span>";
        }
    }

}