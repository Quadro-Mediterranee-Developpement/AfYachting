<?php
session_start();
require '../BDDMANAGER/loaderBDD.php';
if (isset($_POST['connect']) && isset($_POST['userName']) && isset($_POST['password'])) {
    if (!empty($_POST['userName']) AND!empty($_POST['password'])) {
        $userNameConnect = htmlspecialchars($_POST['userName']);
        $passwordConnect = sha1($_POST['password']);
        if (empty($id = compteMANAGER::recupIDone($passwordConnect, $userNameConnect)) === false) {
            $_SESSION['ID'] = $id;
            echo 'OK';
        } else {
            $_SESSION['erreur'] = ['desc' => 'mauvais identifiant ou mot de passe', 'code' => 1];
            echo $_SESSION['erreur']['desc'];
        }
    } else {
        $_SESSION['erreur'] = ['desc' => 'champ mot de passe ou identifiant vide', 'code' => 2];
        echo $_SESSION['erreur']['desc'];
    }
}
else
{
    echo 'champ mot de passe ou identifiant vide';
}
