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
class evenementMANAGER {

    public static function recupAllHoraireByBateau($id) {
        $requete = loaderBDD::connexionBDD()->prepare("SELECT Start_Override Stop_Override WHERE ID_Bateau = $id ORDER BY Start_Override");
        $requete->execute();
        if (($retour = $requete->fetchAll())) {
            return $retour;
        }
        return [];
    }

    public static function giveRefDate($tbl) {
        $retour = [];
        $maxHeure = (8 * 60 * 60);
        $maxDemiHeure = (8 * 60 * 60);
        foreach ($tbl as $unique) {
            if (time(strtotime($unique['Stop_Override']) - strtotime($unique['Start_Override'])) > $maxHeure) {
                $retour[date("Y-m-d", strtotime($unique['Start_Override']))] = 3;
            } elseif (time(strtotime($unique['Stop_Override']) - strtotime($unique['Start_Override'])) > $maxDemiHeure) {
                if (date("G", strtotime($unique['Stop_Override'])) < 14 && date("G", strtotime($unique['Start_Override'])) < 14) {
                    if (isset($retour[date("Y-m-d", strtotime($unique['Start_Override']))])) {
                        if ($retour[date("Y-m-d", strtotime($unique['Start_Override']))] == 2) {
                            $retour[date("Y-m-d", strtotime($unique['Start_Override']))] = 3;
                        }
                    } else {
                        $retour[date("Y-m-d", strtotime($unique['Start_Override']))] = 1;
                    }
                } elseif (date("G", strtotime($unique['Stop_Override'])) > 12 && date("G", strtotime($unique['Start_Override'])) > 12) {
                    if (isset($retour[date("Y-m-d", strtotime($unique['Start_Override']))])) {
                        if ($retour[date("Y-m-d", strtotime($unique['Start_Override']))] == 1) {
                            $retour[date("Y-m-d", strtotime($unique['Start_Override']))] = 3;
                        }
                    } else {
                        $retour[date("Y-m-d", strtotime($unique['Start_Override']))] = 2;
                    }
                }
            }
        }
        return $retour;
    }

}
