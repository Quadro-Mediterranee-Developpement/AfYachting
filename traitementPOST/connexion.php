<?php
if (isset($_POST['connect']) && isset($_POST['userName']) && isset($_POST['password'])) {
    if (!empty($_POST['userName']) AND!empty($_POST['password'])) {
        $userNameConnect = htmlspecialchars($_POST['userName']);
        $passwordConnect = sha1($_POST['password']);
        if (empty($id = compteMANAGER::recupIDone($passwordConnect, $userNameConnect)) === false) {
            $_SESSION['ID'] = $id;
            $tp = $_SESSION['activeBackPage']['url'];
            $_SESSION['activeBackPage']['url'] = 'Connexion';
            header('Location: ../index?p='. $tp);
        } else {
            $_SESSION['erreur'] = ['desc' => 'mauvais identifiant ou mot de passe', 'code' => 1];
            header('Location: ../index?p=connexion&userName='.$userNameConnect);
        }
    } else {
        $_SESSION['erreur'] = ['desc' => 'champ mot de passe ou identifiant vide', 'code' => 2];
        header('Location: ../index?p=connexion');
    }
}
else
{
    header('Location: ../index?p=404');
}

    