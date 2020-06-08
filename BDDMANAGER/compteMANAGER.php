<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of compteMANAGER
 *
 * @author HugoMUSOLES
 */
class compteMANAGER extends loaderBDD {

    private const tables = ["admin", "client", "skipper"];

    public static function recupIDone($password, $identifiant) {
        foreach (self::tables as $table) {
            $requete = loaderBDD::connexionBDD()->prepare("SELECT ID FROM $table WHERE (Username = ? OR Mail = ?) AND Password = ?");
            $requete->execute(array($identifiant, $identifiant, $password));

            if (($id = $requete->fetch())) {
                return ['ID' => $id['ID'], 'ROLE' => $table];
            }
        }
        return false;
    }

    public static function recupINFORMATIONone($id) {
        $requete = loaderBDD::connexionBDD()->prepare("SELECT Username, Mail, Phone, Creation FROM " . $id['ROLE'] . " WHERE ID = ?");
        $requete->execute(array($id['ID']));
        if (($retour = $requete->fetch())) {
            return $retour;
        }
    }

    public static function recupINFORMATIONall($table) {
        $requete = loaderBDD::connexionBDD()->prepare("SELECT Username, Mail, Phone, Creation FROM $table WHERE 1");
        $requete->execute();
        if (($retour = $requete->fetch())) {
            return $retour;
        }
    }

    public static function creatNEWuser($username, $password, $email, $phone, $table) {
        $requete = loaderBDD::connexionBDD()->prepare("INSERT INTO $table (Username, Password, Mail, Phone) VALUES (?,  ?, ?, ?)");
        $requete->execute(array($username, $password, $email, $phone));
        return self::recupIDone($password, $username);
    }

    public static function creatNEWTEMPOuser($username, $email) { //a tester
        $requete = loaderBDD::connexionBDD()->prepare("INSERT INTO client_ponctuel (Username, Mail) VALUES (?, ?)");
        $requete->execute(array($username, $email));
        return ['ID' =>  $requete->lastInsertId(), 'ROLE' => 'client_ponctuel'];
    }

    public static function recupIDby($username, $email) {
        foreach (self::tables as $table) {
            $requete = loaderBDD::connexionBDD()->prepare("SELECT ID FROM $table WHERE Username = ? OR Mail = ?");
            $requete->execute(array($username, $email));
            if (($id = $requete->fetch())) {
                return ['ID' => $id['ID'], 'ROLE' => $table];
            }
        }
    }

}
