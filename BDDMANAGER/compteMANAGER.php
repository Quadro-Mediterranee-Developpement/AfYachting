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

    private static function simpleREQUESTselect($condition, $table, $select) {
        $sql = "SELECT $select FROM $table WHERE $condition LIMIT 1";
        $requete = loaderBDD::connexionBDD()->query($sql);
        if ($requete) {
            return $requete->fetch();
        }
    }

    public static function recupIDone($password, $identifiant) {
        foreach (self::tables as $table) {
            if (empty($id = self::simpleREQUESTselect("(Username LIKE '$identifiant' OR Mail LIKE '$identifiant' OR Phone LIKE '$identifiant') AND Password LIKE '$password'", $table, "ID")) === false) {
                return ['ID' => $id['ID'], 'ROLE' => $table];
            }
        }
    }

    public static function recupINFORMATIONone($id) {

        if (empty($request = self::simpleREQUESTselect("ID LIKE " . $id['ID'], $id['ROLE'], "Username, Mail, Phone, Creation")) === false) {
            return $request;
        }
    }

    public static function recupINFORMATIONall($table) {
        if (empty($request = self::simpleREQUESTselect(1, $table, "Username, Mail, Phone, Creation")) === false) {
            return $request;
        }
    }

    public static function creatNEWuser($username, $password, $email, $phone, $table) {
        $time = DateTime::getTimestamp();
        $sql = "INSERT INTO $table (Username, Password, Mail, Phone, Creation) VALUES ('$username',  '$password', '$email', '$phone', '$time')";
        loaderBDD::connexionBDD()->exec($sql);
        return self::recupIDone($password,$username);
    }

    public static function recupIDby($username, $email) {
        foreach (self::tables as $table) {
            if (empty($id = self::simpleREQUESTselect("(Username LIKE '$username' OR Mail LIKE '$email')", $table, 'ID')) === false) {
                var_dump($id);
                return $id;
            }
        }
    }

}
