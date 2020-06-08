<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {

    function compte_info() {
        return '<a href="index.php?p=accueil&destroy=1">Déconnexion</a>';
    }

}

