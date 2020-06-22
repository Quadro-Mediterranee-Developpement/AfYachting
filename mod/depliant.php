<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {


    function depliant($text, $fonction) {
        static $id = 0;
        $id++;
        ?>
        <h4><a onclick="return depli('depliant<?= $id ?>')" href="" ><?= $text ?></a></h4>
        <div  id="depliant<?= $id ?>" style="height:0px;opacity: 0; transition-duration: 1s; overflow:scroll">
            <?= $fonction('onclick="return depli(\'depliant' . $id . '\')"') ?>
        </div>
        <script type="text/javascript">
            function depli(id)
            {
                if (window.document.getElementById(id).style.height === '0px')
                {
                    window.document.getElementById(id).style.height = '550px';
                    window.document.getElementById(id).style.opacity = '1';
                } else
                {
                    window.document.getElementById(id).style.height = '0px';
                    window.document.getElementById(id).style.opacity = '0';
                }
                return false;
            }
        </script>
        <?php
    }

}
