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
        $requete = loaderBDD::connexionBDD()->prepare("SELECT bateau.ID AS 'Option',Nom, Description,Modele,Passagers,Moteur,Longueur,Equipement,Divers,ID_images,HS,MS,BS,Caution,Age,State,Largeur,Prix FROM bateau LEFT JOIN location ON location.ID = bateau.ID_Location LEFT JOIN vente ON vente.ID = bateau.ID_Vente WHERE Password IS NOT NULL");
        $requete->execute();
        if (($retour = $requete->fetchAll())) {
            return $retour;
        }
        return [];
    }
    
    public static function recupINFORMATIONone($id) {
        $requete = loaderBDD::connexionBDD()->prepare("SELECT bateau.ID AS 'Option',Nom, Description,Modele,Passagers,Moteur,Longueur,Equipement,Divers,ID_images,HS,MS,BS,Caution,Age,State,Largeur,Prix FROM bateau LEFT JOIN location ON location.ID = bateau.ID_Location LEFT JOIN vente ON vente.ID = bateau.ID_Vente WHERE (Password IS NOT NULL) AND bateau.ID = '".$id."'");
        $requete->execute();
        if (($retour = $requete->fetchAll())) {
            return $retour;
        }
        return [];
    }

    public static function recupOPTION($id) {
        $requete = loaderBDD::connexionBDD()->prepare("SELECT option_boat.Name AS name,option_boat.Description AS description,option_boat.Prix AS prix FROM option_boat INNER JOIN routageoption ON routageoption.ID_Option = option_boat.ID WHERE routageoption.ID_Bateau = $id");
        $requete->execute();
        if (($retour = $requete->fetchAll())) {
            return $retour;
        }
        return [];
    }

    public static function creatNEWboat($nom, $description, $nomModele, $moteur, $longueur, $nombrePassager, $Equipement, $divers) {
        $image = self::giveRefImage();
        $requete = loaderBDD::connexionBDD()->prepare("INSERT INTO bateau (Description, Nom, Modele, Passagers, Moteur,Longueur, Equipement, Divers,ID_images) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $requete->execute(array($description, $nom, $nomModele, $nombrePassager, $moteur, $longueur, $Equipement, $divers,$image));
        
    }

}
