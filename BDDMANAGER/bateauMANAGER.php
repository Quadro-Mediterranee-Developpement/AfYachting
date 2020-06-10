<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bateauMANAGER
 *
 * @author HugoMUSOLES
 */
class bateauMANAGER extends loaderBDD {

    public static function recupINFORMATIONall() {
        $requete = loaderBDD::connexionBDD()->prepare("SELECT Nom, Description,Modele,Passagers,Moteur,Longueur,Equipement,Divers,ID_images,HS,MS,BS,Caution,Age,State,Largeur,Prix FROM bateau LEFT JOIN location ON location.ID = bateau.ID_Location LEFT JOIN vente ON vente.ID = bateau.ID_Vente WHERE Password IS NOT NULL");
        $requete->execute();
        if (($retour = $requete->fetchAll())) {
            return $retour;
        }
    }

}
