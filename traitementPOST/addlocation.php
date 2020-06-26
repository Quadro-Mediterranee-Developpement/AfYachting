<?php

if (isset($_POST['submit'])) {


    if (isset($_POST['description']) && isset($_POST['nom']) && isset($_POST['modele']) && isset($_POST['nombrePassager']) && isset($_POST['moteur']) && isset($_POST['longueur']) && isset($_POST['equipement']) && isset($_POST['divers'])) {


        if (!empty($_POST['description']) && !empty($_POST['nom']) && !empty($_POST['modele']) && !empty($_POST['nombrePassager']) && !empty($_POST['moteur']) && !empty($_POST['longueur']) && !empty($_POST['equipement']) && !empty($_POST['divers'])) {

            if (isset($_FILES['fileName']) AND!empty($_FILES['fileName']['name'])) {
                $tailleMax = 2097152;
                $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
                if ($_FILES['fileName']['size'] <= $tailleMax) {
                    $extensionUpload = strtolower(substr(strrchr($_FILES['fileName']['name'], '.'), 1));
                    if (in_array($extensionUpload, $extensionsValides)) {
                        $chemin = "../pictures/bateaux" . $_SESSION['id'] . "." . $extensionUpload;
                        $resultat = move_uploaded_file($_FILES['fileName']['tmp_name'], $chemin);
                        if ($resultat) {
                            
                            $updateavatar = $bdd->prepare('UPDATE bateau SET image = :image WHERE id = :id');
                            $updateavatar->execute(array(
                                'image' => $_SESSION['id'] . "." . $extensionUpload,
                                'id' => $_SESSION['id']
                            ));
                            echo 'ouiiiii';
                        } else {
                            $msg = "Erreur durant l'importation de votre photo de profil";
                        }
                    } else {
                        $msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
                    }
                } else {
                    $msg = "Votre photo de profil ne doit pas dépasser 2Mo";
                }
            }

            $description = htmlspecialchars($_POST['description']);
            $nom = htmlspecialchars($_POST['nom']);
            $modele = htmlspecialchars($_POST['modele']);

            $nombrePassager = htmlspecialchars($_POST['nombrePassager']);
            $moteur = htmlspecialchars($_POST['moteur']);
            $longueur = htmlspecialchars($_POST['longueur']);
            $equipement = htmlspecialchars($_POST['equipement']);
            $divers = htmlspecialchars($_POST['divers']);

            $descriptionLenght = strlen("$description");

            if ($descriptionLenght <= 1000) {

                $reqNom = $bdd->prepare("SELECT * FROM bateau WHERE Nom = ? ");
                $reqNom->execute(array($nom));
                $nomExist = $reqNom->rowCount();
                if ($nomExist == 0) {
                    $reqModele = $bdd->prepare("SELECT * FROM bateau WHERE Modele = ?");
                    $reqModele->execute(array($modele));
                    $modeleExist = $reqModele->rowCount();
                    if ($modeleExist == 0) {
                        $insertusr = $bdd->prepare("INSERT INTO bateau(Description, Nom, Modele, Passagers, Moteur, Longueur, Equipement, Divers) VALUES (?,?,?,?,?,?,?,?)");
                        $insertusr->execute(array($description, $nom, $modele, $nombrePassager, $moteur, $longueur, $equipement, $divers));
                        header('Location: locationForm.php?bateauCrée');
                        $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                        echo"creationOK";
                    } else {
                        $erreur = "les mots de passe doivent être identiques";
                        echo"erreur mdp";
                    }
                } else {
                    $erreur = "au autre bateau du même nom est enregistré !";
                    echo"erreur nom bateaux";
                }
            } else {
                $erreur = "Votre nom d'utilisateur ne doit pas dépasser les 256 caractères ! ";
                echo"erreur mdp";
            }
        } else {
            $erreur = "Tous les champs doivent être  complétés !";
            echo"erreur vide";
        }
    }
} else {
    echo"error pas de submit";
}