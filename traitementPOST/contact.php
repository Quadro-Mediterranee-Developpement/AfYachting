<?php

if (isset($_POST['nameuser']) && isset($_POST['email']) && isset($_POST['tel']) && isset($_POST['sujet']) && isset($_POST['message']) && isset($_POST['send'])) {
    $uname = $_POST['nameuser'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $sujet = $_POST['sujet'];
    $message = $_POST['message'];

    $email_to = 'contact@afyachting-location.com';
    $messageFinal = '
                <html>
                <head>
                  <title>Récupération de mot de passe - AfYachting</title>
                  <meta charset="utf-8" />
                </head>
                <body>        

  <font color="#303030";>
                    <div align="center">
                    <h1>' . $sujet . '</h1>
                    <h2>Message venant de <span style="color:red;">' . $uname . '</span> avec l\'adresse <a style="color:blue;">' . $email . '</a></h2>
                    <h3>Numéro de téléphone : <span style="color:Violet;">' . $tel . ' </span></h3>
                    <h4><p style="color:#669999;">' . $message . '</p></h4>
                    
                </div>
            
                </body>
                </html>';
    $passage_ligne = '\n';



    $headers .= "Reply-to: " . $uname . " <" . $email . ">" . $passage_ligne; //Emetteur
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= 'Content-Type:text/html; charset="utf-8"' . "\n";
    $headers .= 'Content-Transfer-Encoding: 8bit';

    $_SESSION['news']['location'] = ['desc' => 'Test en cours, Veuillez réessayer plus tard', 'code' => false];


    if (mail($email_to, $sujet, $messageFinal, $headers) == false) {
        $_SESSION['news']['location'] = ['desc' => 'Email non envoyé, Veuillez réessayer plus tard', 'code' => false];
        $erreur = "email non envoyé";
        $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 50];
    } else {
        $_SESSION['news']['location'] = ['desc' => 'Demande effectuée, veuillez attendre une réponse', 'code' => true];
    }
} else {
    $_SESSION['news']['location'] = ['desc' => 'Merci de remplir tous les champs', 'code' => false];

    $error = 'Merci de remplir tous les champs';
    $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 50];
    header("location:" . $_SERVER['HTTP_REFERER']);
}


header("location: ../index.php");
