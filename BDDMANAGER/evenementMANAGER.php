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
class evenementMANAGER extends loaderBDD {

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
        $contexteFormat = "m-d-Y";
        $maxHeure = 6;
        foreach ($tbl as $unique) {
            $Start = strtotime($unique['Start_Override']);
            $Stop = strtotime($unique['Stop_Override']);

            if (date("G", $Stop - $Start) > $maxHeure) {
                $retour[date($contexteFormat, $Start)] = 3;
            } else {
                if (date("G", $Stop) <= 14 && date("G", $Start) <= 14) {
                    if (isset($retour[date($contexteFormat, $Start)])) {
                        if ($retour[date($contexteFormat, $Start)] == 2) {
                            $retour[date($contexteFormat, $Start)] = 3;
                        }
                    } else {
                        $retour[date($contexteFormat, $Start)] = 1;
                    }
                } elseif (date("G", $Stop) >= 12 && date("G", $Start) >= 12) {
                    if (isset($retour[date($contexteFormat, $Start)])) {
                        if ($retour[date($contexteFormat, $Start)] == 1) {
                            $retour[date($contexteFormat, $Start)] = 3;
                        }
                    } else {
                        $retour[date($contexteFormat, $Start)] = 2;
                    }
                } else {
                    $retour[date($contexteFormat, $Start)] = 3;
                }
            }
        }
        
        return $retour;
    }

}
