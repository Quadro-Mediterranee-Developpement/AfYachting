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
            if (isset($_SESSION['ID'])) {
                switch ($_SESSION['ID']['ROLE']) {
                    case 'admin':
                        inscription($_POST['userName'], $_POST['mail'], $_POST['password'], $_POST['passwordVerif'], $_POST['phone'], $_POST['table']);
                        break;

                    default:
                        $erreur = "autorisation du compte limité";
                        $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 21];
                        break;
                }
            } else {
                inscription($_POST['userName'], $_POST['mail'], $_POST['password'], $_POST['passwordVerif'], '', 'client');
            }

            break;
        case 'modification':
            if (isset($_SESSION['ID'])) {
                switch ($_SESSION['ID']['ROLE']) {
                    case 'admin':
                        if (isset($_POST['ID']) && isset($_POST['table'])) {
                            modification($_POST['userName'], $_POST['mail'], $_POST['password'], $_POST['passwordVerif'], $_POST['phone'], $_POST['ID'], $_POST['table']);
                            break;
                        }
                    default:
                        modification($_POST['userName'], $_POST['mail'], $_POST['password'], $_POST['passwordVerif'], $_POST['phone'], $_SESSION['ID']['ID'], $_SESSION['ID']['ROLE']);
                        break;
                }
            } else {
                $erreur = "erreur serveur";
                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 22];
            }
            break;
        case 'suprimer':
            if (isset($_SESSION['ID'])) {
                if ($_SESSION['ID']['ROLE'] == 'admin' && isset($_POST['ID']) && isset($_POST['table'])) {
                    compteMANAGER::deleteID(array('ID' => $_POST['ID'], 'ROLE' => $_POST['table']));
                    $_SESSION['erreur'] = ['desc' => 'OK', 'code' => -1];
                } else {
                    $_SESSION['erreur'] = ['desc' => 'vous n\'avez pas les droit nécéssaire', 'code' => 50];
                }
            }
            break;
        case 'addboat':
            if (isset($_SESSION['ID']) && $_SESSION['ID']['ROLE'] == 'admin') {
                
            } else {
                $erreur = "vous n'avez pas l'autorisation";
                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 21];
            }
            break;
        default :
            $erreur = "erreur serveur";
            $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 22];
            break;
    }
} else {
    $erreur = "erreur serveur";
    $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 23];
}
echo $_SESSION['erreur']['desc'];

function connexion($user, $pass) {
    if (verificationType::isseter([$user, $pass])) {
        if (verificationType::emptyer([$user, $pass])) {
            if (verificationType::simpleText($user) && verificationType::simpleText($pass)) {
                $userNameConnect = htmlspecialchars($user);
                $passwordConnect = sha1($pass);
                $id = compteMANAGER::recupIDone($passwordConnect, $userNameConnect);
                if ($id) {
                    if (compteMANAGER::verifActivate($id)) {
                        $_SESSION['erreur'] = ['desc' => 'OK', 'code' => -1];
                        $_SESSION['ID'] = $id;
                    } else {
                        $_SESSION['erreur'] = ['desc' => 'compte non activer (verifier les spam)', 'code' => 1];
                    }
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
}

function inscription($user, $mail, $pass, $verifpass, $tel, $table) {
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
}

function modification($user, $mail, $pass, $verifpass, $tel, $id, $table) {
    $prepare = [];

    $_SESSION['erreur'] = ['desc' => 'OK', 'code' => -1];

    if (isset($user)) {
        if (!empty($user)) {
            if (verificationType::simpleText($user)) {
                $username = htmlspecialchars($user);
                if (empty(compteMANAGER::recupIDby($user, '', $id, $table))) {
                    $prepare['Username'] = $username;
                } else {
                    $erreur = "nom deja pris";
                    $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 30];
                }
            } else {
                $erreur = "il y a trop ou pas assez de charactere";
                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 31];
            }
        }
    }
    if (isset($mail)) {
        if (!empty($mail)) {
            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $email = htmlspecialchars($mail);
                if (empty(compteMANAGER::recupIDby('', $email, $id, $table))) {
                    $prepare['Mail'] = $email;
                } else {
                    $erreur = "l'email est deja pris";
                    $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 32];
                }
            } else {
                $erreur = "l'email n'es pas conforme";
                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 32];
            }
        }
    }
    if (isset($pass)) {
        if (!empty($pass)) {
            if ($pass === $verifpass) {
                if (verificationType::password($pass)) {
                    $password = sha1($pass);
                    $prepare['Password'] = $password;
                } else {
                    $erreur = "le mot de passe n'es pas conforme";
                    $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 33];
                }
            } else {
                $erreur = "la verification du mot de passe a échoué";
                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 34];
            }
        }
    }

    if (isset($tel)) {
        if (!empty($tel)) {
            if (ctype_digit($tel) && strlen($tel) == 10) {
                $phone = htmlspecialchars($tel);
                $prepare['Phone'] = $phone;
            } else {
                $erreur = "le numéro de téléphone est incorrecte";
                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 35];
            }
        }
    }
    if ($_SESSION['erreur']['desc'] == 'OK') {
        foreach ($prepare as $k => $i) {
            compteMANAGER::updateUSERone($k, $i, $id, $table);
        }
    }
}
