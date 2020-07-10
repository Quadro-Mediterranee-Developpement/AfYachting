<?php

session_start();
require_once '../BDDMANAGER/loaderBDD.php';
require_once '../utilityPhp/verificationType.php';
$retour = [];
$tbl = [$_POST['type'], $_POST['ID'], $_POST['dure'], $_POST['date'], $_POST['skipper']];
if (verificationType::isseter($tbl)) {
    if ($_POST['type'] == 'boatLoc') {
        $infoo = bateauMANAGER::recupINFORMATIONone(intval($_POST['ID']));
        $horaire = evenementMANAGER::recupAllHoraireByBateau($_POST['ID']);
        $driverdate = preg_split('/,/', $_POST['date']);
        $retour['IdBoat'] = intval($_POST['ID']);
        $convert = evenementMANAGER::giveRefDate($horaire);
        $retour['prixTotal'] = 0;
        $plusieurDate = -1;
        $retour['error'] = 0;
        switch ($_POST['dure']) {
            case 'matin':
                $retour['type'] = 'matin';
                if (dayGood($driverdate[0], $convert, 1)) {
                    $plusieurDate = 2;
                }
                break;
            case "apresmidi":
                $retour['type'] = 'après midi';
                if (dayGood($driverdate[0], $convert, 2)) {
                    $plusieurDate = 2;
                }
                break;
            case "jour":
                $retour['type'] = 'journée';
                if (dayGood($driverdate[0], $convert, 3)) {
                    $plusieurDate = 1;
                }
                break;
            case "jours":
                $retour['type'] = 'plusieurs jours';
                $plusieurDate = 0;
                break;
            default:
                $retour['type'] = 'indéfini';
                $retour['error'] = -3;
                break;
        }
        if ($plusieurDate == 0) {
            if (strtotime($driverdate[0]) > strtotime($driverdate[1])) {
                $tp = $driverdate[0];
                $driverdate[0] = $driverdate[1];
                $driverdate[1] = $tp;
            }
            $retour['datage'] = "du " . date("d-m-Y", strtotime($driverdate[0])) . " au " . date("d-m-Y", strtotime($driverdate[1]));
            $oh1 = periode($driverdate[0]);
            $oh2 = periode($driverdate[1]);
            if ($oh1 > 0 && $oh2 > 0) {
                $nbr = nbrDaysGood($driverdate[0], $driverdate[1], $convert);
                if ($nbr < 1) {
                    $retour['type'] = "formulaire invalide, veuiller recomencer plus tard";
                    $retour['error'] = -3;
                } elseif ($oh1 == 2 || $oh2 == 2) {
                    $retour['prixTotal'] += $infoo[0]['HS'] * $nbr;
                } else {
                    $retour['prixTotal'] += $infoo[0]['BS'] * $nbr;
                }
            } else {
                $retour['type'] = "date cale seche";
                $retour['error'] = -2;
            }
        } else if ($plusieurDate > 0) {
            $retour['datage'] = "le " . date("d-m-Y", strtotime($driverdate[0]));
            $oh = periode($driverdate[0]);
            if ($oh == 1) {
                $retour['prixTotal'] += $infoo[0]['BS'] / $plusieurDate;
            } else if ($oh == 2) {
                $retour['prixTotal'] += $infoo[0]['HS'] / $plusieurDate;
            } else {
                $retour['type'] = "date de cale seche";
                $retour['error'] = -2;
            }
        } else {
            $retour['type'] = "formulaire invalide, veuiller recomencer plus tard";
            $retour['error'] = -3;
        }

        if ($_POST['skipper'] == "true") {
            $retour['skip'] = "oui";
            $retour['prixTotal'] += 50;
        } else {
            $retour['skip'] = "non";
        }



        $retour['nom'] = $infoo[0]["Nom"];
        if (isset($_POST['option'])) {
            $alloption = bateauMANAGER::recupOPTION(intval($_POST['ID']));
            $retour['opt'] = "";

            foreach ($alloption as $i) {
                if (mb_substr_count($_POST['option'], $i['ID'])) {
                    $retour['opt'] .= $i['name'] . ", ";
                    $retour['prixTotal'] += $i['prix'];
                }
            }
        }
        if ($retour['error'] >= 0) {
            $_SESSION['locationEnCours'] = $retour;
            if (isset($_SESSION["ID"])) {
                    $retour['error'] = 0;
            } else {
                $retour['error'] = 1;
            }
        }
    } else {
        $retour['type'] = "formulaire invalide, veuiller recomencer plus tard";
        $retour['error'] = -3;
    }
} else {
    $retour['type'] = "formulaire invalide, veuiller recomencer plus tard";
    $retour['error'] = -3;
}

echo json_encode($retour);

function periode($date) {
    $HS = [[strtotime("1 Jun 1977"), strtotime("31 August 1977")], [strtotime('28 September 1977'), strtotime('15 October 1977')]];
    $BS = [[strtotime('1 March 1977'), strtotime('30 Jun 1977')], [strtotime('16 October 1977'), strtotime('31 October 1977')]];
    $between = strtotime(date("d M", strtotime($date)) . " 1977");
    for ($i = 0; $i < 2; $i++) {
        if ($HS[$i][0] <= $between && $HS[$i][1] >= $between) {
            return 2;
        } else if ($BS[$i][0] <= $between && $BS[$i][1] >= $between) {
            return 1;
        }
    }

    return 0;
}

function nbrDaysGood($date1, $date2, $exlu) {
    $nbr = 0;
    $time = (strtotime($date2) - strtotime($date1)) / (strtotime("2 day") - strtotime("1 day"));
    if ($time > 7) {
        return 0;
    } else {
        for ($i = 0; $i < $time; $i++) {
            if (dayGood(date("d-m-Y", strtotime($date1) + ((strtotime("2 day") - strtotime("1 day")) * $i)), $exlu, 3)) {
                $nbr++;
            } else {
                return 0;
            }
        }
    }
    return $nbr;
}

function dayGood($date, $exlu, $like) {
    if (strtotime($date) < strtotime('today')) {
        return false;
    } else if (isset($exlu[date("m-d-Y", strtotime($date))])) {
        if ($exlu[date("m-d-Y", strtotime($date))] == 3) {
            return false;
        } else if ($exlu[date("m-d-Y", strtotime($date))] == $like) {
            return false;
        }
    }
    return true;
}

