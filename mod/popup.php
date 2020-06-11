<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function popup() {
        if (isset($_SESSION['news'])) {
            echo "<span id='popup'>";
            $id = 0;
            foreach ($_SESSION['news'] as $k => $i) {
                $id++;
                ?>
                <div class="popup <?= ($i['code']) ? "green" : "red"; ?>" id="popup<?= $id ?>" ><h5>Message <?= $k ?>:</h5><?= $i['desc'] ?>&nbsp;&nbsp;<a href="#" onclick="return closeee('popup<?= $id ?>')"> close</a></div>
                <?php
            }
            echo "</span>";
            ?>
            <script type="text/javascript">
                function closeee(id)
                {
                    var parent = window.document.getElementById("popup");
                    var child = window.document.getElementById(id);
                    parent.removeChild(child);
                    return false;
                }
            </script>
            <?php
        }
    }

}