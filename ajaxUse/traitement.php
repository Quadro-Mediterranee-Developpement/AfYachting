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
                    $_SESSION['erreur'] = ['desc' => 'vous n\'avez pas les droits nécéssaires', 'code' => 50];
                }
            }
            break;
        case 'addboat':
            if (isset($_SESSION['ID']) && $_SESSION['ID']['ROLE'] == 'admin') {
                ajouteBateau($_POST['nom'], $_POST['description'], $_POST['nomModele'], $_POST['moteur'], $_POST['longueur'], $_POST['nombrePassager'], $_POST['Equipement'], $_POST['divers']);
            } else if (isset($_SESSION['ID']) && $_SESSION['ID']['ROLE'] == 'entreprise') {
                ajouteBateau($_POST['nom'], $_POST['description'], $_POST['nomModele'], $_POST['moteur'], $_POST['longueur'], $_POST['nombrePassager'], $_POST['Equipement'], $_POST['divers']);
            } else {
                $erreur = "vous n'avez pas l'autorisation";
                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 21];
            }
            break;
        case 'supprImage':
            if (isset($_SESSION['ID']) && $_SESSION['ID']['ROLE'] == 'admin') {
                loaderBDD::deleteImage($_POST['ID']);
                $_SESSION['erreur'] = ['desc' => 'OK', 'code' => -1];
            } else if (isset($_SESSION['ID']) && $_SESSION['ID']['ROLE'] == 'entreprise') {
                if (bateauMANAGER::confirmeDonneeImage($_POST['ID']) == $_SESSION['ID']['ID']) {
                    loaderBDD::deleteImage($_POST['ID']);
                    $_SESSION['erreur'] = ['desc' => 'OK', 'code' => -1];
                } else {
                    $_SESSION['erreur'] = ['desc' => 'vous n\'avez pas l\'autorisation', 'code' => 21];
                }
            }
            break;
        case 'supprOption':
            if (isset($_SESSION['ID']) && $_SESSION['ID']['ROLE'] == 'admin') {
                bateauMANAGER::deleteOption($_POST['ID']);
                $_SESSION['erreur'] = ['desc' => 'OK', 'code' => -1];
            } else if (isset($_SESSION['ID']) && $_SESSION['ID']['ROLE'] == 'entreprise') {
                if (bateauMANAGER::confirmeOption($_POST['ID'], $_SESSION['ID']['ID']) == 1) {
                    bateauMANAGER::deleteOption($_POST['ID']);
                    $_SESSION['erreur'] = ['desc' => 'OK', 'code' => -1];
                } else {
                    $_SESSION['erreur'] = ['desc' => 'vous n\'avez pas l\'autorisation', 'code' => 21];
                }
            }
            break;

        case 'oublie':
            recuperation($_POST['mail']);


            break;
        case 'inspect':
            codeverif($_POST['code']);
            break;
        case 'modifMDP':
            reiniMDP($_POST['mdp1'], $_POST['mdp2'], $_POST['code']);
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
                        $_SESSION['news']['connexion'] = ['desc' => 'Connexion réussie', 'code' => true];
                        $_SESSION['ID'] = $id;
                    } else {
                        $_SESSION['erreur'] = ['desc' => 'compte non activé (verifiez les spams)', 'code' => 1];
                    }
                } else {
                    $_SESSION['erreur'] = ['desc' => 'mauvais identifiant ou mot de passe', 'code' => 1];
                }
            } else {
                $_SESSION['erreur'] = ['desc' => 'un champ dépasse le nombre maximum de charactère', 'code' => 3];
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
                                    $_SESSION['news']['inscription'] = ['desc' => 'Inscription réussie, email de validation envoyé', 'code' => true];
                                } else {
                                    $erreur = "erreur inconnue, l'inscription à échouer";
                                    $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 11];
                                }
                            } else {
                                $erreur = "email ou nom déjà existant";
                                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 12];
                            }
                        } else {
                            $erreur = "le nom d'utilisateur ne respecte pas le format";
                            $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 13];
                        }
                    } else {
                        $erreur = "l'email est incorrecte";
                        $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 14];
                    }
                } else {
                    $erreur = "le mot de passe ne respecte pas le format";
                    $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 15];
                }
            } else {
                $erreur = "Les mots de passes ne sont pas identiques";
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
                    $erreur = "Le nom est déjà pris";
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
                $erreur = "l'email n'est pas conforme";
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

function ajouteBateau($nom, $description, $nomModele, $moteur, $longueur, $nombrePassager, $Equipement, $divers) {
    if (verificationType::isseter([$nom, $description, $nomModele, $moteur, $longueur, $nombrePassager, $Equipement, $divers])) {
        if (verificationType::emptyer([$nom, $description, $nomModele, $moteur, $longueur, $nombrePassager, $Equipement, $divers])) {
            if (ctype_digit($longueur) && ctype_digit($nombrePassager)) {
                $id = 0;
                if ($_SESSION['ID']['ROLE'] == 'entreprise') {
                    $id = $_SESSION['ID']['ID'];
                }
                bateauMANAGER::creatNEWboat($nom, $description, $nomModele, $moteur, $longueur, $nombrePassager, $Equipement, $divers, $id);
                $_SESSION['erreur'] = ['desc' => 'OK', 'code' => -1];
            } else {
                $erreur = "Les champs longeurs et nombre de passager doivent etre des nombres";
                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 48];
            }
        } else {
            $erreur = "Tous les champs doivent être  complétés !";
            $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 47];
        }
    } else {
        $erreur = "Tous les champs doivent être  complétés !";
        $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 47];
    }
}

