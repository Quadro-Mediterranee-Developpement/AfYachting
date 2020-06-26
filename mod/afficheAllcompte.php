<?php

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require 'identityCard.php';
    //TEXT
    // un peu partout
//$col_title, $col_img, $col_subtitle, $col_data, $col_button, $col_button_link
    function afficheAllcompte($information) {
        echo "<div class='container-fluid mt-4 mb-4 infoContainer'> <div class='row ml-3 '>";
        foreach ($information as $k => $i) {
            echo "<div class='col d-flex flex-column mt-3 mb-3'>";
            echo"<a onclick='return depli(\"$k\")' href='#' ><h2>$k</h2></a><div id='$k' style='height:0;overflow:scroll;transition-duration:1s;'>";

            foreach ($i as $y) {
                echo '<div>';
                identityCard($y[0], $y[1], $y[2], $y[3]);
                echo "<a class='btn btn-outline-primary btn-lg align-self-center' href='#$y[4]&$k&$y[0]&$y[1]&$y[2]' >modifier id$y[4]</a>";
                echo "<a class='btn btn-outline-primary btn-lg align-self-center' href='#' onclick='return suprimer(\"$y[4]\",\"$k\")'>supprimer</a></div>";
            }
            echo '</div></div>';
        } echo "</div></div>";
        ?>
        <script type="text/javascript">
            function depli(id)
            {
                if (window.document.getElementById(id).style.height === '0px')
                {
                    window.document.getElementById(id).style.height = '500px';
                } else
                {
                    window.document.getElementById(id).style.height = '0px';
                }
                return false;
            }
        </script>

        <?php

    }

}