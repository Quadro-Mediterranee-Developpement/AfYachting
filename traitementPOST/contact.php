<?php


if(isset($_POST['nameuser']) && isset($_POST['email']) && isset($_POST['tel']) && isset($_POST['sujet']) && isset($_POST['message']) && isset($_POST['send']))
{
    $uname=$_POST['nameuser'];
    $email=$_POST['email'];
    $tel=$_POST['tel'];
    $sujet=$_POST['sujet'];
    $message=$_POST['message'];
    
    
}
 else {
$error='Merci de remplir tous les champs';    
}

            $email_to='contact@afyachting-location.com';
            $messageFinal = '<div>
                    <h3>'.$sujet.'</h3>
                    <h2>Message venant de'.$uname.' avec l\'adresse '.$email.'</h2>
                    <h2>Numéro de téléphone :'.$tel.' </h2>
                    <p>'.$message.'</p>
                    
                </div>';
            $passage_ligne=\n;



            $headers .= "Reply-to: " . $uname . " <" . $email . ">" . $passage_ligne; //Emetteur
            $header = "MIME-Version: 1.0\r\n";
            $header .= 'Content-Type:text/html; charset="utf-8"' . "\n";
            $header .= 'Content-Transfer-Encoding: 8bit';

            
            if (mail($email_to, $sujet, $messageFinal, $headers) == false) {
                $_SESSION['news']['location'] = ['desc' => 'Email non envoyé, Veuillez réessayer plus tard', 'code' => false];
                $erreur = "email non envoier";
                $_SESSION['erreur'] = ['desc' => $erreur, 'code' => 50];
            } else {
                $_SESSION['news']['location'] = ['desc' => 'Demande effectuée, veuillez attendre une réponse', 'code' => true];
            }
        
header("location: ../index.php");
