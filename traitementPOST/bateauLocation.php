<?php

if (isset($_POST['skipper']) && isset($_POST['date']) && isset($_POST['heureD']) && isset($_POST['heureF']) && isset($_POST['heureF']) && isset($_POST['calcul'])) {
    if (!empty($_POST['skipper']) && !empty($_POST['date']) && !empty($_POST['heureD']) && !empty($_POST['heureF']) && !empty($_POST['heureF']) && !empty($_POST['calcul'])) {
        $userNameConnect = htmlspecialchars($_POST['userName']);
        $passwordConnect = sha1($_POST['password']);
        if (empty($id = compteMANAGER::recupIDone($passwordConnect, $userNameConnect)) === false) {
            $_SESSION['ID'] = $id;
            header('Location: ../index?p='. $g ."&g="."connexion");
        } else {
            $_SESSION['erreur'] = ['desc' => 'mauvais identifiant ou mot de passe', 'code' => 1];
            header('Location: ../index?p=connexion&g=' . $g . '&userName='.$userNameConnect);
        }
    } else {
        $_SESSION['erreur'] = ['desc' => 'champ mot de passe ou identifiant vide', 'code' => 2];
        header('Location: ../index?p=connexion&g='. $g);
    }
}
else
{
    header('Location: ../index?p=404');
}

