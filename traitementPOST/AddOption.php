<?php

if (isset($_SESSION['ID']) && ($_SESSION['ID']['ROLE'] == 'admin' || $_SESSION['ID']['ROLE'] == 'entreprise')) {
    if (isset($_POST['Prix']) && isset($_POST['Nom']) && isset($_POST['Description']) && isset($_POST['id'])) {
        if (!empty($_POST['Prix']) && !empty($_POST['Nom']) && !empty($_POST['Description']) && bateauMANAGER::confirmeDonneeImage($_POST['id']) == $_SESSION['ID']['ID']) {
            bateauMANAGER::creatNEWoption($_POST['Nom'], $_POST['Description'], $_POST['Prix'], $_POST['id']);
        } else {
            $erreur = "modification du html";
            $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 51];
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

