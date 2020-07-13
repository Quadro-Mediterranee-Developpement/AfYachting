<?php

if (isset($_SESSION['ID']) && ($_SESSION['ID']['ROLE'] == 'admin' || $_SESSION['ID']['ROLE'] == 'entreprise')) {
    if (isset($_POST['id'])) {
        if (!empty($_POST['HS']) && !empty($_POST['BS']) && !empty($_POST['Caution']) && bateauMANAGER::confirmeDonneeImage($_POST['id']) == $_SESSION['ID']['ID']) {
            bateauMANAGER::creatLocation($_POST['HS'], $_POST['BS'], $_POST['Caution'], $_POST['id']);
        } else if(bateauMANAGER::confirmeDonneeImage($_POST['id']) == $_SESSION['ID']['ID']) {
            bateauMANAGER::supprLocation($_POST['id']);
        }
        else{
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

