<?php
session_start();
unset($_SESSION['erreur']);
?>
<!DOCTYPE html>
<!--
Site officiel de la société AfYachting
Créé par QMD : Quadro Méditerranée Développement


Administration : Ange CAESARI
Architecture : Adrien ROUPIE
Front : Paul-Emile NEU
Back : Hugo MUSOLES
-->
<html lang="fr">
    <?php
    require 'BDDMANAGER/loaderBDD.php';

    if (isset($_GET["p"])) {
        $p = filter_input(INPUT_GET, "p");
    } else if (isset($_POST['connect']) && isset($_POST['userName']) && isset($_POST['password'])) {
        if (!empty($_POST['userName']) AND!empty($_POST['password'])) {
            $userNameConnect = htmlspecialchars($_POST['userName']);
            $passwordConnect = sha1($_POST['password']);
            if (empty($id = compteMANAGER::recupIDone($passwordConnect, $userNameConnect)) === false) {
                $_SESSION['ID'] = $id;
                $p = 'accueil';
            } else {
                $p = 'connexion';
                $_SESSION['erreur'] = ['desc' => 'mauvais identifiant ou mot de passe', 'code' => 1];
            }
        } else {
            $p = 'connexion';
            $_SESSION['erreur'] = ['desc' => 'champ mot de passe ou identifiant vide', 'code' => 2];
        }
    } else if (isset($_POST['userName']) && isset($_POST['mail']) && isset($_POST['password']) && isset($_POST['passwordVerif']) && isset($_POST['inscription'])) {
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
                                    $p = 'accueil';
                                } else {
                                    $p = "inscription";
                                    $erreur = "erreur inconnue, l'inscription à échouer";
                                    $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 3];
                                }
                            } else {
                                $p = "inscription";
                                $erreur = "email, nom ou telephone deja existant";
                                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 9];
                            }
                        } else {
                            $p = "inscription";
                            $erreur = "le nom d'utilisateur n'es pas correcte";
                            $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 4];
                        }
                    } else {
                        $p = "inscription";
                        $erreur = "l'email n'es pas correcte";
                        $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 5];
                    }
                } else {
                    $p = "inscription";
                    $erreur = "le mot de passe n'es pas correcte";
                    $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 6];
                }
            } else {
                $p = "inscription";
                $erreur = "la confirmation du mot de passe a echouer";
                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 7];
            }
        } else {
            $p = "inscription";
            $erreur = "Tous les champs doivent être  complétés !";
            $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 8];
        }
    } else {
        $p = "accueil";
    }
    $erreur = "Tous les champs doivent être  complétés !";
    $menu = ["Accueil" => "Accueil", "Bateau" => "Bateau", "Connexion" => "Connexion", "Contact" => "Contact", "Inscription" => "Inscription", "Location" => "Location", "Ventes" => "Ventes"];
    if (isset($_SESSION['ID'])) {
        unset($menu["Connexion"]);
        unset($menu["Inscription"]);
        $menu['Compte'] = 'Compte';
    }

    $page = "pages/" . $p . ".php";

    if (is_file($page)) {
        require $page;
    } else {
        require "pages/404.php";
    }
    ?>
</html>