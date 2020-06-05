<?php

if (isset($_POST['date']) && isset($_POST['heureD']) && isset($_POST['heureF']) && isset($_POST['calcul'])) {
    if (!empty($_POST['date']) && !empty($_POST['heureD']) && !empty($_POST['heureF']) && !empty($_POST['calcul'])) {
        $modif = '&date=' . $_POST['date'] . '&heureD=' . $_POST['heureD'] . '&heureF=' . $_POST['heureF'];
        $heureD = new DateTime($_POST['heureD']);
        $heureF = new DateTime($_POST['heureF']);
        if ($heureD < $heureF) {
            $date = new DateTime($_POST['date']);
            $now = new DateTime("yesterday");
            if ($date > $now) {
                $price = 600;
                if (isset($_POST['skipper'])) {
                    $price += 60;
                }
                header('Location: ../index?p=bateau&batID=' . $_POST['calcul'] . '&price=' . $price . $modif);
            } else {
                $_SESSION['erreur'] = ['desc' => 'la date est interieur a aujourd\'hui', 'code' => 12];
                header('Location: ../index?p=bateau&batID=' . $_POST['calcul'] . $modif);
            }
        } else {
            $_SESSION['erreur'] = ['desc' => 'l\'heure de debut et de fin sont inverser ', 'code' => 11];
            header('Location: ../index?p=bateau&batID=' . $_POST['calcul'] . $modif);
        }
    } else {
        $_SESSION['erreur'] = ['desc' => 'un champ est possiblement vide', 'code' => 10];
        header('Location: ../index?p=bateau&batID=' . $_POST['calcul']);
    }
} else if (isset($_POST['date']) && isset($_POST['heureD']) && isset($_POST['heureF']) && isset($_POST['payer'])) {
    if (!empty($_POST['date']) && !empty($_POST['heureD']) && !empty($_POST['heureF'])) {
        $modif = '&date=' . $_POST['date'] . '&heureD=' . $_POST['heureD'] . '&heureF=' . $_POST['heureF'];
        $heureD = new DateTime($_POST['heureD']);
        $heureF = new DateTime($_POST['heureF']);
        if ($heureD < $heureF) {
            $date = new DateTime($_POST['date']);
            $now = new DateTime("yesterday");
            if ($date > $now) {
                $price = 600;
                if (isset($_POST['skipper'])) {
                    $price += 60;
                }
                if (isset($_SESSION['ID'])) {
            
                    header('Location: https://www.paypal.com/fr/webapps/mpp/account-sign-up?gclsrc=aw.ds&gclid=CjwKCAjw2uf2BRBpEiwA31VZjxZo7ijwyV6nRdUOYjjGKjSey2nZ5CDpbT2GIa3qfd_ov_hBZx2-3RoCF4AQAvD_BwE&gclsrc=aw.ds');
                } else if (isset($_POST['userName']) && isset($_POST['mail'])) {
                    if (!empty($_POST['userName']) && !empty($_POST['mail'])) {
                        if (strlen($_POST['userName']) > 1 && strlen($_POST['userName']) < 16 && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                            $_SESSION['ID'] = compteMANAGER::creatNEWTEMPOuser($_POST['userName'], $_POST['mail']);
                            
                            header('Location: https://www.paypal.com/fr/webapps/mpp/account-sign-up?gclsrc=aw.ds&gclid=CjwKCAjw2uf2BRBpEiwA31VZjxZo7ijwyV6nRdUOYjjGKjSey2nZ5CDpbT2GIa3qfd_ov_hBZx2-3RoCF4AQAvD_BwE&gclsrc=aw.ds');
                        } else {
                            $_SESSION['erreur'] = ['desc' => 'maivais pseudo ou mauvais email', 'code' => 15];
                            header('Location: ../index?p=bateau&batID=' . $_POST['calcul'] . $modif);
                        }
                    } else {
                        $_SESSION['erreur'] = ['desc' => 'les champs sont vide', 'code' => 14];
                        header('Location: ../index?p=bateau&batID=' . $_POST['calcul'] . $modif);
                    }
                } else {
                    $_SESSION['erreur'] = ['desc' => 'connexion ou inscription ou rempliser les champs', 'code' => 13];
                    header('Location: ../index?p=bateau&batID=' . $_POST['calcul'] . $modif);
                }
            } else {
                $_SESSION['erreur'] = ['desc' => 'la date est interieur a aujourd\'hui', 'code' => 12];
                header('Location: ../index?p=bateau&batID=' . $_POST['calcul'] . $modif);
            }
        } else {
            $_SESSION['erreur'] = ['desc' => 'l\'heure de debut et de fin sont inverser ', 'code' => 11];
            header('Location: ../index?p=bateau&batID=' . $_POST['calcul'] . $modif);
        }
    } else {
        $_SESSION['erreur'] = ['desc' => 'un champ est possiblement vide', 'code' => 10];
        header('Location: ../index?p=bateau&batID=' . $_POST['calcul']);
    }
} else {
    header('Location: ../index?p=404');
}
