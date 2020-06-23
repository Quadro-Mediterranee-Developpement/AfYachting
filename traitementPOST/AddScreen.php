<?php

if (isset($_SESSION['ID']) && $_SESSION['ID']['ROLE'] == 'admin') {
    if (isset($_FILES["fileToUpload"]) && isset($_POST['id']) && isset($_POST['alt']) && isset($_POST['location']) && isset($_POST["submit"])) {
        $target_dir = "../img/" . $_POST['location'] . '/';
        if (file_exists($target_dir)) {
            $uploadOk = 1;

            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            if ($_FILES["fileToUpload"]["size"] > 5000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            $imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION));
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }



            $tempTarg = $target_dir;
            $i = 0;
            while (file_exists($tempTarg . basename($_FILES["fileToUpload"]["name"]))) {
                $i++;
                $tempTarg = $target_dir . "($i)";
                echo "Sorry, file already exists.";
            }
            $target_file = $tempTarg . basename($_FILES["fileToUpload"]["name"]);

            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    loaderBDD::Addimage($target_file, $_POST['alt'], $_POST['id']);
                    echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }
}