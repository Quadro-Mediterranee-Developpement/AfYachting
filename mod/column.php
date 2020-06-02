<?php

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

//$col_title, $col_img, $col_subtitle, $col_data, $col_button, $col_button_link
    function column($information) {
        echo "<div class='container-fluid mt-4 mb-4 imgBgBoat infoContainer'> <div class='row ml-3 '>";
        foreach ($information as $i) {
            echo "<div class='col d-flex flex-column mt-3 mb-3'>";
            if ($i[0] != NULL) {
                echo "<h5 class='text-center mt-3'>$i[0]</h5>";
            }
            if ($i[1] != NULL) {
                echo "<img src='img/$i[1].png' alt='' class='midPict '/>";
            }
            if ($i[2] != NULL) {
                echo "<h5 class='text-center mt-3'>$i[2]</h5>";
            }
            if ($i[3] != NULL) {
                echo "<p class='text-center'>$i[3]</p>";
            }
            if ($i[4] != NULL && $i[5] != NULL) {
                echo "<a class='btn btn-outline-primary btn-lg align-self-center' href='?p=$i[5]'>$i[4]</a>";
            } echo "</div>";
        } echo "</div></div>";
    }

}