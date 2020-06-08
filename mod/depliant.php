<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {


    function depliant($text, $fonction) {
        ?>
        <h4><a onclick="return depli()" href=""><?= $text ?></a></h4>
        <div id="depliant" style="height:0px; transition-duration: 1s; overflow:hidden">
            <?= $fonction('onclick="depli()"') ?>
        </div>
        <script type="text/javascript">
            function depli()
            {
                if(window.document.getElementById("depliant").style.height === '0px')
                {
                    window.document.getElementById("depliant").style.height = '500px';
                }
                else
                {
                    window.document.getElementById("depliant").style.height = '0px';
                }
                return false;
            }
        </script>
        <?php
    }

}
