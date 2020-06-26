<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header('Location: ../index?p=404');
    exit();
} else {
    require_once 'type_form.php';
    //TEXT
    // un peu partout
    function skippeur_creat_form() {
        ?>
        <h5 class="card-title text-center">Ajouter un skippeur</h5>
        <form method='POST' action='index.php' class="form-signin">
            <?php
            input_text("text", "inputUserame", "Username", "userName", "Username");
            input_text("email", "inputEmail", "Email address", "mail", "Email address");
            input_text("tel", "adminTel", "Téléphone", "phone", "Téléphone");
            echo '<hr>';
            input_text("password", "inputPassword", "Password", "password", "Password");
            input_text("password", "inputConfirmPassword", "Password", "passwordVerif", "Confirm password");
            ?>
            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name='skippeur'>Enregistrer</button>s
        </form>
        <?php
    }

}