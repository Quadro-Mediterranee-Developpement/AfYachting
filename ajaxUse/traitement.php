<?php
    //TEXT
    // un peu partout (quand tu vois un $_SESSION['erreur'] c'est qu'il y a du text (les rapports d'erreurs)
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
                        $erreur = "Autorisation du compte limitée";
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
                $erreur = "Erreur serveur";
                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 22];
            }
            break;
        case 'suprimer':
            if (isset($_SESSION['ID'])) {
                if ($_SESSION['ID']['ROLE'] == 'admin' && isset($_POST['ID']) && isset($_POST['table'])) {
                    compteMANAGER::deleteID(array('ID' => $_POST['ID'], 'ROLE' => $_POST['table']));
                    $_SESSION['erreur'] = ['desc' => 'OK', 'code' => -1];
                } else {
                    $_SESSION['erreur'] = ['desc' => 'Vous n\'avez pas les droits nécessaires', 'code' => 50];
                }
            }
            break;
        case 'addboat':
            if (isset($_SESSION['ID']) && $_SESSION['ID']['ROLE'] == 'admin') {
                ajouteBateau($_POST['nom'], $_POST['description'], $_POST['nomModele'], $_POST['moteur'], $_POST['longueur'], $_POST['nombrePassager'], $_POST['Equipement'], $_POST['divers']);
            } else {
                $erreur = "Vous n'avez pas l'autorisation";
                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 21];
            }
            break;
        default :
            $erreur = "Erreur serveur";
            $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 22];
            break;
    }
} else {
    $erreur = "Erreur serveur";
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
                        $_SESSION['news']['connexion'] = ['desc' => 'Connexion réussie', 'code' => true];
                        $_SESSION['ID'] = $id;
                    } else {
                        $_SESSION['erreur'] = ['desc' => 'Votre compte n\'as pas été activé (verifiez vos spams)', 'code' => 1];
                    }
                } else {
                    $_SESSION['erreur'] = ['desc' => 'Identifiant ou mot de passe incorrect', 'code' => 1];
                }
            } else {
                $_SESSION['erreur'] = ['desc' => 'Un champ dépasse le nombre maximum de charactères', 'code' => 3];
            }
        } else {
            $_SESSION['erreur'] = ['desc' => 'Champ mot de passe ou identifiant vide', 'code' => 2];
        }
    } else {
        $_SESSION['erreur'] = ['desc' => 'Champ mot de passe ou identifiant vide', 'code' => 2];
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
                                    $_SESSION['news']['inscription'] = ['desc' => 'Inscription réussie, Email de validation envoyé', 'code' => true];
                                } else {
                                    $erreur = "Erreur inconnue, l'inscription a échoué";
                                    $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 11];
                                }
                            } else {
                                $erreur = "Email ou nom d'utilisateur déjà existant";
                                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 12];
                            }
                        } else {
                            $erreur = "Le nom d'utilisateur ne respecte pas le format";
                            $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 13];
                        }
                    } else {
                        $erreur = "L'Email est incorrect";
                        $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 14];
                    }
                } else {
                    $erreur = "Le mot de passe ne respecte pas le format";
                    $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 15];
                }
            } else {
                $erreur = "La confirmation de mot de passe est incorrecte";
                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 16];
            }
        } else {
            $erreur = "Tous les champs doivent être complétés";
            $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 17];
        }
    } else {
        $erreur = "Tous les champs doivent être complétés";
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
                    $erreur = "Ce nom d'utilisateur est déjà utilisé";
                    $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 30];
                }
            } else {
                $erreur = "Il y a trop ou pas assez de charactères";
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
                    $erreur = "Cette adresse Email est déjà utilisée";
                    $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 32];
                }
            } else {
                $erreur = "Cet Email n'est pas conforme";
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
                    $erreur = "Ce mot de passe n'est pas conforme";
                    $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 33];
                }
            } else {
                $erreur = "La verification du mot de passe a échoué";
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
                $erreur = "Le numéro de téléphone est incorrect";
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

function ajouteBateau($nom, $description, $nomModele, $moteur, $longueur, $nombrePassager, $Equipement, $divers) {
    if (verificationType::isseter([$nom, $description, $nomModele, $moteur, $longueur, $nombrePassager, $Equipement, $divers])) {
        if (verificationType::emptyer([$nom, $description, $nomModele, $moteur, $longueur, $nombrePassager, $Equipement, $divers])) {
            if (ctype_digit($longueur) && ctype_digit($nombrePassager)) {
                bateauMANAGER::creatNEWboat($nom, $description, $nomModele, $moteur, $longueur, $nombrePassager, $Equipement, $divers);
                $_SESSION['erreur'] = ['desc' => 'OK', 'code' => -1];
            } else {
            $erreur = "Les champs 'longueur' et 'nombre de passager' doivent être des nombres";
            $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 48];
            }
        } else {
            $erreur = "Tous les champs doivent être complétés";
            $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 47];
        }
    } else {
        $erreur = "Tous les champs doivent être complétés";
        $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 47];
    }
}