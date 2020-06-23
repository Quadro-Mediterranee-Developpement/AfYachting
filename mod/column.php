<?php

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

//$col_title, $col_img, $col_subtitle, $col_data, $col_button, $col_button_link
    function column($information) {
        echo "<div class='container-fluid mt-4 mb-4 infoContainer'> <div class='row' style='justify-content: center;'>";
        foreach ($information as $i) {
            echo "<div class='col d-flex flex-column mt-3 mb-3'>";
            if ($i[0] != NULL) {
                echo "<h3 class='text-center mt-3'>$i[0]</h3>";
            }
            if ($i[1] != NULL) {
                if (is_array($i[1])) {
                    require_once 'mod/carousel.php';
                    carousel($i[1]);
                } else {
                    echo "<a style='width:100%;' href='?p=$i[5]'><img src='img/$i[1].png' alt='' class='midPict '/></a>";
                }
            }
            if ($i[2] != NULL) {
                echo "<h5 class='text-center mt-3'>$i[2]</h5>";
            }
            if ($i[3] != NULL) {
                echo "<p class='text-center'>$i[3]</p>";
            }
            if ($i[4] != NULL && $i[5] != NULL) {
                if ($i[4] == $i[5] & $i[4] == "GigahBigah") {
                    ?>
                    <style>
                        .midPict {
                            width: 50vw;
                            height: 636px;
                        }
                        .col {
                            max-width: 53%;
                        }
                        .flex-column>.carousel {
                            width: 50vw;
                        }

                        .flex-column .carousel .carousel-inner .carousel-item .pictSize{
                            height: 636px;
                        }
                        .row {
                            justify-content: flex-start!important;
                        }
                    </style>
                    <?php

                } else {
                    echo "<a class='btn btn-outline-primary btn-lg align-self-center' href='?p=$i[5]'>$i[4]</a>";
                }
            } echo "</div>";
        } echo "</div></div>";
    }

}