<?php

if (isset($_POST['date']) && isset($_POST['heureD']) && isset($_POST['heureF']) && isset($_POST['heureF']) && isset($_POST['calcul'])) {
    if (!empty($_POST['date']) && !empty($_POST['heureD']) && !empty($_POST['heureF']) && !empty($_POST['heureF']) && !empty($_POST['calcul']))
    {
        $modif='&date=' . $_POST['date'] . '&heureD=' . $_POST['heureD'] . '&heureF=' . $_POST['heureF'];
        $heureD = new DateTime($_POST['heureD']);
        $heureF = new DateTime($_POST['heureF']);
        if ($heureD < $heureF) {
            $date = new DateTime($_POST['date']);
            $now = new DateTime("yesterday");
            if ($date > $now) {
                $price = 600;
                if(isset($_POST['skipper']))
                {
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
} else {
    header('Location: ../index?p=404');
}

