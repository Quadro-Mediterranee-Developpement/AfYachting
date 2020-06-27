<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of evenementMANAGER
 *
 * @author HugoMUSOLES
 */
class evenementMANAGER extends loaderBDD{

    public static function recupAllHoraireByBateau($id) {
        $requete = loaderBDD::connexionBDD()->prepare("SELECT Start_Override, Stop_Override FROM evenement WHERE ID_Bateau = $id ORDER BY Start_Override");
        $requete->execute();
        if (($retour = $requete->fetchAll())) {
            return $retour;
        }
        return [];
    }

    public static function giveRefDate($tbl) {
        $retour = [];
        
        $maxHeure = date('24 hours');
        $maxDemiHeure = date('7 hours');
        var_dump($tbl);
        foreach ($tbl as $unique) {
            $Start = strtotime($unique['Start_Override']);
            $Stop = strtotime($unique['Stop_Override']);
            $intervale = $Stop->diff($Start);
            if ($intervale > $maxHeure.time()) {
                $retour[date("Y-m-d", $Start)] = 3;
                var_dump($intervale);
                var_dump($maxHeure.time());
            } elseif ($intervale > $maxDemiHeure) {
                if (date("G", $Stop) <= 14 && date("G", $Start) <= 14) {
                    if (isset($retour[date("Y-m-d", $Start)])) {
                        if ($retour[date("Y-m-d", $Start)] == 2) {
                            $retour[date("Y-m-d", $Start)] = 3;
                        }
                    } else {
                        $retour[date("Y-m-d", $Start)] = 1;
                    }
                } elseif (date("G", $Stop) >= 12 && date("G", $Start) >= 12) {
                    if (isset($retour[date("Y-m-d", $Start)])) {
                        if ($retour[date("Y-m-d", $Start)] == 1) {
                            $retour[date("Y-m-d", $Start)] = 3;
                        }
                    } else {
                        $retour[date("Y-m-d", $Start)] = 2;
                    }
                }
            }
        }
        var_dump($retour);
        return $retour;
    }

}
