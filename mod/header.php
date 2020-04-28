<?php

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function bloc_header() {
        ?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <button class="navbar-toggler"data-toggle="collapse" data-target="#collapse-target"><span class=navbar-toggler-icon></span></button>

            <div class="collapse navbar-collapse" id="collapse-target">
                <a class="navbar-brand"><img src="img/Logo-AFYACHTING.png" alt="" width="50" height="50"/> </a>

                <span class="navbar-text"></span>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="pages/accueil.php">Accueil</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="pages/location.php">Location</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="pages/ventes.php">Vente</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="pages/services.php">Services</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="pages/equipe.php">Notre équipe</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="pages/contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/aide.php">Aide</a>
                    </li>

                </ul>
            </div>
        </nav>
 <?php
    }

}

