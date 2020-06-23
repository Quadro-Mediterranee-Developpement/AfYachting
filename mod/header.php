<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    //TEXT
    // un peu partout
    function bloc_header($lien) {
        ?>
        <nav class="navbar navbar-expand-md navbar-light bgColor">
            <button class="navbar-toggler"data-toggle="collapse" data-target="#collapse-target"><span class=navbar-toggler-icon></span></button>

            <div class="collapse navbar-collapse" id="collapse-target">
                <a class="navbar-brand"><img src="img/Logo-AFYACHTING.png" alt="" width="50" height="50"/> </a>

                <span class="navbar-text"></span>

                <ul class="navbar-nav ml-auto">
                    <?php
                    foreach ($lien as $k => $i) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?p=<?php echo $i ?>"><?php echo $k ?></a>
                        </li>
                    <?php } ?>

                </ul>
            </div>

        </nav>
            <span class="volant">
            <?php
            if (!isset($_SESSION['ID'])) {
                ?>
                <a class="nav-link" href="?p=connexion">Connexion</a>&nbsp;&nbsp;&nbsp;<a class="nav-link" href="?p=inscription">Inscription</a>
            <?php
              
            } else {
                           ?>
            <a class="nav-link" href="?p=compte">Mon compte</a>&nbsp;&nbsp;&nbsp;<a class="nav-link" href="?p=accueil&destroy=1">Se déconnecter</a>
            <?php      
            }
            ?>
            </span>
            <?php
        }

    }

