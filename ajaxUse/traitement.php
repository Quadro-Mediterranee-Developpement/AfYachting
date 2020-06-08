<?php

session_start();
require_once '../BDDMANAGER/loaderBDD.php';
require_once '../utilityPhp/verificationType.php';

if (isset($_POST['type'])) {
    switch ($_POST['type']) {
        case 'connexion':
            connexion($_POST['userName'], $_POST['password']);
            break;
        case 'inscription':
            inscription($_POST['userName'], $_POST['mail'], $_POST['password'], $_POST['passwordVerif'], 'client');
            break;
    }
}

function connexion($user, $pass) {
    if (verificationType::isseter([$user, $pass])) {
        if (verificationType::emptyer([$user, $pass])) {
            if (verificationType::simpleText($user) && verificationType::simpleText($pass)) {
                $userNameConnect = htmlspecialchars($user);
                $passwordConnect = sha1($pass);
                $id = compteMANAGER::recupIDone($passwordConnect, $userNameConnect);
                if ($id) {
                    $_SESSION['erreur'] = ['desc' => 'OK', 'code' => -1];
                    $_SESSION['ID'] = $id;
                } else {
                    $_SESSION['erreur'] = ['desc' => 'mauvais identifiant ou mot de passe', 'code' => 1];
                }
            } else {
                $_SESSION['erreur'] = ['desc' => 'champ mot de passe ou identifiant depasse le nombre de charactere maximum', 'code' => 3];
            }
        } else {
            $_SESSION['erreur'] = ['desc' => 'champ mot de passe ou identifiant vide', 'code' => 2];
        }
    } else {
        $_SESSION['erreur'] = ['desc' => 'champ mot de passe ou identifiant vide', 'code' => 2];
    }
    echo $_SESSION['erreur']['desc'];
}

function inscription($user, $mail, $pass, $verifpass, $table, $tel = '') {
    if (verificationType::isseter([$user, $mail, $pass, $verifpass])) {
        if (verificationType::emptyer([$user, $mail, $pass, $verifpass])) {
            if ($pass === $verifpass) {
                if (verificationType::password($pass)) {
                    if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                        if (verificationType::simpleText($user)) {
                            $username = htmlspecialchars($user);
                            $email = htmlspecialchars($mail);
                            $password = sha1($pass);
                            $phone = $tel;
                            if (empty(compteMANAGER::recupIDby($username, $email))) {
                                if (empty($id = compteMANAGER::creatNEWuser($username, $password, $email, $phone, $table)) === false) {
                                    $_SESSION['ID'] = $id;
                                    $_SESSION['erreur'] = ['desc' => 'OK', 'code' => -1];
                                } else {
                                    $erreur = "erreur inconnue, l'inscription à échouer";
                                    $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 11];
                                }
                            } else {
                                $erreur = "email, nom ou telephone deja existant";
                                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 12];
                            }
                        } else {
                            $erreur = "le nom d'utilisateur n'es pas correcte";
                            $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 13];
                        }
                    } else {
                        $erreur = "l'email n'es pas correcte";
                        $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 14];
                    }
                } else {
                    $erreur = "le mot de passe n'es pas correcte";
                    $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 15];
                }
            } else {
                $erreur = "la confirmation du mot de passe a echouer";
                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 16];
            }
        } else {
            $erreur = "Tous les champs doivent être  complétés !";
            $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 17];
        }
    } else {
        $erreur = "Tous les champs doivent être  complétés !";
        $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 8];
    }

    echo $_SESSION['erreur']['desc'];
}
