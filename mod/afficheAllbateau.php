<?php

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require 'identityCardBoat.php';

//$col_title, $col_img, $col_subtitle, $col_data, $col_button, $col_button_link
    function afficheAllbateau($information) {
        echo "<div class='container-fluid mt-4 mb-4 infoContainer'> <div class='row ml-3 '>";
            echo "<div class='col d-flex flex-column mt-3 mb-3' style='max-width:100%;'>";
            echo"<a onclick='return depli(\"bateauAll\")' href='#' ><h2>bateauAll</h2></a><div id='bateauAll' style='height:0;overflow:scroll;transition-duration:1s;'>";

            foreach ($information as $y) {
                echo '<div>';
                identityCardBoat($y);
                echo "<a class='btn btn-outline-primary btn-lg align-self-center' href='#' onclick='return supprimer(\"" .$y['Nom'] . "\",\"bateau\")'>suprimer</a></div>";
            }
            echo '</div></div>';
         echo "</div></div>";
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