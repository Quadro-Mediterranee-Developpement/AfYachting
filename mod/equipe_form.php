<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function equipe_form($title, $text) {
        ?>

        <h2 class="title text-center"><?php echo $title; ?></h2>

        <div class="timeLine equipeBox">

            <ul>
                <?php foreach ($text as $i) {
                    ?><li>
                        <div class="content">
                            <h3><?php echo $i[0]; ?></h3>
                            <p>
                                <?php echo $i[1]; ?>
                            </p>
                        </div>
                        <div class="time">
                            <?php echo $i[2]; ?>
                        </div>
                    </li>

                <?php } ?>
            </ul>
        </div>
        <?php
    }

}

