<?php

if (isset($_SESSION['ID']) && ($_SESSION['ID']['ROLE'] == 'admin')) {
    if (isset($_POST['id'])) {
        if (!empty($_POST['Age']) && !empty($_POST['State']) && !empty($_POST['Largeur']) && !empty($_POST['Prix'])) {
            bateauMANAGER::creatVente($_POST['Age'], $_POST['State'], $_POST['Largeur'], $_POST['Prix'], $_POST['id']);
        } else {
            bateauMANAGER::supprVente($_POST['id']);
        }
    } else {
        $erreur = "modification du html";
        $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 51];
    }
} else {
    $erreur = "pas de session active correcte";
    $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 51];
}


header("location:" . $_SERVER['HTTP_REFERER']);

