<?php

class loaderBDD {

    protected static function connexionBDD() {
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=afyachtingV2', 'root', '');
        } catch (Exception $e) {
            $bdd = new PDO('mysql:host=localhost:3308;dbname=afyachtingV2', 'root', '');
        }
        $bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $bdd;
    }

    public static function deleteID($id) {
        $requete = loaderBDD::connexionBDD()->prepare("UPDATE " . $id['ROLE'] . " set Password = ? WHERE ID = ? AND Password IS NOT NULL");
        $requete->execute(array(null, $id['ID']));
        if (($requete->fetch())) {
            return true;
        }
        return false;
    }

    public static function giveRefImage() {
        $new = loaderBDD::connexionBDD()->prepare("INSERT INTO `routageimage` (`ID`) VALUES (NULL);");
        $new->execute();
        $requete = loaderBDD::connexionBDD()->prepare("SELECT MAX(ID) FROM routageimage");
        $requete->execute();
        if (($retour = $requete->fetch())) {
            return $retour;
        }
    }

    public static function Addimage($url,$Alt_Descritpion,$selectid) {
        $requete = loaderBDD::connexionBDD()->prepare("INSERT INTO images (Url,Alt_Description,ID_select) VALUE (?,?,?)");
        $requete->execute(array($url,$Alt_Descritpion,$selectid));
    }

    public static function image($selectid) {
        $requete = loaderBDD::connexionBDD()->prepare("SELECT Url,Alt_Description FROM images WHERE ID_select = $selectid ");
        $requete->execute();
        if (($retour = $requete->fetchAll())) {
            return $retour;
        }
    }

}

require_once "compteMANAGER.php";
require_once "evenementMANAGER.php";
require_once "bateauMANAGER.php";
