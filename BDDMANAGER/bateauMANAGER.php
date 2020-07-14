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
        $requete = loaderBDD::connexionBDD()->prepare("SELECT bateau.ID AS 'Option',Nom, Description,Modele,Passagers,Moteur,Longueur,Equipement,Divers,ID_images,ID_entreprise,HS,MS,BS,Caution,Age,State,Largeur,Prix FROM bateau LEFT JOIN location ON location.ID = bateau.ID_Location LEFT JOIN vente ON vente.ID = bateau.ID_Vente WHERE Password IS NOT NULL");
        $requete->execute();
        if (($retour = $requete->fetchAll())) {
            return $retour;
        }
        return [];
    }

    public static function recupINFORMATIONallLocation() {
        $requete = loaderBDD::connexionBDD()->prepare("SELECT bateau.ID AS 'Option',Nom, Description,Modele,Passagers,Moteur,Longueur,Equipement,Divers,ID_images,ID_entreprise,HS,MS,BS,Caution FROM bateau INNER JOIN location ON location.ID = bateau.ID_Location WHERE Password IS NOT NULL");
        $requete->execute();
        if (($retour = $requete->fetchAll())) {
            return $retour;
        }
        return [];
    }

    public static function recupINFORMATIONallVente() {
        $requete = loaderBDD::connexionBDD()->prepare("SELECT bateau.ID AS 'Option',Nom, Description,Modele,Passagers,Moteur,Longueur,Equipement,Divers,ID_images,ID_entreprise,Age,State,Largeur,Prix FROM bateau INNER JOIN vente ON vente.ID = bateau.ID_Vente WHERE Password IS NOT NULL");
        $requete->execute();
        if (($retour = $requete->fetchAll())) {
            return $retour;
        }
        return [];
    }

    public static function recupINFORMATIONallbyEntreprise($id) {
        $requete = loaderBDD::connexionBDD()->prepare("SELECT bateau.ID AS 'Option',Nom, Description,Modele,Passagers,Moteur,Longueur,Equipement,Divers,ID_images,HS,MS,BS,Caution,Age,State,Largeur,Prix FROM bateau LEFT JOIN location ON location.ID = bateau.ID_Location LEFT JOIN vente ON vente.ID = bateau.ID_Vente WHERE Password IS NOT NULL AND ID_entreprise = $id");
        $requete->execute();
        if (($retour = $requete->fetchAll())) {
            return $retour;
        }
        return [];
    }

    public static function recupINFORMATIONone($id) {
        $requete = loaderBDD::connexionBDD()->prepare("SELECT bateau.ID AS 'Option',Nom, Description,Modele,Passagers,Moteur,Longueur,Equipement,Divers,ID_images,HS,MS,BS,Caution,Age,State,Largeur,Prix FROM bateau LEFT JOIN location ON location.ID = bateau.ID_Location LEFT JOIN vente ON vente.ID = bateau.ID_Vente WHERE (Password IS NOT NULL) AND bateau.ID = '" . $id . "'");
        $requete->execute();
        if (($retour = $requete->fetchAll())) {
            return $retour;
        }
        return [];
    }

    public static function recupOPTION($id) {
        $requete = loaderBDD::connexionBDD()->prepare("SELECT option_boat.Name AS name,option_boat.Description AS description,option_boat.Prix AS prix, option_boat.ID AS ID FROM option_boat INNER JOIN routageoption ON routageoption.ID_Option = option_boat.ID WHERE routageoption.ID_Bateau = $id");
        $requete->execute();
        if (($retour = $requete->fetchAll())) {
            return $retour;
        }
        return [];
    }

    public static function creatNEWboat($nom, $description, $nomModele, $moteur, $longueur, $nombrePassager, $Equipement, $divers, $id = 0) {
        $image = self::giveRefImage();
        $requete = loaderBDD::connexionBDD()->prepare("INSERT INTO bateau (Description, Nom, Modele, Passagers, Moteur,Longueur, Equipement, Divers,ID_images,ID_entreprise) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $requete->execute(array($description, $nom, $nomModele, $nombrePassager, $moteur, $longueur, $Equipement, $divers, $image, $id));
    }

    public static function creatNEWoption($nom, $desc, $prix, $id) {
        $requete = loaderBDD::connexionBDD()->prepare("INSERT INTO option_boat ( Name,Description, Prix) VALUES ( ?, ?, ?)");
        $requete->execute(array($nom, $desc, $prix));

        $requete = loaderBDD::connexionBDD()->prepare("SELECT MAX(ID) FROM option_boat");
        $requete->execute();
        if (($retour = $requete->fetch())) {
            $requete = loaderBDD::connexionBDD()->prepare("INSERT INTO routageoption ( ID_Bateau,ID_Option) VALUES ( ?, ?)");
            $requete->execute(array($id, $retour[0]));
        }
    }

    public static function confirmeDonneeImage($id) {
        $requete = loaderBDD::connexionBDD()->prepare("SELECT ID_entreprise AS 'ID_entreprise' FROM bateau WHERE ID_images = $id ");
        $requete->execute();
        if (($retour = $requete->fetchAll())) {
            if (isset($retour[0])) {
                return $retour[0]['ID_entreprise'];
            }
        }
        return 0;
    }

    public static function deleteOption($id) {
        $requete = loaderBDD::connexionBDD()->prepare("DELETE FROM option_boat WHERE ID = $id ");
        $requete->execute();
        $requete = loaderBDD::connexionBDD()->prepare("DELETE FROM routageoption WHERE ID_Option = $id ");
        $requete->execute();
    }

    public static function confirmeOption($id, $idPero) {
        $requete = loaderBDD::connexionBDD()->prepare("SELECT EXISTS( SELECT * FROM routageoption INNER JOIN bateau ON routageoption.ID_bateau = bateau.ID WHERE routageoption.ID_Option = $id AND bateau.ID_entreprise = $idPero)");
        $requete->execute();
        if (($retour = $requete->fetch())) {
            return $retour[0];
        }
        return 0;
    }

    public static function creatLocation($HS, $BS, $Caution, $id) {
        $requete = loaderBDD::connexionBDD()->prepare("SELECT bateau.ID_Location FROM bateau WHERE Password IS NOT NULL AND ID = $id");
        $requete->execute();
        if (($retour = $requete->fetch())) {
            if ($retour[0] == 0) {
                $requete = loaderBDD::connexionBDD()->prepare("INSERT INTO location ( HS,MS, BS,Caution) VALUES ( ?, ?, ?, ?)");
                $requete->execute(array($HS,$BS,0, $Caution));

                $requete = loaderBDD::connexionBDD()->prepare("SELECT MAX(ID) FROM location");
                $requete->execute();
                if (($retour = $requete->fetch())) {
                    $requete = loaderBDD::connexionBDD()->prepare("UPDATE bateau SET ID_Location = ? WHERE ID = ? AND Password IS NOT NULL");
                    $requete->execute(array($retour[0], $id));
                }
            } else {
                $requete = loaderBDD::connexionBDD()->prepare("UPDATE location SET HS = ?, MS = ?, BS = ? , Caution = ? WHERE ID = ?");
                $requete->execute(array($HS,$BS,0, $Caution,$retour[0]));
            }
        }
    }

    public static function supprLocation($id) {
        $requete = loaderBDD::connexionBDD()->prepare("SELECT bateau.ID_Location FROM bateau WHERE Password IS NOT NULL AND ID = $id");
        $requete->execute();
        if (($retour = $requete->fetch())) {
            $requete = loaderBDD::connexionBDD()->prepare("DELETE FROM location WHERE ID = $retour[0] ");
            $requete->execute();
            $requete = loaderBDD::connexionBDD()->prepare("UPDATE bateau SET ID_Location = ? WHERE ID = ? AND Password IS NOT NULL");
            $requete->execute(array(0, $id));
        }
    }

        public static function creatVente($Age, $State, $Largeur,$Prix, $id) {
        $requete = loaderBDD::connexionBDD()->prepare("SELECT bateau.ID_Vente FROM bateau WHERE Password IS NOT NULL AND ID = $id");
        $requete->execute();
        if (($retour = $requete->fetch())) {
            if ($retour[0] == 0) {
                
                $requete = loaderBDD::connexionBDD()->prepare("INSERT INTO vente ( Age, State, Largeur, Prix) VALUES ( ?, ?, ?, ?)");
                $requete->execute(array($Age, $State, $Largeur,$Prix));

                $requete = loaderBDD::connexionBDD()->prepare("SELECT MAX(ID) FROM vente");
                $requete->execute();
                if (($retour = $requete->fetch())) {
                    $requete = loaderBDD::connexionBDD()->prepare("UPDATE bateau SET ID_Vente = ? WHERE ID = ? AND Password IS NOT NULL");
                    $requete->execute(array($retour[0], $id));
                }
            } else {
                $requete = loaderBDD::connexionBDD()->prepare("UPDATE vente SET Age = ?, State = ?, Largeur = ?, Prix = ? WHERE ID = ?");
                $requete->execute(array($Age, $State, $Largeur,$Prix,$retour[0]));
            }
        }
    }

    public static function supprVente($id) {
        $requete = loaderBDD::connexionBDD()->prepare("SELECT bateau.ID_Vente FROM bateau WHERE Password IS NOT NULL AND ID = $id");
        $requete->execute();
        if (($retour = $requete->fetch())) {
            $requete = loaderBDD::connexionBDD()->prepare("DELETE FROM vente WHERE ID = $retour[0] ");
            $requete->execute();
            $requete = loaderBDD::connexionBDD()->prepare("UPDATE bateau SET ID_Vente = ? WHERE ID = ? AND Password IS NOT NULL");
            $requete->execute(array(0, $id));
        }
    }
}
