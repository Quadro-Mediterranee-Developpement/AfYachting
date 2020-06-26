<?php

if (isset($_POST['userName']) && isset($_POST['mail']) && isset($_POST['password']) && isset($_POST['passwordVerif']) && isset($_POST['inscription'])) {
    if (!empty($_POST['userName']) && !empty($_POST['mail']) && !empty($_POST['password']) && !empty($_POST['passwordVerif'])) {
        if ($_POST['password'] === $_POST['passwordVerif']) {
            if (strlen($_POST['password']) > 8 && strlen($_POST['password']) < 16) {
                if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                    if (strlen($_POST['userName']) > 1 && strlen($_POST['userName']) < 16) {
                        $username = htmlspecialchars($_POST['userName']);
                        $email = htmlspecialchars($_POST['mail']);
                        $password = sha1($_POST['password']);
                        $table = 'client';
                        $phone = '';
                        if (empty(compteMANAGER::recupIDby($username, $email))) {
                            if (empty($id = compteMANAGER::creatNEWuser($username, $password, $email, $phone, $table)) === false) {
                                $_SESSION['ID'] = $id;
                                $tp = $_SESSION['activeBackPage']['url'];
                                $_SESSION['activeBackPage']['url'] = 'inscription';
                                header('Location: ../index?p='. $tp);
                            } else {
                                $erreur = "erreur inconnue, l'inscription à échouer";
                                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 3];
                                header('Location: ../index?p=inscription&userName=' . $_POST['userName'] . '&mail=' . $_POST['mail']);
                            }
                        } else {
                            $erreur = "email, nom ou telephone deja existant";
                            $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 9];
                            header('Location: ../index?p=inscription&userName=' . $_POST['userName'] . '&mail=' . $_POST['mail']);
                        }
                    } else {
                        $erreur = "le nom d'utilisateur n'es pas correcte";
                        $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 4];
                        header('Location: ../index?p=inscription&userName=' . $_POST['userName'] . '&mail=' . $_POST['mail']);
                    }
                } else {
                    $erreur = "l'email n'es pas correcte";
                    $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 5];
                    header('Location: ../index?p=inscription&userName=' . $_POST['userName'] . '&mail=' . $_POST['mail']);
                }
            } else {
                $erreur = "le mot de passe n'es pas correcte";
                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 6];
                header('Location: ../index?p=inscription&userName=' . $_POST['userName'] . '&mail=' . $_POST['mail']);
            }
        } else {
            $erreur = "la confirmation du mot de passe a echouer";
            $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 7];
            header('Location: ../index?p=inscription&userName=' . $_POST['userName'] . '&mail=' . $_POST['mail']);
        }
    } else {
        $erreur = "Tous les champs doivent être  complétés !";
        $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 8];
        header('Location: ../index?p=inscription');
    }
}
