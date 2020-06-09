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
            $requete = loaderBDD::connexionBDD()->prepare("SELECT ID FROM $table WHERE (Username = ? OR Mail = ?) AND Password = ? AND Password IS NOT NULL");
            $requete->execute(array($identifiant, $identifiant, $password));

            if (($id = $requete->fetch())) {
                return ['ID' => $id['ID'], 'ROLE' => $table];
            }
        }
        return false;
    }

    public static function recupINFORMATIONone($id) {
        $requete = loaderBDD::connexionBDD()->prepare("SELECT Username, Mail, Phone, Creation FROM " . $id['ROLE'] . " WHERE ID = ? AND Password IS NOT NULL");
        $requete->execute(array($id['ID']));
        if (($retour = $requete->fetch())) {
            return $retour;
        }
    }

    public static function recupINFORMATIONall($table) {
        $requete = loaderBDD::connexionBDD()->prepare("SELECT Username, Mail, Phone, Creation, ID FROM $table WHERE ? AND Password IS NOT NULL");
        $requete->execute(array(1));
        if (($retour = $requete->fetchAll())) {
            return $retour;
        }
    }

    public static function creatNEWuser($username, $password, $email, $phone, $table) {
        $code = random_bytes(10);
        $requete = loaderBDD::connexionBDD()->prepare("INSERT INTO $table (Username, Password, Mail, Phone, valide) VALUES (?,  ?, ?, ?, ?)");
        $requete->execute(array($username, $password, $email, $phone, $code));
        return self::recupIDone($password, $username);
    }

    public static function creatNEWTEMPOuser($username, $email) { //a tester
        $requete = loaderBDD::connexionBDD()->prepare("INSERT INTO client_ponctuel (Username, Mail) VALUES (?, ?)");
        $requete->execute(array($username, $email));
        return ['ID' => $requete->lastInsertId(), 'ROLE' => 'client_ponctuel'];
    }

    public static function recupIDby($username, $email, $id = null, $tbl = null) {
        foreach (self::tables as $table) {
            $requete = null;
            if ($tbl != $table) {
                $requete = loaderBDD::connexionBDD()->prepare("SELECT ID FROM $table WHERE Username = ? OR Mail = ? AND Password IS NOT NULL");
                $requete->execute(array($username, $email));
            } else {

                $requete = loaderBDD::connexionBDD()->prepare("SELECT ID FROM $table WHERE (Username = ? OR Mail = ?) AND ID != ? AND Password IS NOT NULL");
                $requete->execute(array($username, $email, $id));
            }
            if (($id = $requete->fetch())) {
                return ['ID' => $id['ID'], 'ROLE' => $table];
            }
        }
    }

    public static function validedation($code) {
        foreach (self::tables as $table) {
            $requete = loaderBDD::connexionBDD()->prepare("SELECT ID FROM $table WHERE valide = ? AND Password IS NOT NULL");
            $requete->execute(array($code));
            if (($id = $requete->fetch())) {
                self::updateUSERone('valide', '0', $id['ID'], $table);
                return ['ID' => $id['ID'], 'ROLE' => $table];
            }
        }
        return false;
    }

    public static function updateUSERone($colname, $text, $id, $tbl) {
        $requete = loaderBDD::connexionBDD()->prepare("UPDATE $tbl SET $colname = ? WHERE ID = ? AND Password IS NOT NULL");
        $requete->execute(array($text, $id));
    }

    public static function verifActivate($id) {
        $requete = loaderBDD::connexionBDD()->prepare("SELECT Username FROM " . $id['ROLE'] . " WHERE ID = ? AND valide = ? AND Password IS NOT NULL");
        $requete->execute(array($id['ID'], '0'));
        if (($requete->fetch())) {
            return true;
        }
        return false;
    }

    public static function deleteID($id) {
        $requete = loaderBDD::connexionBDD()->prepare("UPDATE " . $id['ROLE'] . " set Password = ? WHERE ID = ? AND Password IS NOT NULL");
        $requete->execute(array(null,$id['ID']));
        if (($requete->fetch())) {
            return true;
        }
        return false;
    }

    public static function sendEmail($name, $mail, $code) {
        // Plusieurs destinataires
        $to = $mail; // notez la virgule
        // Sujet
        $subject = 'validation email afYachting';

        // message
        $message = '
     <html>
      <head>
       <title>validation email afYachting</title>
      </head>
      <body>
       <a href="https://afyachting.fr?p=accueil&validationEmail=' . $code . '">validation mail</p>
       <p>si le lien ne marche pas, copier coller celui ci dans l\'url : https://afyachting.fr?p=accueil&validationEmail=' . $code . '</p>
      </body>
     </html>
     ';

        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';

        // En-têtes additionnels
        $headers[] = "To: $name <$to>";
        $headers[] = 'From: afyachting <afyachting@no-reply.fr>';
        $headers[] = 'Cc: afyachting_archive@afyachting.com';

        // Envoi
        mail($to, $subject, $message, implode("\r\n", $headers));
    }

}