function codeverif($donnee) {
    if (isset($donnee)) {
        if (!empty($donnee)) {
            $bdd = loaderBDD::connexionBDD();
            $verif_code = htmlspecialchars($donnee);
            $verif_req = $bdd->prepare('SELECT id FROM recuperation WHERE code = ?');
            $verif_req->execute(array($verif_code));
            $verif_req = $verif_req->rowCount();
            if ($verif_req == 1) {
                $up_req = $bdd->prepare('UPDATE recuperation SET confirme= 1 WHERE code = ?');
                $up_req->execute(array($verif_code));
                $error = "OK";
                $_SESSION['erreur'] = ['desc' => $error, 'code' => -1];
            } else {
                $error = "Le code que vous avez saisi est invalide";
                $_SESSION['erreur'] = ['desc' => $error, 'code' => 47];
            }
        } else {
            $error = "Veuillez entrer le code de confirmation";
            $_SESSION['erreur'] = ['desc' => $error, 'code' => 47];
        }
    }
}

function recuperation($donnee) {
    if (isset($donnee)) {
        if (!empty($donnee)) {
            $bdd = loaderBDD::connexionBDD();
            $recup_mail = htmlspecialchars($donnee);
            if (filter_var($recup_mail, FILTER_VALIDATE_EMAIL)) {
                $mailexist = $bdd->prepare('SELECT ID,Username FROM client WHERE Mail = ?');
                $mailexist->execute(array($recup_mail));
                $mailexist_count = $mailexist->rowCount();
                if ($mailexist_count == 1) {
                    $username = $mailexist->fetch();
                    $username = $username['Username'];

                    $recup_code = "";
                    for ($i = 0; $i < 8; $i++) {
                        $recup_code .= mt_rand(0, 9);
                    }

                    $mail_recup_exist = $bdd->prepare('SELECT id FROM recuperation WHERE mail= ?');
                    $mail_recup_exist->execute(array($recup_mail));
                    $mail_recup_exist = $mail_recup_exist->rowCount();

                    if ($mail_recup_exist == 1) {
                        $recup_insert = $bdd->prepare('UPDATE recuperation SET code= ? WHERE mail= ?');
                        $recup_insert->execute(array($recup_code, $recup_mail));
                    } else {
                        $recup_insert = $bdd->prepare('INSERT INTO recuperation(mail,code) VALUES (?,?)');
                        $recup_insert->execute(array($recup_mail, $recup_code));
                    }

                    $header = "MIME-Version: 1.0\r\n";
                    $header .= 'From:"[AfYachting]"<ange.cesari1@gmail.com>' . "\n";
                    $header .= 'Content-Type:text/html; charset="utf-8"' . "\n";
                    $header .= 'Content-Transfer-Encoding: 8bit';
                    $message = '
                <html>
                <head>
                  <title>Récupération de mot de passe - AfYachting</title>
                  <meta charset="utf-8" />
                </head>
                <body>
                  <font color="#303030";>
                    <div align="center">
                      <table width="600px">
                        <tr>
                          <td>

                            <div align="center">Bonjour <b>' . $username . '</b>,</div>
                            Voici votre code de récupération: <b>' . $recup_code . '</b>
                            A bientôt sur <a href="#">Votre site</a> !

                          </td>
                        </tr>
                        <tr>
                          <td align="center">
                            <font size="2">
                              Ceci est un email automatique, merci de ne pas y répondre
                            </font>
                          </td>
                         <td align="center">
                            <font size="2">
                              Si la demande ne vient pas de vous, ignorez simplement ce message
                            </font>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </font>
                </body>
                </html>
                ';

                    if (/* mail($recup_mail, "Récupération de mot de passe - AfYachting", $message, $header) */ true == false) {
                        $_SESSION['erreur'] = ['desc' => 'Probleme interne', 'code' => 50];
                    } else {
                        $_SESSION['erreur'] = ['desc' => 'OK', 'code' => -1];
                    }
                } else {
                    $error = "L'adresse que vous avez saisie n'est pas liée à un compte";
                    $_SESSION['erreur'] = ['desc' => $error, 'code' => 47];
                }
            } else {
                $error = "L'adresse que vous avez saisi est invaldie";
                $_SESSION['erreur'] = ['desc' => $error, 'code' => 47];
            }
        } else {
            $error = 'Veuillez entrer votre adresse mail';
            $_SESSION['erreur'] = ['desc' => $error, 'code' => 47];
        }
    }
}

