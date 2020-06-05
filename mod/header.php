<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function bloc_header($lien) {
        ?>
        <nav class="navbar navbar-expand-md navbar-light bgColor">
            <button class="navbar-toggler"data-toggle="collapse" data-target="#collapse-target"><span class=navbar-toggler-icon></span></button>

            <div class="collapse navbar-collapse" id="collapse-target">
                <a class="navbar-brand"><img src="img/Logo-AFYACHTING.png" alt="" width="50" height="50"/> </a>

                <span class="navbar-text"></span>

                <ul class="navbar-nav ml-auto">
                    <?php
                    foreach ($lien as $k=>$i) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?p=<?php echo $i ?>&g=<?= (isset($_GET['p'])) ? $_GET['p'] : "accueil"; ?>"><?php echo $k ?></a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
        </nav>
        <?php
    }

}

