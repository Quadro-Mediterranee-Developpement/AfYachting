<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function foot($required) {
            foreach ($required as $i) {
                if (is_file('js/' . $i . '.js')) {
                    echo '<script src="js/' . $i . '.js" type="text/javascript"></script>';
                }
            }
            echo '<script src="https://unpkg.com/scrollreveal"></script><script src="js/animation.js" type="text/javascript"></script>';
    }

}