function reiniMDP($mdp1, $mdp2, $code) {
    if (isset($mdp1, $mdp2)) {
        $bdd = loaderBDD::connexionBDD();
        $verif_confirme = $bdd->prepare('SELECT confirme FROM recuperation WHERE code = ?');
        $verif_confirme->execute(array($code));
        $verif_confirme = $verif_confirme->fetch();
        $verif_confirme = $verif_confirme['confirme'];
        if ($verif_confirme == 1) {
            $mdp = htmlspecialchars($mdp1);
            $mdpc = htmlspecialchars($mdp2);
            if (!empty($mdp) AND!empty($mdpc)) {
                if ($mdp == $mdpc) {
                    $mdp = sha1($mdp);
                    $ins_mdp = $bdd->prepare('UPDATE client INNER JOIN recuperation ON client.Mail = recuperation.mail SET client.password = ? WHERE recuperation.code = ?');
                    $ins_mdp->execute(array($mdp, $code));
                    $del_req = $bdd->prepare('DELETE FROM recuperation WHERE code =? ');
                    $del_req->execute(array($code));
                    $_SESSION['erreur'] = ['desc' => 'OK', 'code' => -1];
                } else {
                    $error = "Vos mots de passes ne correspondent pas";
                    $_SESSION['erreur'] = ['desc' => $error, 'code' => 47];
                }
            } else {
                $error = "Veuillez valider votre grâce au code de vérification";
                $_SESSION['erreur'] = ['desc' => $error, 'code' => 47];
            }
        } else {
            $error = "Merci de remplir tous les champs avant de valider";
            $_SESSION['erreur'] = ['desc' => $error, 'code' => 47];
        }
    } else {
        $error = 'Veuillez remplr tous les champs';
        $_SESSION['erreur'] = ['desc' => $error, 'code' => 47];
    }
}
