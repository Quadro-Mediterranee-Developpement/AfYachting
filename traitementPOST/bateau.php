<?php

if (isset($_SESSION['ID']) && ($_SESSION['ID']['ROLE'] == 'client')) {
    var_dump(isset($_FILES["IDcard1"]));
    var_dump(isset($_FILES["IDcard2"]));
    var_dump(isset($_POST['validation']));
    var_dump(isset($_SESSION['locationEnCours']));
    if (isset($_FILES["IDcard1"]) && isset($_FILES["IDcard2"]) && isset($_POST['validation']) && isset($_SESSION['locationEnCours'])) {
        if (($_SESSION['locationEnCours']['skip'] == 'oui' || ($_SESSION['locationEnCours']['skip'] == 'non' && isset($_FILES["permis"])) && verifImage($_FILES["permis"])) && verifImage($_FILES["IDcard1"]) && verifImage($_FILES["IDcard2"])) {

            $perso = compteMANAGER::recupINFORMATIONone($_SESSION['ID']);

            $nom = $perso["Username"];
            $email_from = 'no-reply@afyachting-location.com';
            $message = '<div>
                    <h3>Récapitulatif</h3>
                    <p>Bateau : <span id="nom">' . $_SESSION['locationEnCours']['nom'] . '</span></p>
                    <p>Type : <span id="type">' . $_SESSION['locationEnCours']['type'] . '</span></p>
                    <p>Date : <span id="datage">' . $_SESSION['locationEnCours']['datage'] . '</span></p>
                    <p>Skypper : <span id="skip">' . $_SESSION['locationEnCours']['skip'] . '</span></p>
                    <p>Option : <span id="opt">' . $_SESSION['locationEnCours']['opt'] . '</span></p>
                    <p>Prix total: <span id="prixTotal">' . $_SESSION['locationEnCours']['prixTotal'] . '</span></p>
                </div>';


            if (preg_match("#@(hotmail|live|msn).[a-z]{2,4}$#", $email_from)) {
                $passage_ligne = "\n";
            } else {
                $passage_ligne = "\r\n";
            }

            $email_to = $perso["Mail"]; //Destinataire
            $email_subject = "location bateau"; //Sujet du mail


            $boundary = md5(rand()); // clé aléatoire de limite
            $headers = "From: " . $nom . "<" . $email_from . ">" . $passage_ligne; //Emetteur
            $headers .= "Reply-to: " . $nom . " <" . $email_from . ">" . $passage_ligne; //Emetteur
            $headers .= "Bcc: <admin@afyachting-location.com>" . $passage_ligne; //Emetteur
            $headers .= "MIME-Version: 1.0" . $passage_ligne; //Version de MIME
            $headers .= 'Content-Type: multipart/mixed; boundary=' . $boundary . ' ' . $passage_ligne; //Contenu du message (alternative pour deux versions ex:text/plain et text/html

            $email_message = '--' . $boundary . $passage_ligne; //Séparateur d'ouverture
            $email_message .= "Content-Type: text/plain; charset='utf-8'" . $passage_ligne; //Type du contenu
            $email_message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne; //Encodage
            $email_message .= $passage_ligne . $message . $passage_ligne; //Contenu du message

            $source = $_FILES['IDcard1']['tmp_name'];
            $type_fichier = $_FILES['IDcard1']['type'];
            $taille_fichier = $_FILES['IDcard1']['size'];

            $handle = fopen($source, 'r'); //Ouverture du fichier
            $content = fread($handle, $taille_fichier); //Lecture du fichier
            $encoded_content = chunk_split(base64_encode($content)); //Encodage
            $f = fclose($handle); //Fermeture du fichier

            $email_message .= $passage_ligne . "--" . $boundary . $passage_ligne; //Deuxième séparateur d'ouverture
            $email_message .= 'Content-type:' . $type_fichier . ';name="IDcard1"' . "n"; //Type de contenu (application/pdf ou image/jpeg)
            $email_message .= 'Content-Disposition: attachment; filename="IDcard1"' . "n"; //Précision de pièce jointe
            $email_message .= 'Content-transfer-encoding:base64' . "n"; //Encodage
            $email_message .= "n"; //Ligne blanche. IMPORTANT !
            $email_message .= $encoded_content . "n"; //Pièce jointe


            $source = $_FILES['IDcard2']['tmp_name'];
            $type_fichier = $_FILES['IDcard2']['type'];
            $taille_fichier = $_FILES['IDcard2']['size'];

            $handle = fopen($source, 'r'); //Ouverture du fichier
            $content = fread($handle, $taille_fichier); //Lecture du fichier
            $encoded_content = chunk_split(base64_encode($content)); //Encodage
            $f = fclose($handle); //Fermeture du fichier

            $email_message .= $passage_ligne . "--" . $boundary . $passage_ligne; //Deuxième séparateur d'ouverture
            $email_message .= 'Content-type:' . $type_fichier . ';name="IDcard2"' . "n"; //Type de contenu (application/pdf ou image/jpeg)
            $email_message .= 'Content-Disposition: attachment; filename="IDcard2"' . "n"; //Précision de pièce jointe
            $email_message .= 'Content-transfer-encoding:base64' . "n"; //Encodage
            $email_message .= "n"; //Ligne blanche. IMPORTANT !
            $email_message .= $encoded_content . "n"; //Pièce jointe


            if ($_SESSION['locationEnCours']['skip'] == 'non' && isset($_FILES["permis"])) {

                $source = $_FILES['permis']['tmp_name'];
                $type_fichier = $_FILES['permis']['type'];
                $taille_fichier = $_FILES['permis']['size'];

                $handle = fopen($source, 'r'); //Ouverture du fichier
                $content = fread($handle, $taille_fichier); //Lecture du fichier
                $encoded_content = chunk_split(base64_encode($content)); //Encodage
                $f = fclose($handle); //Fermeture du fichier

                $email_message .= $passage_ligne . "--" . $boundary . $passage_ligne; //Deuxième séparateur d'ouverture
                $email_message .= 'Content-type:' . $type_fichier . ';name="Permis"' . "n"; //Type de contenu (application/pdf ou image/jpeg)
                $email_message .= 'Content-Disposition: attachment; filename="Permis"' . "n"; //Précision de pièce jointe
                $email_message .= 'Content-transfer-encoding:base64' . "n"; //Encodage
                $email_message .= "n"; //Ligne blanche. IMPORTANT !
                $email_message .= $encoded_content . "n"; //Pièce jointe
            }

            if (mail($email_to, $email_subject, $email_message, $headers) == false) {
                $erreur = "email non envoier";
                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 50];
            } else {
                $_SESSION['news']['location'] = ['desc' => 'Demande effectuer, veuiller attendre une réponse', 'code' => true];
            }
        } else {
            $_SESSION['news']['location'] = ['desc' => 'Les donnée sont invalides', 'code' => false];
            $erreur = "image ou donnée non conforme";
            $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 50];
        }
    } else {
        $_SESSION['news']['location'] = ['desc' => 'Tout les documents ne sont pas complet', 'code' => false];
        $erreur = "tout les champs ne sont pas rempli";
        $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 50];
    }
} else {
    $erreur = "perdu";
    $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 50];
}

function verifImage($file) {
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        return false;
    }

    if ($file["size"] > 5000000) {
        return false;
    }

    $imageFileType = strtolower(pathinfo(basename($file["name"]), PATHINFO_EXTENSION));
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        return false;
    }

    return true;
}

header("location: ../index.php");
