<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    require_once 'mod/column.php';

    function contents($content_title, $content_col) {
       if($content_title != NULL) {echo "<h1 class='text-center mt-5'>$content_title</h1><hr>";}
            column($content_col);
    }
}