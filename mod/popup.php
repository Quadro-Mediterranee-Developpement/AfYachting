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
<div class="popup <?= ($i['code']) ? "green" : "red"; ?>" id="popup<?= $id ?>" ><h5><?= $i['desc'] ?></h5></div>
<a class="fermeur" href="#" onclick="return closeee('popup<?= $id ?>')"> close</a>
                <?php
            }
            echo "</span>";
            ?>
            <script type="text/javascript">
                
                setTimeout(function(){ window.document.getElementById("popup").remove(); }, 5000);
                
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