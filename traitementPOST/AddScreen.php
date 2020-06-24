<?php

if (isset($_SESSION['ID']) && $_SESSION['ID']['ROLE'] == 'admin') {
    if (isset($_FILES["fileToUpload"]) && isset($_POST['id']) && isset($_POST['alt']) && isset($_POST['location']) && isset($_POST["submit"])) {
        $target_dir = "../img/" . $_POST['location'] . '/';
        if (file_exists($target_dir)) {
            $uploadOk = 1;

            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $erreur = "File is not an image.";
                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 50];
                $uploadOk = 0;
            }

            if ($_FILES["fileToUpload"]["size"] > 5000000) {
                $erreur = "Sorry, your file is too large.";
                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 50];
                $uploadOk = 0;
            }

            $imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION));
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $erreur = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 50];
                $uploadOk = 0;
            }



            $tempTarg = $target_dir;
            $i = 0;
            while (file_exists($tempTarg . basename($_FILES["fileToUpload"]["name"]))) {
                $i++;
                $tempTarg = $target_dir . "($i)";
            }
            $target_file = $tempTarg . basename($_FILES["fileToUpload"]["name"]);

            if ($uploadOk == 0) {
                $erreur = "Sorry, your file was not uploaded.";
                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 50];
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    loaderBDD::Addimage($target_file, $_POST['alt'], $_POST['id']);
                } else {
                    $erreur = "Sorry, there was an error uploading your file.";
                    $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 50];
                }
            }
        }
    }
}

header("location:".  $_SERVER['HTTP_REFERER']); 